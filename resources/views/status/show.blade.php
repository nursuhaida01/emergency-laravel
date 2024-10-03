@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Status</h2>
    <div class="card">
        <div class="card-body">
            <h3>{{ $incident->status }}</h3>
            <p>{{ $incident->updated_at->format('H:i - d/m/y') }}</p>
        </div>
    </div>
    <a href="{{ route('status.edit', $incident->id) }}" class="btn btn-primary mt-3">Edit Status</a>
</div>
@endsection
