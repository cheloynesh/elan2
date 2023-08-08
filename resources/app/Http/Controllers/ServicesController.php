<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Status;
use App\Permission;
use App\Service;
use App\Branch;
use App\Insurance;
use App\Paymentform;
use App\Charge;
use App\Currency;
use App\Policy;
use App\Client;
use App\Branch_assign;
use App\Status_History;
use App\Exports\ExportService;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use DateTime;

class ServicesController extends Controller
{
    public function index()
    {
        // dd($initials);
        $clients = Client::get();
        $agents = User::select('id', DB::raw('CONCAT(name," ",firstname) AS name'))->where("fk_profile","12")->orderBy('name')->pluck('name','id');
        $estatusExc = Status::select('id', 'name')->where("fk_section","16")->pluck('name','id');
        $branchesExc = Branch::select('id', 'name')->pluck('name','id');
        $insurances = Insurance::orderBy('name')->pluck('name','id');
        $branches = Branch::pluck('name','id');
        $cmbStatus = Status::select('id','name')
        ->where("fk_section","16")
        ->pluck('name','id');
        $profile = User::findProfile();
        $perm = Permission::permView($profile,16);
        $perm_btn =Permission::permBtns($profile,16);
        $currencies = Currency::pluck('name','id');
        $paymentForms = Paymentform::pluck('name','id');
        $charges = Charge::pluck('name','id');
        $user = User::user_id();
        if($profile != 12)
        {
            $services = DB::table("Status")
                ->select('Status.id as statId','Status.name as statName','Services.id as id','Services.name as name','folio','type','color',
                'Insurance.name as insurance','Branch.name as branch', DB::raw('CONCAT(users.name," ",users.firstname) AS agent'), 'policy')
                ->join('Services','Services.fk_status','=','Status.id')
                ->join('Insurance','Insurance.id','=','Services.fk_insurance')
                ->join('Branch','Branch.id','=','Services.fk_branch')
                ->join('users','users.id','=','Services.fk_agent')
                ->whereNull('Services.deleted_at')->get();
        }
        else
        {
            $services = DB::table("Status")
                ->select('Status.id as statId','Status.name as statName','Services.id as id','Services.name as name','folio','type','color',
                'Insurance.name as insurance','Branch.name as branch', DB::raw('CONCAT(users.name," ",users.firstname) AS agent'), 'policy')
                ->join('Services','Services.fk_status','=','Status.id')
                ->join('Insurance','Insurance.id','=','Services.fk_insurance')
                ->join('Branch','Branch.id','=','Services.fk_branch')
                ->join('users','users.id','=','Services.fk_agent')
                ->where('fk_agent',$user)
                ->whereNull('Services.deleted_at')->get();
        }
        if($perm==0)
        {
            return redirect()->route('home');
        }
        else
        {
            return view('processes.OT.services.service',
            compact('services','agents','insurances','branches','perm_btn','currencies','insurances','paymentForms',
            'charges','cmbStatus','clients','estatusExc','branchesExc'));
        }
    }
    public function GetInfo($id)
    {
        $service = Service::where('id',$id)->first();
        // dd($service);
        return response()->json(['status'=>true, "data"=>$service]);
    }

    public function store(Request $request)
    {
        $service = new Service;
        $service->fk_agent = $request->agent;
        $service->entry_date = $request->entry_date;
        $service->policy = $request->policy;
        $service->response_date = $request->response_date;
        $service->download = $request->download;
        $service->type = $request->type;
        $service->folio = $request->folio;
        $service->name = $request->name;
        $service->record = $request->record;
        $service->fk_insurance = $request->insurance;
        $service->fk_branch = $request->branch;
        $service->guide = $request->guide;
        $service->save();

        $today = new DateTime();
        $user = User::user_id();
        $history = new Status_History;
        $history->fk_status = 7;
        $history->fk_user = $user;
        $history->id_origin = $service->id;
        $history->change_date = $today->format('Y-m-d');
        $history->save();

        return response()->json(["status"=>true, "message"=>"Servicio creado"]);
    }

