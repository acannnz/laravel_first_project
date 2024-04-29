<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\DataUser;
use App\Models\User;
use App\Models\Users;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $row = $request->input('row', 10);
        if (strlen($search)) {
            $data = User::where('id', 'like', "%$search%")
                ->orWhere('name', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%")
                ->paginate($row);
        } else {
            $data = User::orderBy('id', 'desc')->paginate($row);
        }
        return view('admin.dashboard', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Session::flash('name', $request->name);
        Session::flash('email', $request->email);
        Session::flash('password', $request->password);
        Session::flash('role', $request->role);
        //a
        $request->validate([
            'name' => 'required|unique:users,name',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required',
        ], [
            'name.required' => 'Nama wajib diisi',
            'name.unique' => 'Nama yang diisikan sudah ada dalam database',
            'email.required' => 'email wajib diisi',
            'password.required' => 'password wajib diisi',
            'role.required' => 'role wajib diisi',
        ]);
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ];
        Admin::create($data);
        return redirect()->to('admin')->with('success', 'Berhasil menambahkan data');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Admin::where('id', $id)->first();
        return view('admin.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ], [
            'name.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'password.required' => 'Password wajib diisi',
        ]);
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ];
        Admin::where('id', $id)->update($data);
        return redirect()->to('admin')->with('success', 'Berhasil melakukan update data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Admin::where('id', $id)->delete();
        return redirect()->to('admin')->with('success', 'Berhasil menghapus data');
    }

    function tambahProfil(string $id)
    {
        $data = Admin::where('id', $id)->first();
        return view('admin/tambahProfil', ['data' => $data]);
    }
    function fungsiTambahProfil(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required',
            'umur' => 'required',
            'alamat' => 'required',
            'pekerjaan' => 'required',
            'bio' => 'required',
            'skill' => 'required',
        ], [
            'nama.required' => 'Nama wajib diisi',
            'umur.required' => 'Email wajib diisi',
            'alamat.required' => 'Alamat wajib diisi',
            'pekerjaan.required' => 'Pekerjaan wajib diisi',
            'bio.required' => 'Biodata wajib diisi',
            'skill.required' => 'Skill wajib diisi',
        ]);
        $data = [
            'nama' => $request->nama,
            'umur' => $request->umur,
            'alamat' => $request->alamat,
            'pekerjaan' => $request->pekerjaan,
            'bio' => $request->bio,
            'user_id' => $id,
            'skill' => $request->skill
        ];
        DataUser::where('id', $id)->create($data);
        return redirect()->to('admin')->with('success', 'Berhasil melakukan tambah data');
    }
}
