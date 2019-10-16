<?php
// Cache page
require "../includes/cache_top.php";

// Connect to mysql
require_once "../includes/mysql_connection.php";

// Get page settings
require_once "../includes/get_settings.php";
$settings = loadSettings($conn);

// Get list of projects
require_once "../includes/get_projects.php";
$projects_data = getProjects($conn);

// Load card builder
require_once "../includes/build_project_bootstrap_card.php";
?>
<!doctype html>
<html>
  <head>
   <title><?php echo($settings["page_title"]); ?></title>

   <link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32" />
   <link rel="icon" type="image/png" href="favicon-16x16.png" sizes="16x16" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Custom styles for this template -->
    <link href="./css/common.css" rel="stylesheet">
    <!-- Page specific CSS -->
    <link href="./css/projects.css" rel="stylesheet">

    <!-- jquery, Bootstrap & Popper JS-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" defer></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" defer></script>

  </head>
  <body>
    <div class="site-wrapper">
      <div class="site-wrapper-inner">

        <div class="masthead clearfix mb-auto">
          <div class="container inner">
            <h3 class="masthead-brand"><a href="/"><?php echo($settings["navbar_brand"]); ?></a></h3>
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
  </body>
</html>
<?php
// Finish page cache
require "../includes/cache_bottom.php";
?>
