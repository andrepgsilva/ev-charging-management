<?php

declare(strict_types=1);

use App\Modules\Fleet\Models\Driver;
use Illuminate\Support\Facades\Schema;
use App\Modules\Company\Models\Company;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('make');
            $table->string('model');
            $table->string('plate_number')->unique();
            $table->decimal('battery_capacity_kwh', 6, 2)->nullable();
            $table->foreignIdFor(Driver::class)->nullable()->constrained();
            $table->foreignIdFor(Company::class)->nullable()->constrained();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
