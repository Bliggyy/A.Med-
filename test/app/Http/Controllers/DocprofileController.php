<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Docprofile;
use App\Models\Precord;
use App\Models\Pprofile;
use Illuminate\Support\Facades\Auth;

class DocprofileController extends Controller
{
    public function index()
    {
        $data = Docprofile::all();
        $data2 = Precord::all();
        $data3 = Pprofile::all();
        return view('docHome', compact('data','data2','data3'));
    }
    /**
     * 
     *
     * @param  array  $data
     * @return \App\Models\Docprofile
     */
    public function store(Request $request)
    {
        $dp = new Docprofile;
        $dp->doc_id = auth()->user()->id;
        $dp->doc_email = auth()->user()->email;
        $dp->lname = $request->lname;
        $dp->fname = $request->fname;
        $dp->age = $request->age;
        $dp->sex = $request->sex;
        $dp->bdate = $request->bdate;
        $dp->pnumber = $request->pnumber;
        $dp->clinicadd = $request->clinicadd;
        $dp->save();

        return redirect('/docHome');
    }

    public function update(Request $request)
    {
        $dp = Docprofile::find($request->doc_id);
        $dp->lname = $request->lname;
        $dp->fname = $request->fname;
        $dp->age = $request->age;
        $dp->sex = $request->sex;
        $dp->bdate = $request->bdate;
        $dp->pnumber = $request->pnumber;
        $dp->clinicadd = $request->clinicadd;
        $dp->save();

        return redirect('/docHome');
    }
}
