<?php

namespace App\Http\Controllers;

use App\Models\User;
use Ramsey\Uuid\Uuid;
use App\Exports\UsersExport;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         //get data dari table citizen dengan urutan ascending 10 pertama
         $datas = User::first()->paginate(10);


         //render view dengan variable yang ada menggunakan 'compact', method bawaan php
          return view('masters.users.index', compact('datas'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('masters.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|unique:users|alpha_dash',
            'email' => 'required|email:dns|unique:users',
            'phone' => 'required|numeric|min:12',
            'password' => 'required',
            'cpassword' => 'required|same:password',
            'address' => 'required',
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);
        $validatedData['uuid'] = Uuid::uuid4()->getHex();
        $validatedData['created_by'] = Auth::user()->id;

        User::create($validatedData);

        return redirect('/users')->with('success','Data pengguna berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
    public function destroy($uuid)
    {
        $data = User::get()->where('uuid', $uuid)->firstOrFail();
        $data->deleted_by = Auth::user()->id;
        $data->save();
        $data->delete();

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil dihapus!');
    }

    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
}
