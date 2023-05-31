@extends('admin.admin_master')
@section('admin')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <br>
                        <center>
                            <img class="rounded-circle avatar-xl" src="{{
                                ( !empty($user->profile_image)) ? 
                                url('uploads/admin_images/'.$user->profile_image) : 
                                url('uploads/no_image.jpg')
                            }}" alt="Card image cap">
                        </center>
                    </br>
                    <div class="card-body">
                        <h4 class="card-title"> Name: {{ $user->name }} </h4><hr>
                        <h4 class="card-title"> Email: {{ $user->email }} </h4><hr>
                        <h4 class="card-title"> Username: {{ $user->username }} </h4><hr>
                        <a href ="{{ route('admin.profile.edit') }}" class="btn btn-primary waves-effect waves-light"> Edit profile </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
