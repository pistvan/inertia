<?php

namespace App\Http\Controllers\Email;

use App\Http\Controllers\Controller;
use App\Http\Requests\SendEmailRequest;
use App\Mail\UserEmail;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

class SendEmailController extends Controller
{
    use AuthorizesRequests;

    public function edit()
    {
        $this->authorize('send-email');

        return Inertia::render('SendEmail');
    }

    public function store(SendEmailRequest $request): RedirectResponse
    {
        $mail = new UserEmail(
            recipient: $request->email,
            subject: $request->subject,
            message: $request->message,
        );

        Mail::send($mail);

        return to_route('send-email')->with('flash-message', 'Email sent!');
    }
}
