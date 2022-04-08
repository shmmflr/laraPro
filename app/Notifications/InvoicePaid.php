<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InvoicePaid extends Notification implements ShouldQueue
{
    use Queueable;

    protected $invoice;

    public function __construct($invoice)
    {
        $this->invoice = $invoice;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('سلام خوش آمدید.')
            ->action('Notification Action', url('/'))
            ->line('تشکر بابت همراهی گرمتان');
    }

    // چیزی که در دیتا بیس ذخیره می شود
    // در خانه data از دیتا بیس

    public function toArray($notifiable)
    {
        return [
            'id' => $this->invoice['id'],
            'amount' => $this->invoice['amount'],
        ];
    }
}