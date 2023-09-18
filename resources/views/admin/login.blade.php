<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	@include('partials.commonStyles')
	<title>{{ $title }}</title>
</head>

<body>
	<div class="bg-image" style="
		background: linear-gradient(rgba(0, 0, 0, 0.60), rgba(0, 0, 0, 0.60)), url('img/login-bg.jpg') no-repeat;
		height: 100vh;
		background-position: center;
		background-size: cover;">

		<section class="vh-100 gradient-custom" style="overflow-y : auto;">

			@if (session()->has('loginError'))
			<div class="alert alert-danger alert-dismissible fade show rounded-0" role="alert">
				{{ session('loginError') }}
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
			@endif

			<div class="container py-5 h-100">
				<div class="row d-flex justify-content-center align-items-center h-80">
					<div class="col-12 col-md-8 col-lg-6 col-xl-5">

						<div class="card bg-light text-black" style="border-radius: 1rem;">
							<form action="/login" method="POST" class="mx-auto" style="width: 80%">
								@csrf

								<img src="img/logo.png" class="mt-4 mb-2 position-relative bottom-0 start-50 translate-middle-x">
								<h2 class="fw-bold mb-2 text-uppercase text-center">Desa Malik</h2>
								<p class="text-black-50 mb-5 text-center">Kecamatan Payung, Kabupaten Bangka Selatan</p>

								<div class="form-group mb-3">
									<label for="username" class="form-label">Username</label>
									<input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="username" placeholder="Masukkan username anda" value="{{ old('username') }}" required autofocus>

									@error('username')
										<div class="invalid-feedback">
											{{ $message }}
										</div>
									@enderror
								</div>

								<div class="form-group mb-3">
									<label for="password" class="form-label">Password</label>
									<div class="input-group">
										<input type="password" name="password" class="form-control" id="password" placeholder="Masukkan password anda" required>
										<div class="input-group-append">
											<span class="input-group-text" onclick="password_show_hide();" style="height: 100%; 
													   width: 45.6px;
													   border-top-left-radius: 0;
													   border-top-right-radius: 0.375rem;
													   border-bottom-right-radius: 0.375rem;
													   border-bottom-left-radius: 0;">
												<i class="fas fa-eye" id="show_eye"></i>
												<i class="fas fa-eye-slash d-none" id="hide_eye"></i>
											</span>
										</div>
									</div>
								</div>

								<div class="form-check d-flex justify-content-end mb-4">
									<p><a class="nav-link" style="" href="{{ route('password.request') }}">Forgot password?</a></p>
								</div>

								<button class="btn btn-outline-dark btn-lg mb-4 mt-2 px-5 py-2 position-relative bottom-0 start-50 translate-middle-x">Login</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>

	@include('partials.commonScripts')
	<script>
		function password_show_hide() {
			var x = document.getElementById("password");
			var show_eye = document.getElementById("show_eye");
			var hide_eye = document.getElementById("hide_eye");
			hide_eye.classList.remove("d-none");
			if (x.type === "password") {
				x.type = "text";
				show_eye.style.display = "none";
				hide_eye.style.display = "block";
			} else {
				x.type = "password";
				show_eye.style.display = "block";
				hide_eye.style.display = "none";
			}
		}
	</script>
</body>

</html>