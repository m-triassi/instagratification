@extends("layouts.app")
@section("content")
    <div id='photo-container' class='container'>
        <div class="photo" id="post_{{ $post->id }}" post="{{ $post }}" user="{{ $loggedInUser ?? Auth::user() }}" />
    </div>

@endsection
