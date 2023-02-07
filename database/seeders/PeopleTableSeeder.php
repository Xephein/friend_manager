<?php

namespace Database\Seeders;

use App\Models\Person;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use PhpParser\Node\Expr\PostDec;

class PeopleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $people = [
            [
                'lastname' => 'lastname One',
                'firstname' => 'firstname One'
            ],
            [
                'lastname' => 'lastname Two',
                'firstname' => 'firstname Two'
            ]
        ];

        foreach($people as $key => $value) {
            Person::create($value);
        }
    }
}
