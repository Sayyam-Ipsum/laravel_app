<?php

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

function loggedUserID()
{
    return auth()->user()->id;
}

function validateDateFormat($date,$format='')
{
    $is_valid_date = false;
    if(!empty($date)){
        if(!empty($format)){
            $dt = DateTime::createFromFormat($format, $date);
            $is_valid_date = $dt !== false && !array_sum($dt->getLastErrors());
        }
        else{
            $timestamp = !is_numeric($date) ? strtotime($date) : $date;
            if(date("Y", $timestamp) > 1970) $is_valid_date = true;
        }
    }

    return $is_valid_date;
}

function showDateTime($datetime)
{
    if (!validateDateFormat($datetime)) {
        return '';
    }

    return Carbon::parse($datetime)->format('d-M-Y H:i:s');
}

function showDate($datetime)
{
    if (!validateDateFormat($datetime)) {
        return '';
    }

    return Carbon::parse($datetime)->format('d-M-Y');
}

function send_email($to, $subject, $data, $blade)
{
    $sent = true;
    try {
        Mail::send(sprintf('mails.%s', $blade), $data, function ($message) use ($to, $subject) {
            $message->to($to)
                ->subject($subject);
            $message->from(config('mail.from.address', 'ipsumlive-noreply@ipsum.co.uk'),
                config('mail.from.name', 'Ipsum Live Assets'));
        });
    } catch (\Exception $e) {
        \Illuminate\Support\Facades\Log::debug("Error sending email: ". $e->getMessage());
        $sent = false;
    }

    return $sent;
}
