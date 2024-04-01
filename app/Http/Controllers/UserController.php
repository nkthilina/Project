<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        return Inertia::render('User/Index',[
            users => User::all()
        ]);

    }

    public function create(){
        return Inertia::render('User/Create');
    }

    // public function store(){
    //     $image = Request->file('image')->store( 'users','public');
    //     User::create({
    //         'name' => Request::input('name'),
    //         'image' => $image
    //     })
    //     return Redirect::Route('topics.index')
    // }

    public function store(Request $request)
{
    // Validate the incoming request data
    $request->validate([
        'name' => 'required|string|max:255',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Assuming image field is required and should be an image file
    ]);

    // Store the uploaded image in the 'public/users' directory
    $imagePath = $request->file('image')->store('users', 'public');

    // Create a new user record
    User::create([
        'name' => $request->input('name'),
        'image' => $imagePath, // Save the image path to the database
    ]);

    // Redirect the user to the topics index route after successful creation
    return Redirect::route('topics.index');
}

    public function edit(User $user){
        return Inertia::render('Users/Edit',[
            'user' => $user,
            'image' => asset('storage/' .$user->image)
        ]);
    }

    public function update(User $user){
        $image = $user->image;
        if(Request()->hasFile('image')){
            $image = Request()->file('image')->store('users', 'public');
        }
        $user->update([
            'name' => Request()->name,
            'image' => $image
        ]);
        return Redirect::route('users.index');
    }

    public function userList()
{
    return Inertia::render('admin/product/userList');

}
}
