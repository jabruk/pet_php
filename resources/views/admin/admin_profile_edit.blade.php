@extends('admin.admin_master')
@section('admin')
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h1 class="card-title">Edit profile form</h1>
                        <form method="post" action="{{ route('admin.profile.store') }}" enctype="mu;tpart/form-data">
                            @csrf
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-sm-1 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input name="name" class="form-control" type="text" id="name" value="{{ $user->name}}">
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-sm-1 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input name="email" class="form-control" type="email" id="name" value="{{ $user->email}}">
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-sm-1 col-form-label">Username</label>
                                <div class="col-sm-10">
                                    <input name="username" class="form-control" type="text" id="username" value="{{ $user->username}}">
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-sm-1 col-form-label">Username</label>
                                <div class="col-sm-10">
                                    <input name="profile_image" class="form-control" type="file" id="image" >
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-sm-1 col-form-label"></label>

                                <div class="col-sm-10">
                                    <img id="showImage" class="rounded avatar-lg" src="{{ asset('backend/assets/images/small/img-5.jpg') }}" alt="Card image cap">
                                </div>
                            </div>
                            <!-- end row -->
                            <input type="submit" class="btn btn-info waves-effect waves-light">Update profile</input>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#image').change(function(e){
            let reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);

        })
    })
</script>
@endsection
