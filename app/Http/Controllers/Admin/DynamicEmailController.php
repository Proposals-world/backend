<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\DynamicEmail;
use Exception;
use Swift_TransportException;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Illuminate\Support\Facades\Log;

class DynamicEmailController extends Controller
{
    public function showForm()
    {
        return view('admin.email.send');
    }

    public function send(Request $request)
    {
        $request->validate([
            'to' => 'required|email',
            'title' => 'required|string|max:250',
            'content' => 'required|string',
            'lang' => 'nullable|string'
        ]);

        try {

            Mail::to($request->to)->send(
                new DynamicEmail(
                    $request->title,
                    $request->content,
                    $request->lang
                )
            );

            return back()->with('success', 'Email sent successfully!');
        } catch (TransportExceptionInterface $e) {

            $message = $e->getMessage();

            Log::error("SMTP Transport Error: " . $message);

            // Friendly error translation
            if (str_contains($message, 'Connection could not be established')) {
                $friendly = 'Cannot connect to mail server. Host or port is incorrect.';
            } elseif (
                str_contains($message, 'Expected response code 250') ||
                str_contains($message, '535') ||
                str_contains($message, 'Authentication')
            ) {
                $friendly = 'SMTP authentication failed. Wrong username or password.';
            } elseif (str_contains($message, 'stream_socket_enable_crypto')) {
                $friendly = 'SSL/TLS encryption failed. Check encryption type or port.';
            } elseif (str_contains($message, 'Connection timed out')) {
                $friendly = 'Mail server timeout. Server is unreachable.';
            } elseif (str_contains($message, 'Permission denied')) {
                $friendly = 'Server blocked the SMTP connection. Port not allowed.';
            } else {
                $friendly = 'Email could not be sent due to an SMTP error.';
            }

            return back()->with('error', $friendly);
        } catch (Exception $e) {

            Log::error("Mail Error: " . $e->getMessage());

            return back()->with('error', 'Email could not be sent. Please check configuration.');
        }
    }
}
