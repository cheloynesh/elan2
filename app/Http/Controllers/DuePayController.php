<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Permission;
use App\Profile;

class DuePayController extends Controller
{
    public function index ()
    {
        $profile = User::findProfile();
        $perm = Permission::permView($profile,24);
        $perm_btn =Permission::permBtns($profile,24);
        if($perm==0)
        {
            return redirect()->route('home');
        }
        else
        {
            return view('reports.duepay.duepay', compact('perm_btn'));
        }
    }
}
