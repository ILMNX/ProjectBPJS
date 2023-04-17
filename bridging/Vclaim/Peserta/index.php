<!DOCTYPE html>
<html lang="en">
<head>
  <title>Cek kepesertaan BPJS - CODE EXCLUSIVE</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>

  .animated_tab{
    float:left;
    width:100%;
    text-align:center;
    text-transform : uppercase;
    margin-bottom:50px; 
  }
  
  .animated_tab li{
    position:relative;
    display:inline-block; 
  }
  
  .animated_tab li a{
    display:block;
    color:#999999;
    padding:10px 15px;
    font-weight:bold;
    text-decoration: none ;
  }
  
  .animated_tab li.active a,
  .animated_tab li:hover a{
    color : #333333;
  }
  
  .animated_tab li.active:before,
  .animated_tab li:hover:before,
  .animated_tab li.active:after,
  .animated_tab li:hover:after{
    background-color: #7c4dff;
    position: absolute;
    width:55px; 
    height:2px;
  }
  
  .animated_tab li:before{
    content: "";
    transition: all 0.5s ease-in-out;
    top: 0px;
    right: 0px;
    width: 0px;
    
  }
  
  .animated_tab li:after {
    content: "";
    transition: all 0.5s ease-in-out;
    left: 0px;
    bottom: 0px;
    width: 0px;
    
  }
  
  .with_border {
    border: 1px solid rgba(0, 0, 0, 0.1);
    padding : 20px;
    margin : 10px;
  }
  
  
} 
</style>
</head>
<body>
  <div class="container">
    <p>&nbsp;</p>
    <h2 class="text-center" style="font-weight:bold;color:#7c4dff;">CEK KEPESERTAAN BPJS KESEHATAN </h2><h3>
    <h4 align="center" style="font-weight:bold;color:#7c4dff;"><b></b>  
      <h4 align="center" style="font-weight:bold;color:#7c4dff;"><b>Tanggal : <?php echo date ('d-m-Y') ?></b>  
    </h4>
    <br>
   <?php
   error_reporting(0); 
    $status = $_GET ['status']; 
    $rm     = $_GET ['rm_vc']; 
    $nama   = $_GET ['nama']; 
    $message= $_GET ['mes'];
    $kelas  = $_GET ['kelas'];

    if(isset($_GET['pesan']))
    {
      echo "<div class='login-box-body'>";
      if($_GET['pesan'] == "nokakurang")
      {
        echo "<div class='alert alert-danger alert-dismissable' align='center'>";
        echo "No BPJS tidak boleh kurang dari 13 digit";
        echo "</div>";
      }
      else if($_GET['pesan'] == "nikkurang")
      {
        echo "<div class='alert alert-danger alert-dismissable' align='center'>";
        echo "NIK tidak boleh kurang dari 16 digit";
        echo "</div>";
      }
      else if($_GET['pesan'] == "tidakaktif")
      {
        echo "<div class='alert alert-danger alert-dismissable' align='center'>";
        echo "Status Kepesertaan : <b>TIDAK AKTIF</b>, <br> Keterangan : <b>$status</b>";
        echo "</div>";
      }
      else if($_GET['pesan'] == "tidakada")
      {
        echo "<div class='alert alert-danger alert-dismissable' align='center'>";
        echo "<b>$message</b>";
        echo "</div>";
      }
      else if($_GET['pesan'] == "aktif")
      {
        echo "<div class='alert alert-success alert-dismissable' align='center'>";
        echo "No Rekam Medis     : <b>$rm</b><br>";
        echo "Nama Lengkap       : <b>$nama</b><br>";
        echo "Status Kepesertaan : <b>AKTIF</b><br>";
        echo "Jatah Kelas        : <b>$kelas</b>";
        echo "</div>";
      }
      echo "</div>";
    }
    else
    {
      echo "<p align='center'>Cari Bukti Sesuai Pilihan :</p><br>";
    }
  ?>    
    <ul class="animated_tab">
      <li class="active"><a href="#1a"  data-toggle="tab">NIK</a></li>
      <li><a href="#2a"  data-toggle="tab">No. BPJS</a></li>
    </ul>
    <div class="tab-content clearfix">
    <br><br><br>
      <div class="tab-pane active" id="1a">
        <div class="row">
          <div class="col-md-12">
            <div class="with_border">
              Masukan <b>NIK</b> Anda :
              <br><br>
                <form action="proses_nik.php" method="GET">
                  <input type="text" name="tnik" maxlength="16" placeholder="0000000000000000" required>
                  <input type="submit" value="PROSES" class="btn btn-success btn-sm" name="bnik">
                </form>
            </div>  
          </div>          
        </div>
      </div>

      <div class="tab-pane" id="2a">
        <div class="row">
          <div class="col-md-12">
            <div class="with_border">
              Masukan <b>NOMOR BPJS</b> Anda :
              <form action="proses_nobpjs.php" method="GET"><br>
                <input type="text" name="tnobpjs" maxlength="13" placeholder="0000000000000" required>
                <input type="submit" value="PROSES" class="btn btn-warning btn-sm" name="bnobpjs">
              </form>
            </div>  
          </div>          
        </div>
      </div>
    </div>
    <p align="center">Copy Right &copy 2022. Allright Reserved<br>  Dibuat Dan dikembangkan oleh Code Exclusive<br><b>www.code-exclusive.com</b></p>
  </div> 
</body>
</html>