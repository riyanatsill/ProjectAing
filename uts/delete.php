<?php
if(isset($_POST["id_tr"]) && !empty($_POST["id_tr"])){
    require_once "config.php";
    $sql = "DELETE FROM produk WHERE id_tr = ?";
    if ($stmt = mysqli_prepare($con, $sql)){
        mysqli_stmt_bind_param($stmt,"i", $param_id_tr);
        $param_id_tr = trim($_POST["id_tr"]);
        if (mysqli_stmt_execute($stmt)){
            header("location: read1.php");
            exit();
        } else{
            echo "Oops! Something Went Wrong. Please Try Again Later.";
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($con);
} else{
    if (empty(trim($_GET["id_tr"]))){
        header("location: error.php");
        exit();
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Success</title>
    <link rel="icon" type="image" sizes="32x32" href="images/favicon-32x32.png"/>
    <link rel="stylesheet" type="text/css" href="css/main.css" />
    <link rel="stylesheet" type="text/css" href="css/tambahan.css" />
</head>
<body>
<header>
    <a class="title">JAMALGAMING</a>
</header>

<div class="row">
    <div class="col-12">
        <div class="card-newsletter">
            <div class="row">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="col-12 card-header">
                    <input type="hidden" name="id_tr" value="<?php echo trim($_GET["id_tr"]); ?>"/>
                    <h1>Are You Sure Delete This Data?</h1>
                    </div>
                    <div>
                        <input type="submit" value="Yes" class="input-submit3">
                        <a class="page-item" href="read1.php" class="input-submit">No</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<footer>
    <div class="contact">
        <h1>SOCIAL MEDIA</h1>
        <a href = "https://www.instagram.com/jamal_gaming22/" ><img src="images/ig.png" alt=""/></a>
        <a href = "https://wa.me/6287884541593" ><img src="images/WA2.png" alt=""/></a>
    </div>
</footer>
<div id="copyright">
    &copy;2022 JAMALGAMING
</div>
</body>
</html>
