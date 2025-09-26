<?php
session_start();
if (empty($_SESSION['logged_in'])) {
    header("Location: index.php"); // redirect if not logged in
    exit;
}
?>


<ul>
    <li><a href="download.php?file=passwd.txt">/etc/passwd</a></li>
    <li><a href="download.php?file=shadow.txt">/etc/shadow</a></li>
</ul>

