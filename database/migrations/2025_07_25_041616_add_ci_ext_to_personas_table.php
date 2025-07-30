<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('personas', function (Blueprint $table) {
        $table->string('ci_ext')->nullable()->after('ci');
    });
}

public function down()
{
    Schema::table('personas', function (Blueprint $table) {
        $table->dropColumn('ci_ext');
    });
}
};
