<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminVendorController extends Controller
{
    public function activeVendors()
    {
        $users = User::where(['role' => 'vendor', 'status' => 'active'])->latest()->get();
        $status = 'Active';
        return view('admin.vendor.vendors_table', compact('users', 'status'));
    }
    public function newVendors()
    {
        $users = User::where(['role' => 'vendor', 'status' => 'inactive'])->latest()->get();
        $status = 'New';
        return view('admin.vendor.vendors_table', compact('users', 'status'));
    }
    public function viewVendor($id)
    {
        $user = User::findOrFail($id);
        return view('admin.vendor.vendor_detail_view', compact('user'));
    }
    public function approveVendor(Request $request)
    {
        User::find($request->id)->update(['status' => 'active']);
        return redirect('/admin/vendors/active');
    }
}
