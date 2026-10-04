<?php
include "db.php";
session_start();

if($_SERVER["REQUEST_METHOD"]==="POST"){
    $email=$_POST["email"];
    $password=$_POST["password"];

    $sql=$conn->prepare("select  uid, name, password from users where email=?");
    $sql->bind_param("s",$email);
    $sql->execute();
    $sql->bind_result($i,$n,$p);
    $sql->fetch();

    if(password_verify($password,$p)){
        $_SESSION["uid"]=$i;
        $_SESSION["name"]=$n;

        header("Location:home.php");
        exit();
    }
    else{
        echo "<script>
        alert('Login Failed');
        </script>";
    }
}
?>

<!doctype html>
<html lang="en" data-bs-theme="light">
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
            <!-- place navbar here -->
            
        </header>
        <main>
            <h1 class="text-center m-5" > LOGIN WITH US!!</h1>
            <div
                class="container col-5 border rounded shadow mt-4 p-3"
            >
             <form action="" method="Post">
                <div class="mb-3">
                    <label for="" class="form-label">email</label>
                    <input
                        type="text"
                        class="form-control"
                        name="email"
                        id=""
                        aria-describedby="helpId"
                        placeholder=""
                    />
                 
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Password</label>
                    <input 
                        type="password"
                        class="form-control"
                        name="password"
                        id=""
                        placeholder=""
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
        <footer>
            <!-- place footer here -->
        </footer>
        <!-- Bootstrap JavaScript Bundle (includes Popper) -->
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
