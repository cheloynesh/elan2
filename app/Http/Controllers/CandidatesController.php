<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Status;
use App\Permission;
use App\Candidates;
use DB;

class CandidatesController extends Controller
{
    public function index(){
        $profile = User::findProfile();
        $perm = Permission::permView($profile,29);
        $perm_btn =Permission::permBtns($profile,29);
        $candidates = DB::select('call candidatesTable()');
        $cmbStatus = Status::select('id','name')
        ->where("fk_section","29")
        ->pluck('name','id');
        // dd($perm_btn);
        if($perm==0)
        {
            return redirect()->route('home');
        }
        else
        {
            return view('hiring.control.candidates', compact('perm_btn','candidates','cmbStatus'));
        }
    }

    public function updateStatus(Request $request)
    {
        $status = Candidates::where('id',$request->id)->first();
        // dd($status);
        $status->first_status = $request->status;
        $status->save();

        $profile = User::findProfile();
        $perm_btn =Permission::permBtns($profile,14);
        $candidates = $this->ReturnData($profile);

        return response()->json(['status'=>true, "message"=>"Estatus Actualizado", "candidates" => $candidates, "profile" => $profile, "permission" => $perm_btn]);
    }

    public function ReturnData($profile)
    {
        $candidates = DB::select('call candidatesTable()');

        return $candidates;
    }

    public function GetInfo($id)
    {
        $candidate = Candidates::where('id',$id)->first();
        // dd($candidate);
        return response()->json(['status'=>true, "data"=>$candidate]);
    }
}
