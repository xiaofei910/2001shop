<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BrandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        DB::table('brand')->insert([
//            'brand_name' => Str::random(10),
//            'brand_url' => Str::random(10).'@gmail.com',
//            'brand_logo' => Str::random(10),
//            'brand_desc'=>  Str::random(10),
//        ]);
        //工厂模式
//        factory(App\Models\Brand::class, 3)->create()->each(function($u) {
//                $u->posts()->save(factory(BrandFactory::class)->make());
//            });
        factory(App\Models\Brand::class, 3)->create();
    }
}
