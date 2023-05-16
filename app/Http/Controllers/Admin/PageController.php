<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function authPage()
    {
        return view('admin.auth');
    }

    public function categoriesPage()
    {
        return view('admin.categories');
    }

    public function characteristicsPage()
    {
        return view('admin.characteristics');
    }

    public function productsPage()
    {
        return view('admin.products');
    }
}
