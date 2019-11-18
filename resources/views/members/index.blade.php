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
                    <th>Valgmuligheder:</th>
                </thead>
                <button type="button" id="register-button" data-toggle="modal" data-target="#register-modal" class="btn btn-success col-md-2">Opret Medlem</button>
                <button type="button" id="register-company-button" data-toggle="modal" data-target="#register-company-modal" class="btn btn-success col-md-2">Opret Firma</button>
                <tbody>
                    @foreach ($members as $member)
                        <tr>
                            <td>{{ $member->first_name . ' ' . $member->last_name }}</td>
                            <td>{{ $member->member_type }}</td>
                            <td>dummy data</td>
                            <td></td>
                        </tr>
                    @endforeach
                </tbody>   
            </table>
        </div>
    </div>
    @include('members.partials.member-footer')
@endsection

