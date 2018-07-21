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
                    
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection 
