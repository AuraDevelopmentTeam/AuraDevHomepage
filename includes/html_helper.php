<?php
// Print the HTML beginning and header excluding the trailing </head> tag (to allow to add more stuff in the head)
function html_head($title = 'Unknown Page Title', $page_specifc_css = false) {
	if (($page_specifc_css !== false) && (substr($page_specifc_css, -4) !== '.css')) {
		$page_specifc_css .= '.css';
	}
?>
<!doctype html>
<html lang="en">
  <head>
   <title><?php echo $title; ?></title>

   <link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32" />
   <link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Custom styles for this template -->
    <link href="/css/common.css" rel="stylesheet">
<?php
  if ($page_specifc_css !== false) {
?>
    <!-- Page specific CSS -->
    <link href="/css/<?php echo $page_specifc_css; ?>" rel="stylesheet">
<?php
  }
?>

    <!-- jquery, Bootstrap & Popper JS-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" defer></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" defer></script>
<?php
}

// Closes the body and html tag and adds the Octocat banner
function html_end($forkme_link = "https://github.com/AuraDevelopmentTeam/Web") {
?>
    <a href="<?php echo $forkme_link; ?>" class="github-corner" title="Fork us on GitHub">
      <object type="image/svg+xml" data="/img/octocat.svg">Fork us on GitHub</object>
    </a>
  </body>
</html>
<?php
}
