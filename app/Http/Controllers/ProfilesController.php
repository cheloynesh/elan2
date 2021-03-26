<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
class ProfilesController extends Controller
{
    public function index(){
        $profiles = Profile::get();
        return view('admin.profile.profiles', compact('profiles'));
    }

    public function GetInfo($id)
    {
        $profile = Profile::where('id',$id)->first();
        // dd($profile);
        return response()->json(['status'=>true, "data"=>$profile]);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $profile = new Profile;
        $profile->name = $request->name;
        $profile->save();
        return response()->json(["status"=>true, "message"=>"Perfil Creado"]);
    }

    public function update(Request $request, $id)
    {
        $profile = Profile::where('id',$request->id)->update(['name'=>$request->name]);
        return response()->json(['status'=>true, 'message'=>"Perfil Actualizado"]);
    }

    public function destroy($id)
    {
        $profile = Profile::find($id);
        $profile->delete();
        return response()->json(['status'=>true, "message"=>"Perfil eliminado"]);
    }
}
