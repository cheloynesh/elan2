<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Status;
use App\Permission;
use App\Insurance;
use App\Refund;
use App\Branch_assign;
use App\Branch;
use App\Status_History;
use App\Exports\ExportRefunds;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use DateTime;

class RefundsController extends Controller
{
    public function index()
    {
        // dd($refunds);
        $agents = User::select('id', DB::raw('CONCAT(name," ",firstname) AS name'))->orderBy('name')->whereIn("fk_profile",[12,2])->pluck('name','id');
        $insurances = Insurance::orderBy('name')->pluck('name','id');
        $cmbStatus = Status::select('id','name')
        ->where("fk_section","17")
        ->pluck('name','id');
        $profile = User::findProfile();
        $perm = Permission::permView($profile,17);
        $perm_btn =Permission::permBtns($profile,17);
        $user = User::user_id();
        $estatusExc = Status::select('id', 'name')->where("fk_section","17")->pluck('name','id');
        $branchesExc = Branch::select('id', 'name')->pluck('name','id');
        if($profile != 12)
        {
            $refunds = DB::table("Status")
                ->select('Status.id as statId','Status.name as statName','Refunds.id as id','folio','color',
                'Insurance.name as insurance',DB::raw('CONCAT(users.name," ",users.firstname) AS agent'),'contractor')
                ->join('Refunds','Refunds.fk_status','=','Status.id')
                ->join('Insurance','Insurance.id','=','Refunds.fk_insurance')
                ->join('users','users.id','=','Refunds.fk_agent')
                ->whereNull('Refunds.deleted_at')->get();
        }
        else
        {
            $refunds = DB::table("Status")
                ->select('Status.id as statId','Status.name as statName','Refunds.id as id','folio','color',
                'Insurance.name as insurance',DB::raw('CONCAT(users.name," ",users.firstname) AS agent'),'contractor')
                ->join('Refunds','Refunds.fk_status','=','Status.id')
                ->join('Insurance','Insurance.id','=','Refunds.fk_insurance')
                ->join('users','users.id','=','Refunds.fk_agent')
                ->where('fk_agent',$user)
                ->whereNull('Refunds.deleted_at')->get();
        }
        if($perm==0)
        {
            return redirect()->route('home');
        }
        else
        {
            return view('processes.OT.refunds.refunds',
            compact('refunds','agents','insurances','perm_btn','cmbStatus','estatusExc','branchesExc'));
        }
    }

    public function ReturnData($profile)
    {
        $user = User::user_id();
        if($profile != 12)
        {
            $refunds = DB::table("Status")
                ->select('Status.id as statId','Status.name as statName','Refunds.id as id','folio','color',
                'Insurance.name as insurance',DB::raw('CONCAT(users.name," ",users.firstname) AS agent'),'contractor')
                ->join('Refunds','Refunds.fk_status','=','Status.id')
                ->join('Insurance','Insurance.id','=','Refunds.fk_insurance')
                ->join('users','users.id','=','Refunds.fk_agent')
                ->whereNull('Refunds.deleted_at')->get();
        }
        else
        {
            $refunds = DB::table("Status")
                ->select('Status.id as statId','Status.name as statName','Refunds.id as id','folio','color',
                'Insurance.name as insurance',DB::raw('CONCAT(users.name," ",users.firstname) AS agent'),'contractor')
                ->join('Refunds','Refunds.fk_status','=','Status.id')
                ->join('Insurance','Insurance.id','=','Refunds.fk_insurance')
                ->join('users','users.id','=','Refunds.fk_agent')
                ->where('fk_agent',$user)
                ->whereNull('Refunds.deleted_at')->get();
        }
        return $refunds;
    }

