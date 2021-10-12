<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'name' => "Laptop Acer AC001",
            'detail' => "Intel I7 10810, RAM 8GB, SSD 256",
            'price' => 11500000,
            'category' => 1,
            'type' => 0
        ]);

        DB::table('products')->insert([
            'name' => "Laptop Asus AS001",
            'detail' => "Intel I5 10980, RAM 4GB, SSD 128",
            'price' => 10500000,
            'category' => 1,
            'type' => 0
        ]);
    }
}
