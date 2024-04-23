<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permission;
use App\Branch;
use App\Insurance;
use App\Profile;
use App\User;
use DB;
use DateTime;
use App\Exports\ExportHome;
use Maatwebsite\Excel\Facades\Excel;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        date_default_timezone_set('America/Mexico_City');
        $today = new DateTime();

        $profile = User::findProfile();
        $perm = Permission::permView($profile,14);
        $perm_btn =Permission::permBtns($profile,14);
        $user = User::user_id();

        if($profile != 12)
            $data = DB::select('call homescreen(?,?,?)',[intval($today->format('m')),$today->format('Y'),$today->format('Y-m-d')]);
        else
            $data = DB::select('call homescreenAg(?,?,?,?)',[intval($today->format('m')),$today->format('Y'),$today->format('Y-m-d'),$user]);
            // dd($today->format('m'),$today->format('Y'),$today->format('Y-m-d'));
        return view('template', compact('data'));
    }

    public function GetInfo($id)
    {
        date_default_timezone_set('America/Mexico_City');
        $today = new DateTime();
        // $ppact = DB::select('call hometableIni(?)',[$today->format('Y')]);
        // $today->modify('-1 year');
        // $ppant = DB::select('call hometableIni(?)',[$today->format('Y')]);
        $profile = User::findProfile();
        $perm = Permission::permView($profile,14);
        $perm_btn =Permission::permBtns($profile,14);
        $user = User::user_id();

        if($profile != 12)
            $data = DB::select('call hometableRen(?)',[$today->format('Y')]);
        else
            $data = DB::select('call hometableRenAg(?,?)',[$today->format('Y'),$user]);
            // dd($ppact, $ppant);
        return response()->json(['status'=>true, "data"=>$data]);
    }

    public function ExportExcl($type)
    {
        // dd("entre");
        switch($type)
        {
            case 1: $nombre = "PolizasEmitidas.xlsx"; break;
            case 2: $nombre = "PolizasRenovadas.xlsx"; break;
            case 3: $nombre = "PolizasPorCobrar.xlsx"; break;
            case 4: $nombre = "PolizasCanceladas.xlsx"; break;
            case 5: $nombre = "ConsultaDeTramites.xlsx"; break;
            case 6: $nombre = "PolizasInicialesPagadas.xlsx"; break;
            case 7: $nombre = "PolizasReenovadasPagadas.xlsx"; break;
        }
        // $sheet = new ExportInitialsDuePay();
        $sheet = new ExportHome($type);
        return Excel::download($sheet,$nombre);
    }
}
