<?php

namespace App\Jobs;

use App\Mail\sendToUser;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
class SendMails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $members;
    public $title,$content;
    public function __construct($members,$title,$content)
    {

        $this->members=$members;
        $this->title=$title;
        $this->content=$content;


    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        foreach($this->members as $member){

            $member=User::findOrFail($member);
            Mail::to($member->email)->send(new sendToUser($this->content,$this->title));
        }

        

    }
}
