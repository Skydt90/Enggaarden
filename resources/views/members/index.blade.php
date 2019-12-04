@extends('layouts.app')

@section('additional-scripts')
    <script src="{{ asset('js/members.js') }}" defer></script>
@endsection

@section('content')
    <div class="container">
        <h2 class="text-center">Medlemskartotek</h2>
        <br>
        <div class="row">
            <button type="button" id="register-button" data-toggle="modal" data-target="#register-modal" class="btn btn-sm btn-success"><i class="fas fa-user-plus"></i> Opret Medlem</button>
            <button type="button" id="register-company-button" data-toggle="modal" data-target="#register-company-modal" class="btn btn-sm btn-success ml-1 mr-auto"><i class="far fa-building"></i> Opret Firma</button>
        </div>
        <div class="row mt-2">  
            <label for="show">
                Vis
                <select name="" id="" value="10" class="col-md-6s form-control-sm">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                </select>
                Medlemmer
            </label>
            <table class="table table-hover table-sm">
                <thead>
                    <th>Navn:</th>
                    <th>Medlemstype:</th>
                    <th>Kontigent:</th>
                    <th>Seneste Betaling:</th>
                    <th>Bruger:</th>
                    <th>Valgmuligheder:</th>
                </thead>
                <tbody>
                    @foreach ($members as $member)
                        <tr class="table-row">
                            @if($member->is_company)
                                <td class="font-weight-bold">{{ $member->first_name }}</td>
                            @else
                                <td>{{ $member->first_name . ' ' . $member->last_name }}</td>
                            @endif
                                <td>{{ $member->member_type }}</td>
                                <td>{!! $member->subscriptions[0]->pay_date ?? null ? '<i data-toggle="tooltip" data-placement="right" title="Betalt" class="fas fa-check" style="color: green"></i>' : '<i data-toggle="tooltip" data-placement="right" title="Ikke Betalt" class="fas fa-times" style="color: red"></i>' !!}</td>
                                <td>{{ $member->subscriptions[0]->amount ?? null ? $member->subscriptions[0]->amount .' kr.' : 0 .' kr.'}}</td>

                            @if ($member->externalUser != null)
                                <td><i style="color: green" class="fas fa-user-check"></i> Oprettet</td>
                            @elseif($member->invite != null)         
                                <td><i class="fas fa-hourglass-half"></i> Afventer</td>
                            @else
                                <td>
                                    <div id="div{{ $member->id }}">
                                        <a class="btn-invite-form" data-id="{{ $member->id }}" href="{{ route('invite') }}">
                                            <i class="fas fa-user-plus"></i> Inviter
                                        </a>
    
                                        <form id="{{ $member->id }}" class="invite-form" action="{{ route('invite') }}" method="POST" style="display: none;">
                                            @csrf
                                            <input type="hidden" name='member_id' value="{{ $member->id }}">
                                        </form>
                                    </div>
                                </td>
                            @endif

                            <td>
                                <a data-toggle="tooltip" data-placement="top" title="Rediger" href="{{ route('member.show', ['member' => $member]) }}"><i class="fas fa-edit"></i></a>
                                <a data-toggle="tooltip" data-placement="top" title="Send Mail" class="ml-2" href="{{ route('mail.show', ['id' => $member->id]) }}" style="color:orange"><i class="fas fa-envelope"></i></a>
                                <a class="ml-2 delete-button" data-id="{{$member->id}}" data-name="{{$member->first_name}}" href=""><i data-toggle="tooltip" data-placement="top" title="Slet" style="color: red" class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>   
            </table>
        </div>
    </div>
    @include('members.partials.member-footer')
@endsection

