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
                                        <img src="{{ asset($item->multi_image) }}" name="aboutImage" style="width: 60ps; height: 60px;">
                                    </td>
                                    <td>
                                        <button id="editCompany" class=" fas fa-edit btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target='#practice_modal' data-id="{{ $item->id }}" data-item="{{ $item }}"></button>
                                        <a href="{{ route('delete.multi.image', $item->id) }}" id="delete" class="btn btn-danger btn btn-primary fas fa-trash-alt waves-effect waves-light" title="Delete data"></a>
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

<div class="modal fade" id="practice_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenteredLabel">New message</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="{{ route('edit.multi.image') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" id="id">

                <div class="modal-body">

                    <div class="mb-3 row">
                        <label for="example-text-input" class="col-sm-2 col-form-label">About Multi Image</label>
                        <div class="col-sm-10">
                            <input name="multi_image" class="form-control" type="file" id="image" multiple="" value="{{ asset('uploads/no_image.jpg') }}" required>
                        </div>
                    </div>
                    <!-- end row -->
                    <div class="mb-3 row">
                        <label for="example-text-input" class="col-sm-1 col-form-label"></label>

                        <div class="col-sm-10">
                            <img id="showImage" name="showImage" class="rounded avatar-lg" alt="Card image cap">
                        </div>
                    </div>
                    <!-- end row -->
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="delete" class="btn btn-primary">Update</button>
                </div>
            </form>

        </div>
    </div>
</div>


@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        $('#image').change(function(e) {
            console.log(e);
            let reader = new FileReader();
            reader.onload = function(e) {
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);

        })
        $('body').on('click', '#editCompany', function(event) {

            event.preventDefault();
            var id = $(this).data('id');
            $('#id').val(id);

            let path = $(this).data('item').multi_image;
            let fullPath = `{{ asset('${path}') }}`;
            $('#showImage').attr('src', fullPath);
        });
    })
</script>

@endsection