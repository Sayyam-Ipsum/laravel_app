<?php

namespace App\Console\Commands;

use App\Mail\DigestMail;
use App\Models\Post;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class DailyDigestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:daily-digest';

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
        $posts = Post::orderBy("desc")->take(10)->get();
        $users = User::all();

        foreach ($users as $user) {
            Mail::to($user->email)->send(new DigestMail($posts));
        }

        $this->info("Daily digest emails have been sent successfully!");
    }
}
