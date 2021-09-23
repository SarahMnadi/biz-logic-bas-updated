@extends('layouts.admin')
@push('scripts')
@endpush

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Staffs</h1>
                </div>
            <div>
            <button type="button" id="btnAdd"  class="btn" 
            style="background-color:#3869ae;font-size:20px; border-radius: .2rem;width:100px;margin-left:600px;height:40px">
                <a href="{{ route('addUser') }}" class="nav-link " onclick="toggle_active_class()">
                    <p class="text-light " style="margin-top -50px">Create</p>
                </a>
          </button> 
            </div>
            <div style="margin-left:1200px">
                <label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="tbl-smtp"></label>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div>
        <div style="margin-bottom: .5rem;box-sizing: inherit;margin-left:20px;font-family:Lato, sans-serif">
        <label>Show <select name="tbl-smtp_length" aria-controls="tbl-smtp" class="custom-select custom-select-sm form-control form-control-sm"><option value="5">5</option><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option><option value="-1">All</option></select> entries</label>    </div>
    </div>
        <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Default box -->
            <div class="card">
                @if (count($users) < 0)
                    There is no user registered
                @else
                    <div class="card-body p-0">
                        <table class="table table-striped projects">
                            <thead>
                                <tr>
                                    <th style="width: 15%">
                                        User ID
                                    </th>
                                    <th style="width: 20%">
                                         User Name
                                    </th>
                                    <th style="width: 20%">
                                        Email
                                    </th>
                                   {{-- <th style="width: 20%">
                                    Gender
                                   </th> --}}
                                    <th style="width: 50%; margin-left:-60px" class="text-center">
                                        More Info
                                    </th>
                                </tr>

                            </thead>
                            <tbody id="tableAllUsers">
                                @foreach ($users as $user)
                                    <tr>
                                        <td style="width: 15%">{{ $user->user_id }}</td>
                                        <td style="width: 20%">
                                            <ul class="list-inline">
                                                <li class="list-inline-item">{{ $user->first_name }}
                                                    {{ $user->last_name }}</li>
                                            </ul>
                                        </td>
                                        <td style="width: 20%">
                                            <ul class="list-inline">
                                                <li class="list-inline-item">{{ $user->email }}</li>
                                            </ul>
                                        </td>
                                        {{-- <td style="width: 20%">
                                            <ul class="list-inline">
                                                <li class="list-inline-item">{{ $user->first_name }}
                                                    {{ $user->last_name }}</li>
                                            </ul>
                                        </td> --}}
{{--                                         
                                        <td class="project-state" style="width: 10%">
                                            @if ($user->status->enrollment_status && !$user->status->ready_to_enroll)
                                                <span class="badge bg-success">Enrolled</span>
                                            @else
                                                <span class="badge bg-danger">Not-enrolled</span>
                                            @endif
                                        </td> --}}
                                        <td class="clickable-btn" style="width: 5%;margin-left:200px"> <a
                                                href="{{ route('showUserDetails', [$user->user_id]) }}"><i
                                                    class="fas fa-cogs"></i></a></td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                @endif

            </div>
            <!-- /.card -->
        </div>


    </section>
    <!-- /.content -->

    <!-- /.content-wrapper -->
@endsection
