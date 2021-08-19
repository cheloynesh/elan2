<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Policy;
use App\Permission;
use App\User;
use App\Client;
use DB;
use App\Initial;
use App\Currency;
use App\Insurance;
use App\Paymentform;
use App\Charge;
use App\Branch;

class PoliciesController extends Controller
{
    public function index ()
    {
        // $policy = Policy::get();
        $clients = Client::get();
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
            return view('policies.policy', compact('perm_btn','clients','agents','currencies','insurances','paymentForms','charges','branches'));
        }
    }
    public function GetInfo($id)
    {
        $client = DB::table("Client")
        ->select('Client.inicial','Client.status', 'fk_agent', 'fk_insurance', 'fk_branch', 'pna',
        'fk_currency', 'fk_payment_form', 'fk_charge')
        ->leftJoin('Initials','Initials.id','=','inicial')
        ->where('Client.id',$id)
        ->first();
        // dd($client);
        return response()->json(['status'=>true, "data"=>$client]);
    }
    public function CheckPolicy($policy)
    {
        $policy = Policy::where('policy',$policy)->first();
        if($policy == null)
        {
            return 0;
        }
        else
        {
            return 1;
        }
    }
}
