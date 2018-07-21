@extends('layouts.template')
@section('importcss')
    <link href="{{ asset('css/timeline.css') }}" rel="stylesheet">
@endsection
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

                            @if($case->status != 'Resolved')
                                <!-- <button type="button" class="btn btn-success float-right" id="closeBtn">
                                    Close Case
                                </button> -->
                                <button style="font-weight: 600;" type="button" class="btn btn-success float-right"  data-toggle="modal" data-target="#caseClosureModal">
                                            Close Case
                                </button>
                                <button type="button" class="btn btn-primary float-right"  data-toggle="modal" data-target="#caseProgressModal">
                                    Add Progress Notes
                                </button>
                            @endif
                        </div>
                        <div class="card-body" style="align: center !important;">
                            <div class="row">
                                <div class="col-12">
                                    <ul class="timeline">
                                        <?php $count = 1; ?>
                                        @foreach($progress as $p)
                                            @if($count % 2 > 0)
                                                <li>
                                                    <div class="timeline-badge info" title="Date of Entry">
                                                        <?php echo date( 'd.m', strtotime($p->created_at)).'<br>'.date( 'Y', strtotime($p->created_at)); ?>
                                                    </div>
                                                    <div class="timeline-panel">
                                                        <div class="timeline-body">
                                                            <p>{{ $p->details }}</p>
                                                        </div>
                                                    </div>
                                                </li>
                                            @else
                                                <li class="timeline-inverted">
                                                    <div class="timeline-badge info" title="Date of Entry">
                                                        <?php echo date( 'd.m', strtotime($p->created_at)).'<br>'.date( 'Y', strtotime($p->created_at)); ?>
                                                    </div>
                                                    <div class="timeline-panel">
                                                        <div class="timeline-body">
                                                            <p>{{ $p->details }}</p>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endif
                                            <?php $count += 1; ?>
                                        @endforeach
                                    </ul>

                                </div>
                            </div>
                            <hr/>

                            @if($case->status != 'Resolved')
                                <div class="row">
                                    <div class="col-12">
                                        <!-- <button type="button" class="btn btn-success float-right" id="closeBtn">
                                            Close Case
                                        </button> -->
                                        <button style="font-weight: 600;" type="button" class="btn btn-success float-right"  data-toggle="modal" data-target="#caseClosureModal">
                                            Close Case
                                        </button>
                                        <button style="font-weight: 600;" type="button" class="btn btn-primary float-right"  data-toggle="modal" data-target="#caseProgressModal">
                                            Add Progress Notes
                                        </button>
                                    </div>
                                </div>
                            @endif
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    <!-- Case Progress Modal -->
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

    <!-- Case Closure Notes Modal -->
    <div class="modal fade" id="caseClosureModal" tabindex="-1" role="dialog" aria-labelledby="caseClosureModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Case Closure Notes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="response"></div>
                <div class="form-group">
                    <label for="notes" class="col-form-label">Notes:</label>
                    <textarea class="form-control" id="closureNotes" placeholder="Add and details on how the case is proceeding. Include dates."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="saveCloseCaseNotes">Save & Close Case</button>
            </div>
            </div>
        </div>
    </div>

@endsection
