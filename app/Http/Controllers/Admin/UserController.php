<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function __Construct() 
    {
        $this->middleware('auth');
        // $this->middleware('user.status');
        // $this->middleware('user.permissions');
        $this->middleware('isadmin');
    }

    public function getUsers() {
        // if ($status == 'all') {
            $users = User::orderBy('id', 'desc')->paginate(8);
        /* }
        else {
            $users = User::where('status', $status)->orderBy('id', 'desc')->paginate(8);
        }*/
        $data = ['users' => $users]; 
        return view('admin.users.home', $data);
    }
}
