<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function allCategories()
    {
        $categories = Category::latest()->get();
        return view('admin.category.category_all', compact('categories'));
    }
    public function addCategory()
    {
        return view('admin.category.category_add');
    }
    public function storeCategory(Request $request)
    {
        $fileName = '';
        if ($request->file('photo')) {
            $file = $request->file('photo');
            $fileName = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/category'), $fileName);
        }
        Category::insert([
            'name' => $request->name,
            'image' => $fileName
        ]);
        $nofi = array(
            'message' => 'Category Added Successfully!',
            'alert-type' => 'success'
        );
        return redirect('/admin/category/all')->with($nofi);
    }
    public function deleteCategory($id)
    {
        Category::findOrFail($id)->delete();
        $nofi = array(
            'message' => 'Category Deleted Successfully!',
            'alert-type' => 'success'
        );
        return redirect('/admin/category/all')->with($nofi);
    }
    public function editCategory($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.category_edit', compact('category'));
    }
    public function updateCategory(Request $request)
    {

        $fileName = $request->old_img;
        if ($request->file('photo')) {
            $file = $request->file('photo');
            $fileName = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/category'), $fileName);
        }
        Category::find($request->id)->update([
            'name' => $request->name,
            'image' => $fileName
        ]);
        $nofi = array(
            'message' => 'Category Updated Successfully!',
            'alert-type' => 'success'
        );
        return redirect('/admin/category/all')->with($nofi);
    }
}
