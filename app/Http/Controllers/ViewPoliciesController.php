<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Policy;
use App\Permission;
use App\User;
use App\Receipts;
use App\Currency;
use App\Insurance;
use App\Paymentform;
use App\Charge;
use App\Branch;
use App\Status;
use App\Client;
use App\Branch_assign;
use App\Status_History;
use DateTime;
use DB;
use App\Exports\ExportPolicy;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ReceiptsImport;
use Carbon\Carbon;


class ViewPoliciesController extends Controller
{
    public function index ()
    {
        // $policy = DB::table('Policy')
        // ->select('Policy.*',DB::raw('CONCAT(IFNULL(Client.name, "")," ",IFNULL(firstname, "")," ",IFNULL(lastname, "")) AS name'),'Client.rfc')
        // ->join('Client','Client.id','=','Policy.fk_client')->whereNull('Policy.deleted_at')
        // ->get();
        // dd($policy);
        $clients = Client::get();
        // dd($policy[0]->color);

        // CONCAT(isnull(`affiliate_name`,''),'-',isnull(`model`,''),'-',isnull(`ip`,'')
        $cmbStatus = Status::select('id','name')
        ->where("fk_section","20")
        ->pluck('name','id');
        $user = User::user_id();
        $profile = User::findProfile();
        // dd($user);
        $perm = Permission::permView($profile,20);
        $perm_btn =Permission::permBtns($profile,20);
        $agents = User::select('id', DB::raw('CONCAT(name," ",firstname) AS name'))->where("fk_profile","12")->pluck('name','id');
        $currencies = Currency::pluck('name','id');
        $insurances = Insurance::pluck('name','id');
        $paymentForms = Paymentform::pluck('name','id');
        $charges = Charge::pluck('name','id');
        $branches = Branch::pluck('name','id');
        $estatusExc = Status::select('id', 'name')->where("fk_section","20")->pluck('name','id');
        $branchesExc = Branch::select('id', 'name')->pluck('name','id');

        if($profile != 12)
        {
            $policy = DB::table('Status')
                ->select('Status.id as statId','Status.name as statName','color',DB::raw('CONCAT("$", FORMAT(total, 2)) as pnaa'),'Policy.*',DB::raw('CONCAT(IFNULL(Client.name, "")," ",IFNULL(Client.firstname, "")," ",IFNULL(Client.lastname, "")) AS cname'),'Client.rfc','Branch.name AS branch',DB::raw('CONCAT(IFNULL(users.name, "")," ",IFNULL(users.firstname, "")) AS agname'))
                ->join('Policy','Policy.fk_status','=','Status.id')
                ->join('Client','Client.id','=','Policy.fk_client')
                ->join('users','users.id','=','Policy.fk_agent')
                ->join('Branch','Branch.id','=','Policy.fk_branch')
                ->where('Policy.fk_status','!=',16)
                ->whereNull('Policy.deleted_at')
                ->get();
        }
        else
        {
            $policy = DB::table('Status')
                ->select('Status.id as statId','Status.name as statName','color',DB::raw('CONCAT("$", FORMAT(total, 2)) as pnaa'),'Policy.*',DB::raw('CONCAT(IFNULL(Client.name, "")," ",IFNULL(Client.firstname, "")," ",IFNULL(Client.lastname, "")) AS cname'),'Client.rfc','Branch.name AS branch',DB::raw('CONCAT(IFNULL(users.name, "")," ",IFNULL(users.firstname, "")) AS agname'))
                ->join('Policy','Policy.fk_status','=','Status.id')
                ->join('Client','Client.id','=','Policy.fk_client')
                ->join('users','users.id','=','Policy.fk_agent')
                ->join('Branch','Branch.id','=','Policy.fk_branch')
                ->where('Policy.fk_status','!=',16)
                ->where('fk_agent',$user)
                ->whereNull('Policy.deleted_at')
                ->get();
        }

        // dd($perm);
        if($perm==0)
        {
            return redirect()->route('home');
        }
        else
        {
            return view('policies.viewPolicies', compact('perm_btn','policy','agents','currencies','insurances','paymentForms',
            'charges','branches','cmbStatus','clients','user','estatusExc','branchesExc'));
        }
    }

