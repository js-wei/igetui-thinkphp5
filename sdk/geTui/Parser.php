<?php

require_once('../parser/pb_parser.php');
$test = new PBParser();
$test->parse('./performance.proto');
?>