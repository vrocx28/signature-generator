<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
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

    // login function
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
            return back()->withErrors('Invalid Username or Password');
        }
    }

    // function to return admin login form
    public function adminLoginForm()
    {
        if (Auth::guard('admin')->user()) {
            return redirect('signature');
        } else {
            return view('login');
        }
    }

    // function to return signatue view
    public function signatureForm()
    {
        return view('signature', ['data' => '']);
    }

    // function to function to generate signature script
    public function signaturePost(Request $request)
    {
        $phone = "";
        $mobile = "";
        $breakline = "";
        $input = $request->all();
        if ($request->hasfile('inputLogopic')) {
            $file = $request->file('inputLogopic');
            $picname = ((string)(microtime(true) * 10000)) . "-" . $file->getClientOriginalName();
            $file->move('images/', $picname);

            $logoimg ='<img style="float:left; height:120px; width:147px;" src="' . asset('images/' . $picname) . '">';
        } else {
            $logoimg ='<img style="float:left; height:120px; width:147px;" src="' . asset('images/logo.png') . '">';
        }
        if ($input['inputPhone']) {
            $phone = '<img src="' . asset('images/icons/phone-icon.png') . '"> ' . $input['inputPhone'] . ' &nbsp;&nbsp;';
        }
        if ($input['inputMobile']) {
            $mobile = '<img src="' . asset('images/icons/mobile-icon.png') . '"> ' . $input['inputMobile'] . '';
        }
        if ($input['inputPhone'] || $input['inputMobile']) {
            $breakline = '<br>';
        }

        $html = '<div style="font-family:Mulish; font-size:14px; margin:60px auto; width:493px;">'. "\n" .''.$logoimg.' ' . "\n" . '<div style="margin-left:170px;">' . "\n" . '<h4 style="color:#000; font-size:15px; font-weight:500; line-height:1.15; margin:0 0 10px;"><span style="color:#05A3F4; display:block; font-size:22px; font-weight:600; padding:5px 0 3px; text-transform:uppercase; font-family:Oswald;">' . $input['inputFname'] . ' ' .  $input['inputLname'] . '</span> <span style="color:#000000; display:block;">' .  ucwords($input['inputJobPosition']) . ' at NDS Digital</span></h4>' . "\n" . '<h5 style="border-image:linear-gradient(35deg, #B2FF59, #05A3F4) 1; border-top-style:solid; border-width:1.5px; color:#000; display:inline-block; font-size:14px; font-weight:400; line-height:1.5; margin:0; padding-right:30px; padding-top:7px;">' . $phone . '' . $mobile . ' ' . $breakline . '<img style="vertical-align:middle;" src="' . asset('images/icons/email-icon.png') . '">  ' . $input['inputEmail'] . ' &nbsp;&nbsp;<img style="vertical-align:middle;" src="' . asset('images/icons/web-icon.png') . '"> ndsdigital.com</h5>' . "\n" . '</div>' . "\n" . '</div>';
        return redirect('signature')->with(['data' => $html]);
    }

    public function ForgetPasswordPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:admins',
        ]);
        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        $to_email = $request->email;
        Mail::send('forgotpasswordemail', ['token' => $token], function ($message) use ($to_email) {
            $message->to($to_email)->subject("Reset Password");
            $message->from("vaibhdev28@gmail.com", "Dev lord");
        });

        return back()->with('message', 'Check e-mail to reset password');
    }

    public function ResetPasswordForm($token)
    {
        $email = DB::table('password_resets')->where('token', $token)->value('email');
        return view('resetpassword', ['token' => $token, 'email' => $email]);
    }

    public function ResetPasswordPost(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required'
        ]);

        $updatePassword = DB::table('password_resets')
            ->where([
                'email' => $request->email,
                'token' => $request->token
            ])
            ->first();

        if (!$updatePassword) {
            return back()->withInput()->with('error', 'Invalid token!');
        }
        $data['password'] = bcrypt($request->password);

        $update = $this->admin::where('email', $request->email)->update($data);

        DB::table('password_resets')->where(['email' => $request->email])->delete();

        return redirect('login')->with('message', 'Your password has been changed!');
    }

    // logout function
    public function logout()
    {
        Auth::guard('admin')->logout();
        return Redirect('login');
    }
}
