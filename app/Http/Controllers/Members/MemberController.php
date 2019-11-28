<?php

namespace App\Http\Controllers\Members;

use App\Contracts\InviteServiceContract;
use App\Contracts\MemberServiceContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateMemberRequest;
use App\Http\Requests\CreateInvitationRequest;
use Illuminate\Http\Request;

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
        return view('members.index', ['members' => $this->memberService->getAll()]);
    }

    public function store(CreateMemberRequest $request)
    {
        return $this->memberService->store($request);
    }

    public function storeCompany(CreateMemberRequest $request)
    {
        return $this->memberService->storeCompany($request);
    }
    
    public function show($id)
    {
        return view('members.show', ['member' => $this->memberService->getByID($id)]);
    }

    public function update(Request $request, $id)
    {
        dd($request->request);
        return $this->memberService->update($request, $id);
    }

    public function destroy($id)
    {
        //
    }

    public function invite(CreateInvitationRequest $request)
    {
        return $this->inviteService->store($request);
    }
   
}
