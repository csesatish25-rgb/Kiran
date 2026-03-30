<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $hasUsername = Schema::hasColumn('users', 'username');
        $hasMustChangePassword = Schema::hasColumn('users', 'must_change_password');

        if (! $hasUsername || ! $hasMustChangePassword) {
            Schema::table('users', function (Blueprint $table) use ($hasUsername, $hasMustChangePassword) {
                if (! $hasUsername) {
                    $table->string('username')->nullable()->after('name');
                }

                if (! $hasMustChangePassword) {
                    $table->boolean('must_change_password')->default(true)->after('password');
                }
            });
        }

        if (Schema::hasColumn('users', 'username') && ! Schema::hasIndex('users', 'users_username_unique')) {
            Schema::table('users', function (Blueprint $table) {
                $table->unique('username');
            });
        }

        $admin = DB::table('users')
            ->where('email', 'admin@kiranmis.local')
            ->orWhere('username', 'admin')
            ->first();

        if ($admin) {
            DB::table('users')
                ->where('id', $admin->id)
                ->update([
                    'name' => $admin->name ?: 'System Administrator',
                    'username' => $admin->username ?: 'admin',
                    'must_change_password' => $admin->must_change_password ?? true,
                    'updated_at' => now(),
                ]);
        } else {
            DB::table('users')->insert([
                'name' => 'System Administrator',
                'username' => 'admin',
                'email' => 'admin@kiranmis.local',
                'password' => Hash::make('admin'),
                'must_change_password' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('users', 'username') && Schema::hasIndex('users', 'users_username_unique')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropUnique(['username']);
            });
        }

        if (Schema::hasColumn('users', 'username') || Schema::hasColumn('users', 'must_change_password')) {
            Schema::table('users', function (Blueprint $table) {
                $columns = array_values(array_filter([
                    Schema::hasColumn('users', 'username') ? 'username' : null,
                    Schema::hasColumn('users', 'must_change_password') ? 'must_change_password' : null,
                ]));

                if ($columns !== []) {
                    $table->dropColumn($columns);
                }
            });
        }
    }
};
