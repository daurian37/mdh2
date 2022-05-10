<?php

//logout.php

session_start();

session_destroy();

header('location:page_index_ferol.php');

?>