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
              <center><input type="text" name="search" id="search" placeholder="Search..." title="Type in a name"></center><br>
              <table class="ulist">
                <td class="uid"><b>User ID</b></td>
                <td class="uname"><b>Username</b></td>
                <td class="elist"><b>E-mail</b></td>
                <td class="acctype"><b>Account type</b></td>
              </table>
              <table id="table" class="ulist">
              @if($data != NULL)
              @foreach($data as $data)
              <center>
                <tr>
                <td class="uid">{{$data->id}}</td>
                <td class="uname">{{$data->username}}</td>
                <td class="elist">{{$data->email}}</td>
                <td class="acctype">{{$data->account_type}}</td>
                </tr>
              </center>
              @endforeach
              @endif
              </table>
            </div>
            <!-- End Tab 1 -->

            <!-- Tab 2 -->
            <div role="tabpanel" class="tab-pane" id="profile">
              <center><input type="text" name="search2" id="search2" placeholder="Search..." title="Type in a name"></center><br>
              <table class="ulist">
                <td class="uid"><b>Doctor ID</b></td>
                <td class="demail"><b>E-mail</b></td>
                <td class="vers"><b>Verification Status</b></td>
                <td class="files"><b>Files</b></td>
                <td class="ver"><b>Verify</b></td>
              </table>
              <table id="table2" class="ulist">
              <tr>
              @if($data2 != NULL)
              @foreach($data2 as $data2)
                <center>
                <td class="uid">{{$data2->id}}</td>
                <td class="demail">{{$data2->email}}</td>
                <td class="vers">{{$data2->verified}}</td>
                <td class="files">
                <center><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter-{{$data2->doc_id}}">
                    Show Files
                </button></center>
                <div class="modal fade" id="exampleModalCenter-{{$data2->doc_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Files</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body"><center>
                          <b>Doctor's License: <br><img class="verify" src="{{ asset('uploads/' . $data2->doclicense) }}" /><br><hr>
                          Board Certificate: <br><img class="verify" src="{{ asset('uploads/' . $data2->boardcert) }}" /><br><hr>
                          Diploma: <br><img class="verify" src="{{ asset('uploads/' . $data2->diploma) }}" /><br><hr>
                          Reference Contacts: <br><img class="verify" src="{{ asset('uploads/' . $data2->refcontacts) }}" /></b>
                        </center></div>
                        </div>
                    </div>
                </div>
                </td>
                @if($data2->verified == "no")
                <td class="ver"><form method="POST" action="{{ route('verify', $data2->id ) }}">
                  @method('POST')
                  @csrf
                  <input type="hidden" value="yes" name="value">
                  <center><input type="submit" value="VERIFY" class="btn btn-primary" name="submit" class="login_sub"></center>
                </form></td></tr>
                @elseif($data2->verified == "yes")
                <td class="ver"><form method="POST" action="{{ route('verify', $data2->id ) }}">
                  @method('POST')
                  @csrf
                  <input type="hidden" value="no" name="value">
                  <center><input type="submit" value="UNVERIFY" class="btn btn-primary" name="submit" class="login_sub"></center>
                </form></td></tr>
                @endif
              </center>
              @endforeach
              @endif
              </table>
            </div>
            <!-- End Tab 2 -->

            <!-- Tab 3 -->
            <div role="tabpanel" class="tab-pane" id="messages">
            <center><input type="text" name="search2" id="search3" placeholder="Search..." title="Type in a name"></center><br>
            <table class="ulist">
                <td class="uid"><b>Patient ID</b></td>
                <td class="pname"><b>Name</b></td>
                <td class="pemail"><b>E-mail</b></td>
                <td class="files"><b>Patient Details</b></td>
              </table>
            <table id="table3" class="ulist">
            <tr>
            @if($data4 != NULL)
            @foreach($data4 as $data4)
            @if($data5 != NULL)
            @foreach($data5 as $data5)
            @if($data4->p_email == $data5->p_email)
              <center>
              <td class="uid">{{$data4->id}}</td>
              <td class="pname">{{$data5->lname}}, {{$data5->fname}}</td>
              <td class="pemail">{{$data5->p_email}}</td>
              <td class="files">
                <center><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter2-{{$data2->doc_id}}">
                    Show Details
                </button></center>
                <div class="modal fade" id="exampleModalCenter2-{{$data2->doc_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Patient Details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body"><center>
                          <b>Age:</b> {{$data5->age}}<br>
                          <b>Sex:</b> {{$data5->sex}}<br>
                          <b>Birth Date:</b>  {{$data5->bdate}}<br>
                          <b>Phone Number:</b> {{$data5->pnumber}}<br>
                          <b>Blood Type:</b> {{$data4->blood_type}}<br>
                          <b>Major Illnesses:</b> {{$data4->major_illnesses}}<br>
                          <b>Allergies:</b> {{$data4->allergies}}<br>
                          <b>Emergency Contact Person:</b> {{$data4->e_contact}}<br>
                          <b>Emergency Contact Number:</b> {{$data4->e_number}}<br>
                          <b>Medication: {{$data4->medication}}
                        </center></div>
                        </div>
                    </div>
                </div>
              </td>
              </center>
            @endif
            @endforeach
            @endif
            @endforeach
            @endif
            </table>
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