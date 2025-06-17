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
        Schema::create('notes', function (Blueprint $table) {

            $table->id();
            $table->string('header', 50);
            $table->text('text');
            $table->boolean('pinned')->default(false);
            $table->dateTime('reminder')->nullable();
            $table->timestamps();

            $table -> foreignId('user_id') -> constrained()->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notes');
    }
};
