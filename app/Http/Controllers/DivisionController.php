<?php

namespace App\Http\Controllers;
use App\Division;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    public function getDivisionJSON(){
        $data = Division::orderBy('title', 'ASC')->get();

        return response()->json([
            'status' => "1",
            'message' => "Success",
            'data' => $data,
        ], 200);
    }

    public function addDivision(Request $request){

        $this->validate($request, [
            'title' => 'required|unique:division|max:50'
        ]);

        Division::create($request->all());

        return redirect()->back()->withErrors(['message'=>'Division added successfully']);
    }
}
