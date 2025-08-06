<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::table('reports', function (Blueprint $table) {
            DB::statement("ALTER TABLE reports MODIFY COLUMN status ENUM('Pending', 'Accepted', 'Rejected') NOT NULL DEFAULT 'Pending'");
        });
    }

    public function down()
    {
        Schema::table('reports', function (Blueprint $table) {
            DB::statement("ALTER TABLE reports MODIFY COLUMN status ENUM('Pending', 'Reviewed', 'Resolved') NOT NULL DEFAULT 'Pending'");
        });
    }
};
