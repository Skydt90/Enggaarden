<?php

namespace App\Http\Controllers;

use App\Jobs\SendExternalUserInvitation;
use App\Mail\ExternalUserInvitation;
use App\Models\ExternalUser;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TestController extends Controller
{
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
        $expire = now()->addMonth();
        $member = Member::find(1);
        return new ExternalUserInvitation($member, 'link', $expire);
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
