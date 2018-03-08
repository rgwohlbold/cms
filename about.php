<?php
    define("ADMIN", false);
    require_once "include/config.php";
    require_once ROOTDIR . "template/top.php";
?>

<h1 class="page-header">About</h1>
This is just a simple CMS written in PHP in my free time. It is
not by any means perfect and its security against Cross-Site-Scripting
and SQL-Injection should be seriously reviewed. Nevertheless it works
and is my best PHP project so far.


<?php
    require_once ROOTDIR . "template/bottom.php";
?>