<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="vendor/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="vendor/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="style.css" />
  <title>Doctor Patient Portal</title>
</head>

<body>
  <header class="header d-flex justify-content-between align-items-center py-4 px-3 px-md-5 border">
    <h2 class="logo color1 m-0">Doctor Patient Portal</h2>
    <div class="dropdown">
      <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
        Login
      </button>
      <div class="dropdown-menu mt-1">
        <a class="dropdown-item" href="patient">Patient</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="doctor">Doctor</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="admin">Admin</a>
      </div>
    </div>
  </header>
  <main>
    <section class="hero">
      <div class="container py-5 py-md-0">
        <div class="row d-flex align-items-center">
          <div class="col-md-6 col-12">
            <h2 class="color1 mb-3">Connect with Trusted Doctors and Take Charge of Your Health</h2>
            <p class="mb-4">Sign up now and discover all the features our healthcare portal has to offer - book appointments, check your medical history, donate blood, and much more.</p>
            <a href="patient/signup" class="hero-btn">Register Now <i class="fa-solid fa-arrow-right-long ms-2"></i></a>
          </div>
          <div class="col-md-6 col-12">
            <div class="hero-svg">
              <img src="./img/doctors-animate.svg" alt="Students" class="img-fluid">
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/bootstrap.bundle.min.js"></script>
  <script src="main.js"></script>
</body>

</html>