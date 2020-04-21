<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order_status')->insert([
            'id' => 1,
            'status' => 'обрабатывается',
        ]);
        DB::table('order_status')->insert([
            'id' => 2,
            'status' => 'подтвержден',
        ]);
        DB::table('order_status')->insert([
            'id' => 3,
            'status' => 'отменен',
        ]);
        DB::table('order_status')->insert([
            'id' => 4,
            'status' => 'завершен',
        ]);
    }
}
