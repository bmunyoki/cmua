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
                <button type="button" class="btn btn-primary add-buttons" data-toggle="modal" data-target=".bd-example-modal-lg">+ Student</button>
            </div>
            <table class="table table-responsive-sm">
                <thead>
                <tr>
                    <th>#</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Apartment</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                </tr>
                </thead>
                <tbody class="users">
                    <?php $count = 1; ?>
                    @foreach($students as $vol)
                        <tr>
                            <td>{{ $count }}</td>
                            <td>{{ $vol->fname }}</td>
                            <td>{{ $vol->lname }}</td>
                            <td>{{ $vol->email }}</td>
                            <td>{{ $vol->gender }}</td>
                            <td>{{ $vol->apartment }}</td>
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
                {{ $students->links('vendor.pagination.bootstrap-4') }}
            </ul>
        </div>
    </div>
</div>


<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add a Student</h5>
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
                        <div class="col-6">
                            <div class="form-group">
                                <label for="lname" class="col-form-label">First Name:</label>
                                <input type="text" class="form-control" id="fname" name="fname">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="lname" class="col-form-label">Last Name:</label>
                                <input type="text" class="form-control" id="lname" name="lname">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="email" class="col-form-label">Email Address:</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="phone" class="col-form-label">Gender:</label><br>
                                <select name="gender" id="gender">
                                    <option value="Female">Female</option>
                                    <option value="Male">Male</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="email" class="col-form-label">Apartment:</label>
                                <select name="apartment" id="apartment">
                                    @foreach($apartments as $apartment)
                                        <option value="{{ $apartment->name }}">{{ $apartment->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="addStudent">Save</button>
            </div>
        </div>
    </div>
</div>
@endsection 
