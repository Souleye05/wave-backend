<?php

use App\Enums\ActionCompte;
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
        Schema::create('account_actions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('distributor_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('client_id')->constrained('users')->onDelete('cascade');
            $table->enum('action', array_column(ActionCompte::cases(), 'value'))->default(ActionCompte::DEPOT->value);
            $table->decimal('amount', 15, 2)->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_actions');
    }
};