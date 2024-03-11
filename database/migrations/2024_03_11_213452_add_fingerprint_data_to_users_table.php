<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFingerprintDataToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Check if the column exists before adding it
        if (!Schema::hasColumn('users', 'fingerprint_data')) {
            Schema::table('users', function (Blueprint $table) {
                $table->text('fingerprint_data')->nullable()->after('email_verified_at');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('fingerprint_data');
        });
    }
}
