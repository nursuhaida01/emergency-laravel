@extends('layouts.fontend')

@section('content')
    <div class="container mt-5">
        <h1>{{ $newsItem->title }}</h1>
        <p>{{ $newsItem->created_at->format('d M Y') }}</p>

        @php
            $images = json_decode($newsItem->image);
        @endphp
        @if($images && count($images) > 0)
            <img src="{{ asset($images[0]) }}" class="img-fluid mb-4" alt="{{ $newsItem->title }}">
        @endif

        <p>{{ $newsItem->content }}</p>

        <a href="{{ route('news.frontend') }}" class="btn btn-secondary">กลับไปยังหน้าข่าวสาร</a>
    </div>
@endsection
