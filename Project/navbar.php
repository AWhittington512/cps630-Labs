<div>
  <nav class="navbar navbar-expand-lg navbar-light p-2 bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="./index.php"><img src="scs-logo.png" style="width: 80px"></a>
      <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto">
          <a href="./index.php" class="nav-item nav-link ms-2">Home</a>
          <a href="./items.php" class="nav-item nav-link ms-2">Shop</a>
          <a href="./about.php" class="nav-item nav-link ms-2">About Us</a>
          <a href="#" class="nav-item nav-link ms-2">Reviews</a>
          <a href="#" class="nav-item nav-link ms-2">Services</a>
          <a class="btn btn-primary ms-2" data-bs-toggle="modal" href="#logInModal" role="button">Log In</a>
          <a data-bs-toggle="modal" href="#logInModal" class="nav-item nav-link ms-2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-fill" viewBox="0 0 16 16">
              <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5z" />
            </svg></a>
        </div>
      </div>
    </div>
  </nav>

  <div class="modal fade" id="logInModal" aria-hidden="true" aria-labelledby="logInModalLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5 lead">Log in to your account</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-4">
          <form action="login.php" method="POST">
            <div class="mb-3">
              <label for="email" class="form-label">Email address</label>
              <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3 form-check">
              <input type="checkbox" class="form-check-input" id="remember-me">
              <label class="form-check-label" for="remember-me">Remember me</label>
            </div>
            <button type="submit" class="btn btn-outline-success d-block m-auto my-2">Log In</button>
            <button type="button" class="btn btn-outline-primary d-block m-auto my-2" data-bs-target="#signUpModal" data-bs-toggle="modal">Sign Up</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="signUpModal" aria-hidden="true" aria-labelledby="signUpModalLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5 lead">Create an account</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-4">
          <form action="signup.php" method="POST">
            <h1 class="fs-6 fw-bold">Personal Info</h1>
            <div class="mb-3">
              <label for="name" class="form-label">Name</label>
              <input type="name" class="form-control" id="name" name="name" aria-describedby="userName" required>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email address</label>
              <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Repeat Password</label>
              <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
            </div>
            <div class="mb-3">
              <label for="telephone" class="form-label">Phone</label>
              <input type="tel" class="form-control" id="telephone" name="telephone" aria-describedby="phoneNumber">
            </div>
            <h1 class="fs-6 fw-bold mt-4">Address</h1>
            <div class="mb-3">
              <label for="streetaddr" class="form-label">Street Address</label>
              <input type="text" class="form-control" id="streetaddr" name="streetaddr" aria-describedby="streetAddress">
            </div>
            <div class="mb-3">
              <label for="city" class="form-label">City</label>
              <input type="text" class="form-control" id="city" name="city" aria-describedby="cityAddress">
            </div>
            <div class="mb-3">
              <label for="province" class="form-label">Province</label>
              <input type="text" class="form-control" id="province" name="province" aria-describedby="provinceAddress">
            </div>
            <div class="mb-3">
              <label for="postcode" class="form-label">Postal Code</label>
              <input type="text" class="form-control" id="postcode" name="postcode" aria-describedby="postAddress">
            </div>
            <button type="submit" class="btn btn-outline-primary d-block m-auto my-2">Sign Up</button>
            <div class="form-text text-center">
              Already have an account?
              <a class="link-primary" href="logInModal" data-bs-target="#logInModal" data-bs-toggle="modal">Log In</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>