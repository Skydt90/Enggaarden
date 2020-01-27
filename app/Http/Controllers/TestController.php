<?php

namespace App\Http\Controllers;

use App\Jobs\SendExternalUserInvitation;
use App\Mail\ExpiredNotification;
use App\Mail\ExternalUserInvitation;
use App\Mail\InviteExistingMember;
use App\Mail\MailToMember;
use App\Models\ExternalUser;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class TestController extends Controller
{


    private $message = "Lorem Ipsum er ganske enkelt fyldtekst fra print- og typografiindustrien. Lorem Ipsum har været standard fyldtekst siden 1500-tallet, hvor en ukendt trykker sammensatte en tilfældig spalte for at trykke en bog til sammenligning af forskellige skrifttyper. Lorem Ipsum har ikke alene overlevet fem århundreder, men har også vundet indpas i elektronisk typografi uden væsentlige ændringer. Sætningen blev gjordt kendt i 1960'erne med lanceringen af Letraset-ark, som indeholdt afsnit med Lorem Ipsum, og senere med layoutprogrammer som Aldus PageMaker, som også indeholdt en udgave af Lorem Ipsum.";

    public function testPage()
    {
        $externalUser = ExternalUser::withRelations()->findOrFail(22);
        
        return view('external_users.show', ['ex_user' => $externalUser]);
    }

    public function destroyTest($id)
    {
        return [
            'status' => 200,
            'message' => 'deleted with id ' . $id
        ];
    }

    public function postFormTest(Request $request) 
    {
        dd($request->request);
    }

    public function sendMail()
    {
        $member = Member::find(1);
        $when = now()->addMinutes(1);
        
        // when ShouldQueue is implemented on the mailable
        /* Mail::to('christian_skydt@hotmail.com')->send(
            new ExternalUserInvitation('testinv', $member)
        ); */

        // queue imidiately without shouldQueue interface on mailable
        // Mail::to('test@mail.dk')->queue(
        //     new ExternalUserInvitation('test', $member)
        // );

        // add to queue and send later. Still without shouldQueue interface on mailable class 
        /* Mail::to('test@mail.dk')->later(
            $when, new ExternalUserInvitation('test', $member)
        ); */
    }

    public function viewMail() 
    {
        $expire = now()->addWeek();
        $member = Member::with('subscriptions')->find(2);
        $link = URL::temporarySignedRoute('reg-ext', $expire, ['id' => $member->id, 'email' => $member->email]);
        //return new ExternalUserInvitation($member, $link, $expire);
        //return new MailToMember($this->message, 'Emne', 'christian@mail.dk');
        //return new InviteExistingMember($member, $link, $expire);
        return new ExpiredNotification($member);
    }

    public function writeMail()
    {
        return view('emails.show');
    }

    public function error()
    {
        return view('errors.440');
    }

}
