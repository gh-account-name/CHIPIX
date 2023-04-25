<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function authPage() {
        return view('admin.auth');
    }

    public function categoriesPage() {
        return view('admin.categories');
    }
}
