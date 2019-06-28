<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Upazila;

class UpazilaController extends Controller
{
    public function getUpazilaJSON($dist_id){
        if($dist_id!=0){
          $data = Upazila::where("district_id", $dist_id)->orderBy('title', 'ASC')->get();
        }
        else{
            $data = Upazila::orderBy('title', 'ASC')->get();
        }

        return response()->json([
            'status' => "1",
            'message' => "Success",
            'data' => $data,
        ], 200);
    }

    public function addUpazila(Request $request){
        $this->validate($request, [
            'title' => 'required|max:50',
            'district_id' => 'required|integer',
        ]);

        Upazila::create($request->all());

        return redirect()->back()->withErrors(['message'=>'Upazila added successfully']);
    }
}
