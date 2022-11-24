<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use  App\Models\User;
<<<<<<< HEAD
=======
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
>>>>>>> c3dc9dd7984e68a6641346bde1c82185250c0655

class UserController extends Controller

{

     public function __construct(){
        $this->middleware('auth');
     }
<<<<<<< HEAD
    /**
=======
    /**Auth::user()->is_admin
>>>>>>> c3dc9dd7984e68a6641346bde1c82185250c0655
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
<<<<<<< HEAD
    {
        $users= User::all();
        return view('users.index',compact('users'));
=======
    {     

        //  $is = Auth::

        $id = Auth::id();

          //dd();

        
              

        //    $users = User::orderBy('id', 'DESC')->paginate(5);
             
        //    return view('users.index',compact('users'));

          if (Auth::user()->is_admin==1) {
            //  $users= User::all();
           
              $users = User::orderBy('id', 'DESC')->paginate(5);
             
           return view('users.index',compact('users'));
          }else {
            //dd(Auth::user());
      
               //$users= User::find($id)->paginate(1) ;
               //dd(Auth::id());
               $users= User::where('id',$id)->get();
               //dd($users);
                return view('users.index',compact('users'));
          }

      
       
>>>>>>> c3dc9dd7984e68a6641346bde1c82185250c0655
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
<<<<<<< HEAD
        //
=======
    return view('auth.register');
>>>>>>> c3dc9dd7984e68a6641346bde1c82185250c0655
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
<<<<<<< HEAD
    public function store(Request $request)
    {
        //
    }
=======
   


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
>>>>>>> c3dc9dd7984e68a6641346bde1c82185250c0655

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
<<<<<<< HEAD
    public function update(Request $request, $id)
    {

        
        $image = Image::findOrFail($id);

        if ($request->hasFile('image')) {

            // $request->validate([

            //     'image'=> 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:width=500,height=500'

            // ]);

            //    $validated = $validator->safe()->only(['image']);
            //    $validated = $validator->safe()->except(['image.required', 'image.image']);

            if (file_exists(public_path('/uploads/'.$image->image))) {
                unlink(public_path('/uploads/'.$image->image)); 
            }

           

            $file= $request->file('image');
            $extension= $file->extension();
            $final= date('YmdHis').'.'.$extension;

            $file->move(public_path('/uploads/'),$final);

            $image->image= $final;

        }

    //      $request->validate([
    //          'first_name'=> 'required|max:25',
    //         'last_name'=> 'required|max:25',
    //         'mobile'=> 'required|numeric',
    //         'address'=> 'required',
    //         'post_code'=> 'required|digits:4',
           

    //    ]);

            $validated = $request->validated();
    //    $validated =  $request->safe()->except(['image.required','image.image']);

       $image->first_name= $request->first_name;
       $image->last_name= $request->last_name;
       $image->mobile= $request->mobile;
       $image->address= $request->address;
       $image->post_code= $request->post_code;

       $image->update();

       return redirect()->route('image.index');
        
=======
    


    public function update(Request $request, $id)
    {
    
         $user = User::findOrFail($id);

         $request->validate([
            'name' => ['required', 'string', 'max:255'],
            // 'email' => [ 'string', 'email', 'max:255'],
            // 'password' => ['required', 'confirmed', Rules\Password::defaults()],
             'email'=>'required|string|email|max:255|unique:users,email,'. $id,
            'first_name'=> 'required|max:25',
            'last_name'=> 'required|max:25',
            'mobile'=> 'required|numeric',
            'address'=> 'required|max:50',
            'post_code'=> 'required|digits:5',
            'image'=> 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        
    
        $input = $request->all();
  
        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }else{
            unset($input['image']);
        }
         
         if (file_exists(public_path('image/'.$user->image))) {
                unlink(public_path('image/'.$user->image)); 
            }
            
         $password= bcrypt($request->password);
         $input['password']= $password;
         $input['is_admin']=0;
  
        
        
          
        $user->update($input);
    
        return redirect()->route('users.index');
  
       
       
>>>>>>> c3dc9dd7984e68a6641346bde1c82185250c0655
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
<<<<<<< HEAD
        //
    }
=======
        $user= User::findOrFail($id);
        
         if (file_exists(public_path('/uploads/'.$user->image))) {
                unlink(public_path('/uploads/'.$user->image)); 
            }

        $user->delete();

        return redirect()->route('users.index');
    }


    //  public function handleAdmin()
    // {
    //     return view('handleAdmin');
    // } 
>>>>>>> c3dc9dd7984e68a6641346bde1c82185250c0655
}
