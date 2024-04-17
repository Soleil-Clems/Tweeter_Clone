<?php $title = "Messenger";
ob_start(); ?>
<h1>Messenger</h1>
<?php
echo "<pre>";
var_dump($_SESSION);
echo "</pre>";
?>

<?php
$content = ob_get_clean();
require "layout.php";
?>