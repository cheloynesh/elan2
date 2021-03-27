<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Insurance;
use App\Profile;

class InsuranceController extends Controller
{
    public function index(){
        $insurances = Insurance::get();
        $prof = Profile::pluck('name','id');
        // dd($prof);
        return view('admin.insurance.insurances', compact('insurances','prof'));
    }

    public function GetInfo($id)
    {
        $insurance = Insurance::where('id',$id)->first();
        return response()->json(['status'=>true, "data"=>$insurance]);
    }

    public function store(Request $request)
    {
        $insurance = new Insurance;
        $insurance->name = $request->name;
        $insurance->save();
        return response()->json(["status"=>true, "message"=>"Aseguradora creada"]);
    }

    public function update(Request $request, $id)
    {
        $insurance = Insurance::where('id',$request->id)->update(['name'=>$request->name]);
        return response()->json(['status'=>true, 'message'=>"Aseguradora actualizada"]);
    }

    public function destroy($id)
    {
        $insurance = Insurance::find($id);
        $insurance->delete();
        return response()->json(['status'=>true, "message"=>"Aseguradora eliminada"]);
    }
}
