<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Status;
use App\Permission;
use App\Initial;
use App\Currency;
use App\Insurance;
use App\Paymentform;
use App\Charge;
use App\Branch;
use App\Application;
use App\Client;
use App\Branch_assign;
use DB;
use Carbon\Carbon;
use App\Policy;

class InitialController extends Controller
{
    public function index()
    {
        // $initials = Initial::get();

        // dd($initials);
        $agents = User::select('id', DB::raw('CONCAT(name," ",firstname) AS name'))->where("fk_profile","12")->pluck('name','id');
        $currencies = Currency::pluck('name','id');
        $insurances = Insurance::pluck('name','id');
        $paymentForms = Paymentform::pluck('name','id');
        $charges = Charge::pluck('name','id');
        $branches = Branch::pluck('name','id');
        $applications = Application::pluck('name','id');
        $cmbStatus = Status::select('id','name')
        ->where("fk_section","14")
        ->pluck('name','id');
        // $status = DB::table("Status")
        //     ->select('Status.id as id','Status.name as name')
        //     ->join('Initials','Initials.fk_status','=','Status.id')
        //     ->get();
        // dd($status);
        $profile = User::findProfile();
        $perm = Permission::permView($profile,14);
        $perm_btn =Permission::permBtns($profile,14);
        $user = User::user_id();
        if($profile != 12)
        {
            $initials = DB::table("Status")
                ->select('Status.id as statId','Status.name as name','Initials.id as id', 'rfc', 'Initials.name as client',
                'Initials.firstname','Initials.lastname','color','Insurance.name as insurance','Branch.name as branch',
                'users.name as agent','Initials.created_at as date','folio')
                ->join('Initials','Initials.fk_status','=','Status.id')
                ->join('Insurance','Insurance.id','=','Initials.fk_insurance')
                ->join('Branch','Branch.id','=','Initials.fk_branch')
                ->join('users','users.id','=','Initials.fk_agent')
                ->where('Status.id','<>','4')
                ->whereNull('Initials.deleted_at')
                ->get();
        }
        else
        {
            $initials = DB::table("Status")
                ->select('Status.id as statId','Status.name as name','Initials.id as id', 'rfc', 'Initials.name as client',
                'Initials.firstname','Initials.lastname','color','Insurance.name as insurance','Branch.name as branch',
                'users.name as agent','Initials.created_at as date','folio')
                ->join('Initials','Initials.fk_status','=','Status.id')
                ->join('Insurance','Insurance.id','=','Initials.fk_insurance')
                ->join('Branch','Branch.id','=','Initials.fk_branch')
                ->join('users','users.id','=','Initials.fk_agent')
                ->where('Status.id','<>','4')
                ->where('fk_agent',$user)
                ->whereNull('Initials.deleted_at')
                ->get();
        }
        if($perm==0)
        {
            return redirect()->route('home');
        }
        else
        {
            return view('processes.OT.Initials.initial',
            compact('initials','agents','currencies','insurances','paymentForms','charges','branches','applications','perm_btn','cmbStatus'));
        }
    }
    public function GetInfo($id)
    {
        $initial = Initial::where('id',$id)->first();

        $brnchAss = Branch_assign::select('id')->where('fk_insurance',$initial->fk_insurance)->where('fk_branch',$initial->fk_branch)->first();

        $assignedBranches = DB::table('Branch_assign')->select('fk_branch AS id','name')
            ->join('Branch','fk_branch','=','Branch.id')
            ->where('fk_insurance',$initial->fk_insurance)
            ->whereNull('Branch_assign.deleted_at')->get();

        $assignedPlans = DB::table('Plans_assign')->select('fk_plans AS id','name')
            ->join('Plans','fk_plans','=','Plans.id')
            ->where('fk_brnchass',$brnchAss->id)
            ->whereNull('Plans_assign.deleted_at')->get();

        // dd($assignedBranches, $assignedPlans);
        return response()->json(['status'=>true, "data"=>$initial, "branches" => $assignedBranches, "plans" => $assignedPlans]);
    }

