<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DocVerify;
use Illuminate\Support\Facades\Auth;

class DocVerifyController extends Controller
{
    public function index()
    {
        return view('docverify');
    }
    /**
     * 
     *
     * @param  array  $data
     * @return \App\Models\DocVerify
     */
    public function store(Request $request)
    {
        $request->file('doclicense')->move('..\public\uploads');
        $request->file('boardcert')->move('..\public\uploads');
        $request->file('diploma')->move('..\public\uploads');
        $request->file('refcontacts')->move('..\public\uploads');

        $dv = new DocVerify;
        $dv->doc_id = auth()->user()->id;
        $dv->doclicense = $request->doclicense->getClientOriginalName();
        $dv->boardcert = $request->boardcert->getClientOriginalName();
        $dv->diploma = $request->diploma->getClientOriginalName();
        $dv->refcontacts = $request->refcontacts->getClientOriginalName();
        $dv->save();

        return redirect('/docHome');
    }
}
