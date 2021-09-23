@extends('layouts/admin')
@push('scripts')
    <script>
        toggle_active_class()
    </script>

@endpush
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('home', Auth::user()->user_id) }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active"><a href="{{ route('showAllDepartments') }}">list of registered
                                departments</a></li>
                    </ol>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item "><a href="{{ route('home', Auth::user()->user_id) }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active"><a href="{{ route('showAllDepartments') }}">list of registered
                                departments</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">List of Departments</h3>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        @if (count($departments) < 1)
                            There are no department(s) which has been registered
                        @else
                            <table class="table table-hover ">
                                <thead>
                                    <tr>
                                        <th scope="col">Reg Number</th>
                                        <th scope="col">Reg Name</th>
                                        <th scope="col">Phone Number</th>
                                        <th scope="col" style="width: 20%">Email</th>
                                        <th scope="col" style="width: 10%">Address</th>
                                        <th scope="col" style="width: 25%">.</th>
                                    </tr>
                                </thead>
                                <tbody>


                                    @foreach ($departments as $department)
                                        <tr>
                                            <td class="filterable-cell">{{ $department->department_id }}</td>
                                            <td class="filterable-cell">{{ $department->department_name }}</td>
                                            <td class="filterable-cell">{{ $department->department_phone_number }}
                                            </td>
                                            <td class="filterable-cell" style="width: 20%">
                                                {{ $department->department_email }}</td>
                                            <td class="filterable-cell" style="width: 13%">
                                                {{ $department->department_address }}</td>
                                            <td class="project-actions text-right" style="width: 22%">
                                                 {{-- <a
                                                    class="btn btn-primary btn-sm filterable-cell m-1" href="#"><i
                                                        class="fas fa-folder pr-1"> </i>View</a> --}}
                                                @can('editDepartment')
                                                    <a class="btn btn-info btn-sm filterable-cell m-1"
                                                        href="{{ route('editDepartment', [$department->department_id]) }}"><i
                                                            class="fas fa-pencil-alt pr-1">
                                                        </i>Edit</a>
                                                @endcan
                                                @can('deleteDepartment')
                                                    <a class="btn btn-danger btn-sm filterable-cell" href="#" onclick=""><i
                                                            class="fas fa-trash pr-1"> </i>Delete</a>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                        @endif

                        </tbody>
                        </table>
                    </div><!-- /.card-body -->
                </div><!-- /.card -->
            </div><!-- /.col -->
    </section>
    <!-- /.content -->
@endsection
