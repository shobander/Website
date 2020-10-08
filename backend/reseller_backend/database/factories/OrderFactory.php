<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $prods_id_max= Product::max("id");
        $prods_id_min= Product::min("id");

        $prod_id= \rand($prods_id_min, $prods_id_max);
        $product= Product::find($prod_id);

        $qty= \rand(1, 4);
        $price= $qty * $product->price;

        if($product->login_required){
            $login= null;
            $password= null;
        }
        else{
            $login= $this->faker->lastName;
            $password= $this->faker->uuid;
        }

        return [
            "product_id"=> $prod_id,
            "quantity"=> $qty,
            "price"=> $price,
            "twitter"=> $this->faker->lastName,
            "instagram"=> $this->faker->lastName,
            "login"=> $login,
            "password"=> $password,
            "status"=> "processing"
        ];
    }
}
