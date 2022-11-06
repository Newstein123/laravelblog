<?php

namespace App\Http\Controllers\admin;


use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $user_count = User::where('role_as', '0')->orderBy('id', 'desc')->count();
        $admin_count = User::where('role_as', '1')->orderBy('id', 'desc')->count();
        $editor_count = User::where('role_as', '2')->orderBy('id', 'desc')->count();
        $users = User::orderBy('id', 'desc')->paginate(5);
        return view('admin/user/index', compact('users', 'user_count', 'admin_count', 'editor_count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/user/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => bcrypt($request->password),
            'role_as'   => $request->role_as, 
            'address'   => $request->address,
            'dob'       => $request->dob,
            'phone_no'  => $request->phone_no,
            'gender'    => $request->gender
        ]);

        return redirect('admin/user')->with('message', 'An Author is created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin/user/show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $user = User::findOrFail($id);
        return view('admin/user/edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect('admin/user')->with('message', 'A user is deleted successfully');
    }
}
