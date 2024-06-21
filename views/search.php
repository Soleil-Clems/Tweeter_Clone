<?php $title = "Messenger";
ob_start(); ?>

<h1>Search Users</h1>
    <form action="search.php" class="formPost" method="post">
        <input type="text" style="width:95%; height:3em; margin-inline:1em" name="search" class="postContent" placeholder="Search by username or pseudo">
    </form>
   

<?php

?>


<?php
$content = ob_get_clean();
require "layout.php";
?>
