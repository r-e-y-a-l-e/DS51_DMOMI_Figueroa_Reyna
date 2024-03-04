<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function list(){
        $ratings = Rating::all();
        $list = [];
        
        foreach($ratings as $rating){
            $object = [
                "id" => $rating -> id,
                "Usuario" => $rating -> user_id,
                "Lugar" => $rating->place_id,
                "Comentario" => $rating ->comment_id,
                "Calificacion" => $rating ->rating
            ];
            array_push($list, $object);
        }
        return response()->json($list);
    }

    public function getById($id){
        $rating= Rating::where('id', '=', $id)-> first();
            $object = [
                "id" => $rating -> id,
                "Usuario" => $rating -> user_id,
                "Lugar" => $rating->place_id,
                "Comentario" => $rating ->comment_id,
                "Calificacion" => $rating ->rating
            ];
            return response()->json($object);
        }

        public function create(Request $request){
            $data = $request->validate([
                'user_id'=>'required|numeric',
                'comment_id'=>'required|numeric',
                'place_id'=>'required|numeric',
                'rating'=>'required|numeric|min:0|max:5'
            ]);
            $rating = Rating::create([
                'rating'=>$data['rating']
            ]);
            if($rating){
                return response()->json([
                    'message' => 'Operacion Exitosa',
                    'data' => $rating
                ]);
            }else{
                return response()->json([
                    'message' => 'Error'
                ]);
            }
        }

        public function update(Request $request){
            $data = $request->validate([
                'user_id'=>'required|numeric',
                'comment_id'=>'required|numeric',
                'place_id'=>'required|numeric',
                'rating'=>'required|numeric|min:0|max:5'
            ]);
        
            $rating = Rating::where('id', '=', $data['id'])->first();
        
            if($rating){
                $old_data = $rating->replicate();
        
                $rating->type = $data['user_id'];
                $rating->type = $data['place_id'];
                $rating->type = $data['comment_id'];
                $rating->type = $data['rating'];
                if($rating->save()){
                    $object = [
                        "response" => 'Success. Item Update',
                        "old" => $old_data,
                        "new" => $rating
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
}
