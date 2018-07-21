@extends('layouts.template')

@section('importcss')
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
@endsection

@section('content')
<!-- Breadcrumb -->
<ol class="breadcrumb">
    <!-- <li class="breadcrumb-item active" style="font-weight: 500; font-size: 18px;">Active Cases</li> -->
    <form id="dashboard-control" style="width: 100%;" method="GET" action="{{ url('/reports/custom/generate') }}">
        <div class="row">
            <div class="col-lg-3">
                <div class="form-group">
                    <input type="text" class="form-control startDate" id="start" name="start" placeholder="Start Date" value="{{ @$start }}" autocomplete="off">
                </div>
            </div>

            <div class="col-lg-3">
                <div class="form-group">
                    <input type="text" class="form-control endDate" id="end" name="end" placeholder="End Date" value="{{ @$end }}" autocomplete="off">
                </div>
            </div>

            <div class="col-lg-3">
                <div class="form-group">
                    <select id="type" name="type">
                        <option name="all">All Cases</option>
                        <option name="open">Open Cases</option>
                        <option name="resolved">Resolved Cases</option>
                    </select>
                </div>
            </div>
            
            <div class="col-lg-3">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" id="generateReport">Generate</button>
                </div>
            </div>
        </div>
    </form>
</ol>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <table id="report" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Phone</th>
                        <th>Date</th>
                        <th>Location</th>
                        <th>Tag</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $count = 1; ?>
                    @foreach($report as $rep)
                        <tr>
                            <td>{{ $count }}</td>
                            <td>{{ $rep->firstname }}</td>
                            <td>{{ $rep->lastname }}</td>
                            <td>{{ $rep->phone }}</td>
                            <td><?php echo date( 'd M Y', strtotime($rep->created_at)); ?></td>
                            <td>{{ $rep->locationname }}</td>
                            <td>{{ $rep->tagname }}</td>
                            <td>{{ $rep->status }}</td>
                        </tr>
                        <?php $count = $count + 1; ?>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection 
@section('customjs')
    <script type="text/javascript" src="{{ asset('js/charts.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#report').DataTable( {
                lengthChange: false,
                buttons: [
                    {
                        extend: 'excel',
                        text: 'Export to Excel'
                    },
                    {
                        extend: 'pdf',
                        text: 'Export to PDF'
                    }
                ]
            } );
         
            table.buttons().container()
                .appendTo( '.container-fluid .col-md-6:eq(0)' );

            $('.startDate').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true
            });

            $('.endDate').datepicker({
                format: 'yyyy-mm-dd',
                endDate: '0d',
                autoclose: true,
            });

            //Generate button click
            $('#generateReport').click(function(){
                var start = $('#start').val();
                var end = $('.endDate').val();

                  

                if($.trim(start) == ''){
                    alert('Start date is required');
                    return false;
                }else if($.trim(end) == ''){
                    alert('End date is required');
                    return false;
                }else if(new Date(end) < new Date(start)){
                    alert('End date must be greater than or equal to start date');
                    return false;
                }else{
                    return true;
                }
                
            })
        });
    </script>
@endsection
