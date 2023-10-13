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
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('image');
            $table->dropColumn('price');
            $table->dropColumn('upc');
            $table->dropColumn('status');
            $table->string('username')->nullable();
            $table->string('contact')->nullable();
            $table->string('pick_date')->nullable();
            $table->string('pick_time')->nullable();
            $table->string('car_type')->nullable();
            $table->string('days')->nullable();
            $table->string('trip_type')->nullable();
            $table->text('description')->nullable();
            $table->string('payment_mode')->nullable();
            $table->string('credit_mode')->nullable();
            $table->string('trip_amount')->nullable();
            $table->string('advance_amount')->nullable();
            $table->string('drop_date')->nullable();
            $table->string('drop_time')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
};
