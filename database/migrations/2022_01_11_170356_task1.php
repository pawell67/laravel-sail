<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class Task1 extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('users');

        $sql = file_get_contents("database/migrations/db.sql");
        DB::connection()->getPdo()->exec($sql);
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('countries');
        Schema::dropIfExists('user_details');
        Schema::dropIfExists('transactions');
    }
}
