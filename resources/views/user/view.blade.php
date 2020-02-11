@extends('layouts.app')

@section('content')
    <div>
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
    </div>
@endsection