<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command where sendEmail';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = [
            'Mahatma Gandhi' => 'Live as if you were to die tomorrow. Learn as if you were to live forever.',
            'Friedrich Nietzsche' => 'That which does not kill us makes us stronger.',
            'Theodore Roosevelt' => 'Do what you can, with what you have, where you are.',
            'Oscar Wilde' => 'Be yourself; everyone else is already taken.',
            'William Shakespeare' => 'This above all: to thine own self be true.',
            'Napoleon Hill' => 'If you cannot do great things, do small things in a great way.',
            'Milton Berle' => 'If opportunity doesn’t knock, build a door.'
        ];

        $key = array_rand($email);
        $data = $email[$key];

        $users = User::all();

        foreach($users as $user){
            Mail::raw("{$key} -> {$data}", function($mail)use($user){
                $mail->from('lucio@freeweb.com');
                $mail->to($user->email)
                ->subject('Daily new quote');
            });
        }

        $this->info('Succefully sent daily quote to everyone');
    }
}
