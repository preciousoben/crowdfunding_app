@extends('layouts.app')

@section('content')
    <div class="container">
    <br><br>
    <center><h3 style="font-family: 'Comic Sans MS', sans-serif;">OPENED DONATIONS</h3></center>
    <center>View the donations you have opened</center><br><br><br>

        @if($donations->count() > 0)
            <table class="table" style="border-radius: 15px;">
                <thead>
                    <tr>
                        <th>Title</th>
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
                            <td>
                                <a href="{{ route('donations.show', ['id' => $donation->id]) }}" class="btn btn-primary" style="background-color: #17B169; color: white; border: none;border-bottom: 3px solid">View</a>
                                <a href="{{ route('donations.edit', ['id' => $donation->id]) }}" class="btn btn-warning" style="background-color: #17B169; color: white; border: none;">Edit</a><br>
                                <form action="{{ route('donations.destroy', ['id' => $donation->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" style="background-color: #17B169; color: white; border: none;">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="card" style="border-radius: 15px;">
                <center>
                    <div class="card-body">
                        <h5 class="card-title">No opened donations found.</h5>
                    </div>
                </center>
            </div>
        @endif
    </div>
@endsection
