<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Place;
use Illuminate\Http\Request;

class PlaceController extends Controller
{

    public function list(){
    $places = Place::all();
    
    $response = [];
    
    foreach ($places as $place) {
        $average_rating = $place->comments()->avg('rating');

        $object = [
            "id" => $place->id,
            "user_id"=>$place->user_id,
            "name" => $place->name,
            "description"=> $place->description,
            "location" => $place->location,
            "contact" => $place->contact,
            "imagen" => $place->imagen,
            "category" => $place->category->type,
            "rating" => round($average_rating, 1)
        ];
        $response[] = $object;
    }

    return response()->json($response);
}

public function getByUser($id){
        $places= Place::where('user_id', '=', $id)-> get();
        $response = [];
        foreach ($places as $place) {
        $average_rating = $place->comments()->avg('rating');

        $object = [
            "id" => $place->id,
            "user_id"=>$place->user_id,
            "name" => $place->name,
            "description"=> $place->description,
            "location" => $place->location,
            "contact" => $place->contact,
            "imagen" => $place->imagen,
            "category" => $place->category->type,
            "rating" => round($average_rating, 1)
        ];
        $response[]= $object;
    }
            return response()->json($response);
        }

    public function getById($id){
        $places= Place::where('id', '=', $id)-> get();
        $response = [];
        foreach ($places as $place) {
        $average_rating = $place->comments()->avg('rating');

        $object = [
            "id" => $place->id,
            "user_id"=>$place->user_id,
            "name" => $place->name,
            "description"=> $place->description,
            "location" => $place->location,
            "contact" => $place->contact,
            "imagen" => $place->imagen,
            "category" => $place->category->type,
            "rating" => round($average_rating, 1)
        ];
        $response[]= $object;
    }
            return response()->json($response);
        }

        public function create(Request $request){
            $data = $request->validate([
                'user_id'=>'required|numeric',
                'name'=>'required|min:5',
                'description'=>'required|min:10',
                'location'=>'required|min:10',
                'contact'=>'min:10',
                'imagen' => 'required|min:10',
                'category_id'=>'required|numeric'
            ]);
            $place = Place::create([
                'user_id'=>$data['user_id'],
                'name'=>$data['name'],
                'description'=>$data['description'],
                'location'=>$data['location'],
                'contact'=>$data['contact'],
                'imagen'=>$data['imagen'],
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
                'id'=>'required|numeric',
                'name'=>'required|min:5',
                'description' => 'required|min:10',
                'location'=>'required|min:10',
                'contact'=>'required|min:10',
                'imagen' => 'required|min:10',
                'category_id'=>'required|numeric'
            ]);
        
            $place = Place::where('id', '=', $data['id'])->first();
        
            if($place){
                $old_data = $place->replicate();
        
                $place->name = $data['name'];
                $place->description = $data['description'];
                $place->location = $data['location'];
                $place->contact = $data['contact'];
                $place->imagen = $data['imagen'];
                $place->category_id = $data['category_id'];
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

        public function searchByCategory($searchTerm)
{
    $places = Place::where(function ($query) use ($searchTerm) {
        $query->where('name', 'like', "%$searchTerm%")
              ->orWhereHas('category', function ($query) use ($searchTerm) {
                  $query->where('type', 'like', "%$searchTerm%");
              });
    })->get();

    $response = [];
    foreach ($places as $place) {
        $average_rating = $place->comments()->avg('rating');
        if ($place->category) {
            $object = [
                "id" => $place->id,
                "user_id"=>$place->user_id,
                "name" => $place->name,
                "description" => $place->description,
                "location" => $place->location,
                "contact" => $place->contact,
                'imagen' =>$place->imagen,
                "category" => $place->category->type,
                "rating" => round($average_rating, 1)
            ];
            $response[] = $object;
        }
    }

    return response()->json($response);
}


}
