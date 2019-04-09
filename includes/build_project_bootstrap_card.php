<?php
//Builds bootstrap cards from $projects_data and outputs html

/* Example card:

<div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
    <div class="card-header">Header</div>
    <div class="card-body">
      <h5 class="card-title">Title</h5>
      <p class="card-text">Content</p>
    </div>
</div>

*/

function buildCards($projects_data) {
  //loop trough each "project" in $projects_data and insert values into template
  foreach ($projects_data as $value) {
    echo "<div class=\"card text-white bg-dark mb-3\" style=\"max-width: 18rem;\">";
    //echo "    <div class=\"card-header\">" . $value["name"] . "</div>";
    echo "    <div class=\"card-body\">";
    echo "      <h5 class=\"card-title\">" . $value["name"] . "</h5>";
    echo "      <p class=\"card-text\">" . $value["description"] . "</p>";
    echo "    </div>";
    echo " </div>";
  }

return true;
}
