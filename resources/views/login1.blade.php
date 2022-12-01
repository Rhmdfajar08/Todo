@extends('layout1')

@section('content')
<div class="container">
	<div class="screen">
		<div class="screen__content">
			<form class="login" action="{{ route('login.auth') }}" method="POST">
                @csrf
				<div class="login__field">
					<i class="login__icon fas fa-user"></i>
					<input type="text" name="email" class="login__input" placeholder="User name / Email">
                    @error('email')
                        {{$message}}
                    @enderror
				</div>
				<div class="login__field">
					<i class="login__icon fas fa-lock"></i>
					<input type="password" name="password" class="login__input" placeholder="Password">
                    @error('password')
                        {{$message}}
                    @enderror
				</div>
				<button class="button login__submit" type="submit">
					<span class="button__text">Log In Now</span>
					<i class="button__icon fas fa-chevron-right"></i>
				</button>
				<br>
                <a href="register">don't have an account yet</a>
				<br>
				@if(session('error'))
					{{ session('error') }}
				@endif
				@if(session('isLogin'))
					{{ session('isLogin') }}
				@endif
			</form>
			<div class="social-login">
				<div class="social-icons">
					<a href="#" class="social-login__icon fab fa-instagram"></a>
					<a href="#" class="social-login__icon fab fa-facebook"></a>
					<a href="#" class="social-login__icon fab fa-twitter"></a>
				</div>
			</div>
		</div>
		<div class="screen__background">
			<span class="screen__background__shape screen__background__shape4"></span>
			<span class="screen__background__shape screen__background__shape3"></span>		
			<span class="screen__background__shape screen__background__shape2"></span>
			<span class="screen__background__shape screen__background__shape1"></span>
		</div>		
	</div>
</div>

@endsection