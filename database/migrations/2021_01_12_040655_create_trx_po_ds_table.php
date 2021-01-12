<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrxPoDsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trx_po_d', function (Blueprint $table) {
            $table->id();
            $table->string('po_h_id');
            $table->string('po_item_id');
            $table->string('po_item_qty');
            $table->decimal('po_item_price');
            $table->decimal('po_item_cost');
            $table->timestamps();
            $table->dateTime('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trx_po_d');
    }
}
