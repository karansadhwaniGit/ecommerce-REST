<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if(App::environment() === 'production'){
            exit();
        }
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');


        //truncate all the table except migrations
        $tables=DB::select('SHOW TABLES');
        $tempTableKey = "Tables_in_" .env("DB_DATABASE");
        foreach($tables as $table){
            if($table->$tempTableKey != "migrations"){
                DB::table($table->$tempTableKey)->truncate();
            }
        }

        //set the count of data we want
        $numOfUsers =200;
        $numOfCategories= 30;
        $numOfProducts=1000;
        $numOfTransactions=1000;

        //seed the data with the count given
        User::factory()->count($numOfUsers)->create();

        Category::factory()->count($numOfCategories)->create();
        Product::factory()
                ->count($numOfProducts)
                ->create()
                ->each(function(Product $product){
                    $categories=Category::all()->random(mt_rand(1,5))->pluck('id');
                    $product->categories()->attach($categories);
                });
        Transaction::factory()->count($numOfTransactions)->create();



    }
}
