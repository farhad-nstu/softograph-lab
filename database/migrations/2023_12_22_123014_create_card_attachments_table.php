<?php

use App\Models\Card;
use App\Models\CardAttachment;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(with(new CardAttachment)->getTable(), function (Blueprint $table) {
            $table->id();
            $table->string('document_path', 55)->nullable();
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
        Schema::dropIfExists(with(new CardAttachment)->getTable());
    }
}
