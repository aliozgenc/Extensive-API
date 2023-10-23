<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CategoryController extends Controller
{
    public function viewCategories(Request $request)
    {
        // Sadece "view category" izni olan kullanıcılara kategorileri gösterin
        $this->authorize('view category');

        $categories = Category::all();
        return response()->json(['categories' => $categories]);
    }
}
