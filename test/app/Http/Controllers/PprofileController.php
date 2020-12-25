<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pprofile;
use App\Models\Precord;
use Illuminate\Support\Facades\Auth;

class PprofileController extends Controller
{
    public function index()
    {
        $data3 = Pprofile::all();
        $data2 = Precord::all();
        return view('home', compact('data2','data3'));
    }
    /**
     * 
     *
     * @param  array  $data
     * @return \App\Models\Pprofile
     */
    public function store(Request $request)
    {
        $pp = new Pprofile;
        $pp->p_id = auth()->user()->id;
        $pp->p_email = auth()->user()->email;
        $pp->lname = $request->lname;
        $pp->fname = $request->fname;
        $pp->age = $request->age;
        $pp->sex = $request->sex;
        $pp->bdate = $request->bdate;
        $pp->pnumber = $request->pnumber;
        $pp->save();

        return redirect('/home');
    }

    public function update(Request $request)
    {
        $pp = Pprofile::find($request->p_id);
        $pp->lname = $request->lname;
        $pp->fname = $request->fname;
        $pp->age = $request->age;
        $pp->sex = $request->sex;
        $pp->bdate = $request->bdate;
        $pp->pnumber = $request->pnumber;
        $pp->save();

        return redirect('/home');
    }
}
