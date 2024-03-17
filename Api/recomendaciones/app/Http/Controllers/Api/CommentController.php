<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function list(){
        $comments = Comment::all();
        $list = [];
        
        foreach($comments as $comment){
            $object = [
                "id" => $comment -> id,
                "user" => $comment -> user->name,
                "Lugar" => $comment->place->name,
                "Comment" => $comment -> comment
            ];
            array_push($list, $object);
        }
        return response()->json($list);
    }

    public function getById($id) {
    $comments = Comment::where('place_id', '=', $id)->get();

    $response = [];
    foreach ($comments as $comment) {
        $object = [
            "id" => $comment->id,
            "user" => $comment->user->name,
            "Lugar" => $comment->place->name,
            "Comment" => $comment->comment,
            "rating" => $comment->rating
        ];
        $response[] = $object;
    }

    return response()->json($response);
}
    
        public function create(Request $request){
            $data = $request->validate([
                'user_id'=>'required|numeric',
                'place_id'=>'required|numeric',
                'comment'=>'required|min:16|max:200',
                'rating' => 'min:1'
            ]);
            $comment = Comment::create([
                'user_id' => $data['user_id'],
                'place_id' => $data['place_id'],
                'comment'=>$data['comment'],
                'rating' =>$data['rating']
            ]);
            if($comment){
                return response()->json([
                    'message' => 'Operacion Exitosa',
                    'data' => $comment
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
                'place_id'=>'required|numeric',
                'comment'=>'required|min:16|max:200'
            ]);
        
            $comment = Comment::where('id', '=', $data['id'])->first();
        
            if($comment){
                $old_data = $comment->replicate();
        
                $comment->type = $data['user_id'];
                $comment->type = $data['place_id'];
                $comment->type = $data['comment'];
                if($comment->save()){
                    $object = [
                        "response" => 'Success. Item Update',
                        "old" => $old_data,
                        "new" => $comment
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
