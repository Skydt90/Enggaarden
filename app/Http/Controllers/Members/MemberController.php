<?php

namespace App\Http\Controllers\Members;

use App\Contracts\InviteServiceContract;
use App\Contracts\MemberServiceContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateMemberRequest;
use App\Http\Requests\CreateInvitationRequest;
use App\Http\Requests\UpdateMemberRequest;
use App\Models\Member;
use App\Models\Subscription;
use App\Traits\PageSetup;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MemberController extends Controller
{
    use PageSetup;

    private $memberService;
    private $inviteService;
    private $error = 'Noget gik galt under håndteringen af din forespørgsel. En log med fejlen er oprettet. Beklager ulejligheden.';

    public function __construct(MemberServiceContract $memberService, InviteServiceContract $inviteService)
    {
        $this->memberService = $memberService;
        $this->inviteService = $inviteService;
    }

    public function index()
    {
        /* $members = Member::whereHas('subscriptions', function($query) {
            $query->orderBy('member_id', 'DESC')->where('pay_date', '<>', null)->limit(1);      
        })->with(['invite', 'externalUser', 'address'])->get(); */
        
        try {
            $params = $this->pageSetup();
           // dump($members->count());
            $members = $this->memberService->getAll($params->get('amount'));
        } catch (Exception $e) {
            Log::error('MemberController@index: ' . $e);
            return redirect()->back()->withErrors($this->error);
        }
        
        return view('members.index', [
            'members' => $members, 
            'page' => $params->get('page'),
            'amount' => $params->get('amount'),
            'type' => $params->get('type'),
        ]);
    }

    public function store(CreateMemberRequest $request)
    {
        try {
            $member = $this->memberService->store($request);
        } catch (Exception $e) {
            Log::error('MemberController@store: ' . $e);
            return response()->json([
                'status' => 500,
                'message' => json_encode($e->__toString())
            ], 500);
        }
        return response()->json([
            'status' => 200,
            'message' => 'Medlem tilføjet korrekt',
            'data' => $member
        ], 200);
    }
    
    public function show($id)
    {
        try {
            $member = $this->memberService->getByID($id);
        } catch (Exception $e) {
            Log::error('MemberController@show: ' . $e);
            return redirect()->back()->withErrors($this->error);
        }
        return view('members.show', ['member' => $member]);
    }

    public function update(UpdateMemberRequest $request, $id)
    {
        try {
            $member = $this->memberService->update($request, $id);
        } catch (Exception $e) {
            Log::error('MemberController@update: ' . $e);
            return response()->json([
                'status' => 500,
                'message' => json_encode($e->__toString())
            ], 500);
        }
        return response()->json([
            'status' => 200,
            'message' => 'Medlem opdateret',
            'data' => $member
        ], 200);
    }

    public function destroy($id)
    {
        try {
            $deleted = $this->memberService->deleteByID($id);
        } catch (Exception $e) {
            Log::error('MemberController@destroy: ' . $e);
            return response()->json([
                'status' => 500,
                'message' => json_encode($e->__toString())
            ], 500);
        }
        return response()->json([
            'status' => 200,
            'message' => 'Medlem slettet',
            'data' => $deleted
        ], 200);
    }

    public function invite(CreateInvitationRequest $request)
    {
        try {
            $savedInvite = $this->inviteService->store($request);
        } catch (Exception $e) {
            Log::error('MemberController@invite: ' . $e);
            return response()->json([
                'status' => 500,
                'message' => json_encode($e->__toString())
            ], 500);
        }
        return response()->json([
            'status' => 200,
            'message' => 'Invitation sendt',
            'data' => $savedInvite
        ]);
    }

    public function deleteInvite($id)
    {
        try {
            $this->inviteService->destroyByMemberId($id);
        } catch (Exception $e) {
            Log::error('MemberController@deleteInvite: ' . $e);
            return redirect()->back()->withErrors($this->error);
        }
        return redirect(route('member.show', ['member' => $id]));
    }
}
