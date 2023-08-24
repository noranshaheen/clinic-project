@extends('Admin.master')

@section('page-header')
    Majors
@endsection

@section('content')
    <section>

        <form action="{{ route('major.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label>Major Title</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter Major Title">
                    @error('name')
                        <ul>
                            <li class="text-red">{{ $message }}</li>
                        </ul>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Major Image</label>
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