    public function update(Request $request, $id)
    {
        $service = Service::where('id',$request->id)->
        update(['fk_agent'=>$request->agent,
        'entry_date' => $request->entry_date,
        'policy' => $request->policy,
        'response_date' => $request->response_date,
        'download' => $request->download,
        'type' => $request->type,
        'folio' => $request->folio,
        'name' => $request->name,
        'record' => $request->record,
        'fk_insurance' => $request->insurance,
        'guide' => $request->guide,
        'fk_branch' => $request->branch]);
        return response()->json(['status'=>true, 'message'=>"Servicio actualizado"]);
    }

    public function destroy($id)
    {
        $service = Service::find($id);
        $service->delete();
        return response()->json(['status'=>true, "message"=>"Servicio eliminado"]);
    }

    public function updateStatus(Request $request)
    {
        $status = Service::where('id',$request->id)->first();
        $status->fk_status = $request->status;
        // dd($status);
        $status->commentary=$request->commentary;
        $status->save();

        $user = User::user_id();
        $history = Status_History::where('id_origin',$request->id)->where('fk_status',$request->status)->first();
        // dd($history);
        if($history == null)
        {
            $today = new DateTime();
            $history = new Status_History;
            $history->fk_status = $request->status;
            $history->fk_user = $user;
            $history->id_origin = $request->id;
            $history->change_date = $today->format('Y-m-d');
            $history->save();
        }

        return response()->json(['status'=>true, "message"=>"Estatus Actualizado"]);
    }

    public function GetinfoStatus($id)
    {
        $service = Service::where('id',$id)->first();
        // dd($service);
        return response()->json(['status'=>true, "data"=>$service]);
    }
    public function GetPolicyInfo($id)
    {
        $policyNumber = DB::table('Services')->select('policy','fk_insurance')->where('id',$id)->first();
        $policy = Policy::where('policy',$policyNumber->policy)->first();
        if($policy != null)
        {
            $brnchAss = Branch_assign::select('id')->where('fk_insurance',$policy->fk_insurance)->where('fk_branch',$policy->fk_branch)->first();
            $assignedBranches = DB::table('Branch_assign')->select('fk_branch AS id','name')
                ->join('Branch','fk_branch','=','Branch.id')
                ->where('fk_insurance',$policy->fk_insurance)
                ->orderBy('name')
                ->whereNull('Branch_assign.deleted_at')->get();
            $assignedPlans = DB::table('Plans_assign')->select('fk_plans AS id','name')
                ->join('Plans','fk_plans','=','Plans.id')
                ->where('fk_brnchass',$brnchAss->id)
                ->orderBy('name')
                ->whereNull('Plans_assign.deleted_at')->get();
            $service = null;
            $client = DB::table('Client')->select('*',DB::raw('CONCAT(IFNULL(Client.name, "")," ",IFNULL(firstname, "")," ",IFNULL(lastname, "")) AS name'))
                ->where('id',$policy->fk_client)->first();
        }
        else
        {
            $service = Service::where('id',$id)->first();
            $assignedBranches = DB::table('Branch_assign')->select('fk_branch AS id','name')
                ->join('Branch','fk_branch','=','Branch.id')
                ->where('fk_insurance',$policyNumber->fk_insurance)
                ->orderBy('name')
                ->whereNull('Branch_assign.deleted_at')->get();
            $assignedPlans = null;
            $client = null;
        }
        // dd($policy);
        return response()->json(['status'=>true, "data"=>$policy, "branches" => $assignedBranches, "plans" => $assignedPlans, "service" => $service, "client" => $client]);
    }
    public function getBranches($id)
    {
        $assignedBranches = DB::table('Branch_assign')->select('fk_branch AS id','name')
            ->join('Branch','fk_branch','=','Branch.id')
            ->where('fk_insurance',$id)
            ->orderBy('name')
            ->whereNull('Branch_assign.deleted_at')->get();
        // dd($id);

        return response()->json(['status'=>true, "branches" => $assignedBranches]);
    }
    public function ExportService($status,$branch)
    {
        // dd("entre");
        $nombre = "Servicios.xlsx";
        $sheet = new ExportService($status, $branch);
        return Excel::download($sheet,$nombre);
    }
}
