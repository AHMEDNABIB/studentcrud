<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use  App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Repositories\Interfaces\userRepositoryInterface;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\userRequest;
use App\Http\Requests\userUpdateRequest;


class UserController extends Controller

{
    private $userRepository;

     public function __construct(userRepositoryInterface $userRepository){
        $this->middleware('auth');
        $this->userRepository= $userRepository;

     }

    /**Auth::user()->is_admin
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */ 

   
    public function index()
    {    
        
        $users = $this->userRepository->all(); 

        return view('users.index',compact('users'));  
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    return view('auth.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   


    public function store(userRequest $request)
    {

        
  
         $input = $request->all();

     

        //  $password= Hash::make($request->password);
         $password= bcrypt($request->password);
         $input['password']= $password;
         $input['is_admin']=0;
  
        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }
    
        // User::create(
        //    $input
        // );

        $this->userRepository->create($input);

     
        return redirect()->route('users.index');
                       
    
    
     }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $user= $this->userRepository->show($id);
        return view('users.show',compact('user'));
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
          $user= $this->userRepository->show($id);
        return view('users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    


    public function update(userUpdateRequest $request, $id)
    {
    
      
          $user= $this->userRepository->show($id);
        
         
        dd($user->id,$id);
    
        $input = $request->all();

      


        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";  
            
             
         if (file_exists(public_path('image/'.$user->image))) {
                unlink(public_path('image/'.$user->image)); 
            }

        }else{  
            unset($input['image']);
        }
        
  
      
        
          if($input['password'] == null) {
          
               unset($input['password']);
               unset($input['password_confirmation']);
               
          }else{
              $password= bcrypt($request->password);
             $input['password']= $password;
          }

        //    $input['is_admin']=0;

        //  dd($input);

        if (Auth::user()->is_admin&& $user->is_admin) {
            $input['is_admin']=1;
        } else {
            $input['is_admin']=0;
        }
        

       
      
  
        
        
          
        // $user->update($input);

        $this->userRepository->update($id,$input);

        
    
        return redirect()->route('users.index');
  
       
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $user= $this->userRepository->show($id);

        //  dd($user->id,$id);

       //  dd($id);
        
         if (file_exists(public_path('/uploads/'.$user->image))) {
                unlink(public_path('/uploads/'.$user->image)); 
            }

         $this->userRepository->delete($id);

        // dd($this);
        return redirect()->route('users.index');
    }

    public function changePassword(Request $request)
    {
        return view('users.change-password');
    }
 
    public function changePasswordSave(Request $request)
    {
        
        $this->validate($request, [
            'current_password' => 'required|string',
            'new_password' => 'required|confirmed|min:8|string'
        ]);
        $auth = Auth::user();
 
 // The passwords matches
        if (!Hash::check($request->get('current_password'), $auth->password)) 
        {
            return back()->with('error', "Current Password is Invalid");
        }
 
// Current password and new password same
        if (strcmp($request->get('current_password'), $request->new_password) == 0) 
        {
            return redirect()->back()->with("error", "New Password cannot be same as your current password.");
        }
 
        $user =  User::find($auth->id);
        $user->password =  Hash::make($request->new_password);
        $user->save();
        return back()->with('success', "Password Changed Successfully");
    }


   
}
