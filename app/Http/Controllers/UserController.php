<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(){
        // Filtra os usuários que não têm a role "admin"
        $users = User::whereDoesntHave('roles', function ($query) {
            $query->where('name', 'admin');
        })->paginate(10);
    
        return view('admin.users.index', compact('users'));
    }

    public function create(){
        if(request()->isMethod('get')){
            return view('admin.users.create');
        }

        if(request()->isMethod('post')){
            $data = request()->all();
            User::create($data);
            return redirect()->route('admin.users');
        }
    }
}
