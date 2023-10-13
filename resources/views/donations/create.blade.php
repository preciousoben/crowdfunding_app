@extends('layouts.app') 

@section('content')
    <div class="container">
        <br><br><br>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create New Donation Request') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('donations.store') }}">
                            @csrf
                            <!-- Form fields will go here -->
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control" required></textarea>
                            </div>

                            <div class="form-group">
                                <label for="target_amount">Target Amount</label>
                                <input type="number" name="target_amount" id="target_amount" class="form-control" required>
                            </div>

                            <button type="submit" class="btn btn-primary">{{ __('Create Request') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
