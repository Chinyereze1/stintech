<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class ResetAdminUser extends Command
{
    protected $signature = 'admin:reset';

    protected $description = 'Reset the first user account to a known admin login';

    public function handle(): int
    {
        $user = User::first();

        if (! $user) {
            $this->error('No user account found.');
            return 1;
        }

        $user->name = 'Admin';
        $user->email = 'admin@example.com';
        $user->password = Hash::make('password123');
        $user->save();

        $this->info('Admin account reset successfully.');
        $this->info('Email: admin@example.com');
        $this->info('Password: password123');

        return 0;
    }
}
