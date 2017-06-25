<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ManageProfileRequest;

class ManageProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show form for new resource
     *
     * @return \Illuminate\Http\Response
     */
    public function showManageProfileForm($id) 
    {
        $user = auth()->user();
        if($user->id != $id) {
            abort(404);
        }
        return view('auth.manage')->with('user', $user);
    }

    /**
     * Update resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(ManageProfileRequest $request, $id) 
    {
        $user = auth()->user()->find($id);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();

        return back()->with('success', 'Profile updated successfully');
    }
}
