<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTransactionsAddTransactionStatusColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('transactions', 'transaction_status')) {
            Schema::table('transactions', function (Blueprint $table) {
                $table->string('transaction_status');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('transactions', 'transaction_status')) {
            Schema::table('transactions', function (Blueprint $table) {
                $table->dropColumn('transaction_status');
            });
        }
    }
}
