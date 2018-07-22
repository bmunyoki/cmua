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
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Apartment</th>
                    <th>Room Number</th>
                    <th>Room Type</th>
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
                            <td>{{ $vol->room }}</td>
                            <td>{{ $vol->room_description }}</td>
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



@endsection 
