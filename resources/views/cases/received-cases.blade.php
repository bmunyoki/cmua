@extends('layouts.template')
@section('content')
    <!-- Breadcrumb -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Rec Reporter</li>
        <li class="breadcrumb-item">Cases</li>
        <li class="breadcrumb-item active">Received</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i> Received cases - Pending
                        </div>
                        <div class="card-body">
                            <table class="table table-stripped" style="width:100%" id="receivedCasesTable">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Victim</th>
                                    <th>Calling Phone</th>
                                    <th>Received By</th>
                                    <th>Location</th>
                                    <th>Tag</th>
                                    <th>Date</th>
                                    <th>Priority</th>
                                    <th>&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php $count = 1; ?>
                                    @foreach($cases as $case)
                                        <tr>
                                            <td>{{ $count }}</td>
                                            <td>{{ $case->firstname }} {{ $case->lastname }}</td>
                                            <td>{{ $case->phone }}</td>
                                            <td>{{ $case->user->firstname }}</td>
                                            <td>{{ $case->locationname }}</td>
                                            <td>{{ $case->tagname }}</td>
                                            <td><?php echo date( 'd F Y', strtotime($case->created_at)); ?></td>
                                            <td>
                                                @if($case->priority == 'Low')
                                                    <button type="button" class="btn btn-info">Low</button>
                                                @elseif($case->priority == 'Medium')
                                                    <button type="button" class="btn btn-warning">Medium</button>
                                                @elseif($case->priority == 'High')
                                                    <button type="button" class="btn btn-danger">High</button>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ url('/cases/single/'.$case->case_uid) }}">
                                                    <button type="button" class="btn btn-primary">Details</button>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php $count = $count + 1; ?>
                                    @endforeach
                                </tbody>
                            </table>
                            
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
@endsection