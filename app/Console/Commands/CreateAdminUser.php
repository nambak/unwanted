<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CreateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new admin user with email and password prompts';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info('Creating a new admin user...');

        // Get email with validation
        do {
            $email = $this->ask('Enter admin email');
            
            $validator = Validator::make(['email' => $email], [
                'email' => 'required|email|unique:users,email'
            ]);

            if ($validator->fails()) {
                $this->error($validator->errors()->first('email'));
                $email = null;
            }
        } while (!$email);

        // Get password with validation  
        do {
            $password = $this->secret('Enter admin password (min 8 characters)');
            $passwordConfirmation = $this->secret('Confirm admin password');

            if (strlen($password) < 8) {
                $this->error('Password must be at least 8 characters long.');
                continue;
            }

            if ($password !== $passwordConfirmation) {
                $this->error('Passwords do not match. Please try again.');
                continue;
            }

            break;
        } while (true);

        // Get name
        $name = $this->ask('Enter admin name', 'Admin');

        // Create the user
        try {
            $user = User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password),
                'email_verified_at' => now(),
            ]);

            $this->info("Admin user created successfully!");
            $this->table(
                ['Field', 'Value'],
                [
                    ['ID', $user->id],
                    ['Name', $user->name],
                    ['Email', $user->email],
                    ['Created At', $user->created_at->format('Y-m-d H:i:s')],
                ]
            );

        } catch (\Exception $e) {
            $this->error('Failed to create admin user: ' . $e->getMessage());
        }
    }
}
