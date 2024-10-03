@extends('layouts.web')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center my-4">
        <div class="col-md-8">
            <div id="rcorners2" class="p-4 bg-light border rounded shadow-sm">
                <h4 class="mb-4">Edit Learning Resource</h4>
                <form action="{{ route('learning-resources.update', $resource->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group row">
                        <label for="title" class="col-sm-4 col-form-label text-right">Title:</label>
                        <div class="col-sm-8">
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" value="{{ old('title', $resource->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-sm-4 col-form-label text-right">Description:</label>
                        <div class="col-sm-8">
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" rows="5" required>{{ old('description', $resource->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="image" class="col-sm-4 col-form-label text-right">Image (optional):</label>
                        <div class="col-sm-8">
                            <input name="image" type="file" class="form-control-file @error('image') is-invalid @enderror" id="image" />
                            @if ($resource->image)
                                <img src="{{ asset('images/' . basename($resource->image)) }}" alt="Resource Image" class="img-thumbnail mt-2" style="max-width: 150px;">
                            @endif
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-4"></div>
                        <div class="col-sm-8 d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">Update Resource</button>
                            <a href="{{ route('learning-resources.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
