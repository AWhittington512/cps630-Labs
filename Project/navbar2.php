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
          <?php
            include "phpScripts/DBConnect.php";

            $stmt = $connection->prepare("SELECT Administrator FROM user_info WHERE Email = ?");
            $stmt->bind_param("s", $_SESSION['email']);
            $stmt->execute();
            $result = $stmt->get_result();
            $admin = $result->fetch_assoc()["Administrator"];

            if($admin == 'Y')
            {
              echo('
                <div class="dropdown">
                  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    DB Maintain
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="./insert.php">Insert</a>
                    <a class="dropdown-item" href="./delete.php">Delete</a>
                    <a class="dropdown-item" href="./select.php">Select</a>
                    <a class="dropdown-item" href="./update.php">Update</a>
                  </div>
                </div>
              ');
            }
            else
            {
              echo('
                <form action="search.php" method="POST">
                    <input type="text" class="form-control" id="orderID" name="orderID" placeholder="OrderID" required>
                    <button type="submit" name="SubmitButton" class="btn btn-secondary">Search</button>
                </form>
              ');
            }
            // $connection->close();
          ?>
          <a class="btn btn-primary ms-2" data-bs-toggle="modal" href="#userModal" role="button">Welcome, <?php echo $_SESSION["username"];?>!</a>
          <a href="cart.php" class="nav-item nav-link ms-2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-fill" viewBox="0 0 16 16"><path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5z"/></svg></a>
        </div>
      </div>
    </div>
  </nav>
  <div class="modal fade" id="userModal" aria-hidden="true" aria-labelledby="userModalLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5 lead">Account information</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p4">
          <h5 class="fs-5 lead">Name</h5>
          <p><?php echo $_SESSION['username'];?></p>
          <h5 class="fs-5 lead">Email</h5>
          <p><?php echo $_SESSION['email'];?></p>
          <h5 class="fs-5 lead">Phone</h5>
          <p><?php echo $_SESSION['phone'];?></p>
          <h5 class="fs-5 lead">Address</h5>
          <p><?php echo $_SESSION['address'] . ", " . $_SESSION['postcode'];?></p>
          <h5 class="fs-5 lead">Balance</h5>
          <p><?php echo $_SESSION['balance'];?></p>
        </div>
      </div>
    </div>
  </div>
</div>
