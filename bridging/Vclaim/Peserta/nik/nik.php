<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS"
    crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr"
    crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <title>Cek Data NIK</title>
</head>
<body>
<H1 class="display-5">Jadwal</h1>
        <hr>
    <div class="container"><br>
    
    <table border="1" class="table table-borderless table-dark">
        <thead class="thead-dark">
            <tr>
            
                <th class="text-center">Nama</th>
                <th class="text-center">NOMOR KARTU</th>
                <th class="text-center">NIK</th>
                <th class="text-center">Tanggal Lahir</th>
                <th class="text-center">HAPUS</th>

               
            </tr>
        </thead>

    <?php
    $koneksi = new PDO("mysql:host=localhost;dbname=bridgingbpjs_db", 'root','');//menghubungkan aplikasi dengan database


    $data_nik = $koneksi->query("SELECT * FROM tb_nik");//mengambil semua field di tabel kegiatan
    while ($data= $data_nik->fetch(PDO::FETCH_ASSOC)){
        echo "<tr>
            <td>$data[nama]</td>
            <td>$data[noKartu]</td>
            <td>$data[nik]</td>
            <td>$data[tglLahir]</td>
            
    
            <td> 
                 <a href='deletenik.php?id=$data[id]' class='btn btn-danger' onclick='return confirm(\"apakah anda yakin?\")'>Hapus<a/>
            </td>

        </tr>";
        
    }
            ?>
        
        </table>

        <a href="nik-respon.php"> Kembali </a>
    
        <section>
            <div class="container">
            <div class="row">
                    <div class="col-md-12">
            <br>
            
    </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
    </html>