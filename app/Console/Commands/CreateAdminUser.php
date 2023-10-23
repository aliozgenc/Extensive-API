<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\Hash;
use App\Models\User;


class CreateAdminUser extends Command
{
    protected $signature = 'admin:create';
    protected $description = 'Create an admin user';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $name = $this->ask('Enter the name of the admin user:');
        $email = $this->ask('Enter the email of the admin user:');
        $password = $this->secret('Enter the password for the admin user:');

        $user = new User;
        $user->name = $name;
        $user->email = $email;
        $user->password = Hash::make($password);
        $user->save();

        $user->assignRole('admin');

        $this->info('Admin user created successfully!');
    }
}
