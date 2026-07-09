<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->string('email_status')->default('pending')->after('agency'); // pending | sent | failed
            $table->text('email_error')->nullable()->after('email_status');
        });

        Schema::table('attendances', function (Blueprint $table) {
            $table->string('email_status')->default('pending')->after('checked_in_at');
            $table->text('email_error')->nullable()->after('email_status');
        });
    }

    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->dropColumn(['email_status', 'email_error']);
        });

        Schema::table('attendances', function (Blueprint $table) {
            $table->dropColumn(['email_status', 'email_error']);
        });
    }
};