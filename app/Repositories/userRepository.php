<?php

namespace App\Repositories;
use App\Models\User;
use App\Repositories\Interfaces\userRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;

class userRepository implements userRepositoryInterface{


       public function all()
            {     
                $id = Auth::id();
                if (Gate::allows('isAdmin')) {
                    return User::orderBy('id', 'DESC')->paginate(5);
                } else {
                    return User::where('id',$id)->get();
                 }
            }
     

    

    public function create(array $attributes)
    {
        User::create($attributes);
    }

    public function show($id)
    {
        return User::find($id);
    }

    public function update($id, array $attributes)
    {
        $this->show($id)->update($attributes);
    }

    public function delete($id)
    {
        // $this->show($id)->update(['status'=>0]);

        return User::find($id)->delete();
    }
}
