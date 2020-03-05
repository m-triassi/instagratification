@extends('layouts.app')

@section('content')
            <div id='photo-container' class='container'>.
        <title>Instagratification</title>
        <link rel="icon" href="favicon.ico" type="image/x-icon">
            @foreach($posts as $i => $post)
                <div class="photo" id="post_{{ $i }}" post="{{ $post }}" user="{{ $loggedInUser ?? Auth::user() }}" />
            @endforeach
            </div>
        </div>
@endsection
