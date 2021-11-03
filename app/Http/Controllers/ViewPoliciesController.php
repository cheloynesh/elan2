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
use DB;

class ViewPoliciesController extends Controller
{
    public function index ()
    {
        // $policy = DB::table('Policy')
        // ->select('Policy.*',DB::raw('CONCAT(IFNULL(Client.name, "")," ",IFNULL(firstname, "")," ",IFNULL(lastname, "")) AS name'),'Client.rfc')
        // ->join('Client','Client.id','=','Policy.fk_client')->whereNull('Policy.deleted_at')
        // ->get();
        // dd($policy);
        $policy = DB::table('Status')
        ->select('Status.id as statId','Status.name as statName','color','Policy.*',DB::raw('CONCAT(IFNULL(Client.name, "")," ",IFNULL(firstname, "")," ",IFNULL(lastname, "")) AS name'),'Client.rfc')
        ->join('Policy','Policy.fk_status','=','Status.id')
        ->join('Client','Client.id','=','Policy.fk_client')
        ->whereNull('Policy.deleted_at')
        ->get();
        // dd($policy[0]->color);


        // CONCAT(isnull(`affiliate_name`,''),'-',isnull(`model`,''),'-',isnull(`ip`,'')
        $cmbStatus = Status::select('id','name')
        ->where("fk_section","20")
        ->pluck('name','id');
        $profile = User::findProfile();
        $perm = Permission::permView($profile,11);
        $perm_btn =Permission::permBtns($profile,11);
        $agents = User::select('id', DB::raw('CONCAT(name," ",firstname) AS name'))->where("fk_profile","12")->pluck('name','id');
        $currencies = Currency::pluck('name','id');
        $insurances = Insurance::pluck('name','id');
        $paymentForms = Paymentform::pluck('name','id');
        $charges = Charge::pluck('name','id');
        $branches = Branch::pluck('name','id');
        if($perm==0)
        {
            return redirect()->route('home');
        }
        else
        {
            return view('policies.viewPolicies', compact('perm_btn','policy','agents','currencies','insurances','paymentForms',
            'charges','branches','cmbStatus'));
        }
    }

    public function ViewReceipts($id)
    {
        // dd($id);
        $receipts = Receipts::where('fk_policy',$id)->get();
        // dd($receipts);
        return response()->json(['status'=>true, "data"=>$receipts]);

    }
    
    public function GetInfo($id)
    {
        // dd($id);
        $policy = Policy::where('id',$id)->first();
        // dd($policy);
        return response()->json(['status'=>true, "data"=>$policy]);

    }

    public function paypolicy(Request $request){
        // dd($request->all());

        $status = Receipts::where('id',$request->id)->first();
        // dd($status);
        $status->status = 1;
        $status->save();
        return response()->json(['status'=>true, "message"=>"Recibo Pagada"]);

    }
    public function updateStatus(Request $request)
    {
        $status = Policy::where('id',$request->id)->first();
        // dd($status);
        $status->fk_status = $request->status;
        $status->save();
        return response()->json(['status'=>true, "message"=>"Estatus Actualizado"]);
    }
}
