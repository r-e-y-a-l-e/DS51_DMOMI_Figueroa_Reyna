<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function upload(Request $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            return response()->json(['image' => $imageName], 200);
        } else {
            return response()->json(['error' => 'No se ha proporcionado ninguna imagen'], 400);
        }
    }
}