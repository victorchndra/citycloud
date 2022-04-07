<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $thisId = \Auth::user()->id;
        $data = User::findOrFail($thisId);
        
        return view('profile', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, $uid)
    {
        $thisId = \Auth::user()->id;
        $data = User::findOrFail($thisId);

        if (!empty($request->get('password'))) {
            $request->validate([
                'name' => 'required',
                'password' => 'confirmed|min:4',
                'username' => [
                    'required', 'min:4',
                    Rule::unique('users')->ignore($thisId)
                ]
            ],[
                'username.unique' => 'Username sudah digunakan',
                'password.confirmed' => 'Password dan konfirmasi password tidak sesuai',
            ]);
        } else {
            $request->validate([
                'name' => 'required',
                'username' => [
                    'required', 'min:4',
                    Rule::unique('users')->ignore($thisId)
                ],
            ],[
                'username.unique' => 'Username sudah digunakan',
            ]);
        }

        DB::beginTransaction();

        try {
            $data->username = $request->get('username');
            $data->name = $request->get('name');
            $data->address = $request->get('address');
            $data->phone = $request->get('phone');
            $data->email = $request->get('email');
            $data->updated_by = \Auth::user()->id;

            if (!empty($request->get('password')))
                $data->password = \Hash::make($request->get('password'));
            
            $data->save();

            DB::commit();
            
            return redirect()->route('citizens.index')->with('status', 'Data Profil berhasil diupdate!');

        } catch (\Throwable $th) {
            throw $th;

            DB::rollback();
            return redirect()->route('profiles.index', [$uid])->with('status', 'FAILED');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
