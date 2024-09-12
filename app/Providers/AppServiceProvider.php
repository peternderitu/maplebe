<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use BeyondCode\Mailbox\Facades\Mailbox;
use BeyondCode\Mailbox\InboundEmail;
use Illuminate\Support\Facades\DB;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Mailbox::to('verify@whizdeals.ca', function (InboundEmail $email) {
            // Handle the incoming email
            // how do I handle the incoming email for test reasons?
            // I think storing in the db is the safest bet for now.
            Log::info('working1');
            Log::info('Received an email from: ' . $email->from());
            $mailbox_inbound_email = [
                'message_id' => $email->id(),
                'message' => $email->text()
            ];
            DB::table('mailbox_inbound_emails')-> insert($mailbox_inbound_email);
        });
    }
}
