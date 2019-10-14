<?php
//connect to mysql
include_once "../includes/mysql_connection.php";

//get page settings
include_once "../includes/get_settings.php";
$settings = loadSettings($conn);

//get list of projects
include_once "../includes/get_projects.php";
$projects_data = getProjects($conn);

//load card builder
include_once "../includes/build_project_bootstrap_card.php";

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

</head>
<body>
  <div class="site-wrapper">
    <div class="site-wrapper-inner">

      <div class="masthead clearfix mb-auto">
        <div class="container inner">
          <h3 class="masthead-brand"><?php echo($settings["navbar_brand"]); ?></h3>
          <nav class="masthead-nav">
            <ul class="nav masthead-nav">
              <li class="nav-link"><a href="./index.php">Home</a></li>
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

    <!-- jquery, Bootstrap & Popper JS-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  </body>
</html>
