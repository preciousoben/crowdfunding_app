@extends('layouts.app')

@section('content')
<br><br>
    <center><h3 style="font-family: 'Comic Sans MS', sans-serif;">DONATION HISTORY</h3></center>
    <center>View the details of the donations you have made</center><br><br><br>
    
    @if (count($donationHistory) > 0)
        <table class="table" style="border-radius: 50px;">
            <thead>
                <tr>
                    <th>Donation Date</th>
                    <th>Donation Amount</th>
                    <th>Description</th>
                    <th>Created By</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($donationHistory as $record)
                    <tr>
                        <td>{{ $record->pivot->created_at }}</td>
                        <td>{{ $record->pivot->amount }}</td>
                        <td>{{ $record->description }}</td>
                        <td>{{ $record->user->name }}</td> <!-- Access the creator's name -->
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="card" style="border-radius: 15px;">
            <center>
                <div class="card-body">
                    <h5 class="card-title">You haven't donated yet :(</h5>
                </div>
            </center>
        </div>
    @endif
</div>
@endsection
