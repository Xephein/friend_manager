<?php

namespace App\Http\Controllers;

use App\Models\Relationship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RelationshipController extends Controller
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
        $request->validate([
            'person_id' => 'required|numeric',
            'friend_id' => 'required|numeric'
        ]);

        $relationship = new Relationship();
        $relationship->person_id = $request->person_id;
        $relationship->friend_id = $request->friend_id;
        $relationship->save();

        return redirect(route('People.Edit', $request->person_id));
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
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $relation = Relationship::find($id);
        
        $IDs = [$relation->person_id, $relation->friend_id];
        
        Relationship::destroy($id);

        $groupsToCheck = DB::table('group_person')
        ->select('group_id')
        ->whereIn('people_id', $IDs)
        ->get();

        foreach ($groupsToCheck as $group) {

            echo($group->group_id);

            $memberIDshelper = DB::table('group_person')
            ->select('people_id')
            ->where('group_id', $group->group_id);

            echo($memberIDshelper->get());

            $fofID = DB::table('relationships')
            ->select('person_id', 'friend_id')
            ->whereIn('person_id', $memberIDshelper)
            ->orWhereIn('friend_id', $memberIDshelper);

            $possMembers = DB::table('people')
            ->select('id')
            ->whereIn('id', $fofID->select('person_id'))
            ->orWhereIn('id', $fofID->select('friend_id'));

            $deletenotposs = DB::table('group_person')
            ->where('group_id', $group->group_id)
            ->whereNotIn('people_id', $possMembers)
            ->delete();
        }
       
        return back();
    }
}
