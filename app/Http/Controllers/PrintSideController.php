<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PrintSide;

class PrintSideController extends Controller
{
      public function getPrintSideJSON(){
          $data = PrintSide::orderBy('title', 'asc')->get();

            return response()->json([
                'status' => "1",
                'message' => "Success",
                'data' => $data,
            ], 200);
      }

      public function addPrintSide(Request $request){
          $this->validate($request, [
            "title" => "required|unique:print_side|max:50",
          ]);

          PrintSide::create($request->all());

          return redirect()->back()->withErrors(['message'=>'Print side added successfully']);
      }
}
