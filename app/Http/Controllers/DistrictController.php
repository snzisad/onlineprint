<?php

namespace App\Http\Controllers;

use App\District;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    public function getDistrictJSON($div_id){
        if($div_id!=0){
          $data = District::where("division_id", $div_id)->orderBy('title', 'ASC')->get();
        }
        else {
          $data = District::orderBy('title', 'ASC')->get();
        }

        return response()->json([
            'status' => "1",
            'message' => "Success",
            'data' => $data,
        ], 200);
    }

    public function addDistrict(Request $request){
        $this->validate($request, [
            'title' => 'required|max:50',
            'division_id' => 'required|integer',
        ]);

        District::create($request->all());

        return redirect()->back()->withErrors(['message'=>'District added successfully']);
    }
}
