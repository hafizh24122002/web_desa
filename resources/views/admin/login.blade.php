<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
    integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous" />
  <title>{{ $title }}</title>
</head>

<body>
  <div class="bg-image" style="
    background: linear-gradient(rgba(0, 0, 0, 0.60), rgba(0, 0, 0, 0.60)), url('img/login-bg.jpg') no-repeat;
      height: 100vh;
      background-position: center;
              background-size: cover;
    ">
    <section class="vh-100 gradient-custom" style="overflow-y : auto;">
      <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-80">
          <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card bg-light text-black" style="border-radius: 1rem;">
              <div class="card-body p-5 text-center">
                <img src="img/logo.png">
                <div class="mb-md-5 mt-md-4 pb-5">
                  <h2 class="fw-bold mb-2 text-uppercase">Desa Malik</h2>
                  <p class="text-black-50 mb-5">Kecamatan Payung, Kabupaten Bangka Selatan</p>
                  <div class="col-12">
                    <div class="input-group mb-3">
                      <input name="username" type="text" value="" class="input form-control" id="username"
                        placeholder="Nama pengguna" aria-label="Username" aria-describedby="basic-addon1" />
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="input-group mb-3">
                      <input name="password" type="password" value="" class="input form-control" id="password"
                        placeholder="Kata sandi" required="true" aria-label="password"
                        aria-describedby="basic-addon1" />
                      <div class="input-group-append">
                        <span class="input-group-text" onclick="password_show_hide();">
                          <i class="fas fa-eye" id="show_eye"></i>
                          <i class="fas fa-eye-slash d-none" id="hide_eye"></i>
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="form-check d-flex justify-content-end mb-4">
                    <p class=><a class="text-black-100" href="#!">Forgot password?</a></p>
                  </div>
                  <button class="btn btn-outline-dark btn-lg px-5" type="submit">Login</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
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