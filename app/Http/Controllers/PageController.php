<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function mainPage() {
        return view('main');
    }

    public function catalogPage() {
        return view('catalog');
    }

    public function productPage() {
        return view('product');
    }
}
