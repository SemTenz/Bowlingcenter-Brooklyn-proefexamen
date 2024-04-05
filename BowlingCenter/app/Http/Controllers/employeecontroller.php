<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\usertype;

class employeecontroller extends Controller
{
    public function index()
    {
        $users = usertype::with('Users')->find(2);

        echo $users;

        return view('admin.employee.index', compact('users'));
    }

    public function create()
    {
        return view('admin.employee.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'usertype' => 'required',
        ]);

        User::create($request->all());

        return redirect()->route('admin.employee.index');
    }

    public function edit($id)
    {
        $user = User::find($id);

        return view('admin.employee.edit', compact('user'));
    }
}
