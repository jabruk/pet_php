@extends('admin.admin_master')
@section('admin')


<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Multi Image All</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Serial Number</th>
                                    <th>About Multi Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach ( $allMultiImage as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>
                                        <img src="{{ asset($item->multi_image) }}" style="width: 60ps; height: 60px;">
                                    </td>
                                    <td>
                                        <a href="{{ route('edit.multi.image', $item->id) }}" class="btn btn-info sm " data-bs-toggle="modal" data-bs-target="#modal-centered" data-bs-whatever="{{ $item }}" title="Edit data" value="{{ asset($item->multi_image) }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="" class="btn btn-danger sm" title="Delete data">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div> <!-- container-fluid -->
</div>

<div class="modal fade" id="modal-centered" tabindex="-1" aria-labelledby="modalCenteredLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenteredLabel">New message</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('all.multi.image') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 row">
                        <label for="example-text-input" class="col-sm-2 col-form-label">About Multi Image</label>
                        <div class="col-sm-10">
                            <input name="multi_image[]" class="form-control" type="file" id="image" multiple="" value="{{ url('uploads/no_image.jpg') }}">
                        </div>
                    </div>
                    <!-- end row -->
                    <div class="mb-3 row">
                        <label for="example-text-input" class="col-sm-1 col-form-label"></label>

                        <div class="col-sm-10">
                            <img id="showImage" class="rounded avatar-lg" src="
                            {{ $item->multi_image ? asset($item->multi_image) : url('uploads/no_image.jpg') }}" alt="Card image cap">
                        </div>
                    </div>
                    <!-- end row -->
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Send message</button>
            </div>
            </form>

        </div>
    </div>
</div>


@endsection

@section('script')
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