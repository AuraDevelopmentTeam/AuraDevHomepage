<?php
// Cache page
require '../includes/cache_top.php';

// Connect to mysql
require_once '../includes/mysql_connection.php';

// Get page settings
require_once '../includes/get_settings.php';
$settings = loadSettings($conn);

// Get list of projects
require_once '../includes/get_projects.php';
$projects_data = getProjects($conn);

// Load card builder
require_once '../includes/build_project_bootstrap_card.php';

// Load html_helper
require_once '../includes/html_helper.php';

html_head($settings['page_title'], 'projects');
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
                <li class="nav-link"><a href="/">Home</a></li>
                <li class="nav-link active"><a href="#">Projects</a></li>
              </ul>
            </nav>
          </div>
        </div>

        <div class="card-deck text-center w-75 mx-auto">
          <?php buildCards($projects_data); ?>
        </div>

      </div>
    </div>
<?php
html_end();

// Finish page cache
require "../includes/cache_bottom.php";
?>
