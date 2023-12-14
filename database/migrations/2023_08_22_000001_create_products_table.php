<?php

use App\Models\Tool;
use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('owner_name', 200)->nullable()->default('');
            $table->string('installer_name', 200)->nullable()->default('');
            $table->foreignIdFor(User::class);
            $table->string('city', 200)->nullable()->default('');
            $table->string('street', 200)->nullable()->default('');
            $table->string('zip', 4)->nullable()->default('');
            $table->string('purchase_place', 200)->nullable()->default('');
            $table->string('serial_number', 200)->nullable(false)->default('');
            $table->string('comments', 500)->nullable()->default('');
            $table->date('installation_date')->nullable();
            $table->date('warrantee_date')->nullable();
            $table->date('purchase_date')->nullable();
            $table->string('mac')->nullable();
            $table->boolean('access_to_wifi')->nullable()->default(false);
            $table->foreignIdFor(Tool::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
