<?php
// Cache page
require '../includes/cache_top.php';

// Connect to mysql
require_once '../includes/mysql_connection.php';

// Get page settings
require_once '../includes/get_settings.php';
$settings = loadSettings($conn);

// Load html_helper
require_once '../includes/html_helper.php';

html_head($settings['page_title'], 'index');
?>
  </head>
  <body>
    <div class="site-wrapper">

      <div class="site-wrapper-inner">

        <div class="masthead clearfix mb-auto">
          <div class="container inner">
            <h3 class="masthead-brand"><a href="/"><?php echo($settings['navbar_brand']); ?></a></h3>
            <nav class="masthead-nav">
              <ul class="nav masthead-nav">
                <li class="nav-link active"><a href="#">Home</a></li>
                <li class="nav-link"><a href="/projects.php">Projects</a></li>
              </ul>
            </nav>
          </div>
        </div>

        <div class="container">
          <div class="inner cover">
            <img class="homepage-image" alt="ADT Logo" title="ADT Logo" src="/img/logo.svg">
            <p class="lead"><?php echo($settings['homepage_text']); ?></p>
            <p class="lead projects-button">
              <a href="/projects.php" class="btn btn-lg btn-secondary">Our Projects</a>
            </p>
          </div>

        </div>

      </div>

    </div>
<?php
html_end();

// Finish page cache
require "../includes/cache_bottom.php";
?>
