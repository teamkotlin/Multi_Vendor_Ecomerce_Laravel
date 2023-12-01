<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Image;

class BrandController extends Controller
{
    public function allBrands()
    {
        $brands = Brand::latest()->get();
        return view('admin.brand.brand_all', compact('brands'));
    }
    public function addBrand()
    {
        return view('admin.brand.brand_add');
    }
    public function storeBrand(Request $request)
    {
        $fileName = '';
        if ($request->file('photo')) {
            $file = $request->file('photo');
            $fileName = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/brand'), $fileName);
        }
        Brand::insert([
            'name' => $request->name,
            'slug' => strtolower(str_replace(' ', '-', $request->name)),
            'image' => $fileName
        ]);
        $nofi = array(
            'message' => 'Brand Added Successfully!',
            'alert-type' => 'success'
        );
        return redirect('/admin/brand/all')->with($nofi);
    }
    public function deleteBrand($id)
    {
        Brand::findOrFail($id)->delete();
        $nofi = array(
            'message' => 'Brand Deleted Successfully!',
            'alert-type' => 'success'
        );
        return redirect('/admin/brand/all')->with($nofi);
    }
    public function editBrand($id)
    {
        $brand = Brand::findOrFail($id);
        return view('admin.brand.brand_edit', compact('brand'));
    }
}
