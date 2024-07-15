<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class UserController extends Controller
{
    public function index() {
        return view('user.user', [
            'first' => 'User',
            'second' => 'Master',
            'third' => 'User',
            'users' => User::where('role_id', 2)->get()
        ]);
    }

    public function add() {
        return view('user.addUser', [
            'first' => 'Tambah User',
            'second' => 'Master',
            'third' => 'User',
        ]);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required',
            'username' => 'required'
        ]);
        // $validated['role_id'] = 2;
        $validated['password'] = '$2a$12$46dfvqwVAlxl0BeRDJamPuLuT4/eCY/yBSFlMtfin83mAT27U6vo.';

        // dd($validated);
        User::create($validated);
        return redirect('/user')->with('success', 'User Berhasil Ditambahkan');
    }

    public function edit($id) {
        return view('user.editUser', [
            'first' => 'Edit User',
            'second' => 'Master',
            'third' => 'User',
            'user' => User::where('id', $id)->first()
        ]);
    }

    public function update(Request $request, $id) {
        $validated = $request->validate([
            'name' => 'required',
            'username' => 'required',
        ]);

        $user = User::where('id', $id)->first();
        $user->update($validated);
        return redirect('/user')->with('success', 'User Berhasil Diubah');
    }

    public function destroy($id) {
        $user = User::where('id', $id)->first();
        $user->delete();
        return redirect('/user')->with('success', 'User Berhasil Dihapus');
    }

    public function profil() {
        return view('user.profil', [
            'first' => 'Profil',
            'second' => 'Profil',
            'third' => 'Profil',
            'user' => User::all(),
        ]);
    }

    public function editProfil(Request $request, $id) {
        $validated = $request->validate([
            'name' => 'required',
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'name' => $validated['name'],
            'username' => $validated['username'],
            'password' => bcrypt($validated['password']),
        ]);

        return redirect()->back()->with('success', 'Data Diri Berhasil Diupdate!');
    }
}
