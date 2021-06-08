<?php

namespace App\Listeners;

use App\Events\HasSomeOneReadPostEvent;
use App\Mail\HasSomeoneReadPost;
use App\Mailer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use mysql_xdevapi\Exception;

class SendEmailToUserListener implements ShouldQueue
{

    public function handle(HasSomeOneReadPostEvent $event)
    {
        // create Email record and set Pending
        $mailer = Mailer::create(
            [
                'recipient_id' => $event->user_post->id,
                'pending' => 1,
            ]
        );
        // take mailer  which has added in db
        $mailer->first();

        // update sending
        $mailer->update(['sending' => 1]);

        //catch error if Mail is sending failed
        try{
            Mail::to($event->user_post->email)->send(new HasSomeoneReadPost());
            // if it was sent successfully then update DONE.
            $mailer->update(['done' => 1]);
        }catch (\Exception $ex)
        {
            // update if Mail didn't sending
            $mailer->update([
                'error' => 1
            ]);
        }
    }
}
