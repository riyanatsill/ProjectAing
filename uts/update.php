<?php
require_once "config.php";
$nama = $tgl = $product = $harga ="";
$nama_err = $tgl_err = $product_err = $harga_err ="";
if (isset($_POST["id_tr"]) && !empty($_POST["id_tr"])){
    $id_tr = $_POST["id_tr"];
    $input_nama = trim($_POST["nama"]);
    if (empty($input_nama)){
        $nama_err = "Please Enter A Valid Username!";
    } elseif (!filter_var($input_nama, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $nama_err = "Please Enter A Valid Username!";
    } else{
        $nama = $input_nama;
    }

    $input_tgl = trim($_POST["tgl"]);
    if (empty($input_tgl)){
        $tgl_err = "Please Enter The tgl!";
    } else{
        $tgl = $input_tgl;
    }

    $input_product = trim($_POST["product"]);
    if (empty($input_product)){
        @$product_err = "Please Choose the Product!";
    } else{
        $product = $input_product;
    }

    $input_harga = trim($_POST["harga"]);
    if (empty($input_harga)){
        @$harga_err = "Please Choose the harga!";
    } else{
        $harga = $input_harga;
    }


    if (empty($nama_err) && empty($tgl_err) && empty($product_err) && empty($harga_err)) {
        $sql = "UPDATE produk SET nama=?, tgl=?, product=?, harga=? WHERE id_tr=?";

        if ($stmt = mysqli_prepare($con, $sql)) {
            mysqli_stmt_bind_param($stmt, "sssii", $param_nama, $param_tgl, $param_product, $param_harga, $param_id_tr);
            $param_nama = $nama;
            $param_tgl = $tgl;
            $param_product = $product;
            $param_harga = $harga;
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
        $sql = "SELECT * FROM produk WHERE id_tr = ?";
        if ($stmt = mysqli_prepare($con, $sql)){
            mysqli_stmt_bind_param($stmt, "i", $param_id_tr);
            $param_id_tr = $id_tr;
            if (mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
                if (mysqli_num_rows($result) == 1){
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    $nama = $row["nama"];
                    $tgl = $row["tgl"];
                    $product = $row["product"];
                    $harga = $row["harga"];
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
            <input type="text" name="nama" value="<?php echo $nama; ?>" class="input-submit" onkeydown="return /[a-z]/i.test(event.key)" required="true">
            <span><?php echo $nama_err;?></span>
            <p>ID</p>
            <input type="date" name="tgl" value="<?php echo $tgl; ?>" class="input-submit" required="true"/>
        </div>
    </div>

    <div class="col-12" id="data2">
        <div class="row background-data">
                <div class="row">
                    <h2>Nama Barang</h2>
                    <input type="text" name="product" value="<?php echo $product; ?>" class="input-submit" required="true"/>
                </div>
        </div>
    </div>

    <div class="col-12" id="data3">
        <div class="row background-data">
            <h2>Harga</h2>
            <div class="col-12">
                <select class="input-submit" name="harga">
                    <option value = "10000">Rp.10.000</option>
                    <option value = "50000">Rp.50.000</option>
                    <option value = "100000">Rp.100.000</option>
                    <option value = "150000">Rp.150.000</option>
                    <option value = "200000">Rp.200.000</option>
                    <option value = "250000">Rp.250.000</option>
                    <option value = "300000">Rp.300.000</option>
                    <option value = "350000">Rp.350.000</option>
                    <option value = "500000">Rp.500.000</option>
                    <option value = "1000000">Rp.1.000.000</option>
                    <option value = "3000000">Rp.3.000.000</option>
                    <option value = "5000000">Rp.5.000.000</option>
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
