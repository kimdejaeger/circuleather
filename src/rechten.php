<?php

function alleenAdmin()
{
    if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
        header("Location: dashboard.php");
        exit;
    }
}

?>