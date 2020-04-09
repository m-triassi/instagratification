@extends("layouts.app")
@section("content")
<div>
  <h3 class="flex-center"> Search Results: </h3>
  <ul class="content" style="list-style-type: none;">
    @foreach($user as $u)
      <li>
        <h4><a href="/user/{{ $u->name }}">{{ $u->name }}</a><h4>
      </li>
    @endforeach
  </ul>
</div>
@endsection
