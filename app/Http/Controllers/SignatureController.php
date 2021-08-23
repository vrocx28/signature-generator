<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class SignatureController extends Controller
{
    public function signature()
    {
        return view('signature',['data' => '']);
    }

    public function signaturePost(Request $request)
    {   
        $input = $request->all();
        if(!empty($input['inputFname']))
        {
            $html='<div style=" display:flex; align-items:center; font-family:Poppins;height:100%; justify-content:center; margin:0 auto; width:100%;">'."\n".'<img src="'.asset('images/logo.png').'">'."\n".'<div style="margin-left:15px;">'."\n".'<h4 style="border-bottom:6px solid #4c668b; color:#4c668b; font-size:13px; font-weight:500; line-height:1.15; margin:0 0 6px; padding-bottom:8px;"><span style="display:block; font-weight:600;">'.$input['inputFname'].' '. $input['inputLname'].'</span>'.$input['inputPosition'].'</h4>'."\n".'<h5 style="color:#444; font-size:13px; font-weight:500; margin:0;"><span style="color:#4c668b; font-weight:600;">P: </span>'. $input['inputPhone'].''. " ".'<span style="color:#4c668b; font-weight:600;">E: </span>'.$input['inputEmail'].'</h5>'."\n".'</div>'."\n".'</div>';
            return redirect('signature')->with(['data' => $html]);
        }
        else{
            $html="fill details";
            return redirect('signature')->with(['data' => $html]);
        }
        
    }
}
