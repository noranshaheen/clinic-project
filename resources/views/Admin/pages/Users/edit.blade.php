@extends('Admin.master')

@section('page-header')
    Doctors
@endsection

@section('content')
    <section>

        <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="card-body">
                <div class="form-group">
                    <label> Name</label>
                    <input type="text" value="{{$user->name}}" name="name" class="form-control" placeholder="Enter Major Title">
                    @error('name')
                        <ul>
                            <li class="text-red">{{ $message }}</li>
                        </ul>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" value="{{$user->email}}" name="email" class="form-control" placeholder="Enter Email">
                    @error('email')
                        <ul>
                            <li class="text-red">{{ $message }}</li>
                        </ul>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Select Role</label>
                    <select name="role" class="form-control">
                        <option value="admin" {{$user->role=='admin'? "selected":""}}>Admin</option>
                        <option value="user" {{$user->role=='user'? "selected":""}}>User</option>
                        <option value="doctor" {{$user->role=='doctor'? "selected":""}}>Doctor</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Image</label>
                    <div class="input-group">
                        <div>
                            <input type="file" name="image">
                            <div class="py-3">
                                <img src="{{asset($user->image)}}"
                                style="width:200px; height:200px;"/>
                            </div>
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
