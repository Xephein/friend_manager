<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GroupPersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::table('group_person')
        ->insert([
            'group_id' => $request->groupID,
            'people_id' => $request->memberID
        ]);

        return redirect(route('Group.Edit', $request->groupID));
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param  \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $g_id = $request->group_id;
        $m_id = $request->member_id;

        $deleted = DB::table('group_person')
        ->where('group_id', $g_id)
        ->where('people_id', $m_id)
        ->delete();
        
        $memberIDshelper = DB::table('group_person')
        ->select('people_id')
        ->where('group_id', $g_id);

        $fofID = DB::table('relationships')
        ->select('person_id', 'friend_id')
        ->whereIn('person_id', $memberIDshelper)
        ->orWhereIn('friend_id', $memberIDshelper);
        
        $possMembers = DB::table('people')
        ->select('id')
        ->whereIn('id', $fofID->select('person_id'))
        ->orWhereIn('id', $fofID->select('friend_id'));

        $deletenotposs = DB::table('group_person')
        ->where('group_id', $g_id)
        ->whereNotIn('people_id', $possMembers)
        ->delete();

        return back();
    }
}
