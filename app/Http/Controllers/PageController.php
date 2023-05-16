<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Direction;
use App\Models\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function mainPage()
    {
        return view('main');
    }

    public function catalogPage(Direction $direction, Category $category)
    {
        $products = Product::query()
            ->where('category_id', $category->id)
            ->whereHas('directions', function ($query) use ($direction) {
                $query->where('directions.id', $direction->id);
            })
            ->get();
        return view('catalog', ['products' => $products, 'category' => $category]);
    }

    public function productPage(Product $product)
    {
        return view('product', ['product' => $product->load('images', 'characteristics')]);
    }
}
