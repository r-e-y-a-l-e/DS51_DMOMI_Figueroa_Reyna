<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Recommendation;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function list(){
        $users = User::all();
        $list = [];

        foreach($users as $user){
            $object = [
                "id" => $user->id,
                "Name" => $user->name,
                "Email" => $user->email
            ];
            array_push($list ,$object);
        }
        return response()->json($list);
    }

    public function getById($id){
        $user= User::where('id', '=', $id)-> first();
            $object = [
                "id" => $user->id,
                "Name" => $user->name,
                "Email" => $user->email
            ];
            return response()->json($object);
        }

        public function create(Request $request){
            $data = $request->validate([
                'name'=>'required|min:3',
                'email'=>'required'
            ]);
            $user = User::create([
                'name'=>$data['name'],
                'email'=>$data['email']
            ]);
            if($user){
                return response()->json([
                    'message' => 'Operacion Exitosa',
                    'data' => $user
                ]);
            }else{
                return response()->json([
                    'message' => 'Error'
                ]);
            }
        }

        public function update(Request $request){
            $data = $request->validate([
                'id' => 'required|integer|min:1',
                'name'=>'required|min:3',
                'email'=>'required',
                'password'=>'required|min:8'
            ]);
        
            $user = User::where('id', '=', $data['id'])->first();
        
            if($user){
                $old_data = $user->replicate();
        
                $user->type = $data['name'];
                $user->type = $data['email'];
                $user->type = $data['password'];
                if($user->save()){
                    $object = [
                        "response" => 'Success. Item Update',
                        "old" => $old_data,
                        "new" => $user
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

        public function getUsers($name){
            $users = User::where('name', 'like', "%$name%")->get();
            $response = [];
            foreach ($users as $user) {
                $object = [
                    "id" => $user->id,
                    "Nombre" => $user->name,
                    "Email" => $user->email
                ];
                $response[] = $object;
            }
            return response()->json($response);
        }
    
        
}
