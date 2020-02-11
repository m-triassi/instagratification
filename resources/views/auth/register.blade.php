@extends('layouts.app')

@section('content')

<style>

.contentContainer {
  position: relative;
  z-index: 2;
  margin: 0 auto;
  max-width: 720px;
  text-align: center;
}

.content__heading {
  margin-bottom: 24px;
  color: #272727;
  font-size: 44px;
}

.content__teaser {
  margin-bottom: 24px;
  color: #595959;
  font-size: 22px;
}

.content__cta {
  display: inline-block;

  padding: 12px 48px;
  color: #ff3c64;
  font-size: 22px;
  text-decoration: none;
  border: solid 4px #ff3c64;
}

.video {
    position: fixed;
    top: 50%;
    left: 50%;
    min-width: 100%;
    min-height: 100%;
    width: auto;
    height: auto;
    z-index: -100;
    transform: translateX(-50%) translateY(-50%);
	background-size: cover;
	transition: 1s opacity;
}

.logo{
  position: relative;
  width: 300px;
  height: 300px;
}

.btn {
  position: relative;
  width: 330px;
  height: 40px;
  font-size: 16px;
  background:		#A1479D;
  font-weight: lighter;
  font-size: 20px;
  color: #fff;
  border: 0px;
  border-radius: 5px;
}
</style>

<div class="col-md-4 box">
   <video loop  autoplay preload="none" class="video" ><source src="http://dfcb.github.io/BigVideo.js/vids/dock.mp4" type="video/mp4" />
   </video>
</div>

<div class="container">
  <center><img src="https://i.imgur.com/nwHjAY5.png" class="logo"/>
 </center>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