    // public function ReturnData($profile)
    public function ReturnData($profile,$active)
    {
        if($active == 0) $active = '%';
        $user = User::user_id();
        if($profile != 12)
        {
            $policy = DB::table('Status')
                ->select('Status.id as statId','Status.name as statName','color',DB::raw('CONCAT("$", FORMAT(total, 2)) as pnaa'),'Policy.*',DB::raw('CONCAT(IFNULL(Client.name, "")," ",IFNULL(Client.firstname, "")," ",IFNULL(Client.lastname, "")) AS cname'),'Client.rfc','Branch.name AS branch',DB::raw('CONCAT(IFNULL(users.name, "")," ",IFNULL(users.firstname, "")) AS agname'))
                ->join('Policy','Policy.fk_status','=','Status.id')
                ->join('Client','Client.id','=','Policy.fk_client')
                ->join('users','users.id','=','Policy.fk_agent')
                ->join('Branch','Branch.id','=','Policy.fk_branch')
                ->whereNull('Policy.deleted_at');
        }
        else
        {
            $policy = DB::table('Status')
                ->select('Status.id as statId','Status.name as statName','color',DB::raw('CONCAT("$", FORMAT(total, 2)) as pnaa'),'Policy.*',DB::raw('CONCAT(IFNULL(Client.name, "")," ",IFNULL(Client.firstname, "")," ",IFNULL(Client.lastname, "")) AS cname'),'Client.rfc','Branch.name AS branch',DB::raw('CONCAT(IFNULL(users.name, "")," ",IFNULL(users.firstname, "")) AS agname'))
                ->join('Policy','Policy.fk_status','=','Status.id')
                ->join('Client','Client.id','=','Policy.fk_client')
                ->join('users','users.id','=','Policy.fk_agent')
                ->join('Branch','Branch.id','=','Policy.fk_branch')
                ->where('fk_agent',$user)
                ->whereNull('Policy.deleted_at');
        }

        if($active == 0)
        {
            $policy = $policy->get();
        }
        else
        {
            $policy = $policy->where('Policy.fk_status','!=',16)->get();
        }

        return $policy;
    }


    public function ViewReceipts($id)
    {
        // dd($id);
        $receipts = Receipts::where('fk_policy',$id)->get();
        $profile = User::findProfile();
        $perm_btn =Permission::permBtns($profile,20);
        // dd($receipts);
        return response()->json(['status'=>true, "data"=>$receipts, "permission"=>$perm_btn]);

    }

    public function GetInfo($id)
    {
        // dd($id);
        $policy = DB::table('Policy')->select('*',DB::raw('CONCAT(IFNULL(Client.name, "")," ",IFNULL(firstname, "")," ",IFNULL(lastname, "")) AS name'))
            ->join('Client','fk_client','=','Client.id')
            ->where('Policy.id',$id)->first();
        // dd($policy);

        if($policy->fk_insurance != null)
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
        }
        else
        {
            $assignedBranches = $assignedPlans = null;
        }

