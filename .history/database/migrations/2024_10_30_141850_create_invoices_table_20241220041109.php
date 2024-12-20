<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->bigInteger('customer_id');
            $table->date('invoice_date');
            $table->text('intro_cash')->nullable();
            $table->text('total_buy')->nullable();
            $table->text('total_remain')->nullable();
            $table->text('day_of_pay')->nullable();
            $table->tinyInteger('status')->default(0); // 1 payed 2 late 3 Uncomplete
             $table->date('deleted_at')->nullable();
            $table->integer('Value_Status')->nullable(); // or use the correct data type for your needs
            $table->text('Total')->nullable(); // or use the correct data type for your needs

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
        Schema::dropIfExists('invoices');
    }
}
