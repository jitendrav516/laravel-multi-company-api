<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddActiveCompanyToUsers extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('active_company_id')->nullable()->after('remember_token');
            $table->foreign('active_company_id')->references('id')->on('companies')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['active_company_id']);
            $table->dropColumn('active_company_id');
        });
    }
}
