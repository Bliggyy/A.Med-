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
        $pr->p_email = $request->p_email;
        $pr->blood_type = $request->blood_type;
        $pr->last_visit = $request->last_visit;
        $pr->major_illnesses = $request->major_illnesses;
        $pr->allergies = $request->allergies;
        $pr->e_contact = $request->e_contact;
        $pr->e_number = $request->e_number;
        $pr->medication = $request->medication;
        $pr->save();

        return redirect('/docHome');
    }

    public function update(Request $request, $id)
    {
        $pr = Precord::find($id);
        $pr->blood_type = $request->blood_type;
        $pr->last_visit = $request->last_visit;
        $pr->major_illnesses = $request->major_illnesses;
        $pr->allergies = $request->allergies;
        $pr->e_contact = $request->e_contact;
        $pr->e_number = $request->e_number;
        $pr->medication = $request->medication;
        $pr->save();

        return redirect('/docHome');
    }
}
