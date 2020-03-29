@extends("layouts.app")
@section("content")
<div>
  <h3 class="flex-center"> Search Results: </h3>
  <ul class="content">
    @foreach($user as $u)
      <li>
        <a href="/user/{{ $u->name }}">{{ $u->name }}</a>
      </li>
    @endforeach
  </ul>
</div>
@endsection
