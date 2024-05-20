<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Status;
use App\Permission;
use App\Candidates;
use DB;

class HiringReportController extends Controller
{
    public function index()
    {
        $profile = User::findProfile();
        $perm = Permission::permView($profile,31);
        $perm_btn =Permission::permBtns($profile,31);
        $reports = DB::select('call hiringReport()');
        // dd($candidates);
        $cmbStatus = Status::select('id','name')
        ->where("fk_section","31")
        ->pluck('name','id');
        // dd($perm_btn);
        if($perm==0)
        {
            return redirect()->route('home');
        }
        else
        {
            return view('hiring.report.hiringReport', compact('perm_btn','reports','cmbStatus'));
        }
    }
}
