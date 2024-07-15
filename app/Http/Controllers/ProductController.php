<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        return view('product.product', [
            'first' => 'Barang',
            'second' => 'Master',
            'third' => 'Barang',
            'products' => Product::all()
        ]);
    }

    public function add() {
        return view('product.addProduct', [
            'first' => 'Tambah Barang',
            'second' => 'Master',
            'third' => 'Barang',
            'suppliers' => Supplier::all(),
            'categories' => Category::all()
        ]);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'supplier_id' => 'required',
            'category_id' => 'required',
            'code' => 'required',
            'name' => 'required',
            'stock' => 'required',
        ]);
        // dd($validated);
        $price = $request->input('price');
        $validated['price'] = str_replace([',', ' '], '', $price);
        Product::create($validated);
        return redirect('/product')->with('success', 'Product Berhasil Ditambahkan');
    }

    public function edit($id) {
        return view('product.editProduct', [
            'first' => 'Edit Barang',
            'second' => 'Master',
            'third' => 'Barang',
            'p' => Product::where('id', $id)->first(),
            'suppliers' => Supplier::all(),
            'categories' => Category::all()
        ]);
    }

    public function update(Request $request, $id) {
        $validated = $request->validate([
            'supplier_id' => 'required',
            'category_id' => 'required',
            'code' => 'required',
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required',
        ]);
        // dd($validated);
        $price = $request->input('price');
        $validated['price'] = str_replace([',', ' '], '', $price);
        $product = Product::where('id', $id)->first();
        $product->update($validated);
        return redirect('/product')->with('success', 'Product Berhasil Diubah');
    }

    public function stok() {
        return view('stokbarang', [
            'first' => 'Barang',
            'second' => 'Master',
            'third' => 'Barang',
            'products' => Product::all()
        ]);
    }
}
