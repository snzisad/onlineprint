<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PaperType;

class PaperTypeController extends Controller
{
      public function getPaperTypeJSON(){
          $data = PaperType::orderBy('title', 'asc')->get();

            return response()->json([
                'status' => "1",
                'message' => "Success",
                'data' => $data,
            ], 200);
      }

      public function addPaperType(Request $request){
          $this->validate($request, [
            "title" => "required|unique:paper_type|max:50",
          ]);

          PaperType::create($request->all());

          return redirect()->back()->withErrors(['message'=>'Paper type added successfully']);
      }
}
