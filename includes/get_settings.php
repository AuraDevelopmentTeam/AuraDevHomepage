<?php
//loads settings from database

function loadSettings($conn) {
  //get key and setting from the website_settings table
  $sql = "SELECT `key`,`value` FROM `website_settings`";
  $result = $conn->query($sql);

  //loop through each setting and put it into Array
  foreach ($result->fetch_all() as $key => $val) {
        //if array not made yet, create one
        if (!isset($site_settings)) {
            $site_settings = array();
        }
        /*
          $val[0] contains the key of the settings, $val[1] is the value of the
          setting, this creates an array of multiple setting_key=>setting_value
        */
        $site_settings[$val[0]] = $val[1];
  }

  return $site_settings;
}
