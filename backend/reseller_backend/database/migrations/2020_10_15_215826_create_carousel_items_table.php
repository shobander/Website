<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarouselItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carousel_items', function (Blueprint $table) {
            $table->bigInteger("id");
            $table->string("img_lg", 200);
            $table->string("img_sm", 200);
            $table->string("caption", 200);
            $table->timestamps();
            $table->primary("id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Delete Images 
        $items= App\Models\CarouselItem::all();

        foreach($items as $item){

            $path= "silder/".$item->img_lg;
            if (Storage::disk("images")->exists($path)){
                Storage::disk("images")->delete($path);
            }

            $path= "slider/".$item->img_sm;
            if (Storage::disk("images")->exists($path)){
                Storage::disk("images")->delete($path);
            }

        }      

        // Drop table
        Schema::dropIfExists('carousel_items');
    }
}
