@extends('layouts.template')

@section('content')
<!-- Breadcrumb -->
<ol class="breadcrumb">
    <li class="breadcrumb-item">Backend</li>
    <li class="breadcrumb-item active">Students</li>
</ol>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-lg-12">
            <div class="add-buttons">
                <button type="button" class="btn btn-primary add-buttons" data-toggle="modal" data-target=".bd-example-modal-lg">+ Apartment</button>
            </div>
            <table class="table table-responsive-sm">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                </tr>
                </thead>
                <tbody class="users">
                    <?php $count = 1; ?>
                    @foreach($apartments as $vol)
                        <tr>
                            <td>{{ $count }}</td>
                            <td>{{ $vol->name }}</td>
                            <td style="color: blue;">
                                <a href="#" class="editUser" data-code="{{ $vol->id }}" title="Edit" data-toggle="modal" data-target=".bd-example-modal-lg-edit"><i class="fa fa-edit" style="color: #20a8d8;"></i></a>
                            </td>
                            <td>
                                <a href="#" class="deleteUser" data-code="{{ $vol->id }}" title="Delete"><i class="fa fa-trash" style="color: red;"></i></a>
                            </td>
                        </tr>
                        <?php $count = $count + 1; ?>
                    @endforeach
                </tbody>
            </table>
            <ul class="pagination">
                {{ $apartments->links('vendor.pagination.bootstrap-4') }}
            </ul>
        </div>
    </div>
</div>


<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add an apartment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-12 response">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="name" class="col-form-label">Name:</label>
                                <input type="text" class="form-control" id="name" name="name">
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="addApartment">Save</button>
            </div>
        </div>
    </div>
</div>

@endsection 
