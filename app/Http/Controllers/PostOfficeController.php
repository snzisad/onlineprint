<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PostOffice;

class PostOfficeController extends Controller
{
    public function getPostOfficeJSON($upa_id){
        $data = PostOffice::where("upazila_id", $upa_id)->orderBy('title', 'ASC')->get();

        return response()->json([
            'status' => "1",
            'message' => "Success",
            'data' => $data,
        ], 200);
    }

    public function addPostOffice(Request $request){
        $this->validate($request, [
            'title' => 'required|max:50',
            'upazila_id' => 'required|integer',
        ]);

        PostOffice::create($request->all());

        return redirect()->back()->withErrors(['message'=>'Post office added successfully']);
    }
}
