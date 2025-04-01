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
        <!-- weather widget from www.booked.net -->
         <!-- weather widget start --><div id="m-booked-small-t3-551"> <div class="booked-weather-160x36 w160x36-01" style="background-color:#FFF5D9; color:#333333; border-radius:4px; -moz-border-radius:4px;"> <div style="color:#08488D;" class="booked-bl-simple-city">Barrie</div> <div class="booked-weather-160x36-degree"><span class="plus">+</span>2&deg;<span>C</span></div> </div> </div><script type="text/javascript"> var css_file=document.createElement("link"); var widgetUrl = encodeURIComponent(location.href); css_file.setAttribute("rel","stylesheet"); css_file.setAttribute("type","text/css"); css_file.setAttribute("href",'https://s.bookcdn.com/css/w/bw-160-36.css?v=0.0.1'); document.getElementsByTagName("head")[0].appendChild(css_file); function setWidgetData_551(data) { if(typeof(data) != 'undefined' && data.results.length > 0) { for(var i = 0; i < data.results.length; ++i) { var objMainBlock = document.getElementById('m-booked-small-t3-551'); if(objMainBlock !== null) { var copyBlock = document.getElementById('m-bookew-weather-copy-'+data.results[i].widget_type); objMainBlock.innerHTML = data.results[i].html_code; if(copyBlock !== null) objMainBlock.appendChild(copyBlock); } } } else { alert('data=undefined||data.results is empty'); } } var widgetSrc = "https://widgets.booked.net/weather/info?action=get_weather_info;ver=6;cityID=26910;type=13;scode=;domid=w209;anc_id=72227;cmetric=1;wlangID=32;color=fff5d9;wwidth=158;header_color=fff5d9;text_color=333333;link_color=08488D;border_form=0;footer_color=fff5d9;footer_text_color=333333;transparent=0";widgetSrc += ';ref=' + widgetUrl;widgetSrc += ';rand_id=551';var weatherBookedScript = document.createElement("script"); weatherBookedScript.setAttribute("type", "text/javascript"); weatherBookedScript.src = widgetSrc; document.body.appendChild(weatherBookedScript) </script><!-- weather widget end -->
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