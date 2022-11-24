@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
	<div class="col-md-4">
		<div class="card">
		<div class="card-header">Registration</div>
		<div class="card-body">
			<form action="{{ route('users.store') }}" method="POST">
				@csrf
				<div class="form-group mb-3">
					<input type="text" name="name" class="form-control" placeholder="Name" />
					@if($errors->has('name'))
						<span class="text-danger">{{ $errors->first('name') }}</span>
					@endif
				</div>
				<div class="form-group mb-3">
					<input type="text" name="first_name" class="form-control" placeholder="Name" />
					@if($errors->has('first_name'))
						<span class="text-danger">{{ $errors->first('first_name') }}</span>
					@endif
				</div>
				<div class="form-group mb-3">
					<input type="text" name="last_name" class="form-control" placeholder="Name" />
					@if($errors->has('last_name'))
						<span class="text-danger">{{ $errors->first('last_name') }}</span>
					@endif
				</div>
				<div class="form-group mb-3">
					<input type="text" name="email" class="form-control" placeholder="Email Address" />
					@if($errors->has('email'))
						<span class="text-danger">{{ $errors->first('email') }}</span>
					@endif
				</div>

                <div class="form-group mb-3">
					<input type="text" name="mobile" class="form-control" placeholder="mobile" />
					@if($errors->has('mobile'))
						<span class="text-danger">{{ $errors->first('mobile') }}</span>
					@endif
				</div>
                <div class="form-group mb-3">
					<input type="text" name="address" class="form-control" placeholder="Address" />
					@if($errors->has('address'))
						<span class="text-danger">{{ $errors->first('address') }}</span>
					@endif
				</div>
                <div class="form-group mb-3">
					<input type="text" name="post_code" class="form-control" placeholder="Post_code" />
					@if($errors->has('post_code'))
						<span class="text-danger">{{ $errors->first('post_code') }}</span>
					@endif
				</div>
                <div class="form-group mb-3">
					<input type="file" name="image" class="form-control" placeholder="Image" />
					@if($errors->has('name'))
						<span class="text-danger">{{ $errors->first('name') }}</span>
					@endif
				</div>


				<div class="form-group mb-3">
					<input type="password" name="password" class="form-control" placeholder="Password" />
					@if($errors->has('password'))
						<span class="text-danger">{{ $errors->first('password') }}</span>
					@endif
				</div>



				<div class="d-grid mx-auto">
					<button type="submit" class="btn btn-dark btn-block">Register</button>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection('content')
