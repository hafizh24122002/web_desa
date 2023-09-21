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

			@if (session()->has('status'))
				<div class="alert alert-success alert-dismissible fade show rounded-0" role="alert">
					{{ session('status') }}
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
			@endif
			
			<div class="container py-5 h-100">
				<div class="row d-flex justify-content-center align-items-center h-80">
					<div class="col-12 col-md-8 col-lg-6 col-xl-5">
						
						<div class="card bg-light text-black" style="border-radius: 1rem;">
							<form name="captcha-contact-us" method="POST" class="mx-auto" style="width: 80%">
								@csrf
								
								<img src="img/logo.png" class="mt-4 mb-2 position-relative bottom-0 start-50 translate-middle-x">
								<h2 class="fw-bold mb-2 text-uppercase text-center">Desa Malik</h2>
								<p class="text-black-50 mb-5 text-center">Kecamatan Payung, Kabupaten Bangka Selatan</p>
								
								<div class="form-group mb-3">
									<label for="email" class="form-label">Email</label>
									<input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Masukkan email anda" value="{{ old('username') }}" required autofocus>
				
									@error('email')
										<div class="invalid-feedback">
											{{ $message }}
										</div>
									@enderror
								</div>

								<div class="form-group mt-4 mb-4">
									<div class="captcha">
										<span>{!! captcha_img() !!}</span>
										<button type="button" class="btn btn-danger" class="reload" id="reload">
											↻
										</button>
									</div>
								</div>

								<div class="form-group mb-4">
									<input id="captcha" type="text" class="form-control @error('captcha') is-invalid @enderror" placeholder="Masukkan teks di atas" name="captcha">

									@error('captcha')
										<div class="invalid-feedback">
											{{ $message }}
										</div>
									@enderror
								</div>

								<button class="btn btn-outline-dark btn-lg mb-4 mt-2 px-5 py-2 position-relative bottom-0 start-50 translate-middle-x">Kirim Lupa Sandi</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>

	@include('partials.commonScripts')
	<script type="text/javascript">
    $('#reload').click(function () {
        $.ajax({
            type: 'GET',
            url: '/reload-captcha',
            success: function (data) {
                $(".captcha span").html(data.captcha);
            }
        });
    });
 
</script>
	</script>
</body>

</html>