    public function store(Request $request)
    {
        $initial = new Initial;
        $initial->fk_agent = $request->agent;
        $initial->name = $request->name;
        $initial->firstname = $request->firstname;
        $initial->lastname = $request->lastname;
        $initial->rfc = $request->rfc;
        $initial->insured = $request->insured;
        $initial->type = $request->type;
        $initial->promoter_date = $request->promoter;
        $initial->system_date = $request->system;
        $initial->folio = $request->folio;
        $initial->fk_insurance = $request->insurance;
        $initial->fk_branch = $request->branch;
        $initial->fk_plan = $request->plan;
        $initial->fk_application = $request->application;
        $initial->pna = $request->pna;
        $initial->fk_payment_form = $request->paymentForm;
        $initial->fk_currency = $request->currency;
        $initial->fk_charge = $request->charge;
        $initial->guide = $request->guide;
        $initial->save();
        return response()->json(["status"=>true, "message"=>"Inicial creada"]);
    }

    public function update(Request $request, $id)
    {
        $initial = Initial::where('id',$request->id)->
        update(['fk_agent'=>$request->agent,
        'name'=>$request->name,
        'firstname'=>$request->firstname,
        'lastname'=>$request->lastname,
        'rfc' => $request->rfc,
        'promoter_date' => $request->promoter,
        'system_date' => $request->system,
        'folio' => $request->folio,
        'fk_insurance' => $request->insurance,
        'fk_branch' => $request->branch,
        'fk_plan' => $request->plan,
        'fk_application' => $request->application,
        'pna' => $request->pna,
        'fk_payment_form' => $request->paymentForm,
        'fk_currency' => $request->currency,
        'guide' => $request->guide,
        'fk_charge' => $request->charge]);
        return response()->json(['status'=>true, 'message'=>"Inicial actualizada"]);
    }

    public function destroy($id)
    {
        $initial = Initial::find($id);
        $initial->delete();
        return response()->json(['status'=>true, "message"=>"Inicial eliminado"]);
    }

    public function updateStatus(Request $request)
    {
        // dd($request->all());
        $status = Initial::where('id',$request->id)->first();
        // dd($status);
        $status->fk_status = $request->status;
        if($request->sub_status==1)
        {
            $status->commentary=$request->commentary;

        }else{
            $status->commentary=$request->sub_status;

        }
        $status->save();

        if($request->status == 4)
        {
            $client = new Client;
            $client->name = $status->name;
            $client->firstname = $status->firstname;
            $client->lastname = $status->lastname;
            $client->birth_date = null;
            $client->rfc = $status->rfc;
            $client->curp = null;
            $client->gender = null;
            $client->marital_status = null;
            $client->street = null;
            $client->e_num = null;
            $client->i_num = null;
            $client->pc = null;
            $client->suburb = null;
            $client->country = null;
            $client->state = null;
            $client->city = null;
            $client->cellphone = null;
            $client->email = null;
            $client->name_contact = null;
            $client->phone_contact = null;
            $client->status = $status->type;
            $client->inicial = $request->id;
            $client->save();
            return response()->json(["status"=>true, "message"=>"Cliente Emitido"]);
        }
        return response()->json(['status'=>true, "message"=>"Estatus Actualizado"]);
    }

    public function GetinfoStatus($id)
    {
        $initial = Initial::where('id',$id)->first();
        // dd($initial->commentary);
        return response()->json(['status'=>true, "data"=>$initial]);
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

    public function getPlans($insurance, $branch)
    {
        if($branch != 0)
        {
            $brnchAss = Branch_assign::select('id')->where('fk_insurance',$insurance)->where('fk_branch',$branch)->first();

            $assignedPlans = DB::table('Plans_assign')->select('fk_plans AS id','name')
                ->join('Plans','fk_plans','=','Plans.id')
                ->where('fk_brnchass',$brnchAss->id)
                ->orderBy('name')
                ->whereNull('Plans_assign.deleted_at')->get();
        }
        else
        {
            $assignedPlans = [];
        }

        return response()->json(['status'=>true, "branches" => $assignedPlans]);
    }
}
