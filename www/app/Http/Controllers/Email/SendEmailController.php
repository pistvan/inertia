<?php

namespace App\Http\Controllers\Email;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Inertia\Inertia;

class SendEmailController extends Controller
{
    use AuthorizesRequests;

    public function edit()
    {
        $this->authorize('send-email');

        return Inertia::render('SendEmail');
    }
}
