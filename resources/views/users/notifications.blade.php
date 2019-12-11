@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="text-center">Notifikationer</h2> 
        <br>
        @toast @endtoast
        
        <div class="row">
            <table id="notifications" class="table table-hover table-sm table-striped table-bordered">
                <thead class="thead-dark">
                    <th>Fejltype:</th>
                    <th>Besked:</th>
                    <th>Løsning:</th>
                    <th>Oprettet:</th>
                    <th>Status:</th>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    @foreach ($notifications as $notification)
                        <tr class="table-row">
                            <td>{{ substr($notification->type, strrpos($notification->type, "\\") + 1 ) }}</td>
                            
                            @if ($notification->data['to'] ?? null)
                                <td>Email til: <strong>{{ $notification->data['to'] }}</strong> slog fejl</p></td>
                            @else
                                <td>{{$notification->data['message']}}</td>
                            @endif
                            <td>{{ $notification->data['solution'] ?? 'Prøv igen' }}</td>
                            <td>{{ $notification->created_at }}</td>
                            
                            @if (!$notification->read_at)
                                <td>
                                    <i data-toggle="tooltip" data-placement="top" title="Ulæst" style="color: red" class="fas fa-exclamation-triangle"></i>
                                    <form id="mark-{{ $i }}" action="{{ route('notifications.mark') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="created_at" value="{{ $notification->created_at }}">
                                    <i data-toggle="tooltip" data-placement="top" title="Marker som læst" class="fas fa-eye" onClick="document.getElementById('mark-{{ $i }}').submit();"></i>
                                    </form>
                                </td>
                            @else
                                <td><i data-toggle="tooltip" data-placement="top" title="Læst" style="color: green" class="fas fa-check"></i></td>
                            @endif
                        </tr>
                        <?php $i++; ?>
                    @endforeach
                </tbody>   
            </table>
        </div>  
    </div>
@endsection