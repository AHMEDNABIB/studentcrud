
@extends('layouts.app')

@section('content')
  <div class="row justify-content-center"></div>
      
<div class="card">
  <div class="card-header">View Page</div>
  <div class="card-body">
   
 
        <div class="card-body">
        <h2 class="card-text">Address : {{ $user->name }}</h2>
        <h5 class="card-title">Name : {{ $user->first_name }} {{$user->last_name}}</h5>
         <p class="card-text">Email : {{ $user->email }}</p>
        <p class="card-text">Address : {{ $user->address }}</p>
        <p class="card-text">Mobile : {{ $user->mobile }}</p>
        <p class="card-text">Post Code : {{ $user->post_code }}</p>

         </br>

        <img src="{{url('/uploads', $user->image)}}" alt="" srcset="" width="120"></br>
        </br>
        
  </div>
       
    </hr>
  
  </div>
</div>
  </div>

  @endsection
