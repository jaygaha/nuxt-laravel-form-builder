<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormLayoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('form_layouts')) {
            Schema::create('form_layouts', function (Blueprint $table) {
                $table->id();
                $table->foreignId('form_id')->constrained();
                $table->integer("version");
                $table->json("form_layout");
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('form_layouts');
    }
}
