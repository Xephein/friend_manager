<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\Relationship;
use Illuminate\Database\Eloquent\Factories\Relationship as FactoriesRelationship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $people = Person::where('lastname', 'Mercer')->get();
        $people = Person::orderBy('lastname')
        ->get();

        return view('People.p_index')->with('people', $people);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('People.p_create');
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
            'lastname' => 'required|max:255|alpha',
            'firstname' => 'required|max:255|alpha'
        ]);

        $person = new Person();
        $person->lastname = $request->lastname;
        $person->firstname = $request->firstname;
        $person->save();

        return redirect(route('People.Create'))->with('message', $person->lastname . ' ' . $person->firstname . ' hozzáadva az adattáblához.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $friends = Relationship::all();

        dd($friends);

        return view('People.p_edit', [
            'person' => Person::findOrFail($id),
            'friends' => $friends
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $friendquery = DB::table('People')
        ->join('Relationships', 'People.id', '=', 'Relationships.person_id' )
        ->select('relationships.id', 'firstname', 'lastname', 'person_id', 'friend_id')
        ->where('person_id', $id)
        ->orWhere('friend_id', $id)
        ->get();

        $friends = array();
        foreach ($friendquery as $friend) {
            array_push($friends, DB::table('people')
            ->select('id', 'lastname', 'firstname')
            ->where('id',($id == $friend->person_id) ? $friend->friend_id : $friend->person_id)
            ->get());
        }

        $nfhelper = DB::table('people')
        ->select('id')
        ->where('id', $id);

        foreach ($friendquery as $friend2) {
            $nfhelper = DB::table('people')
            ->select('id')
            ->where('id', ($id == $friend2->person_id) ? $friend2->friend_id : $friend2->person_id)
            ->union($nfhelper);
        }

        $nfhelper = DB::table('people')
        ->select('id')
        ->where('id', $id)
        ->union($nfhelper)
        ->get()
        ->toArray();

        $nonfriendids = array();
        foreach ($nfhelper as $instance) {
            array_push($nonfriendids, $instance->id);
        }

        $nonfriends = DB::table('people')
        ->select('id', 'lastname', 'firstname')
        ->whereNotIn('id', $nonfriendids)
        ->get();

        $friendgroups = DB::table('groups')
        ->join('group_person', 'group_person.group_id', '=', 'groups.id')
        ->select('id', 'group_name')
        ->where('people_id', $id)
        ->get();
        
        $person = Person::find($id);
        return view('People.p_edit', [
            'person' => Person::where('id')
        ])
        ->with('person', $person)
        ->with('friends', $friends)
        ->with('nonfriends', $nonfriends)
        ->with('friendquery', $friendquery)
        ->with('friendgroups', $friendgroups);
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
            'lastname' => 'required|max:255|alpha',
            'firstname' => 'required|max:255|alpha'
        ]);

        Person::where('id', $id)->update([
            'lastname' => $request->lastname,
            'firstname' => $request->firstname
        ]);

        return redirect(route('People.Edit', $id))->with('message', 'Sikeres módosítás.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $temp = DB::table('people')
        ->where('id', $id)
        ->get();

        $deleted = [$temp[0]->lastname,$temp[0]->firstname];

        Person::destroy($id);

    
        return redirect(route('People.Manage'))->with('message', $deleted[0] . ' ' . $deleted[1] . ' eltávolítva az adattáblából.');
    }

}
