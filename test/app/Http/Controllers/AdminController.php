<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DocVerify;
use App\Models\Precord;
use App\Models\Pprofile;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $data = User::all();
        $data2 = DocVerify::all();
        $data3 = User::all();
        $data4 = Precord::all();
        $data5 = Pprofile::all();
        return view('admin', compact('data','data2','data3','data4','data5'));
    }
    /**
     * 
     *
     * @param  array  $data
     * @return \App\Models\DocVerify
     */
    public function verify(Request $request)
    {
        $dv = DocVerify::find($request->id);
        $dv->verified = $request->verified;
        $dv->save();

        return redirect('/admin');
    }
}
