@extends('admin.admin_master')
@section('admin')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h1 class="card-title">Change password page</h1>
                        <form method="post" action="{{ route('admin.update.password') }}" >
                            @csrf
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-sm-1 col-form-label">Old password</label>
                                <div class="col-sm-10">
                                    <input name="oldpassword" class="form-control" type="password" id="oldpassword">
                                    @if ($errors->has('oldpassword')) <p class="alert alert-danger alert-dismissible fade show mt-2">{{ $errors->first('oldpassword') }}</p> @endif
                                </div>
                            </div>

                            <!-- end row -->
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-sm-1 col-form-label">New password</label>
                                <div class="col-sm-10">
                                    <input name="newpassword" class="form-control" type="password" id="newpassword">
                                    @if ($errors->has('newpassword')) <p class="alert alert-danger alert-dismissible fade show mt-2">{{ $errors->first('newpassword') }}</p> @endif
                                </div>

                            </div>
                            <!-- end row -->
                             <!-- end row -->
                             <div class="mb-3 row">
                                <label for="example-text-input" class="col-sm-1 col-form-label">Confirm password</label>
                                <div class="col-sm-10">
                                    <input name="confirm_password" class="form-control" type="password" id="confirm_password">
                                    @if ($errors->has('confirm_password')) <p class="alert alert-danger alert-dismissible fade show mt-2">{{ $errors->first('confirm_password') }}</p> @endif
                                </div>

                            </div>
                            <!-- end row -->
                            <input type="submit" class="btn btn-info waves-effect waves-light" value="Change password"></input>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
