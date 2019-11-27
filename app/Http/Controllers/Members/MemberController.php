<?php

namespace App\Http\Controllers\Members;

use App\Contracts\MemberServiceContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateMemberRequest;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    private $memberService;

    public function __construct(MemberServiceContract $memberService)
    {
        $this->memberService = $memberService;
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

    
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy($id)
    {
        //
    }

   
}
