<?php

use App\Modules\ChargingInfrastructure\Models\ChargingPool;
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
        Schema::create('charging_points', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(ChargingPool::class)->nullable()->constrained();
            $table->string('label');
            $table->string('vendor')->nullable();
            $table->string('serial_number')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('charging_points');
    }
};
