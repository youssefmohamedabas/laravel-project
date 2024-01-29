<?php

namespace App\Console\Commands;
use App\Mail\NotiFyEMail;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
class expiration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'userexpire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '=expire user every 5m';

    /**
     * Execute the console command.
     */
    public function handle()
    {
       $user=User::where('expire',0)->get();
       foreach($user as $u){
        $u->update(['expire'=>1]);
       }
        //
        
        $user=User::select('email')->get();
        $emails=User::pluck('email')->toArray();
        $data=['title'=> 'hi','body' => 'Hi i hope you are alive bro'];
        foreach($emails as $email){
            Mail::To($email)->send(new NotiFyEMail($data));
        }
    }
}