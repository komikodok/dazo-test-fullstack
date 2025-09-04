<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')
            ->paginate(5);
            
        return Inertia::render('products/index', [
            'products' => $products
        ]);
    }

    public function create() {
        return Inertia::render('products/create', [
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'          => 'required|string|max:255',
            'sku'           => 'required|string|max:100',
            'status'        => 'required|boolean',
            'type'          => 'required|string',
            'category'      => 'required|string|max:255',

            'variants'               => 'nullable|array',
            'variants.*.name'          => 'nullable|string|max:255',
            'variants.*.capital_price' => 'nullable|numeric|min:0',
            'variants.*.sell_price'    => 'nullable|numeric|min:0',
            'variants.*.special_price' => 'nullable|numeric|min:0',
            'variants.*.stock'         => 'nullable|integer|min:0',

            'created_at'     => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ]);
        }
        
        $data = $validator->validate();
        
        $category = Category::where('name', $data['category'])->first();

        if (!$category) {
            $category = Category::create([
                'name' => $data['category']
            ]);
        }
        
        try {
            Product::create(array_merge(
                $data,
                ['category_id' => $category->_id]
            ));
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }

        return response()->json([
            'message' => 'Produk berhasil ditambahkan'
        ]);
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name'          => 'required|string|max:255',
            'sku'           => 'required|string|max:100',
            'status'        => 'required|boolean',
            'type'          => 'required|string',
            'category'      => 'required|string|max:255',

            'variants'               => 'nullable|array',
            'variants.*.name'          => 'nullable|string|max:255',
            'variants.*.capital_price' => 'nullable|numeric|min:0',
            'variants.*.sell_price'    => 'nullable|numeric|min:0',
            'variants.*.special_price' => 'nullable|numeric|min:0',
            'variants.*.stock'         => 'nullable|integer|min:0',

            'updated_at'     => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ]);
        }
        
        $data = $validator->validate();
        
        $category = Category::where('name', $data['category'])->first();

        if (!$category) {
            $category = Category::create([
                'name' => $data['category']
            ]);
        }
        
        try {
            $product = Product::findOrFail($id);
            $product->update(array_merge(
                $data,
                ['category_id' => $category->_id]
            ));
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }

        return response()->json([
            'message' => 'Produk berhasil diupdate'
        ]);
    }

    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json([
            'message' => 'Produk berhasil dihapus'
        ], 200);
    }
}
