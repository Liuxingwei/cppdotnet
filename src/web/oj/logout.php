<?php session_start();
unset($_SESSION['user_id']);
session_destroy();
echo "<meta http-equiv='Content-Type' content='text/html'; charset='utf-8'>";
echo "<script charset='utf-8' language='javascript'>\n";
echo "history.go(-1);\n";
echo "</script>";
?>