<?php
session_start();
include "db.php";

$uid = $_SESSION["uid"];

if (isset($_GET["pid"])) {

    $pid = $_GET["pid"];

    $sql = $conn->prepare(
        "delete from products where pid=? and uid=?"
    );

    $sql->bind_param("ii", $pid, $uid);

    if ($sql->execute()) {
        echo "<script>
                alert('Product Deleted Successfully');
                window.location.href='home.php';
              </script>";
        exit();
    } else {
        echo "<script>
                alert('Product Not Deleted');
                window.location.href='home.php';
              </script>";
    }
}
?>