<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function list(){
        $categories = Category::all();
        $list = [];

        foreach($categories as $category){
            $object = [
                "id" => $category->id,
                "type" => $category->type
            ];
            array_push($list ,$object);
        }
        return response()->json($list);
    }

    public function getById($id){
        $category= Category::where('id', '=', $id)-> first();
            $object = [
                'id' => $category->id,
                'type' => $category->type
            ];
            return response()->json($object);
        }

    public function create(Request $request){
        $data = $request->validate([
            'type'=>'required|min:4'
        ]);
        $category = Category::create([
            'type'=>$data['type']
        ]);
        if($category){
            $object = [
                "response"=>'Success. Item Create',
                'data'=>$category
            ];
            return response()->json($object);
        }else{
            $object = [
                "response"=>'Error'
            ];
            return response()->json($object);
        }
    }

    public function update(Request $request){
        $data = $request->validate([
            'id' => 'required|integer|min:1',
            'type' => 'required|min:4'
        ]);
    
        $category = Category::where('id', '=', $data['id'])->first();
    
        if($category){
            $old_data = $category->replicate();
    
            $category->type = $data['type'];
            if($category->save()){
                $object = [
                    "response" => 'Success. Item Update',
                    "old" => $old_data,
                    "new" => $category
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