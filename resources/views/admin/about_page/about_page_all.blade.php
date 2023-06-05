@extends('admin.admin_master')
@section('admin')
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h1 class="card-title">About Page</h1>
                        <form method="post" action="{{ route('update.about') }}" enctype="multipart/form-data">
                            @csrf
                           
                            <input type="hidden" name="id" value="{{ $aboutPage->id }}">
                           
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <input name="title" class="form-control" type="text" id="title" value="{{ $aboutPage->title}}">
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Short Title</label>
                                <div class="col-sm-10">
                                    <input name="short_title" class="form-control" type="text" id="short_title" value="{{ $aboutPage->short_title}}">
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Short Descriptopn</label>
                                <div class="col-sm-10">
                                    <textarea required="" name="short_description" class="form-control" rows="5">{{ $aboutPage->short_description}}</textarea>                                    
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Long Descriptopn</label>
                                <div class="col-sm-10">
                                        <textarea id="elm1" name="long_description"> {{ $aboutPage->long_description}} </textarea>
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-sm-2 col-form-label">About Image</label>
                                <div class="col-sm-10">
                                    <input name="about_image" class="form-control" type="file" id="image">
                                </div>
                            </div>

                            <!-- end row -->
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-sm-1 col-form-label"></label>

                                <div class="col-sm-10">
                                    <img id="showImage" class="rounded avatar-lg" src="{{                                
                                        ( !empty($aboutPage->about_image)) ? 
                                        url($aboutPage->about_image) : 
                                        url('uploads/no_image.jpg') }}" alt="Card image cap">
                                </div>
                            </div>
                            <!-- end row -->
                            <input type="submit" class="btn btn-info waves-effect waves-light" value="Update About Page"></input>
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
