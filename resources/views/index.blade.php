@extends('layouts.app')

@section('content')
            <div id='photo-container' class='container'>.
            @foreach($posts as $i => $post)
                <div class="photo" id="post_{{ $i }}" post="{{ $post }}" user="{{ $loggedInUser ?? Auth::user() }}" />
            @endforeach
            </div>
        </div>
@endsection
