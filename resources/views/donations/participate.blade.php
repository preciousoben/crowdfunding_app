@extends('layouts.app')

@section('content')
<div class="container">
    <br><br><br>
    <div class="card" style="background-color: white; border-radius: 15px; padding: 20px;">
        <center><h3>Participate in Donation</h3></center>
        <p>Donation Title: {{ $donation->title }}</p>
        <p>Donation Description: {{ $donation->description }}</p>

        <form method="POST" action="{{ route('donations.participate', ['id' => $donation->id]) }}">
            @csrf
            <div class="form-group">
                <label for="donation_amount">Donation Amount:</label>
                <input type="number" name="donation_amount" id="donation_amount" class="form-control" required>
            </div>
            <center><button type="submit" class="btn btn-primary" style="background-color: #17B169; color: white; border: none; border-bottom: 3px solid #17B169;">Submit Your Donation</button></center>
        </form>
    </div>
</div>
@endsection
