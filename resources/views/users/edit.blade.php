@extends('layouts.app');

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">User {{$user->name}} id is {{ $user->id}}</div>
            <div class="card-body">

                <form action="{{ route('users.update', $user->id)}}" method="post" enctype="multipart/form-data">

                    @csrf

                    @method('PUT')

                    <label>Username</label></br>
                    <input type="text" name="name" id="first_name" class="form-control" value="{{ $user->name}}"></br>

                    @error('name')

                    <span class="text-danger">{{$message}}</span>

                    @enderror

                    <label>First Name</label></br>
                    <input type="text" name="first_name" id="first_name" class="form-control" value="{{ $user->first_name}}"></br>

                    @error('first_name')

                    <span class="text-danger">{{$message}}</span>

                    @enderror

                    <label>Last Name</label></br>
                    <input type="text" name="last_name" id="last_name" class="form-control" value="{{ $user->last_name}}"  ></br>

                    @error('last_name')

                    <span class="text-danger">{{$message}}</span>

                    @enderror

                    <label>Email</label></br>
                    <input type="email" name="email" id="first_name" class="form-control" value="{{ $user->email}}"></br>

                    @error('email')

                    <span class="text-danger">{{$message}}</span>

                    @enderror

                    <label>Mobile</label></br>
                    <input type="text" name="mobile" id="mobile" class="form-control" value="{{ $user->mobile}}"></br>

                    @error('mobile')

                    <span class="text-danger">{{$message}}</span>

                    @enderror

                    <label>Address</label></br>
                    <input type="text" name="address" id="address" class="form-control" value="{{ $user->address}}"></br>

                    @error('address')

                    <span class="text-danger">{{$message}}</span>

                    @enderror

                    <label>Post Code</label></br>
                    <input type="text" name="post_code" id="post_code" class="form-control" value="{{ $user->post_code}}"></br>

                    @error('post_code')

                    <span class="text-danger">{{$message}}</span>

                    @enderror

                    <label>Image</label></br>
                    <input type="file" name="image" id="img" class="form-control" ></br>

                    @error('image')

                    <span class="text-danger">{{$message}}</span>

                    @enderror

                    </br>

                    <img src="{{url('/image', $user->image)}}" alt="" srcset="" width="120"></br>
                    </br>


                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Enter password" autocomplete="off" ">
                    @error('password')
                    <span class="text-danger">{{$message}}</span>

                    @enderror

                    <label for="confirm-password">Confirm Password</label>
                    <input type="password" name="confirm-password" class="form-control" id="confirm-password" placeholder="Enter confirm password" autocomplete="off">

                    @error('password')
                    <span class="text-danger">{{$message}}</span>

                    @enderror

                    <input type="submit" value="Save" class="btn btn-success"></br>
                </form>

            </div>
        </div>
    </div>

@endsection
