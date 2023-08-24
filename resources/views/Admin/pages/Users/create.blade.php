@extends('Admin.master')

@section('page-header')
    Users
@endsection

@section('content')
    <section>

        <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label> Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter Major Title">
                    @error('name')
                        <ul>
                            <li class="text-red">{{ $message }}</li>
                        </ul>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter Email">
                    @error('email')
                        <ul>
                            <li class="text-red">{{ $message }}</li>
                        </ul>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter password">
                    @error('password')
                        <ul>
                            <li class="text-red">{{ $message }}</li>
                        </ul>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Select Role</label>
                    <select name="role" class="form-control">
                       
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                        <option value="doctor">Doctor</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Image</label>
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
