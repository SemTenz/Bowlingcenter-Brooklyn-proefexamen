<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\usertype;
use App\Models\users;

use function Laravel\Prompts\password;

class employeecontroller extends Controller
{
    public function index()
    {
        $users = usertype::with('Users')->find(2);



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
            'usertype' => 'required',
            'password' => 'required'
        ]);

        $user = new User(
            [
                'name' => $request->name,
                'email' => $request->email,
                'usertype' => $request->usertype,
                'password' => bcrypt('password'),
            ]
        );

        $user->save();

        $users = usertype::with('Users')->find(2);



        return view('admin.employee.index', compact('users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'usertype' => 'required',
        ]);

        User::find($id)->update($request->all());

        $users = usertype::with('Users')->find(2);

        return view('admin.employee.index', compact('users'));
    }

    public function edit($id)
    {
        $user = User::find($id);


        return view('admin.employee.edit', compact('user'));
    }


    public function destroy($id)

    {

        User::find($id)->delete();



        return redirect('admin/index');
    }
}
