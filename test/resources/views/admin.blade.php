@extends('layouts.app')

@section('header')
<title>Home | A.med</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{ URL::asset('js/script.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@endsection

@section('content')
<div class="container1">
  <div class="row">
    <div class="col-md-12"> 
      <!-- Nav tabs -->
      <div class="card" id="card">
        <ul class="nav nav-tabs" id="nav-tabs" role="tablist">
          <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab"><i class="fa fa-home"></i><span>User List</span></a></li>
          <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"><i class="fa fa-user"></i><span>Doctor Verification</span></a></li>
          <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab"><i class="fa fa-envelope-o"></i><span>Patient Records</span></a></li>
          <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab"><i class="fa fa-cog"></i><span>About Us</span></a></li>
        </ul>
        
        <!-- Tab panes -->
        <div class="tab-content" id="tab-content">
            <!-- Tab 1 -->
            <div role="tabpanel" class="tab-pane active" id="home">
            @if($data != NULL)
            @foreach($data as $data)
            <center>
              <b>User ID: {{$data->id}}</b><br>
              Username: {{$data->username}}<br>
              E-mail: {{$data->email}}<br>
              Account type: {{$data->account_type}}<br><hr>
            </center>
            @endforeach
            @endif
            </div>
            <!-- End Tab 1 -->

            <!-- Tab 2 -->
            <div role="tabpanel" class="tab-pane" id="profile">
            @if($data2 != NULL)
            @foreach($data2 as $data2)
            <center>
              <b>{{$data2->email}}</b><br>
              <b>Verified: {{$data2->verified}}</b><br>
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                VERIFY
              </button><br>
              <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                     <div class="modal-dialog modal-dialog-centered" role="document">
                         <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLongTitle">Verify</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                          <div class="modal-body">
                              <form method="POST" action="verify">
                                  @csrf
                                  <input type="hidden" name="id" value="{{$data2->id}}">
                                  <select class="form-control" name="verified" required>
                                    <option selected disabled>Verify</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                  </select><br>
                                  <input type="submit" value="Submit" name="submit" class="login_sub">
                              </form>
                          </div>
                          </div>
                      </div>
                  </div>
              Doctor's License: <br><img class="verify" src="{{ asset('uploads/' . $data2->doclicense) }}" /><br>
              Board Certificate: <br><img class="verify" src="{{ asset('uploads/' . $data2->boardcert) }}" /><br>
              Diploma: <br><img class="verify" src="{{ asset('uploads/' . $data2->diploma) }}" /><br>
              Reference Contacts: <br><img class="verify" src="{{ asset('uploads/' . $data2->refcontacts) }}" /><hr><br>
            </center>
            @endforeach
            @endif
            </div>
            <!-- End Tab 2 -->

            <!-- Tab 3 -->
            <div role="tabpanel" class="tab-pane" id="messages">
            @if($data4 != NULL)
            @foreach($data4 as $data4)
            @if($data5 != NULL)
            @foreach($data5 as $data5)
            @if($data4->p_email == $data5->p_email)
            <center>
              Name: {{$data5->lname}}, {{$data5->fname}}<br>
              E-mail: {{$data5->p_email}}<br>
              Age: {{$data5->age}}<br>
              Sex: {{$data5->sex}}<br>
              Birth Date:  {{$data5->bdate}}<br>
              Phone Number: {{$data5->pnumber}}<br>
              Blood Type: {{$data4->blood_type}}<br>
              Major Illnesses: {{$data4->major_illnesses}}<br>
              Allergies: {{$data4->allergies}}<br>
              Emergency Contact Person: {{$data4->e_contact}}<br>
              Emergency Contact Number: {{$data4->e_number}}<hr><br>
            </center>
            @endif
            @endforeach
            @endif
            @endforeach
            @endif
            </div>
            <!-- End Tab 3 -->

            <!-- Tab 4 -->
            <div role="tabpanel" class="tab-pane" id="settings">
              <center>A.med has been in development since the first year of the following students from the University of San Carlos - Talamban Campus:<br><br>
              Chua, Dan Hoover<br>
              Ignacio, Bligh Stian<br>
              Lawas, Denzel John<br>
              Villaflor, Liam Matthew<br><br>
              ©A.med 2020</center>
            </div>
            <!-- End Tab 4 -->
        </div>
      </div>
    </div>
  </div>
</div>
@endsection


