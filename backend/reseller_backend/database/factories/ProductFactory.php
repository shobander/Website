<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "name"=> $this->faker->name,
            "price"=> \rand(5, 500),
            "promo"=> null,
            "quantity"=> \rand(1, 10),
            "login_required"=> false,
            "account_type"=> null,
            "description"=> $this->faker->sentence(),
            "image_name"=> "fortnite".rand(1,10).".jpg"
        ];
    }


    /**
     * Make product require login
     * 
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function require_login(){
        return $this->state( function (array $attributes) {
            return [
                "login_required"=> true
            ];
        });
    }


    /**
     * Set required account type
     * 
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function account_type(){
        return $this->state(function (array $attributes) {
            $account_types= ["epic", "psn", "xbox live"];
            
            return [
                "account_type"=> $account_types[\rand(0, \count($account_types))]
            ];
        });
    }


}
