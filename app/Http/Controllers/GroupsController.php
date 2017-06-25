<?php

namespace App\Http\Controllers;

use App\Group;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreGroupRequest;

class GroupsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $groups = $user->groups()->paginate(env('DEFAULT_PAGE_SIZE'));
        return view('groups.manage')->with('groups', $groups);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('groups.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGroupRequest $request)
    {
        $user = auth()->user();

        $group = new Group();
        $group->name = $request->input('name');
        $group->description = $request->input('description');
        $group->save();

        $share = $request->input('share');
        $share = $user->whereIn('email', explode(",", $share))->pluck('id');

        $share->push($user->id);
        $group->users()->attach($share);

        return redirect(route('groups.index'))->with('success', 'Successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = auth()->user();

        $group = $user->groups()->findOrFail($id);
        $share = $group->users()->pluck('email')->reject(function ($value, $key) {
            return $value == auth()->user()->email;
        })->implode(",");

        return view('groups.edit')->with(['group' => $group, 'share' => $share]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreGroupRequest $request, $id)
    {
        $user = auth()->user();

        $group = $user->groups()->findOrFail($id);
        $group->name = $request->input('name');
        $group->description = $request->input('description');
        $group->save();
        
        $share = $request->input('share');
        $share = $user->whereIn('email', explode(",", $share))->pluck('id');
        $share->push($user->id);
        $group->users()->sync($share);

        return redirect(route('groups.index'))->with('success', 'Successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = auth()->user();

        $group = $user->groups()->findOrFail($id);
        $group->users()->detach();
        $group->delete();

        return redirect(route('groups.index'))->with('success', 'Successfully removed');
    }
}
