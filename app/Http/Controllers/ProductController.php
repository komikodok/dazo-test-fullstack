<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        return Inertia::render('products/index', [
            'products' => $products
        ]);
    }

    public function create()
    {
        $categories = Category::all();
        return Inertia::render('products/create', [
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'         => 'required|string|max:255',
            'sku'          => 'required|string|unique:products,sku',
            'status'       => 'required|boolean',
            'stock'        => 'required|integer|min:0',
            'cost_price'   => 'required|numeric|min:0',
            'sell_price'   => 'required|numeric|min:0',
            'special_price'=> 'nullable|numeric|min:0',
            'imageUrl'     => 'nullable|string',
            'variants'     => 'nullable|string',
            'type'         => 'required|string|in:simple,variant,bundle',
            'category_id'  => 'required|string|max:255',
            'createdAt'    => 'nullable|date',
        ]);

        Product::create([
            'name'          => $data['name'],
            'sku'           => $data['sku'],
            'status'        => $data['status'],
            'stock'         => $data['stock'],
            'cost_price'    => $data['cost_price'],
            'sell_price'    => $data['sell_price'],
            'special_price' => $data['special_price'] ?? null,
            'imageUrl'      => $data['imageUrl'] ?? null,
            'variants'      => $data['variants'] ?? null,
            'type'          => $data['type'] ?? 'simple',
            'category_id'   => $data['category_id'],
            'createdAt'     => $data['createdAt'] ?? now(),
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function show(string $id)
    {
        $product = Product::with('category')->findOrFail($id);
        return Inertia::render('products/show', [
            'product' => $product
        ]);
    }

    public function edit(string $id)
    {
        $product    = Product::findOrFail($id);
        $categories = Category::all();

        return Inertia::render('products/edit', [
            'product'    => $product,
            'categories' => $categories
        ]);
    }

    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'code'        => 'required|string|unique:products,code,' . $id . ',_id',
            'imageUrl'    => 'nullable|string',
            'variants'    => 'nullable|array',
            'type'        => 'nullable|string',
            'category_id' => 'required|string',
            'price_min'   => 'required|numeric',
            'price_max'   => 'required|numeric',
            'status'      => 'required|string|in:active,inactive',
        ]);

        $product->update([
            'name'        => $data['name'],
            'code'        => $data['code'],
            'imageUrl'    => $data['imageUrl'] ?? null,
            'variants'    => $data['variants'] ?? [],
            'type'        => $data['type'] ?? null,
            'category_id' => $data['category_id'],
            'price'       => [
                'min' => $data['price_min'],
                'max' => $data['price_max'],
            ],
            'status'      => $data['status'],
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil diupdate!');
    }

    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus!');
    }
}
