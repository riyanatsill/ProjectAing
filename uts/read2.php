<?php
if(isset($_GET["id_tr"]) && !empty(trim($_GET["id_tr"]))){
    require_once "config.php";
    $sql = "SELECT nama,tgl,product,harga FROM produk WHERE id_tr = ?";

    if($stmt = mysqli_prepare($con,$sql)){
        mysqli_stmt_bind_param($stmt, "i", $param_id_tr);
        $param_id_tr = trim($_GET["id_tr"]);
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
            if(mysqli_num_rows($result) == 1){
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                $nama = $row["nama"];
                $nim = $row["tgl"];
                $tugas = $row["product"];
                $uts = $row["harga"];
            } else{
                header("location: error.php");
                exit();
            }

        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    mysqli_stmt_close($stmt);
    mysqli_close($con);
} else{
    header("location: error.php");
    exit();
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail Produk</title>
    <link rel="stylesheet" type="text/css" href="css/main.css" />
    <link rel="stylesheet" type="text/css" href="css/tambahan.css" />
</head>
<body>
<header>
    <nav>
        <ul>
            <p><a href= "home.php">HOME</a></p>
        </ul>
    </nav>
</header>
<div>
    <h1 class="contact">Detail Produk</h1>
    <div class="row background-data2">
        <div class="col-12">
            <table>
                <thead>
                <tr>
                    <th>Nama Penjual</th>
                    <th>Tanggal Penjualan</th>
                    <th>Product</th>
                    <th>harga</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><?php echo $row["nama"]; ?></td>
                    <td><?php echo $row["tgl"]; ?></td>
                    <td><?php echo $row["product"]; ?></td>
                    <td><?php echo $row["harga"]; ?></td>
                </tr>
                </tbody>
            </table>
            <p><a class="page-item" href="read1.php" class="input-submit2">Back</a></p>
        </div>
    </div>
</div>
</body>
</html>
