<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\PaperSize;

class PaperSizeController extends Controller
{
      public function getPaperSizeJSON(){
          $data = PaperSize::orderBy('title', 'asc')->get();

            return response()->json([
                'status' => "1",
                'message' => "Success",
                'data' => $data,
            ], 200);
      }

      public function addPaperSize(Request $request){
          $this->validate($request, [
            "title" => "required|unique:paper_size|max:50",
          ]);

          PaperSize::create($request->all());

          return redirect()->back()->withErrors(['message'=>'Paper size added successfully']);
      }
}
