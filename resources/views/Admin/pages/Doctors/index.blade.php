@extends('Admin.master')

@section('page-header')
    Doctors
@endsection

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        @if(session('success'))
                            <div class="alert alert-success p-3">
                                {{session('success')}}
                            </div>
                        @endif
                        <div class="card-header">
                            <button class="bg-primary text-white border-transparent px-3 rounded">
                                <a href="{{route('doctor.create')}}">
                                    Create
                                </a>
                            </button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Doctor Name</th>
                                        <th>Assigned Major</th>
                                        <th>Image</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $x = 0;
                                    @endphp
                                    @forelse ($doctors as $doctor)
                                        <tr>
                                            <td>{{ ++$x }}</td>
                                            <td>{{ $doctor->name }}</td>
                                            <td>{{ $doctor->major->name }}</td>
                                            <td>
                                                <img src="{{ asset($doctor->image) }}" alt="doctor"
                                                style="width:100px; height:100px;" class="rounded-circle" 
                                                >
                                            </td>
                                            <td>
                                                <button class="bg-primary rounded text-white border-transparent">
                                                    <form method="GET" action="{{route('doctor.edit',$doctor->id)}}" >
                                                        <input type="submit" value="Update" 
                                                        class="bg-primary  rounded text-white border-transparent"/>
                                                    </form>
                                                </button>
                                                <button class="bg-danger  rounded text-white border-transparent">
                                                    <form method="POST" action="{{route('doctor.delete',$doctor->id)}}">
                                                        @csrf
                                                        @method('delete')
                                                        <input type="submit" value="Delete" 
                                                        class="bg-danger  rounded text-white border-transparent"/>
                                                    </form>
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4">
                                            there are no majors
                                        </td>
                                    </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
