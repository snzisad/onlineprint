<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PrintRate;

class RateController extends Controller
{
    public function getPrintRateJSON(Request $request){

        $data = PrintRate::where('print_color_id', $request->color)
                ->where('print_type_id', $request->print_type)
                ->where('print_side_id', $request->print_side)
                ->where('paper_size_id', $request->paper_size)
                ->where('paper_type_id', $request->paper_type)
                ->first();

        return response()->json([
            'status' => "1",
            'message' => "Success",
            'data' => $data,
        ], 200);
    }

    public function addPrintRate(Request $request){

        $this->validate($request, [
            'print_color_id' => 'required|integer',
            'print_type_id' => 'required|integer',
            'print_side_id' => 'required|integer',
            'paper_size_id' => 'required|integer',
            'paper_type_id' => 'required|integer',
            'rate' => 'required',
        ]);


        $rate = PrintRate::where('print_color_id', $request->print_color_id)
                  ->where('print_type_id', $request->print_type_id)
                  ->where('print_side_id', $request->print_side_id)
                  ->where('paper_size_id', $request->paper_size_id)
                  ->where('paper_type_id', $request->paper_type_id)
                  ->first();

        if($rate){
          $rate->rate = $request->rate;
          $rate->save();
        }
        else{
            PrintRate::create($request->all());
        }

        return redirect()->back()->withErrors(['message'=>"Print rate updated successfully"]);
    }
}
