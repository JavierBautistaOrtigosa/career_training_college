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
            Schema::table('members', function (Blueprint $table) {
                  $table->text('professional_summary')->nullable()->after('address');
            });
      }

      /**
       * Reverse the migrations.
       */
      public function down()
      {
            Schema::table('members', function (Blueprint $table) {
                  $table->dropColumn('professional_summary');
            });
      }
};
