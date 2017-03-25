<?php

namespace App\Listeners;

use App\Events\ReplyMention;
use App\Repositories\ReplyNotificationRepository;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;

class ReplyMentionListener
{

    /**
     * Create the event listener.
     *
     * @param ReplyNotificationRepository $notification
     */
    public function __construct(ReplyNotificationRepository $notification)
    {
        $this->notification = $notification;
    }

    /**
     * Handle the event.
     *
     * @param  ReplyMention  $event
     * @return void
     */
    public function handle(ReplyMention $event)
    {
        $this->notification->addNotification($event->toUsers,$event->reply);
    }
}
