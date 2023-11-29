<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function allBrands()
    {
        return view('admin.brand.brand_all');
    }
    public function addBrand()
    {
        return view('admin.brand.brand_add');
    }
}
