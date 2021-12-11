<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Models\User;
use Jenssegers\Agent\Agent;
use App\Traits\AlertTrait;

class ContactController extends Controller
{

    use AlertTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $author_id = 'S5210';
        $site_info = User::with('settings')->findOrFail($author_id);
        return view('frontend.pages.contact', compact('site_info'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate(
        [
            'sender_name'  => 'required|min:3|max:100',
            'sender_email' => 'required|email',
            'subject'      => 'required|min:3|max: 250',
            'body'         => 'required|min:2|max: 65000'
        ],
        [
            'sender_name.required' => 'Name is required',
            'sender_name.min' => 'Name should be at least 3 characters in length!',
            'sender_name.max' => 'Keep the name within 100 characters!',

            'sender_email.required' => 'Email is required',
            'sender_email.email' => 'Must be a valid email!',

            'subject.required' => 'Subject is required',
            'subject.min' => 'Subject should be at least 3 characters in length!',
            'subject.max' => 'Keep the subject within 250 characters!',

            'body.required' => 'Message body is required!',
            'body.min' => 'At least say Hi',
        ]);

        $ifExistsByIpAndDate = (Message::where('sender_ip', $request->ip())
                               ->whereDate('created_at', date('Y-m-d'))
                               ->get())->count();
        
        if($ifExistsByIpAndDate){
            return back()->with($this->failed('You cannot send more than 1 message in a day, try again tomorrow!'));
        }                    

        $client = new Agent();

        $sender_information = 
        [
            'Device'  => $client->isDesktop() ? 'Desktop' : $client->device(),
            'Platform' => $client->platform().' '.$client->version($client->platform()),
            'Browser' => $client->browser(),
        ];
        
        $sender_information = json_encode($sender_information);

        $message = new Message();
        $message->sender_name        = $request->sender_name;
        $message->sender_email       = $request->sender_email;
        $message->subject            = $request->subject; 
        $message->body               = $request->body;
        $message->sender_ip          = $request->ip();
        $message->sender_information = $sender_information;
        
        $message->save();

        return back()->with($this->successful('Your message has been sent successfully, thank you for contacting us!'));
    }   

}
