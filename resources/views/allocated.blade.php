@extends('layouts.template')

@section('content')
<!-- Breadcrumb -->
<ol class="breadcrumb">
    <li class="breadcrumb-item">Backend</li>
    <li class="breadcrumb-item active">Allocated</li>
</ol>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-lg-12">
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
                            <td>1</td>
                            <td>2</td>
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



@endsection 
