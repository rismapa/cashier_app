<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class SupplierController extends Controller
{
    public function index() {
        return view('supplier.supplier', [
            'first' => 'Supplier',
            'second' => 'Master',
            'third' => 'Supplier',
            'suppliers' => Supplier::all()
        ]);
    }

    public function add() {
        return view('supplier.addSupplier', [
            'first' => 'Tambah Supplier',
            'second' => 'Master',
            'third' => 'Supplier'
        ]);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required'
        ]);
        // dd($validated);
        Supplier::create($validated);
        return redirect('/supplier')->with('success', 'Supplier Berhasil Ditambahkan');
    }

    public function edit($id) {
        return view('supplier.editSupplier', [
            'first' => 'Edit Supplier',
            'second' => 'Master',
            'third' => 'Supplier',
            'supplier' => Supplier::where('id', $id)->first()
        ]);
    }

    public function update(Request $request, $id) {
        $validated = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required'
        ]);

        $supplier = Supplier::where('id', $id)->first();
        $supplier->update($validated);
        return redirect('/supplier')->with('success', 'Supplier Berhasil Diubah');
    }

    public function destroy($id) {
        $supplier = Supplier::where('id', $id)->first();
        $supplier->delete();
        return redirect('/supplier')->with('success', 'Supplier Berhasil Dihapus');
    }
}
