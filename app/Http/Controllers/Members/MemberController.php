<?php

namespace App\Http\Controllers\Members;

use App\Contracts\InviteServiceContract;
use App\Contracts\MemberServiceContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateMemberRequest;
use App\Http\Requests\CreateInvitationRequest;
use App\Http\Requests\UpdateMemberRequest;
use Exception;

class MemberController extends Controller
{
    private $memberService;
    private $inviteService;

    public function __construct(MemberServiceContract $memberService, InviteServiceContract $inviteService)
    {
        $this->memberService = $memberService;
        $this->inviteService = $inviteService;
    }

    public function index()
    {
        isset($_GET['page']) ? $page = $_GET['page'] : $page = 1;
        isset($_GET['amount']) ? $amount = $_GET['amount'] : $amount = 25;

        return view('members.index', [
            'members' => $this->memberService->getAll($amount), 
            'page' => $page,
            'amount' => $amount
        ]);
    }

    public function store(CreateMemberRequest $request)
    {
        try {
            $member = $this->memberService->store($request);
        } catch (Exception $e) {
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
        return view('members.show', ['member' => $this->memberService->getByID($id)]);
    }

    public function update(UpdateMemberRequest $request, $id)
    {
        try {
            $member = $this->memberService->update($request, $id);
        } catch (Exception $e) {
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
   
}
