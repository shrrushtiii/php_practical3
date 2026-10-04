<?php
session_start();
include "db.php";

$uid = $_SESSION["uid"];

if (isset($_GET["pid"])) {

    $pid = $_GET["pid"];

    $sql = $conn->prepare(
        "SELECT pid, pname, category, price, quantity
         FROM products
         WHERE pid=? AND uid=?"
    );

    $sql->bind_param("ii", $pid, $uid);
    $sql->execute();

    $result = $sql->get_result();
    $row = $result->fetch_assoc();

    if (!$row) {
        echo "Product not found";
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $pid = $_POST["pid"];
    $pname = $_POST["pname"];
    $category = $_POST["category"];
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];

    $sql = $conn->prepare(
        "update products set pname=?, category=?, price=?, quantity=? where pid=? and uid=?");

    $sql->bind_param(
        "ssdiii",$pname,$category,$price, $quantity, $pid, $ui );

    if ($sql->execute()) {
        echo "<script>
                alert('Product Updated Successfully');
                window.location.href='home.php';
              </script>";
        exit();
    } else {
        echo "<script>
                alert('Product Not Updated');
              </script>";
    }
}
?>

<!doctype html>
<html lang="en" data-bs-theme="light">

<head>
    <title>Edit Product</title>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
    />
</head>

<body>

<main>

    <h1 class="text-center m-5">EDIT PRODUCT</h1>

    <div class="container col-5 border rounded shadow mt-4 p-3">

        <form action="" method="POST">

            <input
                type="hidden"
                name="pid"
                value="<?php echo $row["pid"]; ?>"
            >

            <div class="mb-3">
                <label class="form-label">Product Name</label>

                <input
                    type="text"
                    class="form-control"
                    name="pname"
                    value="<?php echo $row["pname"]; ?>"
                >
            </div>

            <div class="mb-3">
                <label class="form-label">Product Category</label>

                <input
                    type="text"
                    class="form-control"
                    name="category"
                    value="<?php echo $row["category"]; ?>"
                >
            </div>

            <div class="mb-3">
                <label class="form-label">Product Price</label>

                <input
                    type="number"
                    class="form-control"
                    name="price"
                    value="<?php echo $row["price"]; ?>"
                >
            </div>

            <div class="mb-3">
                <label class="form-label">Product Quantity</label>

                <input
                    type="number"
                    class="form-control"
                    name="quantity"
                    value="<?php echo $row["quantity"]; ?>"
                >
            </div>

            <button
                type="submit"
                class="btn btn-primary"
            >
                Update Product
            </button>

        </form>

    </div>

</main>

</body>
</html>