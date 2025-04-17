<?php

namespace Database\Seeders;

use App\Models\Batch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $batches = ['الدفعة الأولى', 'الدفعة الثانية', 'الدفعة الثالثة'];

        foreach ($batches as $name) {
            Batch::create(['name' => $name]);
        }
    }
}
