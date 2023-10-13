@section('content')
<div class="container">
    <<center><h3>OPENED DONATIONS</h3></center>

    <table class="table">
        <thead>
            <tr>
                <th>Titl</th>
                <th>Description</th>
                <th>Target Amount</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($donations as $donation)
<tr>
    <td>{{ $donation->title }}</td>
    <td>{{ Str::limit($donation->description, 100) }}</td>
    <td>{{ $donation->target_amount }}</td>
    <td>{{ $donation->totalAmountRaised }}</td>
    <td>
            @if ($donation->is_complete)
                Complete
            @else
                In Progress
            @endif
        </td>
    <td>
        @if ($donation->hasDonated)
            <span data-toggle="tooltip" data-placement="top" title="Donation Date: {{ $donation->donationTimestamp }}<br>Donation Amount: {{ $donation->donationAmount }}">
                Donated
            </span>
        @else
            <a href="{{ route('donations.participate', ['id' => $donation->id]) }}" class="btn btn-primary">Participate</a>
        @endif
    </td>
</tr>
@endforeach

        </tbody>
    </table>
</div>
@endsection

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

