@extends('layouts.template')
@section('content')
    <!-- Breadcrumb -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Rec Reporter</li>
        <li class="breadcrumb-item">Users</li>
        <li class="breadcrumb-item active">Volunteers</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i> Volunteers
                        </div>
                        <div class="card-body">
                            @if(Auth::user()->role == 2)
                            <div class="add-buttons">
                                <button type="button" class="btn btn-primary add-buttons" data-toggle="modal" data-target=".bd-example-modal-lg">+ Volunteer</button>
                            </div>
                            @endif
                            <table class="table table-responsive-sm">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Personal Phone</th>
                                    <th>Device Phone</th>
                                    <th>Enroll Date</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody class="users">
                                    <?php $count = 1; ?>
                                    @foreach($vols as $vol)
                                        <tr>
                                            <td>{{ $count }}</td>
                                            <td>{{ $vol->firstname }} {{ $vol->lastname }}</td>
                                            <td>{{ $vol->email }}</td>
                                            <td>{{ $vol->phone }}</td>
                                            <td>{{ $vol->phone }}</td>
                                            <td><?php echo date( 'd F Y', strtotime($vol->created_at)); ?></td>
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
                                {{ $vols->links('vendor.pagination.bootstrap-4') }}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add a Volunteer</h5>
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
                                    <label for="phone" class="col-form-label">Personal Phone:</label><br>
                                    <input type="text" class="form-control" id="intPhone" name="intPhone">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="device" class="col-form-label">Assigned Phone [Optional]:</label>
                                    <select class="form-control" id="device" name="device">
                                        @foreach($devices as $device)
                                            <option name="{{ $device->mobilenumber }}">{{ $device->mobilenumber }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="addVolunteer">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit volunteer -->
    <div class="modal fade bd-example-modal-lg-edit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Volunteer Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="userDetails">
                        
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="updateUser">Update</button>
                </div>
            </div>
        </div>
    </div>
@endsection