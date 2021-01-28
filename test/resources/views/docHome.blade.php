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
          <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab"><i class="fa fa-home"></i><span>Appointments</span></a></li>
          <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"><i class="fa fa-user"></i><span>Profile</span></a></li>
          <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab"><i class="fa fa-envelope-o"></i><span>Records</span></a></li>
          <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab"><i class="fa fa-cog"></i><span>About Us</span></a></li>
        </ul>
        
        <!-- Tab panes -->
        <div class="tab-content" id="tab-content">
            <!-- Tab 1 -->
            <div role="tabpanel" class="tab-pane active" id="home">
              <calendar-component id="{{ auth()->user()->id }}" acc_type="{{ auth()->user()->account_type }}" />
            </div>
            <!-- End Tab 1 -->

            <!-- Tab 2 -->
            <div role="tabpanel" class="tab-pane" id="profile">
                @if($data != NULL)
                @foreach($data as $data)
                @if($data->doc_id == auth()->user()->id)
                    <center>
                    Name: {{$data->lname}}, {{$data->fname}}<br>
                    Specialization: {{$data->specialization}}<br>
                    E-mail: {{$data->doc_email}}<br>
                    Age: {{$data->age}}<br>
                    Sex: {{$data->sex}}<br>
                    Birth Date:  {{$data->bdate}}<br>
                    Phone Number: {{$data->pnumber}}<br>
                    Clinic Address: {{$data->clinicadd}}<br><br>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter2">
                        Update Profile
                    </button><br>
                    <hr></center>
                    <div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Update Profile</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route('docprofileupdate', $data->id ) }}">
                                    @method('PATCH')
                                    @csrf
                                    <!-- <input type="hidden" name="doc_id" value="{{$data['doc_id']}}"> -->
                                    <input id="lname" type="text" class="login_inp" name="lname" value="{{ $data['lname'] }}" placeholder="Last Name" required>
                                    <input id="fname" type="text" class="login_inp" name="fname" value="{{ $data['fname'] }}" placeholder="First Name" required>
                                    <input id="age" type="number" class="login_inp" name="age" value="{{ $data['age'] }}" placeholder="Age" required><br><br>
                                    <select class="form-control" name="specialization" required>
                                        <option selected disabled>Select Specialization</option>
                                        <option value="Cardiologist">Cardiologist</option>
                                        <option value="Audiologist">Audiologist</option>
                                        <option value="ENT specialist">ENT specialist</option>
                                        <option value="Gynaecologist">Gynaecologist</option>
                                        <option value="Orthopaedic surgeon">Orthopaedic surgeon</option>
                                        <option value="Paediatrician">Paediatrician</option>
                                        <option value="Psychiatrists">Psychiatrists</option>
                                        <option value="Radiologist">Radiologist</option>
                                        <option value="Pulmonologist">Pulmonologist</option>
                                        <option value="Endocrinologist">Endocrinologist</option>
                                        <option value="Oncologist">Oncologist</option>
                                        <option value="Neurologist">Neurologist</option>
                                        <option value="Cardiothoracic surgeon">Cardiothoracic surgeon</option>
                                    </select><br>
                                    <select class="form-control" name="sex" required>
                                        <option selected disabled>Sex</option>
                                        <option value="M">Male</option>
                                        <option value="F">Female</option>
                                    </select><br>
                                    <h5 class="modal-title" id="exampleModalLongTitle">Birth Date:</h5>
                                    <input id="bdate" type="date" class="login_inp" name="bdate" value="{{ $data['bdate'] }}" placeholder="Birth Date" required>
                                    <input id="pnumber" type="text" class="login_inp" name="pnumber" value="{{ $data['pnumber'] }}" placeholder="Phone Number" required>
                                    <input id="clinicadd" type="text" class="login_inp" name="clinicadd" value="{{ $data['clinicadd'] }}" placeholder="Clinic Address" required>
                                    <input type="submit" value="Submit" name="submit" class="login_sub">
                                </form>
                            </div>
                            </div>
                        </div>
                    </div>
                    @break
                @endif
                @endforeach
                @endif
                @if (!@isset($data->fname))
                    <center><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                        Create Profile
                    </button></center>
                @endif
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Create Profile</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="docprofilecreate">
                                @csrf
                                <input id="lname" type="text" class="login_inp" name="lname" value="{{ old('lname') }}" placeholder="Last Name" required>
                                <input id="fname" type="text" class="login_inp" name="fname" value="{{ old('fname') }}" placeholder="First Name" required>
                                <input id="age" type="number" class="login_inp" name="age" value="{{ old('age') }}" placeholder="Age" required>
                                <select class="form-control" name="specialization" required>
                                    <option selected disabled>Select Specialization</option>
                                    <option value="Cardiologist">Cardiologist</option>
                                    <option value="Audiologist">Audiologist</option>
                                    <option value="ENT specialist">ENT specialist</option>
                                    <option value="Gynaecologist">Gynaecologist</option>
                                    <option value="Orthopaedic surgeon">Orthopaedic surgeon</option>
                                    <option value="Paediatrician">Paediatrician</option>
                                    <option value="Psychiatrists">Psychiatrists</option>
                                    <option value="Radiologist">Radiologist</option>
                                    <option value="Pulmonologist">Pulmonologist</option>
                                    <option value="Endocrinologist">Endocrinologist</option>
                                    <option value="Oncologist">Oncologist</option>
                                    <option value="Neurologist">Neurologist</option>
                                    <option value="Cardiothoracic surgeon">Cardiothoracic surgeon</option>
                                </select><br><br>
                                <select class="form-control" name="sex" required>
                                    <option selected disabled>Sex</option>
                                    <option value="M">Male</option>
                                    <option value="F">Female</option>
                                </select><br>
                                <h5 class="modal-title" id="exampleModalLongTitle">Birth Date:</h5>
                                <input id="bdate" type="date" class="login_inp" name="bdate" value="{{ old('bdate') }}" placeholder="Birth Date" required>
                                <input id="pnumber" type="text" class="login_inp" name="pnumber" value="{{ old('pnumber') }}" placeholder="Phone Number" required>
                                <input id="clinicadd" type="text" class="login_inp" name="clinicadd" value="{{ old('clinicadd') }}" placeholder="Clinic Address" required>
                                <input type="submit" value="Submit" name="submit" class="login_sub">
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Tab 2 -->

            <!-- Tab 3 -->
            <div role="tabpanel" class="tab-pane" id="messages">
                <center><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter3">
                    Add Patient Record
                </button></center><br><hr>
                <div class="modal fade" id="exampleModalCenter3" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Add Patient Record</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="prcreate">
                                @csrf
                                <input id="p_email" type="text" class="login_inp" name="p_email" value="{{ old('p_email') }}" placeholder="Patient's E-mail" required>
                                <input id="blood_type" type="text" class="login_inp" name="blood_type" value="{{ old('blood_type') }}" placeholder="Blood Type" required><br><br>
                                <h5 class="modal-title" id="exampleModalLongTitle">Last Visit:</h5>
                                <input id="last_visit" type="date" class="login_inp" name="last_visit" value="{{ old('last_visit') }}" placeholder="Last Visit" required>
                                <input id="major_illnesses" type="text" class="login_inp" name="major_illnesses" value="{{ old('major_illnesses') }}" placeholder="Major Illnesses" required>
                                <input id="allergies" type="text" class="login_inp" name="allergies" value="{{ old('allergies') }}" placeholder="Allergies" required>
                                <input id="e_contact" type="text" class="login_inp" name="e_contact" value="{{ old('e_contact') }}" placeholder="Emergency Contact Person" required>
                                <input id="e_number" type="text" class="login_inp" name="e_number" value="{{ old('e_number') }}" placeholder="Emergency Contact Number" required>
                                <input id="medication" type="text" class="login_inp" name="medication" value="{{ old('medication') }}" placeholder="Medication" required>
                                <input type="submit" value="Submit" name="submit" class="login_sub">
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
                
                @if($data2 != NULL)
                @foreach($data2 as $data2)
                @if($data3 != NULL)
                @foreach($data3 as $data3)
                @if($data2->p_email == $data3->p_email)
                  <center>
                    Name: {{$data3->lname}}, {{$data3->fname}}<br>
                    E-mail: {{$data3->p_email}}<br>
                    Age: {{$data3->age}}<br>
                    Sex: {{$data3->sex}}<br>
                    Birth Date:  {{$data3->bdate}}<br>
                    Phone Number: {{$data3->pnumber}}<br>
                    Blood Type: {{$data2->blood_type}}<br>
                    Last Visit: {{$data2->last_visit}}<br>
                    Major Illnesses: {{$data2->major_illnesses}}<br>
                    Allergies: {{$data2->allergies}}<br>
                    Emergency Contact Person: {{$data2->e_contact}}<br>
                    Emergency Contact Number: {{$data2->e_number}}<br>
                    Current Medication: {{$data2->medication}}<br><br>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter4">
                      Update Record
                    </button><br>
                  <hr></center>
                  <div class="modal fade" id="exampleModalCenter4" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                     <div class="modal-dialog modal-dialog-centered" role="document">
                         <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLongTitle">Update Record</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                          <div class="modal-body">
                              <form method="POST" action="{{ route('prupdate', $data2->id) }}">
                                  @method('PATCH')
                                  @csrf
                                  <input type="hidden" name="p_id" value="{{$data2['p_id']}}">
                                  <input id="p_email" type="text" class="login_inp" name="p_email" value="{{ $data2['p_email'] }}" placeholder="Patient's E-mail" required>
                                  <input id="blood_type" type="text" class="login_inp" name="blood_type" value="{{ $data2['blood_type'] }}" placeholder="Blood Type" required><br><br>
                                  <h5 class="modal-title" id="exampleModalLongTitle">Last Visit:</h5>
                                  <input id="last_visit" type="date" class="login_inp" name="last_visit" value="{{ $data2['last_visit'] }}" placeholder="Last Visit" required>
                                  <input id="major_illnesses" type="text" class="login_inp" name="major_illnesses" value="{{ $data2['major_illnesses'] }}" placeholder="Major Illnesses" required>
                                  <input id="allergies" type="text" class="login_inp" name="allergies" value="{{ $data2['allergies'] }}" placeholder="Allergies" required>
                                  <input id="e_contact" type="text" class="login_inp" name="e_contact" value="{{ $data2['e_contact'] }}" placeholder="Emergency Contact Person" required>
                                  <input id="e_number" type="text" class="login_inp" name="e_number" value="{{ $data2['e_number'] }}" placeholder="Emergency Contact Number" required>
                                  <input id="medication" type="text" class="login_inp" name="medication" value="{{ $data2['medication'] }}" placeholder="Medication" required>
                                  <input type="submit" value="Submit" name="submit" class="login_sub">
                              </form>
                          </div>
                          </div>
                      </div>
                  </div>
                  @break
                @endif
                @endforeach
                @break
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


