<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

/**
 * Creates (or refreshes) the admin account used for the /admin panel.
 * Credentials come from .env: ADMIN_EMAIL and ADMIN_PASSWORD.
 */
class AdminUserSeeder extends Seeder
{
    /**
     * Run the seeder.
     */
    public function run(): void
    {
        $email = env('ADMIN_EMAIL', 'admin@kimlay.dev');
        $password = env('ADMIN_PASSWORD', 'Kimlay@2026');

        User::query()->updateOrCreate(
            ['email' => $email],
            [
                'name' => 'Admin',
                'password' => $password, // hashed automatically by the model cast
            ]
        );

        $this->command?->line("  <info>Admin user ready:</info> {$email}");
    }
}
