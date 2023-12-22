<?php

use App\Models\Admin;
use App\Models\Card;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(with(new Card)->getTable(), function (Blueprint $table) {
            $table->id();
            $table->string('name', 35)->nullable();
            $table->string('description', 255)->nullable();
            $table->string('status', 25)->nullable();
            $table->timestamp('status_date')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
            $table->foreign('created_by')->references('id')->on(with(new Admin)->getTable());
            $table->foreign('updated_by')->references('id')->on(with(new Admin)->getTable());
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(with(new Card)->getTable());
    }
}
