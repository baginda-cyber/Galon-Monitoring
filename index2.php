<?php
  require("conn.php"); // memanggil file koneksi.php untuk koneksi ke database
?>

<!DOCTYPE html>
<html>
  <head>
  <meta http-equiv="refresh" content="10">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <title>Monitoring Suhu dan Kelembapan</title>
  </head>

    <body>
  
      <style>

        #wntable {
          border-collapse: collapse;
          width: 50%;
        }

        #wntable td, #wntable th {
          border: 1px solid #ddd;
          padding: 8px;
        }

        #wntable tr:nth-child(even){background-color: #f2f2f2;}

        #wntable tr:hover {background-color: #ddd;}

        #wntable th {
          padding-top: 12px;
          padding-bottom: 12px;
          text-align: left;
          background-color: #00A8A9;
          color: white;
        }
        /* Popup container */
}

/* Add animation (fade in the popup) */
@-webkit-keyframes fadeIn {
  from {opacity: 0;}
  to {opacity: 1;}
}

@keyframes fadeIn {
  from {opacity: 0;}
  to {opacity:1 ;}
}  

#box1{
        width:150px;
        height:150px;
        background:green;
        border:solid 3px black;
      }
      #box2{
        width:230px;
        height:230px;
        background:#ddd;
        border-radius: 8px;
        border:solid 3px black;
        float: left;
      }
      #box3{
        width:230px;
        height:230px;
        background:white;
        border-radius: 8px;
        border:solid 3px white;
        float: right;
      }
      
</style>

  <!--     <div id="cards" class="cards" align="left">
      Ini adalah Camera 1
      </div>
 -->

       <div id="cards" class="cards" align="center">

       <div id="box2">Ini adalah Camera 1</div>
        <div id="box3"></div>

        <h4>Cek Keadaan</h4>
          <table id="wntable">

          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Keadaan</th>
            <th>Waktu</th>
          </tr>

<?php

          $sql = mysqli_query($koneksi, "SELECT * FROM tbl_on ORDER BY id DESC");


   

          if(mysqli_num_rows($sql) == 0){ 
            echo '<tr><td colspan="14">Data Tidak Ada.</td></tr>'; // jika tidak ada entri di database maka tampilkan 'Data Tidak Ada.'
          }else{ // jika terdapat entri maka tampilkan datanya
            $no = 1; // mewakili data dari nomor 1
            while($row = mysqli_fetch_assoc($sql)){

             // fetch query yang sesuai ke dalam array


              echo '
              <tr>
                <td>'.$no.'</td>
                <td>'.$row['nama'].'</td>
                <td>'.$row['keadaan'].'</td>
                <td>'.$row['data_waktu'].'</td>
              </tr>
              ';
              $no++; // mewakili data kedua dan seterusnya
            }

            $nilai = $row['keadaan'];

          }
          ?>

          </table>
</div>
      <div id="cards" class="cards" align="center">
    
           
          <h1> Data Sensor Suhu</h1>
          
          <table id="wntable">
          <tr>
            <th>No</th>
            <th>Suhu</th>
            <th>Waktu</th>
          </tr>
          <?php

          $sql = mysqli_query($koneksi, "SELECT * FROM tbl_sensor ORDER BY id DESC");


   

          if(mysqli_num_rows($sql) == 0){ 
            echo '<tr><td colspan="14">Data Tidak Ada.</td></tr>'; // jika tidak ada entri di database maka tampilkan 'Data Tidak Ada.'
          }else{ // jika terdapat entri maka tampilkan datanya
            $no = 1; // mewakili data dari nomor 1
            while($row = mysqli_fetch_assoc($sql)){

             // fetch query yang sesuai ke dalam array


              echo '
              <tr>
                <td>'.$no.'</td>
                <td>'.$row['berat'].'</td>
                <td>'.$row['data_waktu'].'</td>
              </tr>
              ';
              $no++; // mewakili data kedua dan seterusnya
            }

            $nilai = $row['berat'];


             if ($nilai <= 1.00) 
    { 
    /*echo '<a href="index3.php"><button class="btn btn-danger"> Habis </button></a>' ;
*/
    }

          }
          ?>

        </table>
</div>

        <div id="cards" class="cards" align="center">
          <h1> Data Sensor Kelembapan</h1>
          
          <table id="wntable">
          <tr>
            <th>No</th>
            <th>Kelembapan</th>
            <th>Waktu</th>
          </tr>

<?php

          $sql = mysqli_query($koneksi, "SELECT * FROM tbl_humi ORDER BY id DESC");


   

          if(mysqli_num_rows($sql) == 0){ 
            echo '<tr><td colspan="14">Data Tidak Ada.</td></tr>'; // jika tidak ada entri di database maka tampilkan 'Data Tidak Ada.'
          }else{ // jika terdapat entri maka tampilkan datanya
            $no = 1; // mewakili data dari nomor 1
            while($row = mysqli_fetch_assoc($sql)){

             // fetch query yang sesuai ke dalam array


              echo '
              <tr>
                <td>'.$no.'</td>
                <td>'.$row['kelembapan'].'</td>
                <td>'.$row['data_waktu'].'</td>
              </tr>
              ';
              $no++; // mewakili data kedua dan seterusnya
            }

            $nilai = $row['kelembapan'];

          }
          ?>
      </table>
      </div>
      <div id="cards" class="cards" align="center">
          </div>
  </body>
</html>