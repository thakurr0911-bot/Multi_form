<?php
session_start();
if (!isset($_SESSION['form_completed']) || $_SESSION['form_completed'] !== true) {
    header("Location: index.php");
    exit();
}

?>
<div>
    <a href="index.php">home</a>
</div>

<?php
session_unset();
session_destroy();
?>