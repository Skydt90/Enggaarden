<?php

namespace App\Http\Controllers\Members;

use Exception;
use App\Traits\Responses;
use App\Traits\PageSetup;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateMemberRequest;
use App\Http\Requests\UpdateMemberRequest;
use App\Http\Requests\CreateInvitationRequest;
use App\Services\Member\MemberServiceInterface;
use App\Services\Invite\InviteServiceInterface;

class MemberController extends Controller
{
    use PageSetup;
    use Responses;

    private $memberService;
    private $inviteService;

    public function __construct(MemberServiceInterface $memberService, InviteServiceInterface $inviteService)
    {
        $this->memberService = $memberService;
        $this->inviteService = $inviteService;
    }

    public function index()
    {
        $this->pageSetup();
        try {
            $members = $this->memberService->getAllByType($this->type);
        } catch (Exception $e) {
            return $this->jError($e);
        }
        return view('members.index', [
            'type' => $this->type, 'page' => $this->page,
            'amount' => $this->amount, 'members' => $members,
        ]);
    }

    public function store(CreateMemberRequest $request)
    {
        try {
            $member = $this->memberService->postMember($request);
        } catch (Exception $e) {
            return $this->jError($e);
        }
        return $this->jSuccess('Medlem tilføjet korrekt', $member);
    }

    public function show($id)
    {
        try {
            $member = $this->memberService->getByIdWithRelations($id, []);
        } catch (Exception $e) {
            return $this->rError($e);
        }
        return view('members.show', compact('member'));
    }

    public function update(UpdateMemberRequest $request, $id)
    {
        try {
            $member = $this->memberService->updateMember($request, $id);
        } catch (Exception $e) {
            return $this->jError($e);
        }
        return $this->jSuccess('Medlem opdateret', $member);
    }

    public function destroy($id)
    {
        try {
            $deleted = $this->memberService->delete($id);
        } catch (Exception $e) {
            return $this->jError($e);
        }
        return $this->jSuccess('Medlem slettet', $deleted);
    }

    public function invite(CreateInvitationRequest $request)
    {
        try {
            $savedInvite = $this->inviteService->create($request);
        } catch (Exception $e) {
            return $this->jError($e);
        }
        return $this->jSuccess('Invitation afsendt', $savedInvite);
    }

    public function deleteInvite($id)
    {
        try {
            $this->inviteService->deleteWhere('member_id', $id);
        } catch (Exception $e) {
            return $this->jError($e);
        }
        return redirect(route('member.show', ['member' => $id]));
    }
}
