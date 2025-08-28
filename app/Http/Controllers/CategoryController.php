<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::all();
        
        return response()->json([
            'data' => $categories
        ]);
    }
    
    public function show(string $id) {
        $category = Category::findOrFail($id);
        
        return response()->json([
            'data' => $category
        ]);
    }
    
    public function store(Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ]);
        }
        
        return response()->json([
            'message' => 'Successfully created category',
            'data' => $request->all()
        ]);
    }
}
