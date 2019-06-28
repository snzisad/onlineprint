<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PrintType;

class PrintTypeController extends Controller
{
      public function getPrintTypeJSON(){
          $data = PrintType::orderBy('title', 'asc')->get();

            return response()->json([
                'status' => "1",
                'message' => "Success",
                'data' => $data,
            ], 200);
      }

      public function addPrintType(Request $request){
          $this->validate($request, [
            "title" => "required|unique:print_type|max:50",
          ]);

          PrintType::create($request->all());

          return redirect()->back()->withErrors(['message'=>'Print type added successfully']);
      }
}
