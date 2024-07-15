<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {
        return view('category.category', [
            'first' => 'Kategori',
            'second' => 'Master',
            'third' => 'Kategori',
            'categories' => Category::all()
        ]);
    }

    public function add() {
        return view('category.addCategory', [
            'first' => 'Tambah Kategori',
            'second' => 'Master',
            'third' => 'Kategori'
        ]);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            // 'code' => 'required|regex:/^[0-9]{2}$/',
            'code' => 'required',
            'name' => 'required'
        ]);

        // dd($validated);
        Category::create($validated);
        return redirect('/category')->with('success', 'Kategori Baru Berhasil Ditambahkan');
    }

    public function edit($id) {
        return view('category.editCategory', [
            'first' => 'Edit Kategori',
            'second' => 'Master',
            'third' => 'Kategori',
            'category' => Category::where('id', $id)->first()
        ]);
    }

    public function update(Request $request, $id) {
        $validated = $request->validate([
            'code' => 'required|regex:/^[0-9]{2}$/',
            'name' => 'required'
        ]);

        $category = Category::where('id', $id)->first();
        $category->update($validated);
        return redirect('/category')->with('success', 'Kategori Baru Berhasil Diubah');
    }

    public function destroy($id) {
        $category = Category::where('id', $id)->first();
        $category->delete();
        return redirect('/category')->with('success', 'Kategori Berhasil Dihapus');
    }
}
