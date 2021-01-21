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
        $dv = new DocVerify;
        $dv->doc_id = auth()->user()->id;
        $dv->verified = 'no';
        $dv->email = auth()->user()->email;

        $file = $request->file('doclicense');
        $extension = $file->getClientOriginalExtension();
        $filename = time() . '.' . $extension;
        $file->move('..\public\uploads', $filename);
        $dv->doclicense = $filename;

        $file = $request->file('boardcert');
        $extension = $file->getClientOriginalExtension();
        $filename = time() . '.' . $extension;
        $file->move('..\public\uploads', $filename);
        $dv->boardcert = $filename;

        $file = $request->file('diploma');
        $extension = $file->getClientOriginalExtension();
        $filename = time() . '.' . $extension;
        $file->move('..\public\uploads', $filename);
        $dv->diploma = $filename;

        $file = $request->file('refcontacts');
        $extension = $file->getClientOriginalExtension();
        $filename = time() . '.' . $extension;
        $file->move('..\public\uploads', $filename);
        $dv->refcontacts = $filename;

        $dv->save();

        return redirect('/docHome');
    }
}
