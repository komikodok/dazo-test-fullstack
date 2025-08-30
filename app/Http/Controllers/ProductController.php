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
            'sku'           => 'required|string|unique:products,sku',
            'status'        => 'required|boolean',
            'type'          => 'required|string|in:simple,variant,bundle',
            
            'category_id'   => 'required|string|exists:categories,_id',

            'variants'      => 'nullable|array',
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
        
        $category = Category::where('name', $data['category']);

        if (!$category) {
            $category = Category::create([
                'name' => $data['category']
            ]);
        }
        
        Product::create(array_merge([
            $data,
            'category_id' => $category->id
        ]));

        return redirect()
            ->route('products.index')
            ->with('success', 'Produk berhasil ditambahkan!');
    }

    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus!');
    }
}