        // dd($policy,$assignedBranches,$assignedPlans);
        return response()->json(['status'=>true, "data"=>$policy, "branches" => $assignedBranches, "plans" => $assignedPlans]);

    }

    public function paypolicy(Request $request){
        // dd($request->all());

        $status = Receipts::where('id',$request->id)->first();
        // dd($request->all());
        $status->status = $request->auth;
        $status->save();
        $policy = Policy::select('*')->where('id',$status->fk_policy)->first();
        $this->updateStatusPayment($policy);
        // dd($policy->policy);

        $profile = User::findProfile();
        $perm_btn =Permission::permBtns($profile,14);
        $policies = $this->ReturnData($profile,$request->active);

        return response()->json(['status'=>true, "message"=>"Recibo Pagado", "policies" => $policies, "profile" => $profile, "permission" => $perm_btn]);

    }
    public function cancelpaypolicy(Request $request){
        // dd($request->all());

        $status = Receipts::where('id',$request->id)->first();
        // dd($status);
        // dd($request->all());
        $status->status = null;
        $status->save();
        $policy = Policy::select('*')->where('id',$status->fk_policy)->first();
        $this->updateStatusPayment($policy);

        $profile = User::findProfile();
        $perm_btn =Permission::permBtns($profile,14);
        $policies = $this->ReturnData($profile,$request->active);

        return response()->json(['status'=>true, "message"=>"Recibo Cancelado", "policies" => $policies, "profile" => $profile, "permission" => $perm_btn]);

    }
    public function updateStatus(Request $request)
    {
        $status = Policy::where('id',$request->id)->first();
        // dd($status);
        $status->fk_status = $request->status;
        $status->save();

        $user = User::user_id();
        $history = Status_History::where('fk_user',$user)->where('id_origin',$request->id)->where('fk_status',$request->status)->first();
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
        $policies = $this->ReturnData($profile,$request->active);

        return response()->json(['status'=>true, "message"=>"Estatus Actualizado", "policies" => $policies, "profile" => $profile, "permission" => $perm_btn]);
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
    public function GetInfoClient($id)
    {
        $client = DB::table('Client')->select('status',DB::raw('CONCAT(IFNULL(Client.name, "")," ",IFNULL(firstname, "")," ",IFNULL(lastname, "")) AS name'))->where('id',$id)->first();
        return response()->json(['status'=>true, "data" => $client]);
    }
    public function GetInfoAll($id, Request $request)
    {
        $profile = User::findProfile();
        $perm_btn =Permission::permBtns($profile,14);
        $policies = $this->ReturnData($profile,$request->active);

        return response()->json(['status'=>true, "policies" => $policies, "profile" => $profile, "permission" => $perm_btn]);
    }
    public function updatePolicies()
    {
        $policies = Policy::whereNull('deleted_at')->where('fk_status','!=',16)->get();
        foreach($policies as $policy)
        {
            $this->updateStatusPayment($policy);
            // dd($policy,$receipts);
        }
        return response()->json(['status'=>true, "message"=>"Actualizado"]);
    }
    public function updatePoliciesNet($id)
    {
        $policies = Policy::whereNull('deleted_at')->where('fk_status','!=',16)->get();
        $today = new DateTime();
        foreach($policies as $policy)
        {
            $this->updateStatusPayment($policy);
            // dd($policy,$receipts);
        }
        return response()->json(['status'=>true, "message"=>"Actualizado"]);
    }
    public function updateStatusPayment($policy)
    {
        // dd($policy->id);
        date_default_timezone_set('America/Mexico_City');
        $receipts = DB::table('Receipts')->select('*')
            ->orderBy('initial_date','asc')
            ->groupBy('fk_policy')
            ->where('fk_policy',$policy->id)
            ->whereNull('status')
            ->whereNull('deleted_at')->first();
        if($receipts == null)
        {
            $today = new DateTime();
            $endDate = new Datetime($policy->end_date);
            if($today >= $endDate)
            {
                $status = Policy::where('id',$policy->id)->first();
                $status->fk_status = 18;
                $status->save();
            }
            else
            {
                $status = Policy::where('id',$policy->id)->first();
                $status->fk_status = 15;
                $status->save();
            }
        }
        else
        {
            $today = new DateTime();
            $endDate = new Datetime($policy->end_date);
            if($today >= $endDate)
            {
                $status = Policy::where('id',$policy->id)->first();
                $status->fk_status = 18;
                $status->save();
            }
            else
            {
                $recptDate = new DateTime($receipts->initial_date);
                if($today >= $recptDate)
                {
                    $status = Policy::where('id',$policy->id)->first();
                    $status->fk_status = 21;
                    $status->save();
                }
                else
                {
                    $status = Policy::where('id',$policy->id)->first();
                    $status->fk_status = 15;
                    $status->save();
                }
            }
        }
    }

    public function ExportPolicy($status,$branch)
    {
        // dd("entre");
        $nombre = "Poliza.xlsx";
        $sheet = new ExportPolicy($status, $branch);
        return Excel::download($sheet,$nombre);
    }

    public function GetPolicies($active)
    {
        // dd("entre");
        $profile = User::findProfile();
        $perm_btn =Permission::permBtns($profile,20);
        $policies = $this->ReturnData($profile,$active);
        return response()->json(['status'=>true, "policies" => $policies, "profile" => $profile, "permission" => $perm_btn]);
    }

    public function GetP($active)
    {
        $policies = DB::table('Policy')->select('id','initial_date','fk_payment_form')
            ->whereDay('initial_date','=',31)
            ->where('fk_payment_form','!=',1)
            ->get();
        // dd($policies);
        return response()->json(['status'=>true, "policies" => $policies]);
    }

    public function updateDate(Request $request)
    {
        $receipts = Receipts::where('fk_policy',$request->id)->get();
        $cont = 0;
        foreach($receipts as $receipt)
        {
            $rcp = Receipts::where('id',$receipt->id)->update(['initial_date'=>$request->dates[$cont]]);
            $cont += 1;
        }
        // dd("terminado");
        return response()->json(['status'=>true]);
    }

    public function import(Request $request)
    {
        set_time_limit(1000);
        $file = $request->file('excl');
        // $file = $request->file;
        $imp = new ReceiptsImport();
        $new_balance = 0;
        $prev_balance = 0;
        // dd($request);
        // Excel::import($imp, $file);
        $array = ($imp)->toArray($file);
        // dd($array[0][1]);
        $array2 = array();
        $arrayNotFound = array();
        $cont = 0;
        $goodCont = 0;
        foreach ($array[0] as $moves)
        {
            $moves[1] = $this->transformDate($moves[1]);
            $moves[2] = $this->transformDate($moves[2]);

            $policy = Policy::select('id')->where('policy',$moves[0])->first();

            if ($policy != null)
            {
                $receipt = Receipts::where('fk_policy',$policy->id)->where('initial_date',$moves[2])->update(['status'=>$moves[1]]);
                $goodCont++;
            }
            else
            {
                $policy = Policy::select('id')->where('reference',$moves[0])->first();

                if($policy != null)
                {
                    $receipt = Receipts::where('fk_policy',$policy->id)->where('initial_date',$moves[2])->update(['status'=>$moves[1]]);
                    $goodCont++;
                }
                else
                {
                    array_push($arrayNotFound, $moves[0]);
                }
            }
        }

        return response()->json(['status'=>true, 'message'=>"Datos Subidos", 'notFnd' => $arrayNotFound, 'importados' => $goodCont]);
    }

    public function transformDate($value)
    {
        return Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value))->format('Y-m-d');
    }
}
