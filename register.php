<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = password_hash($_POST["passsword"], PASSWORD_DEFAULT);
    $phone = $_POST["phone"];
    $city = $_POST["city"];

    $sql = $conn->prepare(
        "insert into users(name, password, email, phone, city)
         values(?,?,?,?,?)"
    );

    $sql->bind_param(
        "sssss", $name, $password, $email, $phone, $city);

    if ($sql->execute()) {

    header("Location: login.php");
    exit();

} else {

    echo "Registration failed: " . $sql->error;
}
}
?>

<!doctype html>
<html lang="en" data-bs-theme="dark">

<head>
    <title>Registration</title>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
        crossorigin="anonymous"
    />
</head>

<body>

<main>

    <h1 class="text-center m-5">REGISTER WITH US</h1>

    <div class="container col-5 border rounded shadow mt-4 p-3">

        <form action="" method="post">

            <div class="mb-3">
                <label class="form-label">Name</label>
                <input
                    type="text"
                    class="form-control"
                    name="name"
                    required
                />
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input
                    type="password"
                    class="form-control"
                    name="password"
                    required
                />
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input
                    type="email"
                    class="form-control"
                    name="email"
                    required
                />
            </div>

            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input
                    type="text"
                    class="form-control"
                    name="phone"
                    required
                />
            </div>

            <div class="mb-3">
                <label class="form-label">City</label>
                <input
                    type="text"
                    class="form-control"
                    name="city"
                    required
                />
            </div>

            <button
                type="submit"
                class="btn btn-primary"
            >
                Submit
            </button>

        </form>

    </div>

</main>

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous">
</script>

</body>
</html>