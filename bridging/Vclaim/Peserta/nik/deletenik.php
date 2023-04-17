<?php

    $id = $_GET['id']; //mendapatkan ID

    //echo $id; //untuk mencetak variabel ID

    $koneksi = new PDO("mysql:host=localhost;dbname=bridgingbpjs_db", 'root','');

    $koneksi->query("DELETE FROM tb_nik WHERE id='$id'");//memberikan perintah ke query utk menghapus data sesuai id nya

    header("Location: nik.php"); //untuk berpindah halaman/file //utk berpindah halaman/file data.php
?>