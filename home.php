<?php
session_start();
include "db.php";

if (!isset($_SESSION["uid"], $_SESSION["name"])) {
    header("Location: login.php");
    exit();
}

$uid = $_SESSION["uid"];

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $pname = $_POST["pname"];
    $category = $_POST["category"];
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];
    $sname = $_POST["sname"];

    $sql = $conn->prepare(
        "insert into products (pname, category, price, quantity, sname, uid)
         values (?, ?, ?, ?, ?, ?)"
    );

    $sql->bind_param(
        "ssdisi",$pname,$category,$price,$quantity,$sname,$uid);

    if ($sql->execute()) {
        echo "<script>alert('Product Added Successfully');</script>";
    } else {
        echo "<script>alert('Product Not Added');</script>";
    }
}

$sql = $conn->prepare(
    "select pid, pname, category, price, quantity, sname from products where uid=?");

$sql->bind_param("i", $uid);
$sql->execute();
$result = $sql->get_result();
?>

<!doctype html>
<html lang="en" data-bs-theme="dark">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <!-- Bootstrap CSS v5.3.8 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
            crossorigin="anonymous"
        />
    </head>

    <body>
       <header>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark shadow">
        <div class="container">

            <a class="navbar-brand fw-bold" href="home.php">
                Hello, <?php echo $_SESSION["name"]; ?>
            </a>

            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#collapsibleNavId"
                aria-controls="collapsibleNavId"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="collapsibleNavId">

                <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a
                            class="nav-link active"
                            href="home.php"
                            aria-current="page"
                        >
                            Home
                        </a>
                    </li>
                </ul>

                <div class="d-flex gap-2">
                    <a
                        class="btn btn-outline-light"
                        href="pdf.php"
                    >
                        Generate PDF
                    </a>

                    <a
                        class="btn btn-primary"
                        href="logout.php"
                    >
                        Logout
                    </a>
                </div>

            </div>
        </div>
    </nav>
</header>
       <main>

            <h1 class="text-center m-5">ADD PRODUCT</h1>

            <div class="container col-5 border rounded shadow mt-4 p-3">

                <form action="" method="POST">

                    <div class="mb-3">
                        <label class="form-label">Product Name</label>
                        <input
                            type="text"
                            class="form-control"
                            name="pname"
                        />
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Product Category</label>
                        <input
                            type="text"
                            class="form-control"
                            name="category"
                        />
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Product Price</label>
                        <input
                            type="number"
                            class="form-control"
                            name="price"
                        />
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Product Quantity</label>
                        <input
                            type="number"
                            class="form-control"
                            name="quantity"
                        />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Supplier Name</label>
                        <input
                            type="text"
                            class="form-control"
                            name="sname"
                        />
                    </div>

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Add Product
                    </button>

                </form>

            </div>
<h1 class="text-center m-5">MY PRODUCTS</h1> 
<div
    class="table-responsive"
>
    <table
        class="table table-primary"
    >
        <thead>
            <tr>
                <th>ID</th>
<th>NAME</th>
<th>CATEGORY</th>
<th>PRICE</th>
<th>QUANTITY</th>
<th>SUPPLIER</th>
<th>ACTION</th>
<th>ACTION</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?> <tr> <td><?php echo $row["pid"]; ?></td> 
            <td><?php echo $row["pname"]; ?></td> 
            <td><?php echo $row["category"]; ?></td> 
            <td><?php echo $row["price"]; ?></td> 
            <td><?php echo $row["quantity"]; ?></td> 
            <td><?php echo $row["sname"]; ?></td> 
            <td>
    <a
        class="btn btn-primary"
        href="edit.php?pid=<?php echo $row["pid"]; ?>"
    >
        Edit
    </a>
</td>
     <td>
    <a
        class="btn btn-primary"
        href="delete.php?pid=<?php echo $row["pid"]; ?>"
        onclick="return confirm('Do you really want to delete this product?');"
    >
        Delete
    </a>
</td>
        </tr> 
        <?php } ?>
           
        </tbody>
    </table>
</div>

        </main>

        <footer>
        </footer>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrVVcXK/BmnVDxM+D2scQbITxI"
            crossorigin="anonymous">
        </script>

    </body>
</html>