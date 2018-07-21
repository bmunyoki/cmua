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
                            <i class="fa fa-align-justify"></i> Single Case - {{ $case->firstname }} {{ $case->lastname }}
                            @if($case->priority == 'Low')
                                <span class="badge badge-info badge-pill" title="Case priority">Low</span>
                            @elseif($case->priority == 'Medium')
                                <span class="badge badge-warning badge-pill" title="Case priority">Medium</span>
                            @elseif($case->priority == 'High')
                                <span class="badge badge-danger badge-pill" title="Case priority">High</span>
                            @endif
                            
                            @if($case->status == 'Resolved')
                                <a href="{{ url('/cases/single/progress/'.$case->case_uid) }}" style="font-weight: 600; border: none !important; padding: 7px;" class="btn btn-primary float-right">
                                    View Progress
                                </a>
                            @else
                                @if($case->status == 'Received')
                                    <button style="font-weight: 600;" type="button" class="btn btn-primary float-right"  data-toggle="modal" data-target="#caseProgressModal">
                                        Move to in Progress
                                    </button>
                                @else
                                    <button style="font-weight: 600;" type="button" class="btn btn-primary float-right"  data-toggle="modal" data-target="#caseProgressModal">
                                        Add Progress Notes
                                    </button>
                                    <a href="{{ url('/cases/single/progress/'.$case->case_uid) }}" style="font-weight: 600; border: none !important; padding: 7px;" class="btn btn-primary float-right">
                                        View Progress
                                    </a>
                                @endif
                            @endif
                        </div>
                        <div class="card-body" id="single-case-details">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <audio controls controlsList="nodownload" style="width: 100% !important">
                                            <source src="{{ $filePath }}" type="audio/mp3">
                                        </audio>
                                    </div>
                                </div>
                            </div>
                            <hr/>

                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="fname" class="col-form-label">First Name:</label>
                                        <input type="text" class="form-control" id="fName" value="{{ $case->firstname }}">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="lname" class="col-form-label">Last Name:</label>
                                        <input type="text" class="form-control" id="lName" value="{{ $case->lastname }}">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="locationName" class="col-form-label">Location Name:</label>
                                        <input type="text" class="form-control" id="locationName" value="{{ $case->locationname }}">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="callDate" class="col-form-label">Call Date:</label><br>
                                        <input type="text" class="form-control" id="callDate" value="{{ $case->calltime }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div id="map" style="margin: 30px 0 !important;"></div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="callerPhone" class="col-form-label">Calling Phone:</label>
                                        <input type="text" class="form-control" id="callerPhone" value="{{ $case->phone }}">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="priority" class="col-form-label">Priority:</label>
                                        <input type="text" class="form-control" id="priority" value="{{ $case->priority }}">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="radius" class="col-form-label">Radius:</label>
                                        <input type="text" class="form-control" id="radius" value="{{ $case->radius }}">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="radius" class="col-form-label">Tag:</label>
                                        <input type="text" class="form-control" id="tag" value="{{ $case->tagname }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="description" class="col-form-label">Description:</label>
                                        <textarea class="form-control" id="description" value="{{ $case->description }}">{{ $case->description }}</textarea>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="caseProgressModal" tabindex="-1" role="dialog" aria-labelledby="caseProgressModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Case Progress Notes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="response"></div>
                <div class="form-group">
                    <input type="hidden" id="caseId" name="caseId" value="{{ $case->id }}" />
                    <label for="notes" class="col-form-label">Notes:</label>
                    <textarea class="form-control" id="notes" placeholder="Add and details on how the case is proceeding. Include dates."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="saveCaseNotes">Save Notes</button>
            </div>
            </div>
        </div>
    </div>
    
@endsection
@section('customjs')
    <script type="text/javascript">
        var map;
        var marker;

        function initMap() {                            
            var latitude = {!! $case->latitude !!}; // YOUR LATITUDE VALUE
            var longitude = {!! $case->longitude !!}; // YOUR LONGITUDE VALUE

            var myLatLng = {lat: latitude, lng: longitude};
            
            map = new google.maps.Map(document.getElementById('map'), {
                center: myLatLng,
                zoom: 9,
                disableDoubleClickZoom: true, // disable the default map zoom on double click
            });
                    
            marker = new google.maps.Marker({
                position: myLatLng,
                map: map,
                title: '{!! $case->locationname !!}' 
            });    
        }
    </script> 
    
@endsection