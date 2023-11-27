<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('category_type_id');
            $table->timestamps();
        });

        DB::table("categories")->insert([
            [
                "name" => "Food & Beverage",
                "category_type_id" => 1
            ],
            [
                "name" => "Transportation",
                "category_type_id" => 1
            ],
            [
                "name" => "Rentals",
                "category_type_id" => 1
            ],
            [
                "name" => "Water Bill",
                "category_type_id" => 1
            ],
            [
                "name" => "Phone Bill",
                "category_type_id" => 1
            ],
            [
                "name" => "Electricity Bill",
                "category_type_id" => 1
            ],
            [
                "name" => "Gas Bill",
                "category_type_id" => 1
            ],
            [
                "name" => "Television Bill",
                "category_type_id" => 1
            ],
            [
                "name" => "Internet Bill",
                "category_type_id" => 1
            ],
            [
                "name" => "Outgoing Transfer",
                "category_type_id" => 1
            ],
            [
                "name" => "Other Utility Bill",
                "category_type_id" => 1
            ],
            [
                "name" => "Salary",
                "category_type_id" => 2
            ],
            [
                "name" => "Other Income",
                "category_type_id" => 2
            ],
            [
                "name" => "Incoming Transfer",
                "category_type_id" => 2
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
