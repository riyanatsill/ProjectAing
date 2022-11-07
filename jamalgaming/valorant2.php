<?php
require_once "config.php";
$ign = $userID = $product = $payment ="";
$ign_err = $userID_err = $product_err = $payment_err ="";
if (isset($_POST["id_tr"]) && !empty($_POST["id_tr"])){
    $id_tr = $_POST["id_tr"];
    $input_ign = trim($_POST["ign"]);
    if (empty($input_ign)){
        $ign_err = "Please Enter A Valid Username!";
    } elseif (!filter_var($input_ign, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $ign_err = "Please Enter A Valid Username!";
    } else{
        $ign = $input_ign;
    }

    $input_userID = trim($_POST["userID"]);
    if (empty($input_userID)){
        $userID_err = "Please Enter The UserID!";
    } elseif (!ctype_digit($input_userID)){
        $userID_err = "Please Enter Integer UserID";
    } else{
        $userID = $input_userID;
    }

    $input_product = trim($_POST["product"]);
    if (empty($input_product)){
        @$product_err = "Please Choose the Product!";
    } else{
        $product = $input_product;
    }

    $input_payment = trim($_POST["payment"]);
    if (empty($input_payment)){
        @$payment_err = "Please Choose the Payment!";
    } else{
        $payment = $input_payment;
    }


    if (empty($ign_err) && empty($userID_err) && empty($product_err) && empty($payment_err)) {
        $sql = "UPDATE transaction SET ign=?, userID=?, product=?, payment=? WHERE id_tr=?";

        if ($stmt = mysqli_prepare($con, $sql)) {
            mysqli_stmt_bind_param($stmt, "sissi", $param_ign, $param_userID, $param_product, $param_payment, $param_id_tr);
            $param_ign = $ign;
            $param_userID = $userID;
            $param_product = $product;
            $param_payment = $payment;
            $param_id_tr = $id_tr;
            if (mysqli_stmt_execute($stmt)) {
                header("location: success.php");
                exit();
            } else {
                echo "Something Went Wrong. Please Try Again Later.";
            }
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($con);
} else{
    if (isset($_GET["id_tr"]) && !empty(trim($_GET["id_tr"]))){
        $id_tr = trim($_GET["id_tr"]);
        $sql = "SELECT * FROM transaction WHERE id_tr = ?";
        if ($stmt = mysqli_prepare($con, $sql)){
            mysqli_stmt_bind_param($stmt, "i", $param_id_tr);
            $param_id_tr = $id_tr;
            if (mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
                if (mysqli_num_rows($result) == 1){
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    $ign = $row["ign"];
                    $userID = $row["userID"];
                    $product = $row["product"];
                    $payment = $row["payment"];
                } else{
                    header("location: error.php");
                    exit();
                }
            } else{
                echo "Oops! Something Went Wrong. Please Try Again Later.";
            }
        }
        mysqli_stmt_close($stmt);
        mysqli_close($con);
    } else{
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
    <title>Valorant</title>
    <link rel="stylesheet" type="text/css" href="css/main.css" />
    <link rel="stylesheet" type="text/css" href="css/tambahan.css" />
    <link rel="icon" type="image" sizes="32x32" href="images/favicon-32x32.png"/>
</head>
<body>
<header>
    <a href="home.php" class="title">JAMALGAMING</a>
    <nav>
        <ul>
            <p><a href="#data1">Data Akun</a></p>
            <p><a href="#data2">Pilihan</a></p>
            <p><a href="#data3">Pembayaran</a></p>
        </ul>
    </nav>
</header>

<div class="card-image">
    <div class="row">
        <img src="images/HD1.jpeg" alt=""/>
    </div>

</div>
<div class="row">
    <div class="col-12">
        <h1>Valorant</h1>
        <p>Top up VALORANT Points hanya dalam hitungan detik!</p>
        <p>Cukup masukan Username dan ID Riot Anda, pilih jumlah Points yang Anda inginkan, selesaikan pembayaran, dan Poin akan secara langsung ditambahkan ke akun VALORANT Anda.</p>
        <p>Unduh dan mainkan VALORANT sekarang!</p>
    </div>
</div>
<form action="<?php echo htmlspecialchars(basename($_SERVER["REQUEST_URI"])); ?>" method="post">
    <div id="data1" class="row">
        <div class="col-12 background-data">
            <h1>Masukan Data Anda</h1>
            <p>Username</p>
            <input type="text" name="ign" value="<?php echo $ign; ?>" class="input-submit" onkeydown="return /[a-z]/i.test(event.key)" required="true">
            <span><?php echo $ign_err;?></span>
            <p>ID</p>
            <input type="text" name="userID" value="<?php echo $userID; ?>" class="input-submit" required="true"/>
        </div>
    </div>

    <div class="col-12" id="data2">
        <div class="row background-data">
            <h2>Pilihan Anda</h2>
            <div class="col-12 ">
                <div class="row">
                    <div class="col-3 border-pilihan">
                        <label>
                            <img src="images/VP3.png"/>
                            <p>100VP 10k</p>
                        </label>
                    </div>
                    <div class="col-3 border-pilihan">
                        <label>
                            <img src="images/VP3.png"/>
                            <p>250VP 25k</p>
                        </label>
                    </div>
                    <div class="col-3 border-pilihan">
                        <label>
                            <img src="images/VP3.png"/>
                            <p>500VP 50k</p>
                        </label>
                    </div>
                    <div class="col-3 border-pilihan">
                        <label>
                            <img src="images/VP3.png"/>
                            <p>780VP 78k</p>
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="row">
                    <div class="col-3 border-pilihan">
                        <label>
                            <img src="images/VP3.png"/>
                            <p>1500VP 150K</p>
                        </label>
                    </div>
                    <div class="col-3 border-pilihan">
                        <label>
                            <img src="images/VP3.png"/>
                            <p>2100VP 210K</p>
                        </label>
                    </div>
                    <div class="col-3 border-pilihan">
                        <label>
                            <img src="images/VP3.png"/>
                            <p>2700VP 270K</p>
                        </label>
                    </div>
                    <div class="col-3 border-pilihan">
                        <label>
                            <img src="images/VP3.png"/>
                            <p>3500VP 350K</p>
                        </label>
                    </div>
                    <select class="input-submit" name="product">
                        <option value = "100VP">100VP</option>
                        <option value = "250VP">250VP</option>
                        <option value = "500VP">500VP</option>
                        <option value = "780VP">780VP</option>
                        <option value = "1500VP">1500VP</option>
                        <option value = "2100VP">2100VP</option>
                        <option value = "2700VP">2700VP</option>
                        <option value = "3500VP">3500VP</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12" id="data3">
        <div class="row background-data">
            <h2>Pembayaran</h2>
            <div class="col-12">
                <div class="col-6">
                    <div class="row wkwk">
                        <label>
                            <img src="images/BCA3.png"/>
                        </label>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row wkwk">
                        <label>
                            <img src="images/Gopay1.png"/>
                        </label>
                    </div>
                </div>
                <select class="input-submit" name="payment">
                    <option value = "BCA">BCA</option>
                    <option value = "GOPAY">GOPAY</option>
                </select>
                <input type="hidden" name="id_tr" value="<?php echo $id_tr; ?>"/>
                <input type="submit" class="input-submit" value="Submit">
            </div>
        </div>
    </div>
</form>

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
