@extends('layouts.app')

@section('content')
    <div class="container">
        <br><br>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @if ($donation)
                        <center><h3 style="font-weight: normal;"><div class="card-header">{{ $donation->title }}</div></h3></center>

                        <center><div class="card-body">
                            <h5>Description:</h5>
                            <p>{{ $donation->description }}</p>
                            <h5>Target Amount:</h5>
                            <p>{{ $donation->target_amount }}</p>
                            
                            <!-- Display creation date and user's name -->
                            <h5>Created By:</h5>
                            <p>{{ $donation->user->name }}</p>
                            <h5>Creation Date:</h5>
                            <p>{{ $donation->created_at }}</p>

                            @if($userHasDonated)
                                <a href="#" data-toggle="modal" data-target="#donationHistoryModal">Donation History: Available</a>
                            @else
                                <p>Donation History: Unavailable</p>
                            @endif

                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <!-- Check if the amount raised is less than the target amount -->
                            @if ($donation->totalAmountRaised < $donation->target_amount)
                                <a href="{{ route('donations.participate', ['id' => $donation->id]) }}" class="btn btn-primary" style="background-color: #17B169; color: white; border: none;">Participate</a>
                            @endif
                            
                            <!-- Display the "Total Amount Raised" -->
                            <h5>Total Amount Raised: {{ $donation->totalAmountRaised }}</h5>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('donations.index') }}" class="btn btn-secondary">Back to All Donations</a>
                        </div>
                    @else
                        <div class="card-header">Donation not found.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if($userHasDonated)
        <!-- Donation History Modal -->
        <div class="modal fade" id="donationHistoryModal" tabindex="-1" role="dialog" aria-labelledby="donationHistoryModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="donationHistoryModalLabel">Donation History</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Display donation history here -->
                        @foreach ($userDonationHistory as $donationRecord)
                            <p>Donation Date: {{ $donationRecord->pivot->created_at }}</p>
                            <p>Donation Amount: {{ $donationRecord->pivot->amount }}</p>
                        @endforeach
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
