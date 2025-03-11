<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="./css/styles.css" />
    <script src="./js/nav.js" defer></script>
    <script src="./js/scripts.js" defer></script>
  </head>
  <body>
    <header id="navbar">
      <nav class="navbar-container container">
        <a href="index.php" class="home-link">
          <div class="navbar-logo"></div>
          Our Travel Spots
        </a>
        <button
          type="button"
          class="navbar-toggle"
          aria-label="Toggle menu"
          aria-expanded="false"
          aria-controls="navbar-menu"
        >
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <div id="navbar-menu" class="detached">
          <ul class="navbar-links">
            <li class="navbar-item">
              <a class="navbar-link" href="about.php">About
                </a>
            </li>
            <li class="navbar-item">
              <a class="navbar-link" href="countries.php">Countries</a>
            </li>
            <li class="navbar-item">
              <a class="navbar-link" href="destinations.php">Destinations</a>
            </li>
            <?php
            /* check session var to determine which links to show
            - Anonymous users see Login & Register
            - Authenticated user see their username & Logout
            */
            if (session_status() == PHP_SESSION_NONE) {
              session_start();
            }
  
            if (isset($_SESSION['username'])) {
                echo '
                  <li class="navbar-item"><a href="#" class="navbar-link">' . $_SESSION['username'] . '</a></li>
                  <li class="navbar-item"><a href="logout.php" class="navbar-link">Logout</a></li>';           
            }
            else {
              echo '
              <li class="navbar-item">
                <a class="navbar-link" href="login.php">Login</a>
              </li>
              <li class="navbar-item">
                <a class="navbar-link" href="register.php">Register</a>
              </li>';
            }
            ?>
          </ul>
        </div>
      </nav>
    </header>
    <main>
<!--
<nav>
    <a href="index.php">
        Home
    </a>
    <a href="about.php">
        About
    </a>
    <a href="countries.php">
        Countries
    </a>
    <a href="destinations.php">
        Destinations
    </a>
    <a href="login.php">
        Login
    </a>
    <a href="register.php">
        Register
    </a>
</nav>

-->