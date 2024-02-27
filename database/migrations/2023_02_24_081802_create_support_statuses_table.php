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
        Schema::create('support_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('is_custom')->default('0');
            $table->string('bg_color')->nullable();
            $table->string('text_color')->nullable();
            $table->string('color_name')->nullable();
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
        Schema::dropIfExists('support_statuses');
    }
};
