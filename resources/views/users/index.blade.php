@extends('layouts.app');

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8">

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Serial No</th>
                        <th scope="col">Name</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Mobile</th>
                        <th scope="col">Address</th>
                        <th scope="col">Post Code</th>
                        <th scope="col">Image</th>
                        <th scope="col">Action</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $user)

                        <tr>
                            <td>{{ $loop->index+1}}</td>
                            <td>{{ $user->name}}</td>
                            <td>{{ $user->first_name}}</td>
                            <td>{{ $user->last_name}}</td>
                            <td>{{ $user->email}}</td>
                            <td>{{ $user->mobile}}</td>
                            <td>{{ $user->address}}</td>
                            <td>{{ $user->post_code}}</td>
                            <td>
                                <img src="{{url('/uploads',$user->image)}}" alt="Product Image" srcset="" width="80">
                                <img src="{{url('image/',$user->image)}}" alt="Product Image" srcset="" width="80">
                            </td>

                            <td>
                                <a href="{{ route('users.show',$user->id)}}" class="btn btn-primary"> Show</a>
                                <a href="{{ route('users.edit',$user->id)}}" class="btn btn-primary"> Edit</a>


                                <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>


                            </td>
                        </tr>

                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        @php $userId=Auth::user()->is_admin; @endphp

        @if($userId==1)
            {{ $users->links() }}
        @endif
    </div>
@endsection
