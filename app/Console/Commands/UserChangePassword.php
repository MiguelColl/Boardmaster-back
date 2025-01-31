<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class UserChangePassword extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:user-change-password';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        foreach (User::cursor() as $user) {
            $passwordHash = Hash::make('password');
            $user->password = $passwordHash;
            $user->save();
            $this->output->write('.');
        }

        $this->output->write(PHP_EOL);
    }
}
