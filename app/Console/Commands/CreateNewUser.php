<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateNewUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:create-user  {name=Admin} {email=admin@admin.com} {password=password} ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create new users';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get string argument.
     *
     * @param string $key
     * @param string $default
     *
     * @return string
     */
    protected function getStringArgument(string $key, string $default): string
    {
        return is_string($this->argument($key)) ? $this->argument($key) : $default;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $email = $this->getStringArgument('email', 'admin@admin.com');
        $password = $this->getStringArgument('password', 'password');
        User::firstOrCreate([
            'name' => $this->argument('name'),
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        $this->line('<info>User ' . $email . ' has been created.</info>');
    }
}
