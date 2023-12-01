<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\SubCategory;

class SubCategoryController extends Controller
{
    public function allSubCategories()
    {
        $sub_categories = SubCategory::with('category')->latest()->get();
        return view('admin.sub_category.sub_category_all', compact('sub_categories'));
    }
    public function addSubCategory()
    {
        $categories = Category::all();
        return view('admin.sub_category.sub_category_add', compact('categories'));
    }
    public function storeSubCategory(Request $request)
    {

        SubCategory::insert([
            'name' => $request->name,
            'category_id' => $request->category_id
        ]);
        $nofi = array(
            'message' => 'SubCategory Added Successfully!',
            'alert-type' => 'success'
        );
        return redirect('/admin/sub_category/all')->with($nofi);
    }
    public function deleteSubCategory($id)
    {
        SubCategory::findOrFail($id)->delete();
        $nofi = array(
            'message' => 'SubCategory Deleted Successfully!',
            'alert-type' => 'success'
        );
        return redirect('/admin/sub_category/all')->with($nofi);
    }
    public function editSubCategory($id)
    {
        $sub_category = SubCategory::with('category')->findOrFail($id);
        $categories = Category::all();

        return view('admin.sub_category.sub_category_edit', compact('sub_category', 'categories'));
    }
    public function updateSubCategory(Request $request)
    {

        SubCategory::find($request->id)->update([
            'name' => $request->name,
            'category_id' => $request->category_id
        ]);
        $nofi = array(
            'message' => 'SubCategory Updated Successfully!',
            'alert-type' => 'success'
        );
        return redirect('/admin/sub_category/all')->with($nofi);
    }
}
