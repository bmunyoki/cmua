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
                            <i class="fa fa-align-justify"></i> Received Recordings - Unattended
                        </div>
                        <div class="card-body">
                            <table class="table table-responsive-sm" style="width:100%" id="waitingCasesTable">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Calling Number</th>
                                    <th>Date</th>
                                    <th>&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody id="audios">
                                    <?php $count = 1; ?>
                                    <input type="hidden" id="audioId" name="audioId" />
                                    @foreach($audios as $audio)
                                        <tr>
                                            <td>{{ $count }}</td>
                                            <td>
                                                <?php
                                                    $recordingName = explode('-', $audio->recordingname);
                                                    $phone = $recordingName[7];

                                                    //If phone number starts with underscore (_), remove the underscore.
                                                    if(substr($phone, 0, 1) == '_')
                                                        $phone = substr($phone, 1);

                                                    echo $phone;
                                                ?>
                                            </td>
                                            <td><?php echo date( 'd F Y', strtotime($audio->sentdt)); ?></td>
                                            <td>
                                                <button type="button" data-code="{{ $audio->id }}" class="btn btn-primary listen-button"> Listen </button>
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
                <h5 class="modal-title" id="exampleModalLabel">Record a Case</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form> 
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group" id="audioName">
                                
                            </div>
                        </div>
                    </div>
                    <hr/>

                    <div class="row">
                        <div class="col-12 response">
                        </div>
                    </div>

                    <div class="div-scrollable">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="fname" class="col-form-label">First Name:</label>
                                    <input type="text" class="form-control" id="fName" name="fName">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="lname" class="col-form-label">Last Name:</label>
                                    <input type="text" class="form-control" id="lName" name="lName">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="locationName" class="col-form-label">Location Name:</label>
                                    <input type="text" class="form-control" id="locationName" name="locationName">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="callDate" class="col-form-label">Call Date:</label><br>
                                    <input type="text" class="form-control" id="callDate" name="callDate" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div id="map"></div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="latitude" class="col-form-label">Latitude:</label>
                                    <input type="text" class="form-control" id="latitude" name="latitude" readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="longitude" class="col-form-label">Longitude:</label><br>
                                    <input type="text" class="form-control" id="longitude" name="longitude" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="radius" class="col-form-label">Radius:</label>
                                    <input type="text" class="form-control" id="radius" name="radius">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="tag" class="col-form-label">Tag:</label><br>
                                    <select class="form-control" id="tag" name="tag"> 
                                        @foreach($tags as $tag)
                                            <option value="{{ $tag->name }}">{{ $tag->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="description" class="col-form-label">Description:</label>
                                    <textarea class="form-control" id="description" name="description"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="callerPhone" class="col-form-label">Calling Phone:</label>
                                    <input type="text" class="form-control" id="callerPhone" name="callerPhone" readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="priority" class="col-form-label">Tag:</label><br>
                                    <select class="form-control" id="priority" name="priority"> 
                                        @foreach($priorities as $priority)
                                            <option value="{{ $priority->name }}">{{ $priority->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="discardCase">Discard</button>
                <button type="button" class="btn btn-primary createCase" id="createCase">Save</button>
            </div>
        </div>
    </div>
</div>
    
@endsection
@section('customjs')
    <script type="text/javascript" src="{{ asset('js/location-picker.js') }}"></script> 
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBOZ3iFXxO0dN75GKYwNsToH3W6u1kcGR0&callback=initMap"
        async defer></script>
    <script type="text/javascript">
        $('.bd-example-modal-lg').on('hidden', function () {
            var audio = document.getElementById("loadedAudio"); 
            audio.pause();
        })
    </script>
@endsection