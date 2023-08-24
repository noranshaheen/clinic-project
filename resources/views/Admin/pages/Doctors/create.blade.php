@extends('Admin.master')

@section('page-header')
    Doctors
@endsection

@section('content')
    <section>

        <form action="{{ route('doctor.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label>Doctor Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter Major Title">
                    @error('name')
                        <ul>
                            <li class="text-red">{{ $message }}</li>
                        </ul>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Select a major</label>
                    <select name="major_id" class="form-control">
                        @foreach ($majors as $major)
                        <option value="{{$major->id}}">
                            {{$major->name}}
                        </option>
                        @endforeach
                        
                    </select>
                </div>

                <div class="form-group">
                    <label>Doctor Image</label>
                    <div class="input-group">
                        <div>
                            <input type="file" name="image">
                            <div>
                                @error('image')
                                    <ul>
                                        <li class="text-red">{{ $message }}</li>
                                    </ul>
                                @enderror
                            </div>
                            {{-- <label>Choose file</label> --}}
                        </div>

                        {{-- <div class="input-group-append">
                            <span class="input-group-text">Upload</span>
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>

    </section>
    </div>
@endsection
