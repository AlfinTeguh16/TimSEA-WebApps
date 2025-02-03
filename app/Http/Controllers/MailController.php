<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function submitForm(Request $request)
    {

        $request->validate([
            'package-name'   => 'required|string',
            'category'       => 'required|string',
            'company-name'   => 'required|string',
            'email'          => 'required|email',
            'location'       => 'required|string',
            'industry'       => 'required|string',
            'telegram'       => 'required|string',
            'project-title'  => 'required|string',
            'project-desc'   => 'required|string',
        ]);


        $data = [
            'packageName'  => $request->input('package-name'),
            'category'     => $request->input('category'),
            'companyName'  => $request->input('company-name'),
            'email'        => $request->input('email'),
            'location'     => $request->input('location'),
            'industry'     => $request->input('industry'),
            'telegram'     => $request->input('telegram'),
            'projectTitle' => $request->input('project-title'),
            'projectDesc'  => $request->input('project-desc'),
        ];


        Mail::send('emails.project_request', $data, function ($message) use ($request) {
            $message->to(env('MAIL_FROM_ADDRESS'), 'Project Request')
                    ->subject('New Project Submission from ' . $request->input('company-name'))
                    ->replyTo($request->input('email'));
        });

        return back()->with('success', 'Your request has been submitted successfully!');
    }

}
