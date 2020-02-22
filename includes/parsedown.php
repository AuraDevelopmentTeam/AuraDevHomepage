<?php

require_once "parsedown/Parsedown.php";
require_once "parsedown_extra/ParsedownExtra.php";
require_once "parsedown_extended/ParsedownExtended.php";

function get_parsedown() {
  $parsedown = new ParsedownExtended([
    // Settings here
    // See:
    //  - https://github.com/erusev/parsedown#escaping-html
    //  - https://github.com/erusev/parsedown-extra
    //  - https://github.com/BenjaminHoegh/ParsedownExtended#added-features
    "toc" => [
      "enable" => true,
      "selector" => ["h1","h2","h3","h4","h5","h6"],
      "inline" => true,
    ],
    "mark" => true,
    "insert" => true,
    "smartTypography" => true,
    "scripts" => true,
    "kbd" => true,
    "task" => true,
    "math" => true,
    "diagrams" => true,
  ]);

  return $parsedown;
}
