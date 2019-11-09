<?php
    define("DB_HOST", "m60mxazb4g6sb4nn.chr7pe7iynqr.eu-west-1.rds.amazonaws.com");
    define("DB_USER", "f4yj08g2imj142qq");
    define("DB_PASS", "tcvf4i2hobj2wxuu");
    define("DB_NAME", "tcjcis2qqlpluhms");
    
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die("Connection to database failed!");
?>