    public function GetInfo($id)
    {
        $refund = Refund::where('id',$id)->first();

        $brnchAss = Branch_assign::select('id')->where('fk_insurance',$refund->fk_insurance)->where('fk_branch',$refund->fk_branch)->first();

        $assignedBranches = DB::table('Branch_assign')->select('fk_branch AS id','name')
            ->join('Branch','fk_branch','=','Branch.id')
            ->orderBy('name')
            ->where('fk_insurance',$refund->fk_insurance)
            ->whereNull('Branch_assign.deleted_at')->get();

        // dd($service);
        return response()->json(['status'=>true, "data"=>$refund, "branches" => $assignedBranches]);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $refund = new Refund;
        $refund->fk_agent = $request->agent;
        $refund->folio = $request->folio;
        $refund->contractor = $request->contractor;
        $refund->fk_insurance = $request->fk_insurance;
        $refund->fk_branch = $request->fk_branch;
        $refund->entry_date = $request->entry_date;
        $refund->policy = $request->policy;
        $refund->insured = $request->insured;
        $refund->sinister = $request->sinister;
        $refund->amount = $request->amount;
        $refund->payment_form = $request->payment_form;
        $refund->guide = $request->guide;
        $refund->type = $request->type;
        $refund->save();

        $today = new DateTime();
        $user = User::user_id();
        $history = new Status_History;
        $history->fk_status = 12;
        $history->fk_user = $user;
        $history->id_origin = $refund->id;
        $history->change_date = $today->format('Y-m-d');
        $history->save();

        $profile = User::findProfile();
        $perm_btn =Permission::permBtns($profile,14);
        $refunds = $this->ReturnData($profile);

        return response()->json(["status"=>true, "message"=>"Reembolso creado", "refunds" => $refunds, "profile" => $profile, "permission" => $perm_btn]);
    }

    public function update(Request $request, $id)
    {
        $refund = Refund::where('id',$request->id)->
        update(['fk_agent'=>$request->agent,
        'fk_agent' => $request->agent,
        'folio' => $request->folio,
        'contractor' => $request->contractor,
        'fk_insurance' => $request->fk_insurance,
        'fk_branch' => $request->fk_branch,
        'entry_date' => $request->entry_date,
        'policy' => $request->policy,
        'insured' => $request->insured,
        'sinister' => $request->sinister,
        'amount' => $request->amount,
        'guide' => $request->guide,
        'payment_form' => $request->payment_form,
        'type' => $request->type,
        'refund_comm' => $request->refund_comm]);

        $profile = User::findProfile();
        $perm_btn =Permission::permBtns($profile,14);
        $refunds = $this->ReturnData($profile);

        return response()->json(['status'=>true, 'message'=>"Reembolso actualizado", "refunds" => $refunds, "profile" => $profile, "permission" => $perm_btn]);
    }

    public function destroy($id)
    {
        $refund = Refund::find($id);
        $refund->delete();

        $profile = User::findProfile();
        $perm_btn =Permission::permBtns($profile,14);
        $refunds = $this->ReturnData($profile);

        return response()->json(['status'=>true, "message"=>"Reembolso eliminado", "refunds" => $refunds, "profile" => $profile, "permission" => $perm_btn]);
    }

    public function updateStatus(Request $request)
    {
        $status = Refund::where('id',$request->id)->first();
        // dd($status);
        $status->fk_status = $request->status;
        $status->attend_date=$request->attend_date;
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

        $profile = User::findProfile();
        $perm_btn =Permission::permBtns($profile,14);
        $refunds = $this->ReturnData($profile);

        return response()->json(['status'=>true, "message"=>"Estatus Actualizado", "refunds" => $refunds, "profile" => $profile, "permission" => $perm_btn]);
    }

    public function GetinfoStatus($id){
        $refund=Refund::where('id',$id)->first();
        return response()->json(['status'=>true, "data"=>$refund]);
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

    public function ExportRefunds($status,$branch)
    {
        // dd("entre");
        $nombre = "Reembolso.xlsx";
        $sheet = new ExportRefunds($status, $branch);
        return Excel::download($sheet,$nombre);
    }
}
