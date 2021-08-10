<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use App\Policy;
use App\Permission;
use App\User;

class PoliciesController extends Controller
{
    public function index ()
    {
        // $policy = Policy::get();
        $profile = User::findProfile();
        $perm = Permission::permView($profile,11);
        $perm_btn =Permission::permBtns($profile,11);
        if($perm==0)
        {
            return redirect()->route('home');
        }
        else
        {
            return view('policies.policy', compact('perm_btn'));
        }
    }
}
