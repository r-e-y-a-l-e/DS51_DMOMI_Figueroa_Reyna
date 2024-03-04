<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Place;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    public function list()        {
        $places = Place::all();
        return response()->json($places);
        $list = [];
        foreach ($places as $place) {
            if ($place->category) {
                $object = [
                    "id" => $place->id,
                    "Nombre" => $place->name,
                    "Ubicacion" => $place->location,
                    "Contacto" => $place->contact,
                    "Categoria" => $place->category->type
                ];
                $list[] = $object;
            }
        }

        return response()->json($list);
    }

    public function getById($id){
        $place= Place::where('id', '=', $id)-> first();
        $object = [
            "id" => $place->id,
            "Nombre" => $place->name,
            "Ubicacion" => $place->location,
            "Contacto" => $place->contact,
            "Categoria" => $place->category->type
        ];
            return response()->json($object);
        }

        public function create(Request $request){
            $data = $request->validate([
                'name'=>'required|min:5',
                'location'=>'required|min:10',
                'contact'=>'required|min:10',
                'category_id'=>'required|numeric'
            ]);
            $place = Place::create([
                'name'=>$data['name'],
                'location'=>$data['location'],
                'contact'=>$data['contact'],
                'category_id'=>$data['category_id']
            ]);
            if($place){
                return response()->json([
                    'message' => 'Operacion Exitosa',
                    'data' => $place
                ]);
            }else{
                return response()->json([
                    'message' => 'Error'
                ]);
            }
        }

        public function update(Request $request){
            $data = $request->validate([
                'name'=>'required|min:5',
                'location'=>'required|min:10',
                'contact'=>'required|min:10',
                'category_id'=>'required|numeric'
            ]);
        
            $place = Place::where('id', '=', $data['id'])->first();
        
            if($place){
                $old_data = $place->replicate();
        
                $place->type = $data['name'];
                $place->type = $data['location'];
                $place->type = $data['contact'];
                $place->type = $data['categry_id'];
                if($place->save()){
                    $object = [
                        "response" => 'Success. Item Update',
                        "old" => $old_data,
                        "new" => $place
                    ];
                    return response()->json($object);
                } else {
                    $object = [
                        "response" => 'Error.'
                    ];
                    return response()->json($object);
                }
            }
        }

        public function searchByCategory($category)
        {
            $places = Place::whereHas('category', function ($query) use ($category) {
                    $query->where('type', 'like', "%$category%");
                })
                ->get();

            $response = [];
            foreach ($places as $place) {
                if ($place->category) {
                    $object = [
                        "id" => $place->id,
                        "Nombre" => $place->name,
                        "Ubicacion" => $place->location,
                        "Contacto" => $place->contact,
                        "Categoria" => $place->category->type
                    ];
                    $response[] = $object;
                }
            }

            return response()->json($response);
        }

}
