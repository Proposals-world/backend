<?php

// app/Mail/SubscriptionReceiptMail.php
namespace App\Mail;

use App\Models\Subscription;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;

class SubscriptionReceiptMail extends Mailable
{
    use Queueable, SerializesModels;
    public $subscription;
    public $fwateer;

    public function __construct($subscription, $fwateer)
    {
        $this->subscription = $subscription;
        $this->fwateer = $fwateer;
    }
    // public function __construct(public Subscription $subscription) {}

    public function build()
    {
        $user     = $this->subscription->user;
        $package  = $this->subscription->package;

        // Format price (USD as per your screenshot—change if needed)
        $price    = number_format((float) ($package->price ?? 0), 2);

        // Dates
        $start    = $this->subscription->start_date ?? now();
        $end      = $this->subscription->end_date ?? now();

        // Months (ceil, minimum 1)
        $days     = max(1, $start->diffInDays($end) ?: 1);
        $months   = max(1, (int) ceil($days / 30));


        // Gender-specific fields
        $isMale   = strtolower((string) $user->gender) === 'male';
        $contacts = (int) ($this->subscription->contacts_remaining ?? 0);
        // dd($contacts, $isMale, $reason, $months, $end, $start, $price, $package, $user);
        return $this->subject('Your Subscription Receipt')
            ->markdown('emails.subscription.receipt', [
                'user'      => $user,
                'package'   => $package,
                'price'     => $price,
                'start'     => $start,
                'end'       => $end,
                'months'    => $months,
                'isMale'    => $isMale,
                'contacts'  => $contacts,
                'fwateer'   => $this->fwateer,
            ]);
    }
}
