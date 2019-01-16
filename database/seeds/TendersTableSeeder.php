<?php

use App\Tender;
use Faker\Factory;
use App\ProductTender;
use Illuminate\Database\Seeder;

class TendersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
     {
        //
        $faker =  Factory::create();

        Tender::truncate();
        ProductTender::truncate();
        foreach(range(1, 20) as $i) {
            $products = collect();
            foreach(range(1, mt_rand(2, 10)) as $j) {
                $body = $faker->text;
                $qty = $faker->numberBetween(1, 20);
                $products->push(new ProductTender([
                    'name' => $faker->sentence, 
                    'qte'  => $qty,
                    'unit' => $faker->name,
                    'body' => $body,
                 ]));
            }
            $tender = Tender::create([
                'body' => $faker->sentence,
                'name' => $faker->name,
                'tender_date' => $faker->date(),
                'type'=>'rfqe'
            ]);
            $tender->products()->saveMany($products);
        }
    }
}
