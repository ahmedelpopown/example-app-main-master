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
        $jobs = ['سائق', 'ممرض', 'فني', 'كاتب', 'طباخ', 'حارس'];

        foreach ($jobs as $job) {
            Job::create(['name' => $job]);
        }
    }
}
