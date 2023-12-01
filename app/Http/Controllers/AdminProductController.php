<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    public function addProduct()
    {
        return view('admin.product.product_add');
    }
}
