<?php

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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string("fullname", 200)->nullable();
            $table->string("nik", 16)->nullable();
            $table->string("email", 100)->nullable();
            $table->string("phone", 20)->nullable();
            $table->string("address", 200)->nullable();
            $table->date("birthdate")->nullable();
            $table->enum("gender", ["male", "female", "other"])->nullable();
            $table->string("religion", 100)->nullable();
            $table->unsignedBigInteger("user_id")->nullable(false);
            $table->timestamps();

            $table->foreign("user_id")->on("users")->references("id")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
