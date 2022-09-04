<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        $user = auth()->user();
        $name = $user->roles()->first()?->name;
        $fromGroup = null;
        if($user->hasRole('student')) {
            $groupName = $user->group->name;
            $fromGroup = "from $groupName group";
        }
        return view('dashboard.index', ["msg"=>"Hello! I am a $name " . $fromGroup]);
    }


}