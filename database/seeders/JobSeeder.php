<?php

namespace Database\Seeders;

use App\Models\Job;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $jobs = ['تحريات', 'عمليات', 'شؤن', 'مطبخ مجندين', 'مطبخ ظباط', 'بوفية'];

        foreach ($jobs as $job) {
            Job::create(['name' => $job]);
        }
    }
}
