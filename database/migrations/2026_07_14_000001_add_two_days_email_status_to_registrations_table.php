<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->string('two_days_email_status')->default('pending')->after('email_error');
            $table->text('two_days_email_error')->nullable()->after('two_days_email_status');
        });
    }

    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->dropColumn(['two_days_email_status', 'two_days_email_error']);
        });
    }
};
