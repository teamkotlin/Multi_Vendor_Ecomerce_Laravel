<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function userDashboard()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('index', compact('user'));
    }
    public function userProfileStore(Request $request)
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
    public function userLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('login');
    }
}
