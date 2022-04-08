<?php

namespace App\Http\Controllers;

use App\Mail\TestMail;
use App\Models\User;
use App\Notifications\InvoicePaid;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        return view('home');
    }

    public function invoice()
    {

        $user = User::find(1);
        $invoice = [
            'id' => 10,
            'amount' => 2500,
        ];
        // Notification::send(User::all(), new InvoicePaid($invoice));

        $user->notify(new InvoicePaid($invoice));
    }

    public function getMessage()
    {
        $user = User::find(1);
        // return $user->notifications;
        // return $user->notifications[0]->data;
        // return $user->unreadNotifications;
        // return $user->unreadNotifications[0]->markRead;
        // return $user->readNotifications;
        // return $user->unreadNotifications->count();
        return $user->readNotifications->count();
    }

    public function mail2()
    {
        $data = ['name' => 'Mohammad Hossein'];

        ## TEXT ##

        // Mail::send(['text' => 'emails.test'], $data, function (Message $message) {

        //     $message->to('shmmflr98@gmail.com', 'hi guys')
        //         ->subject('this is a test')
        //     ;

        // });

        ## HTML ##

        // Mail::send(['html' => 'emails.test'], $data, function (Message $message) {

        //     $message->to('shmmflr98@gmail.com', 'hi guys')
        //         ->subject('this is a test')
        //     ;
        //     dd('ok!!!');
        // });
        Mail::send('emails.test', $data, function (Message $message) {

            $message->to('shmmflr98@gmail.com', 'hi guys')
                ->subject('this is a test')
            ;
        });
        dd('ok!!!');

    }
    public function mail()
    {
        $data = ['name' => 'Mohammad Hossein'];

        Mail::send(new TestMail($data));
        dd('ok!!!');

    }
}