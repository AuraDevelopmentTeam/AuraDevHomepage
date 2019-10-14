<?php

require_once "parsedown/Parsedown.php";
require_once "parsedown_extra/ParsedownExtra.php";
require_once "parsedown_extreme/ParsedownExtreme.php";

function get_parsedown() {
  $parsedown = new ParsedownExtreme();

  // Settings here
  // See:
  //  - https://github.com/erusev/parsedown#escaping-html
  //  - https://github.com/erusev/parsedown-extra
  //  - https://github.com/BenjaminHoegh/parsedown-extreme#new-features

  return $parsedown;
}
