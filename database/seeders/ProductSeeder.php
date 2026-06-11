<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('products')->delete();

        DB::table('products')->insert([
            // SEMBAKO
            ['name'=>'Gulaku Hijau 1kg','description'=>'Gula pasir murni berkualitas','category'=>'sembako','price'=>21500,'stock'=>100,'image'=>'images/products/gulaku_hijau_1kg.jpg'],
            ['name'=>'Tepung Segitiga Biru 1kg','description'=>'Tepung terigu protein sedang','category'=>'sembako','price'=>16000,'stock'=>80,'image'=>'images/products/tepung_segitiga_biru_1kg.jpg'],
            ['name'=>'Elle & Vire Butter Unsalted','description'=>'Butter premium dari Prancis','category'=>'sembako','price'=>78000,'stock'=>30,'image'=>'images/products/butter_elle_vire_unsalted.jpg'],
            ['name'=>'Elle & Vire Butter Salted','description'=>'Butter premium dari Prancis','category'=>'sembako','price'=>78000,'stock'=>30,'image'=>'images/products/butter_elle_vire_salted.jpg'],
            ['name'=>'Sriracha Sauce','description'=>'Dari Bahan-Bahan Alami','category'=>'sembako','price'=>65000,'stock'=>30,'image'=>'images/products/sriracha_sauce.jpg'],
            ['name'=>'Maizena 1kg','description'=>'Tepung Jagung','category'=>'sembako','price'=>30000,'stock'=>30,'image'=>'images/products/maizena_1kg.jpg'],
            ['name'=>'Anchor Cream Cheese','description'=>'Dari Keju Pilihan','category'=>'sembako','price'=>130000,'stock'=>30,'image'=>'images/products/anchor_cream_cheese.jpg'],
            ['name'=>'Whipping Creame Achor 1 liter','description'=>'Bahan-Bahan Alami','category'=>'sembako','price'=>130000,'stock'=>30,'image'=>'images/products/whipping_cream_anchor_1liter.jpg'],

            // SAYURAN
            ['name'=>'Brokoli','description'=>'Tanpa Pestisida','category'=>'sayuran','price'=>25000,'stock'=>30,'image'=>'images/products/brokoli.jpg'],
            ['name'=>'Cabai Rawit','description'=>'Dari Kebun Pilihan','category'=>'sayuran','price'=>60000,'stock'=>30,'image'=>'images/products/cabai_rawit.jpg'],
            ['name'=>'Ubi Cilembu Matang 1kg','description'=>'Manis Alami Tanpa Pestisida','category'=>'sayuran','price'=>35000,'stock'=>30,'image'=>'images/products/ubi_cilembu_matang_1kg.jpg'],
            ['name'=>'Ubi Cilembu Mentah 1kg','description'=>'Bahan-Bahan Alami','category'=>'sayuran','price'=>15000,'stock'=>10,'image'=>'images/products/ubi_cilembu_mentah_1kg.jpg'],
            ['name'=>'Ubi Ungu Mentah 1kg','description'=>'Bahan-Bahan Alami','category'=>'sayuran','price'=>15000,'stock'=>5,'image'=>'images/products/ubi_ungu_mentah_1kg.jpg'],
            ['name'=>'Gochujang Sauce 500g','description'=>'Bahan-Bahan Alami','category'=>'sembako','price'=>62000,'stock'=>5,'image'=>'images/products/gochujang_sauce_500g.jpg'],
        ]);
    }
}
