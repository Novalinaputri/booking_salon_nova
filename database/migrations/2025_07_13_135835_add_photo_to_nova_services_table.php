<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPhotoToNovaServicesTable extends Migration
{
    public function up()
    {
        Schema::table('nova_services', function (Blueprint $table) {
            $table->string('photo')->nullable();
        });
    }

    public function down()
    {
        Schema::table('nova_services', function (Blueprint $table) {
            $table->dropColumn('photo');
        });
    }
}