<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Recommendation;
use Illuminate\Http\Request;

class RecommendationController extends Controller
{
    public function list(){
            $recommendations = Recommendation::with([ 'comment', 'rating', 'user'])->get();
            
            $response = [];
            
            foreach ($recommendations as $recommendation) {
                $object = [
                    "id" => $recommendation->id,
                    "user_id" => $recommendation->user->name,
                    "place_id" => $recommendation->place->name,
                    "category"  => $recommendation->place->category->type,
                    "comment_id" => $recommendation->comment->comment,
                    "rating_id" => $recommendation->rating->rating,
                    "imagen" => $recommendation->imagen
                ];
                $response[] = $object;
            }
    
            return response()->json($response);
    }
    

    public function getById($id){
        $recommendation= Recommendation::where('id', '=', $id)-> first();
            $object = [
                "id" => $recommendation->id,
                "user_id" => $recommendation->user->name,
                "place_id" => $recommendation->place->name,
                "comment_id" => $recommendation->comment->comment,
                "rating_id" => $recommendation->rating->rating,
                "imagen" => $recommendation->imagen
        ];
            return response()->json($object);
        }

        public function create(Request $request){
            $data = $request->validate([
                'user_id' => 'required|integer',
                'place_id' => 'required|integer',
                'comment' => 'required|integer',
                'rating' => 'required|integer',
            ]);
            $recommendation = Recommendation::create([
                'user_id'=>$data['user_id'],
                'place_id'=>$data['place_id'],
                'comment_id'=>$data['comment_id'],
                'rating_id'=>$data['rating_id']
            ]);
            if($recommendation){
                return response()->json([
                    'message' => 'Operacion Exitosa',
                    'data' => $recommendation
                ]);
            }else{
                return response()->json([
                    'message' => 'Error'
                ]);
            }
        }

        public function update(Request $request){
            $data = $request->validate([
                'user_id' => 'required|integer',
                'place_id' => 'required|integer',
                'comment' => 'required|integer',
                'rating' => 'required|integer',
            ]);
        
            $recommendation = Recommendation::where('id', '=', $data['id'])->first();
        
            if($recommendation){
                $old_data = $recommendation->replicate();
        
                $recommendation->type = $data['user_id'];
                $recommendation->type = $data['place_id'];
                $recommendation->type = $data['comment_id'];
                $recommendation->type = $data['rating_id'];
                if($recommendation->save()){
                    $object = [
                        "response" => 'Success. Item Update',
                        "old" => $old_data,
                        "new" => $recommendation
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
    
        public function getUserRecommendations($userName)
        {
            $recommendations = Recommendation::whereHas('user', function ($query) use ($userName) {
                    $query->where('name', $userName);
                })
                ->with(['place.category', 'comment', 'rating', 'user', 'category'])
                ->get();

            $response = [];
            foreach ($recommendations as $recommendation) {
                $object = [
                    "recommendation_id" => $recommendation->id,
                    "category_type" => $recommendation->place->category->type,
                    "place_name" => $recommendation->place->name,
                    "comment" => $recommendation->comment->comment,
                    "rating" => $recommendation->rating->rating,
                    "user_name" => $recommendation->user->name
                ];
                $response[] = $object;
            }

            return response()->json($response);
        }

        public function myrecommendations($user_id)
{
    $recommendations = Recommendation::where('user_id', $user_id)
        ->with(['place.category', 'comment', 'rating', 'user'])
        ->get();

    $response = [];
    foreach ($recommendations as $recommendation) {
        $object = [
            "recommendation_id" => $recommendation->id,
            "category_type" => $recommendation->place->category->type,
            "place_name" => $recommendation->place->name,
            "comment" => $recommendation->comment->comment,
            "rating" => $recommendation->rating->rating,
            "user_name" => $recommendation->user->name
        ];
        $response[] = $object;
    }

    return response()->json($response);
}

}

