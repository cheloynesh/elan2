<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Status;
use App\Permission;
use App\Candidates;
use DB;

class NewAgentController extends Controller
{
    public function index()
    {
        $profile = User::findProfile();
        $perm = Permission::permView($profile,30);
        $perm_btn =Permission::permBtns($profile,30);
        $candidates = DB::select('call newAgentTable()');
        // dd($candidates);
        $cmbStatus = Status::select('id','name')
        ->where("fk_section","30")
        ->pluck('name','id');
        // dd($perm_btn);
        if($perm==0)
        {
            return redirect()->route('home');
        }
        else
        {
            return view('hiring.control.newagent', compact('perm_btn','candidates','cmbStatus'));
        }
    }
    public function GetTable($id)
    {
        $candidates = DB::select('call newAgentTable()');
        // dd($candidates);
        return response()->json(['status'=>true, "data"=>$candidates]);
    }
}
