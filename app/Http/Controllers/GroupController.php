<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = DB::table('groups')
        ->select('id', 'group_name')
        ->orderBy('group_name')
        ->get();

        return view('Group.g_index')
        ->with('groups', $groups);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Group.g_create');
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
            'groupname' => 'required|max:255|string',
        ]);

        $group = new Group();
        $group->group_name = $request->groupname;
        $group->save();

        return redirect(route('Group.Manage'));
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
        $group = DB::table('groups')
        ->select('id', 'group_name')
        ->where('id', $id)
        ->get();

        $allpeople = DB::table('people')
        ->select('id', 'lastname', 'firstname')
        ->whereIn('id', DB::table('relationships')->select('person_id'))
        ->orWhereIn('id', DB::table('relationships')->select('friend_id'))
        ->orderby('lastname')
        ->get();

        $memberIDshelper = DB::table('group_person')
        ->select('people_id')
        ->where('group_id', $id);

        $fofID = DB::table('relationships')
        ->select('person_id', 'friend_id')
        ->whereIn('person_id', $memberIDshelper)
        ->orWhereIn('friend_id', $memberIDshelper);

        $members = DB::table('people')
        ->select('id', 'lastname', 'firstname')
        ->whereIn('id', $memberIDshelper)
        ->orderBy('lastname')
        ->get();
        
        $nonmembers = DB::table('people')
        ->select('id', 'lastname', 'firstname')
        ->whereNotIn('id', $memberIDshelper)
        ->whereIn('id', $fofID->select('person_id'))
        ->orWhereIn('id', $fofID->select('friend_id'))
        ->whereNotIn('id', $memberIDshelper)
        ->orderBy('lastname')
        ->get();

        $everyone = DB::table('people')
        ->get();

        return view('Group.g_edit')
        ->with('group', $group)
        ->with('allpeople', $allpeople)
        ->with('nonmembers', $nonmembers)
        ->with('members', $members)
        ->with('everyone', $everyone);
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
        $request->validate([
            'groupname' => 'required|max:255|string',
        ]);

        Group::where('id', $id)->update([
            'group_name' => $request->groupname,
        ]);

        return redirect(route('Group.Edit', $id))->with('message', 'Sikeres M??dos??t??s');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Group::destroy($id);
    
        return redirect(route('Group.Manage'))->with('message', 'Sor elt??vol??tva az adatb??zisb??l.');
    }
}
