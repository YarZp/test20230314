<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        foreach ($users as $user){
            DB::table('project_user')->insert([
                'project_id'=>fake()->numberBetween(1,30),
                'user_id'=>fake()->numberBetween(1,100)
            ]);
        }
    }
}
