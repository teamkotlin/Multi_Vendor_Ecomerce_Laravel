<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class VendorController extends Controller
{
    public function dashboard()
    {
        return view('vendor.index');
    }
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('vendor/login');
    }
    public function login()
    {
        return view('vendor.login');
    }
    public function profile()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('vendor.profile_view', compact('user'));
    }
    public function profile_store(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->phone = $request->phone;
        if ($request->file('photo')) {
            $file = $request->file('photo');
            $fileName = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/profile'), $fileName);
            $user->photo = $fileName;
        }
        $user->save();
        $nofi = array(
            'message' => 'Profile Updated Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($nofi);
    }
}
