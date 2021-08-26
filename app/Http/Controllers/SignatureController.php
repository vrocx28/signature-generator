<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\Models\Admin;
use Session;
use Hash;


class SignatureController extends Controller
{
    # Bind the Model
    protected $admin;

    public function __construct(Admin $admin)
    {
        $this->admin = $admin;
    }

    public function adminPost(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('name', 'password');
        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect('signature');
        } else {
            return redirect('admin')->withErrors('Invalid Username or Password');
        }
    }
    
    public function admin()
    {
        if (Auth::guard('admin')->user()) {
            return redirect('signature');
        } else {
            return view('admin');
        }
    }

    public function signature()
    {
        return view('signature', ['data' => '']);
    }

    public function signaturePost(Request $request)
    {
        $input = $request->all();
        if (empty($input['inputFname']) || empty($input['inputLname']) || empty($input['inputJobPosition']) || empty($input['inputPhone']) || empty($input['inputEmail'])) {
            $html = "Fill All Details";
            return redirect('signature')->with(['data' => $html]);
        } else {
            $html = '<div style="font-family:Arial; margin:60px auto; width:493px;">' . "\n" . '<img style="float:left; margin:15px 0 0;" src="' . asset('images/logo.png') . '">' . "\n" . '<div style="margin-left:108px;">' . "\n" . '<h4 style="color:#4c668b; font-size:13px; font-weight:500; line-height:1.15; margin:0 0 8px;"><span style="display:block; font-weight:700; padding-bottom:3px;">' . $input['inputFname'] . ' ' . $input['inputLname'] . '</span>' . $input['inputJobPosition'] . '</h4>' . "\n" . '<h5 style="border-top:6px solid #4c668b; color:#999; display:inline-block; font-size:13px; font-weight:500; margin:0; padding-top:8px;"><span style="color:#4c668b; font-weight:600;">P </span>' . $input['inputPhone'] . '<span style="color:#4c668b; font-weight:600; margin-left:5px;">E </span>' . $input['inputEmail'] . '</h5>' . "\n" . '</div>' . "\n" . '</div>';
            return redirect('signature')->with(['data' => $html]);
        }
    }

    public function logout()
    {
        // Session::flush();
        Auth::guard('admin')->logout();

        return Redirect('admin');
    }
}
