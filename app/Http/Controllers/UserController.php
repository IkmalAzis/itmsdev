<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profile = Auth::user();
        $profiles = User::where('userid', $profile->userid)->get();
        return view('bu.profile_index', compact('profiles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $profile)
    {
        if($profile->usertype > 0 && Auth()->user()->id){
            abort(404);
        }else{
            return view ("bu.profile_form", compact('profile'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $profile)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'bunit'=> 'required|string|max:255',
            // 'phonenum'=> 'required|string|unique:users,phonenum',
            // 'email'=> 'required|string|email|unique:users,email',
            'phonenum'=> 'required|string',
            'email'=> 'required|string|email',
            'password'=> 'nullable|string|min:8|confirmed', //OPTIONAL TO CHANGE PASSWORD OR MAINTAIN
            ]);
     
            $profile->fill($request->except('password'));
            if($request['password']){
                $profile->password = Hash::make($request['password']);
            }
            $profile->save();
            return redirect()->route('app.profile.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $profile)
    {
        $profile->delete(); //HARD DELETE
        return redirect()->route('app.profile.index');
    }
}
