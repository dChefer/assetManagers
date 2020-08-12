<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('place_id');
            $table->unsignedInteger('manufacturer_id');
            $table->unsignedInteger('category_id');
            $table->string('model', 30);
            $table->mediumText('description')->nullable();
            $table->enum('state', ['maintenance', 'maintenance_pending', 'active', 'inactive'])
                ->default('active');
            $table->string('patrimony');
            $table->decimal('acquisition_value');
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
        Schema::dropIfExists('equipments');
    }
}
