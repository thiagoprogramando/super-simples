<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recebiveis', function (Blueprint $table) {
            $table->id();
            $table->string('cliente');
            $table->string('cliente_id');
            $table->string('tag');
            $table->double('valor');
            $table->date('data');
            $table->integer('status');
            $table->boolean('parcela');
            $table->double('valor_parcela');
            $table->integer('user_id');
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
        Schema::dropIfExists('recebiveis');
    }
};
