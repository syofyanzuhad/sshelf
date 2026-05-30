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
        Schema::table('servers', function (Blueprint $table) {
            $table->longText('password')->nullable()->change();
            $table->longText('private_key')->nullable()->change();
            $table->longText('passphrase')->nullable()->change();
        });

        Schema::table('ssh_keys', function (Blueprint $table) {
            $table->longText('private_key')->nullable()->change();
            $table->longText('passphrase')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('servers', function (Blueprint $table) {
            $table->text('password')->nullable()->change();
            $table->text('private_key')->nullable()->change();
            $table->string('passphrase')->nullable()->change();
        });

        Schema::table('ssh_keys', function (Blueprint $table) {
            $table->text('private_key')->change();
            $table->text('passphrase')->nullable()->change();
        });
    }
};
