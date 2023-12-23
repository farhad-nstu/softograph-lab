<?php

use App\Models\Card;
use App\Models\Checklist;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChecklistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(with(new Checklist)->getTable(), function (Blueprint $table) {
            $table->id();
            $table->string('title', 55)->nullable();
            $table->unsignedBigInteger('card_id')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
            $table->foreign('card_id')->references('id')->on(with(new Card)->getTable());
            $table->foreign('created_by')->references('id')->on(with(new User)->getTable());
            $table->foreign('updated_by')->references('id')->on(with(new User)->getTable());
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(with(new Checklist)->getTable());
    }
}
