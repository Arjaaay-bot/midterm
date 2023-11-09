<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('quantity');
            $table->decimal('amount', 10, 2);
            $table->string('status')->default('waiting for approval');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('requests');
    }
};
