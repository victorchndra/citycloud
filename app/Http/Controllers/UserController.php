<?php

namespace App\Http\Controllers;

use App\Models\User;
use Ramsey\Uuid\Uuid;
use App\Exports\UsersExport;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
         $datas = User::first()->cari(request(['search']))->paginate(10);


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

        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Menambah</em> pengguna baru <strong>[' . $request->name . ']</strong>',
            'category' => 'Tambah',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);

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
    public function edit($uuid)
    {
        $datas = User::where('uuid', $uuid)->get();
        return view('masters.users.edit', compact('datas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uuid)
    {
        // Define selected user
        $user = User::where('uuid', $uuid)->firstOrFail();

        // Change selected user personal data
        if ($request->name && $request->phone && $request->email && $request->username && $request->address) {
            $rules = [
                'name' => 'required|max:255',
                'phone' => 'required|numeric|min:12',
                'address' => 'required',
            ];

            if($request->username != $user->username) {
                $rules['username'] = 'required|unique:users';
            }

            if($request->email != $user->email) {
                $rules['email'] = 'required|email:dns|unique:users';
            }

            $validatedData = $request->validate($rules);

            $log = [
                'uuid' => Uuid::uuid4()->getHex(),
                'user_id' => Auth::user()->id,
                'description' => '<em>Mengubah</em> data personal akun <strong>[' . $request->name . ']</strong>',
                'category' => 'Edit',
                'created_at' => now(),
            ];

            DB::table('logs')->insert($log);
        }

        // Change selected user password
        if($request->oldPassword && $request->password && $request->cpassword) {
            // Validate inputed value from user
            $request->validate([
                //first array : used to custom field rules
                'oldPassword' => 'required',
                'password' => 'required|different:oldPassword',
                'cpassword' => 'required|same:password',
            ], [
                //second array : used to custom rules message
            ], [
                //third array : used to change validation name message
                'oldpassword' => 'old password',
                'password' => 'new password',
                'cpassword' => 'confirm new password',
            ]);

            // Check old password
            if(Hash::check($request->oldPassword, $user->password)) {
                $validatedData = [
                    'password' => bcrypt($request['password'])
                ];
            } else {
                return redirect()->route('users.changePassword', $uuid)->with('success', 'Kata sandi lama tidak cocok');
            }

            $log = [
                'uuid' => Uuid::uuid4()->getHex(),
                'user_id' => Auth::user()->id,
                'description' => '<em>Mengubah</em> kata sandi akun <strong>[' . $request->name . ']</strong>',
                'category' => 'Edit',
                'created_at' => now(),
            ];

            DB::table('logs')->insert($log);
        }

        $validatedData['uuid'] = Uuid::uuid4()->getHex();
        $validatedData['updated_by'] = Auth::user()->id;

        User::where('uuid', $uuid)->update($validatedData);

        return redirect('/users')->with('success', 'Data pengguna berhasil diperbarui!');
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
        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Menghapus</em> akun <strong>[' . $request->name . ']</strong>',
            'category' => 'Hapus',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);
        $data->delete();

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil dihapus!');
    }

    public function export()
    {
        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Export</em> data pengguna',
            'category' => 'Export',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);

        return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function changePassword($uuid) {
        $datas = User::where('uuid', $uuid)->get();
        return view('masters.users.editPassword', compact('datas'));
    }
}
