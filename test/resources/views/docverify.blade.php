@extends('layouts.app')

@section('header')
<title>Doctor Verification | A.med</title>
@endsection

@section('content')
<div class="login">
    <img src="../../assets/finallogo.png" id="logo" alt="logo">
    <h1>V E R I F I C A T I O N</h1>
    <div class="login_bx">
        <p>Requirements:</p>
        <p>Please attach .jpg files</p>
        <form method="POST" action="docverifycreate" onclick="/home" enctype="multipart/form-data">
            @csrf
            <table style="width: 100%"> 
                <tr>
                    <td><label>Doctor's License </label></td>
                    <td><input type="file" name="doclicense" required></td>
                </tr>
                <tr>
                    <td><label>Board Certification </label></td>
                    <td><input type="file" name="boardcert" required></td>
                </tr>
                <tr>
                    <td><label>Medical School Diploma </label></td>
                    <td><input type="file" name="diploma" required></td>
                </tr>
                <tr>
                    <td><label>Reference Contacts </label></td>
                    <td><input type="file" name="refcontacts" required></td>
                </tr>
            </table>
            <input type="submit" value="Submit" name="submit" class="login_sub"><br>
        </form>
        <p><a class="btn-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Go Back') }}</a></p>
    </div>
</div>
@endsection
