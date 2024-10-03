@extends('layouts.app')

@section('title', 'Incident Report Form')

@section('content')
<h1>Incident Report Form</h1>
<form action="{{ route('incident.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" name="title" required>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" name="description" rows="5" required></textarea>
    </div>
    <div class="form-group">
        <label for="image">Upload Image</label>
        <input type="file" class="form-control-file" id="image" name="image">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection
