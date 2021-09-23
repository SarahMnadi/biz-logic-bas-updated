@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h3>Customers</h3>
                <hr>
                <table id="customers" class="table table-bordered table-condensed table-striped" >
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>DOB</th>
                    </tr>
                    </thead>

                </table>


                <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
                <link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
                <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>

                <!-- our script will be here -->
            </div>
        </div>
    </div>
@endsection 
<script type="text/javascript">
    $(document).ready(function() {
    $.noConflict();
    
    $('#customers').DataTable({
        ajax: '',
        serverSide: true,
        processing: true,
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
    
        ]
    });
})
</script>