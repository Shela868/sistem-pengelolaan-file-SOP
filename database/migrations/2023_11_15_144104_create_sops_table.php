<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSopsTable extends Migration
{
    public function up()
    {
        Schema::create('sops', function (Blueprint $table) {
            $table->id();
            $table->string('perihal_SOP');
            $table->string('klasifikasi');
            $table->string('lampiran');
            $table->string('status_SOP');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sops');
    }


};
