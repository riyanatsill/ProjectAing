<?php require "config.php" ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>List Produk</title>
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
    <h1 class="contact">List Produk</h1>
    <div class="row background-data2">
        <div class="col-12">
            <div class="col-6">
                <form method="get">
                <div>
                    <input type="search" name="search" id="form1" placeholder="Searching History"/>
                    <input type="submit" value="Search">
                </div>
                </form>
            </div>
            <table>
                <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Penjual</th>
                    <th>Produk</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $batas = 2;
                $halaman = @$_GET['halaman'];
                if(empty($halaman)){
                    $posisi = 0;
                    $halaman = 1;
                }
                else{
                    $posisi = ($halaman-1) * $batas;
                }
                if(isset($_GET['search'])){
                    $search = $_GET['search'];
                    $sql="SELECT * from produk WHERE nama LIKE '%$search%' order by id_tr Asc limit $posisi, $batas";
                }else{
                    $sql="SELECT * from produk order by id_tr Asc limit $posisi,$batas";
                }

                $hasil=mysqli_query($con, $sql);
                while ($data = mysqli_fetch_array($hasil)){
                ?>
                <tr>
                    <td><?= ($data['id_tr']) ?></td>
                    <td><?= ($data['nama']) ?></td>
                    <td><?= ($data['product']) ?></td>
                    <td>
                        <form>
                            <a class="page-item" href="read2.php?id_tr=<?= $data['id_tr'] ?>">Read</a>
                        </form>
                        <form>
                            <a class="page-item" href="update.php?id_tr=<?= $data['id_tr'] ?>">Update</a>
                        </form>
                        <form>
                            <a class="page-item" href="delete.php?id_tr=<?= $data['id_tr'] ?>">Delete</a>
                        </form>
                    </td>
                    <?php }
                    ?>
                </tr>
                <?php
                if(isset($_GET['search'])){
                    $search = $_GET['search'];
                    $query2 = "SELECT * from produk WHERE nama LIKE '%$search%' order by id_tr Desc";
                }else{
                    $query2 = "SELECT * from produk order by id_tr Desc";
                }
                $result2 = mysqli_query($con, $query2);
                $jmldata = mysqli_num_rows($result2);
                $jmlhalaman = ceil($jmldata/$batas);
                ?>
                </tbody>
            </table>
            <nav>
                <ul>
                    <?php
                    for($i=1;$i<=$jmlhalaman;$i++){
                        if ($i !=$halaman){
                            if(isset($_GET['search'])){
                                $search = $_GET['search'];
                                echo "<a class='page-item' href='history.php?halaman=$i&search=$search'>$i</a>";
                            }else{
                                echo "<a class='page-item' href='history.php?halaman=$i'>$i</a>";
                            }

                        }else{
                            echo "<a  class='page-item' href='#'>$i</a>";
                        }
                    }
                    ?>
                </ul>
            </nav>
        </div>
    </div>
</div>
</body>
</html>