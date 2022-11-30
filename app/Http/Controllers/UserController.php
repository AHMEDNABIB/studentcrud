<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use  App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

use Illuminate\Support\Facades\Gate;


class UserController extends Controller

{

     public function __construct(){
        $this->middleware('auth');
     }
    /**Auth::user()->is_admin
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */ 

   
    public function index()
    {     
           $id = Auth::id();
          if (Gate::allows('isAdmin')) {
            $users = User::orderBy('id', 'DESC')->paginate(5);
             
           return view('users.index',compact('users'));
     
    } else {

        $users= User::where('id',$id)->get();
             
          return view('users.index',compact('users'));

    }
      

    //     $id = Auth::id();
    //    if (Auth::user()->is_admin==1) {
         
           
    //           $users = User::orderBy('id', 'DESC')->paginate(5);
             
    //        return view('users.index',compact('users'));
    //       }else {
         
    //            $users= User::where('id',$id)->get();
             
    //             return view('users.index',compact('users'));
    //       }

      
       
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
   


    public function store(Request $request)
    {

            $request->validate([
           'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'first_name'=> 'required|max:25',
            'last_name'=> 'required|max:25',
            'mobile'=> 'required|numeric',
            'address'=> 'required|max:50',
            'post_code'=> 'required|digits:5',
            'image'=> 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
  
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
    
        User::create(
           $input
        );
     
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
         $user= User::findOrFail($id);
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
          $user= User::findOrFail($id);
        return view('users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    


    public function update(Request $request, $id)
    {
    
         $user = User::findOrFail($id);

         $request->validate([
            'name' => ['required', 'string', 'max:255'],
            // 'email' => [ 'string', 'email', 'max:255'],
             'password' => 'nullable|confirmed|min:6',
             'email'=>'required|string|email|max:255|unique:users,email,'. $id,
            'first_name'=> 'required|max:25',
            'last_name'=> 'required|max:25',
            'mobile'=> 'required|numeric',
            'address'=> 'required|max:50',
            'post_code'=> 'required|digits:5',
             'image'=> 'mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        
    
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
        

       
      
  
        
        
          
        $user->update($input);

        
    
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
        $user= User::findOrFail($id);
        
         if (file_exists(public_path('/uploads/'.$user->image))) {
                unlink(public_path('/uploads/'.$user->image)); 
            }

        $user->delete();

        return redirect()->route('users.index');
    }


   
}
