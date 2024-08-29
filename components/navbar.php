<?php
$loggedIn = false;
$companyloggedIn = false;
$criticloggedIn = false; // Initialize the variable
session_start();
if (isset($_SESSION['criticloggedin']) && $_SESSION['criticloggedin'] == true) {
  $criticloggedIn = true;
  $username = $_SESSION['username'];
  $displayName = $_SESSION['Name'];
  $role = $_SESSION['role'];
  $critic_score = $_SESSION['critic-score'];
  $email = $_SESSION['email'];
}
if (isset($_SESSION['companyloggedin']) && $_SESSION['companyloggedin'] == true) {
  $companyloggedIn = true;
  $username = $_SESSION['username'];
  $displayName = $_SESSION['Name'];
  $role = $_SESSION['role'];
  $company_marks = $_SESSION['company_marks'];
  $email = $_SESSION['email'];
}
?>
<nav class="navbar navbar-expand-lg bg-body-tertiary py-4">
  <div class="container-fluid">
    <a class="navbar-brand text-primary" href="#">Viksit Infra</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        
        <?php

        if ($criticloggedIn || $companyloggedIn) {
          ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <?php echo $displayName; ?>
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Update Profile</a></li>
              <li><a class="dropdown-item" href="logout.php">Logout</a></li>
            </ul>
          </li>
         
          <?php
        } else { ?>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="login.php">Login/Signup</a>
          </li><?php }
        ?>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>