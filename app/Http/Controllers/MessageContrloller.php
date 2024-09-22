<?php
namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MessageContrloller extends Controller
{
    public function send(Request $request)
    {
      

        try {
            $data = $request->validate([
                'name' => 'required',
                'phone' => 'required',
                'email' => 'required|email',
                'message' => 'required',
            ]);
            Mail::to('antonrizk71@gmail.com')->send(new ContactMail($data));

            alert()->success('Contact Us', 'Your message has been sent successfully');
        } catch (\Exception $e) {
            // alert()->error('Contact Us', 'Failed to send your message');
            alert($e->getMessage());
        }

        return redirect()->back();
    }
}
