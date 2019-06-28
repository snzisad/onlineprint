<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Courier;
use App\CourierBranch;

class CourierController extends Controller
{
    public function getCourierJSON(){
        $data = Courier::orderBy('title', 'ASC')->get();

        return response()->json([
            'status' => "1",
            'message' => "Success",
            'data' => $data,
        ], 200);
    }

    public function getCourierBranchJSON($courier_id){
        $data = CourierBranch::where("courier_id", $courier_id)->orderBy('title', 'ASC')->get();

        return response()->json([
            'status' => "1",
            'message' => "Success",
            'data' => $data,
        ], 200);
    }

    public function addCourier(Request $request){
        $this->validate($request, [
            'title' => 'required|unique:courier|max:50'
        ]);

        Courier::create($request->all());

        return redirect()->back()->withErrors(['message'=>'Courier added successfully']);
    }

    public function addBranch(Request $request){
        $this->validate($request, [
            'title' => 'required|max:50',
            'courier_id' => 'required|integer',
        ]);

        CourierBranch::create($request->all());

        return redirect()->back()->withErrors(['message'=>'Courier branch added successfully']);
    }
}
