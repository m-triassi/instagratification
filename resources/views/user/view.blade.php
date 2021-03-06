@extends('layouts.app')

@section('content')
    <div class="flex-center" style="padding-bottom: 50px;">
      <h3 style="padding-right: 50px;">{{ ucfirst($user->name) }}'s Profile</h3>
      @if(!$user->is($loggedInUser))
        @if($userCanFollow)
            <form method="POST" action="{{ route('user.follow') }}">
                @csrf
                <input type="hidden" value="{{$user->id}}" name="userID">
                <button class='btn btn-primary' type="submit">Follow</button>
            </form>
        @else
            <form method="POST" action="{{ route('user.unfollow') }}">
                @csrf
                <input type="hidden" value="{{$user->id}}" name="userID">
                <button class='btn btn-primary' type="submit">Unfollow</button>
            </form>
            @endif
        @endif
    </div>

    <div id='photo-container' class='container'>
        @foreach($user->posts as $i => $post)
            <div class="photo" id="post_{{ $i }}" post="{{ $post }}" user="{{ $loggedInUser ?? Auth::user() }}" />
        @endforeach
    </div>

@endsection
