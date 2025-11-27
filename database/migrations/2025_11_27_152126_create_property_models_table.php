<?php

use App\Models\PropertyModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('title', 128);
            $table->text('description');
            $table->string('city', 32);
            $table->string('municipality', 32);
            $table->string('address', 64);
            $table->decimal('price',12, 2);
            $table->decimal('area',5,1);
            $table->integer('floor')->nullable();
            $table->integer('total_floors')->nullable();
            $table->string('property_type', 32)->default(PropertyModel::PROPERTY_APARTMENT);
            $table->enum('heating_type', ['central', 'ta', 'gas', 'floor', 'none']);
            $table->integer('construction_year')->nullable();
            $table->boolean('parking')->default(false);
            $table->boolean('furnished')->default(false);
            $table->foreignId('user_id')->constrained()->OnDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
