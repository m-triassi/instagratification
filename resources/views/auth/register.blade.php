@extends('layouts.app')

@section('content')

<style>

html{
  margin:0;
  padding:0;
  width: 100%;
  height:100vh;
}
body{
  margin:0;
  padding: 0;
  width: 100%;
  height: 100vh;
background-clip: cover;
  background-size: cover;
  display: table;
}
.register{
  position:absolute;
  transform: translate(-50%,-50%);
  width: 400px;
  height: 670px;

  background:#fff;
  border-radius: 3px;
  padding: 0.6em;
  top: 63%;
  left:50%;

}
.logo{

  position:relative;
  width: 300px;
  height: 300px;


}
h2{
  font-family: Source Sans Pro;
  font-weight: lighter;
  color: #fff;
  font-size:50px;
  text-align: center;
}
input{
  display: block ;
  width: 320px;
  height: 30px;
  background-color: transparent;
  background: rgba(0,0,0,0.05);
  outline: none;

  border: 0.5px solid rgba(0, 0, 0, 0.4);
  font-family: Source Sans Pro;
  font-weight:lighter;
  font-size: 18px;
  margin-bottom: 10px;
  padding-left: 10px;
  border-radius: 5px;

}
label{
  color:#000;
  font-size: 15px;
}

.btn {
  position:relative;
  width:380px;
  height: 40px;
  font-size: 16px;
  background:		#A1479D;
  font-weight: lighter;
  font-size: 20px;
  color: #fff;
  border: 0px;
  border-radius: 5px;
}
.forgot{
  position:relative;
  color: #000;

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
</style>


   <video loop  autoplay muted class="video" ><source src="https://i.imgur.com/BQ9K5r6.mp4" type="video/mp4" />
   </video>


<div class="register">
  <center><img src="https://i.imgur.com/nwHjAY5.png" class="logo"/>
 </center>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                            <label for="name" >{{ __('Name') }}</label>

                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            <label for="email" >{{ __('Email') }}</label>


                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            <label for="password" >{{ __('Password') }}</label>


                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror



                            <label for="password-confirm" >{{ __('Confirm Password') }}</label>


                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">

                                <button type="submit" class="btn">
                                    {{ __('Register') }} <br>
                                </button>

          </form>
</div>
@endsection
