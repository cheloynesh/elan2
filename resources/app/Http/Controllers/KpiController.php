<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Permission;
use App\Branch;
use App\Insurance;
use App\Profile;
use DB;
use DateTime;

class KpiController extends Controller
{
    public function index ()
    {
        $profile = User::findProfile();
        $perm = Permission::permView($profile,25);
        $perm_btn =Permission::permBtns($profile,25);
        $insurances = Insurance::orderBy('name')->pluck('name','id');
        $branches = Branch::orderBy('name')->pluck('name','id');
        $arrayAux = array();
        $today = new DateTime();
        $sinister = DB::select('call kpiSinister(?,?,?,?,?)',["%","%","%","%",$today->format('Y')]);
        $initials = DB::select('call kpiInitial(?,?,?,?,?)',["%","%","%","%",$today->format('Y')]);
        $services = DB::select('call kpiServices(?,?,?,?,?)',["%","%","%","%",$today->format('Y')]);
        $pay = DB::select('call kpiPaid(?,?,?,?,?)',["%","%","%","%",$today->format('Y')]);
        // dd($siniestros[0]->CountIngr,$servicios,$initials);
        if($perm==0)
        {
            return redirect()->route('home');
        }
        else
        {
            return view('reports.kpi.kpi', compact('perm_btn','insurances','branches','sinister','initials','services','pay'));
        }
    }
    public function GetInfo($id)
    {
        date_default_timezone_set('America/Mexico_City');
        $today = new DateTime();
        $sinister = DB::select('call kpiSinister(?,?,?,?,?)',["%","%","%","%",$today->format('Y')]);
        $initials = DB::select('call kpiInitial(?,?,?,?,?)',["%","%","%","%",$today->format('Y')]);
        $services = DB::select('call kpiServices(?,?,?,?,?)',["%","%","%","%",$today->format('Y')]);
        $pay = DB::select('call kpiPaid(?,?,?,?,?)',["%","%","%","%",$today->format('Y')]);
        return response()->json(['status'=>true, "sinister"=>$sinister, "initials" => $initials, "services" => $services, "pay" => $pay]);
    }
    public function GetInfoFilters(Request $request)
    {
        date_default_timezone_set('America/Mexico_City');
        $today = new DateTime();
        $sinister = DB::select('call kpiSinister(?,?,?,?,?)',[$request->branch,$request->insurance,$request->month,$request->quarter,$today->format('Y')]);
        $initials = DB::select('call kpiInitial(?,?,?,?,?)',[$request->branch,$request->insurance,$request->month,$request->quarter,$today->format('Y')]);
        $services = DB::select('call kpiServices(?,?,?,?,?)',[$request->branch,$request->insurance,$request->month,$request->quarter,$today->format('Y')]);
        $pay = DB::select('call kpiPaid(?,?,?,?,?)',[$request->branch,$request->insurance,$request->month,$request->quarter,$today->format('Y')]);
        // dd($request->all());
        return response()->json(['status'=>true, "sinister"=>$sinister, "initials" => $initials, "services" => $services, "pay" => $pay]);
    }
}
