@extends('layouts.app')

@section('content')
<div class="container">
    <br><br>
    <center><h3 style="font-family: 'Comic Sans MS', sans-serif;">VIEW ALL DONATIONS</h3></center>
    <center>Donate to any of the causes below ;)</center><br>
    <div class="row">
        @if (count($donations) > 0)
            @foreach($donations as $donation)
            <div class="col-md-6">
                <div class="card mb-4" style="border-radius: 15px;">
                    <center>
                        <div class="card-body">
                            <h5 class="card-title">{{ $donation->title }}</h5>
                            <p class="card-text">TARGET: {{ $donation->target_amount }}</p>
                            <p class="card-text">DESCRIPTION: {{ $donation->description }}</p>
                            <p class="card-text">CREATED BY: {{ $donation->user->name }}</p>
                            <a href="{{ route('donations.show', ['id' => $donation->id]) }}" class="btn btn-primary" style="background-color: #17B169; color: white; border: none;">View</a>
                        </div>
                    </center>
                </div>
            </div>
            @endforeach
        @else
            <div class="col-md-12">
                <div class="card" style="border-radius: 15px;">
                    <center>
                        <div class="card-body">
                            <h5 class="card-title">OOPS NO OPEN DONATIONS!</h5>
                        </div>
                    </center>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
