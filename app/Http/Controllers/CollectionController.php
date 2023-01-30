<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Plan;
use App\Permission;
use App\User;
use App\Policy;
use App\Branch;
use App\Client;
use App\Receipts;
use DB;

class CollectionController extends Controller
{
    public function index ()
    {
        $profile = User::findProfile();
        $perm = Permission::permView($profile,22);
        $perm_btn =Permission::permBtns($profile,22);
        $receipts = DB::table('Receipts')->select('Receipts.id as rid', DB::raw('CONCAT(IFNULL(users.name, "")," ",IFNULL(users.firstname, "")," ",IFNULL(users.lastname, "")) AS agname'),
        DB::raw('CONCAT(IFNULL(Client.name, "")," ",IFNULL(Client.firstname, "")," ",IFNULL(Client.lastname, "")) AS clname'),'rfc','Branch.name as brName','policy',
        'pna_t','Receipts.initial_date as initiald', 'Receipts.end_date as endd','Receipts.status as rStatus')
            ->join('Policy','fk_policy','=','Policy.id')
            ->join('users','fk_agent','=','users.id')
            ->join('Client','fk_client','=','Client.id')
            ->join('Branch','fk_branch','=','Branch.id')
            ->orderBy('Receipts.initial_date','asc')
            ->groupBy('policy')
            ->whereNull('Receipts.status')
            ->whereNull('Policy.deleted_at')
            ->whereNull('Receipts.deleted_at')->get();
        if($perm==0)
        {
            return redirect()->route('home');
        }
        else
        {
            return view('policies.collection', compact('receipts','perm_btn'));
        }
    }
}
