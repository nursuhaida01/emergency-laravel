@extends('layouts.backend')

@section('content')
<div class="container-fluid">
    <div style="margin-left: 200px; padding: 20px;">
        <div id="rcorners2">
            <div class="form-group">
                <div class="col-sm-5"></div>
                <div class="col-sm-5" align="left">
                    <h4>Edit News</h4>
                    <br>
                    <form action="{{ route('news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="title" class="col-sm-4 col-form-label text-right">Title:</label>
                            <div class="col-sm-8">
                                <input type="text" name="title" class="form-control" id="title" value="{{ old('title', $news->title) }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="content" class="col-sm-4 col-form-label text-right">Content:</label>
                            <div class="col-sm-8">
                                <textarea name="content" class="form-control" id="content" rows="5" required>{{ old('content', $news->content) }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="image" class="col-sm-4 col-form-label text-right">Image (optional):</label>
                            <div class="col-sm-8">
                                <input name="image" type="file" class="form-control-file" id="image" />
                                @if ($news->image)
                                    <img src="{{ asset($news->image) }}" alt="News Image" style="max-width: 100px;">
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="username" class="col-sm-4 col-form-label text-right">Username:</label>
                            <div class="col-sm-8">
                                <input name="username" type="text" class="form-control" id="username" value="{{ old('username', $news->username) }}" required />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="location" class="col-sm-4 col-form-label text-right">Location:</label>
                            <div class="col-sm-8">
                                <input name="location" type="text" class="form-control" id="location" value="{{ old('location', $news->location) }}" required />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="time" class="col-sm-4 col-form-label text-right">Time:</label>
                            <div class="col-sm-8">
                                <input type="datetime-local" name="time" class="form-control" id="time" value="{{ old('time', \Carbon\Carbon::parse($news->time)->format('Y-m-d\TH:i')) }}" required />
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-5"></div>
                            <div class="col-sm-5 d-flex justify-content-between">
                                <button type="submit" class="btn btn-primary">Update News</button>
                                <a href="{{ route('news.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
