<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement('ALTER TABLE order_items ALTER COLUMN bouquet_name TYPE VARCHAR(1000)');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE order_items ALTER COLUMN bouquet_name TYPE VARCHAR(255)');
    }
};
