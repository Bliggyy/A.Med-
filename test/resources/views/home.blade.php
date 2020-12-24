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
          <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab"><i class="fa fa-envelope-o"></i><span>Medication</span></a></li>
          <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab"><i class="fa fa-cog"></i><span>About Us</span></a></li>
        </ul>
        
        <!-- Tab panes -->
        <div class="tab-content" id="tab-content">
            <!-- Tab 1 -->
            <div role="tabpanel" class="tab-pane active" id="home">
              <calendar-component/>
            </div>
            <!-- End Tab 1 -->

            <!-- Tab 2 -->
            <div role="tabpanel" class="tab-pane" id="profile">
                <!-- Profile -->
                  @if($data != NULL)
                  @foreach($data as $data)
                  @if($data->p_id == auth()->user()->id)
                    <center><hr>
                      Name: {{$data->lname}}, {{$data->fname}}<br>
                      Age: {{$data->age}}<br>
                      Sex: {{$data->sex}}<br>
                      Birth Date:  {{$data->bdate}}<br>
                      Phone Number: {{$data->pnumber}}<br>
                    <hr></center>
                  @endif
                  @endforeach
                  @endif  
                <!-- End of Profile -->
                <!-- Button trigger modal -->
                <center><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                    Create Profile
                </button></center><br>
                <center><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter2">
                    Update Profile
                </button></center>
                <!-- End Button -->

                <!-- Modal -->
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
                            <form method="POST" action="pprofilecreate">
                                @csrf
                                <input id="lname" type="text" class="login_inp" name="lname" value="{{ old('lname') }}" placeholder="Last Name" required>
                                <input id="fname" type="text" class="login_inp" name="fname" value="{{ old('fname') }}" placeholder="First Name" required>
                                <input id="age" type="number" class="login_inp" name="age" value="{{ old('age') }}" placeholder="Age" required><br><br>
                                <select class="form-control" name="sex" required>
                                    <option selected disabled>Sex</option>
                                    <option value="M">Male</option>
                                    <option value="F">Female</option>
                                </select>
                                <input id="bdate" type="date" class="login_inp" name="bdate" value="{{ old('bdate') }}" placeholder="Birth Date" required>
                                <input id="pnumber" type="text" class="login_inp" name="pnumber" value="{{ old('pnumber') }}" placeholder="Phone Number" required>
                                <input type="submit" value="Submit" name="submit" class="login_sub"><br>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                        </div>
                    </div>
                </div>

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
                            @if($data != NULL)
                            <form method="POST" action="pprofileupdate">
                                @csrf
                                <input id="lname" type="text" class="login_inp" name="lname" value="" placeholder="Last Name" required>
                                <input id="fname" type="text" class="login_inp" name="fname" value="" placeholder="First Name" required>
                                <input id="age" type="number" class="login_inp" name="age" value="" placeholder="Age" required><br><br>
                                <select class="form-control" name="sex" required>
                                    <option selected disabled>Sex</option>
                                    <option value="M">Male</option>
                                    <option value="F">Female</option>
                                </select>
                                <input id="bdate" type="date" class="login_inp" name="bdate" value="" placeholder="Birth Date" required>
                                <input id="pnumber" type="text" class="login_inp" name="pnumber" value="" placeholder="Phone Number" required>
                                <input type="submit" value="Submit" name="submit" class="login_sub"><br>
                            </form>
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                        </div>
                    </div>
                </div>
                <!-- End Modals -->
            </div>
            <!-- End Tab 2 -->

            <!-- Tab 3 -->
            <div role="tabpanel" class="tab-pane" id="messages">
              Medication
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


