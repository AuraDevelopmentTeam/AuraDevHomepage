<?php
//lists projects in database

function getProjects($conn) {

  //get all values from the website_settings table
  $sql = "SELECT * FROM `website_projects`";
  $result = $conn->query($sql);

  //get column names so we can assemble it into an array together with the rows
  //uses the same query data so we don't have to do a second query
  foreach ($result->fetch_fields() as $key => $val) {
    //if array not made yet, create one
    if (!isset($column_names)) {
        $column_names = array();
    }
    //add field (column) name to array of columns
    array_push($column_names, $val->orgname);
  }


/* TODO: Still needs better documentation and i dont really know what i did
         with the variable names... but it works */

//loop trough results (rows) and assemble them with the column names into one array
  foreach ($result->fetch_all() as $val) {

        $column_name_row_counter = 0;
        foreach ($val as $subval) {

          $project_array[$column_names[$column_name_row_counter]] = $subval;

          $column_name_row_counter++;

        }

        if (!isset($projects_data)) {
            $projects_data = array();
        }

        array_push($projects_data, $project_array);

  }

  return $projects_data;
}
