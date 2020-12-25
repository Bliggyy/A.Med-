<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Precord;
use Illuminate\Support\Facades\Auth;

class PrecordController extends Controller
{
    public function index()
    {
        $data = Precord::all();
        return view('docHome',['data'=>$data]);
    }
    /**
     * 
     *
     * @param  array  $data
     * @return \App\Models\Precord
     */
    public function store(Request $request)
    {
        $pr = new Precord;
        $pr->p_id = auth()->user()->id;
        $pr->lname = $request->lname;
        $pr->fname = $request->fname;
        $pr->age = $request->age;
        $pr->sex = $request->sex;
        $pr->bdate = $request->bdate;
        $pr->pnumber = $request->pnumber;
        $pr->save();

        return redirect('/docHome');
    }

    public function update(Request $request)
    {
        $pr = Precord::find($request->p_id);
        $pr->lname = $request->lname;
        $pr->fname = $request->fname;
        $pr->age = $request->age;
        $pr->sex = $request->sex;
        $pr->bdate = $request->bdate;
        $pr->pnumber = $request->pnumber;
        $pr->save();

        return redirect('/docHome');
    }
}
