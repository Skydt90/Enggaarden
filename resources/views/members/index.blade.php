@extends('layouts.app')

@section('additional-scripts')
    <script src="{{ asset('js/members.js') }}" defer></script>
@endsection

@section('content')
    <div class="container">

        <div class="row">
            <table class="table table-hover table-border">
                <thead>
                    <th>Navn:</th>
                    <th>Medlemstype:</th>
                    <th>Kontigent:</th>
                    <th>Bruger:</th>
                    <th>Valgmuligheder:</th>
                </thead>
                <button type="button" id="register-button" data-toggle="modal" data-target="#register-modal" class="btn btn-success col-md-2">Opret Medlem</button>
                <button type="button" id="register-company-button" data-toggle="modal" data-target="#register-company-modal" class="btn btn-success col-md-2">Opret Firma</button>
                <tbody>
                    @foreach ($members as $member)
                        <tr>
                            @if($member->is_company)
                                <td class="font-weight-bold">{{ $member->first_name }}</td>
                            @else
                                <td>{{ $member->first_name . ' ' . $member->last_name }}</td>
                            @endif
                                <td>{{ $member->member_type }}</td>
                                <td>Betalings status</td>

                            @if ($member->externalUser != null)
                                
                                <td><strong>Oprettet bruger</strong></td>

                            @elseif($member->invite != null)
                                
                                <td>Inviteret allerede</td>
                            
                            @else
                                <td>
                                    <div id="div{{ $member->id }}">
                                        <a class="btn btn-primary btn-invite-form" data-id="{{ $member->id }}" href="{{ route('invite') }}">
                                            Inviter
                                        </a>
    
                                        <form id="{{ $member->id }}" class="invite-form" action="{{ route('invite') }}" method="POST" style="display: none;">
                                            @csrf
                                            <input type="hidden" name='member_id' value="{{ $member->id }}">
                                        </form>
                                    </div>
                                </td>
                            @endif

                            <td>
                                <a class="btn btn-primary" href="{{ route('member.show', ['member' => $member]) }}">Rediger</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>   
            </table>
        </div>
    </div>
    @include('members.partials.member-footer')
@endsection

