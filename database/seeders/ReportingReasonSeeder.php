<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReportingReasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reporting_reasons');
        $reporting_reasons = [
            [
                'name' => 'Scam or Fraud',
            ],
            [
                'name' => 'Expired Deal',
            ],
            [
                'name' => 'Misleading Information',
            ],
            [
                'name' => 'Inappropriate Content',
            ],
            [
                'name' => 'Not Relevant',
            ],
            [
                'name' => 'Technical Issues',
            ],
        ];
        DB::table('reporting_reasons')-> insert($reporting_reasons);
    }
}
