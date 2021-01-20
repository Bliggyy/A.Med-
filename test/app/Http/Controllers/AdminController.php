<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DocVerify;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $data = User::all();
        $data2 = DocVerify::all();
        return view('admin', compact('data','data2'));
    }
    /**
     * 
     *
     * @param  array  $data
     * @return \App\Models\DocVerify
     */

}
