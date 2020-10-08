<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("name", 150);
            $table->string("game_app", 150);
            $table->float("price");
            $table->float("promo")->nullable();
            $table->integer("quantity");
            $table->boolean("login_required");
            $table->enum("account_type", ["epic", "psn", "xbox live"])->nullable();
            $table->text("description");
            $table->text("image_name");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Delete Product Images
        // Storage::disk("local")->delete(Storage::files("images/"));

        // Drop table
        Schema::dropIfExists('products');
    }
}
