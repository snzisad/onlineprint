<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PrintColor;

class PrintColorController extends Controller
{
    public function getPrintColorJSON(){
        $data = PrintColor::orderBy('title', 'asc')->get();

          return response()->json([
              'status' => "1",
              'message' => "Success",
              'data' => $data,
          ], 200);
    }

    public function addColor(Request $request){
        $this->validate($request, [
          "title" => "required|unique:print_color|max:50",
        ]);

        PrintColor::create($request->all());

        return redirect()->back()->withErrors(['message'=>'Color added successfully']);
    }
}
