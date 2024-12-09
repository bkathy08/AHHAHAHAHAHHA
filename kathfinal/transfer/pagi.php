<?php
$search_query = '';
$per_page = 5; // number of records per page

// get the current page number
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $per_page;
?>