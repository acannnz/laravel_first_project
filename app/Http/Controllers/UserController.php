<?php

namespace App\Http\Controllers;

use App\Models\DataUser;
use app\Models\User;
use App\Models\Users;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    function user(Request $request)
    {
        return view('user.dashboard', ['data' => $request->session()]);
    }
    // function logo(string $id)
    // {
    //     $data = Users::get();
    //     return view('user.dashboard', ['data' => $data]);
    // }
    public function index(Request $request)
    {
        $data = [];
        if (auth()->check()) {
            $data = DataUser::where('user_id', auth()->id())->get();
        }
        return view('user.dashboard', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        $userId = $request->session()->get('id');
        if ($userId == $id) {
            $data = DataUser::find($id);
            return view('user.dashboard', compact('data'));
        } else {
            return redirect('/')->withErrors('Anda tidak diizinkan mengakses halaman ini.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = DataUser::where('id', $id)->first();
        return view('user.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
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
            'skill' => $request->skill
        ];
        DataUser::where('id', $id)->update($data);
        return redirect()->to('user')->with('success', 'Berhasil melakukan update data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
