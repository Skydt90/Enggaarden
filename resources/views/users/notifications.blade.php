@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="text-center">Notifikationer</h2> 
        <br>
        @toast @endtoast
        
        <div class="row">
            <table id="notifications" class="table table-hover table-sm">
                <thead>
                    <th>Fejltype:</th>
                    <th>Besked:</th>
                    <th>Oprettet:</th>
                    <th>Navn på bruger:</th>
                    <th>Status:</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($notifications as $notification)
                        <tr class="table-row">
                            <td>{{ substr($notification->type, strrpos($notification->type, "\\") + 1 ) }}</td>
                            
                            @if ($notification->data['to'])
                                <td>Email til: <strong>{{ $notification->data['to'] }}</strong> slog fejl</p></td>
                            @else
                                
                            @endif
                            <td>{{ $notification->created_at->format('j\\. M Y') }}</td>
                            <td>{{ $notification->data['username'] ?? 'Ukendt' }}</td>
                            
                            @if (!$notification->read_at)
                                <td><i data-toggle="tooltip" data-placement="top" title="Ulæst" style="color: red" class="fas fa-exclamation-triangle"></i></td>
                            @else
                                <td><i data-toggle="tooltip" data-placement="top" title="Læst" style="color: green" class="fas fa-check"></i></td>
                            @endif
                            
                            @if(!$notification->read_at)
                                <td>
                                <form id="mark" action="{{ route('notifications.mark') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="created_at" value="{{ $notification->created_at }}">
                                        <i data-toggle="tooltip" data-placement="top" title="Marker som læst" class="fas fa-eye" onClick="document.getElementById('mark').submit();"></i>
                                    </form>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>   
            </table>
        </div>  
    </div>
@endsection