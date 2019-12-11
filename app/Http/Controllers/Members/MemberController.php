<?php

namespace App\Http\Controllers\Members;

use App\Contracts\InviteServiceContract;
use App\Contracts\MemberServiceContract;
use App\Contracts\PaginationServiceContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateMemberRequest;
use App\Http\Requests\CreateInvitationRequest;
use App\Http\Requests\UpdateMemberRequest;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MemberController extends Controller
{
    private $memberService;
    private $inviteService;
    private $paginationService;
    private $error = 'Noget gik galt under håndteringen af din forespørgsel. En log med fejlen er oprettet. Beklager ulejligheden.';

    public function __construct(
        MemberServiceContract $memberService, 
        InviteServiceContract $inviteService, 
        PaginationServiceContract $paginationService)
    {
        $this->memberService = $memberService;
        $this->inviteService = $inviteService;
        $this->paginationService = $paginationService;
    }

    public function index()
    {
        try {
            $pageParams = $this->paginationService->getPaginationParams();
            $members = $this->memberService->getAll($pageParams->get('amount'));
            $sum = $this->memberService->getSubscriptionSum();
        } catch (Exception $e) {
            Log::error('MemberController@index: ' . $e);
            return redirect()->back()->withErrors($this->error);
        }
        
        return view('members.index', [
            'members' => $members, 
            'page' => $pageParams->get('page'),
            'amount' => $pageParams->get('amount'),
            'user' => Auth::user(),
            'sum' => $sum,
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
