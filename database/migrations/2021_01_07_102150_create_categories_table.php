<?php

use App\Category;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();

            $table->string('name');

            $table->timestamps();
        });

        $categories = [
            'Giochi', 'Arredamento', 'Telefonia', 'Elettrodomestici', 'Vestiti',
            'Cucina', 'Igiene intima', 'Argenteria', 'Libri', 'Orologi'
        ];

        foreach ($categories as $category) {
            $c = new Category();
            $c->name = $category;
            $c->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
