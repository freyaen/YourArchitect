<?php 
session_start();
require_once('db_connect.php');

if(!isset($_SESSION['logged']) && !$_SESSION['logged']){
  header("Location: login.php");
}

$id_user = $_SESSION['id_user'];

$appointments = $conn->query("SELECT * FROM appointments LEFT JOIN user ON user.id_user = appointments.id_arsitek LEFT JOIN reports ON reports.appointment_id = appointments.id WHERE appointments.id_user = $id_user");

if(isset($_GET['bayar']) && $_GET['bayar']){
  echo "<script>confirm('Pembayaran berhasil')</script>";
  // header('Location: riwayat_appointment.php');
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Riwayat Appointment</title>
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
      /* Warna latar belakang */
    }

    .container {
      max-width: 800px;
      /* Lebar maksimum kontainer */
      margin: 50px auto;
      /* Posisi kontainer di tengah halaman */
      background: #ffffff;
      /* Warna latar belakang kontainer */
      padding: 30px;
      /* Padding di dalam kontainer */
      border-radius: 10px;
      /* Melengkungkan sudut kontainer */
      box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
      /* Efek bayangan */
    }

    .table {
      width: 100%;
      /* Lebar tabel 100% dari kontainer */
      margin-top: 20px;
      /* Jarak antara tabel dengan kontainer */
    }

    .table th,
    .table td {
      text-align: center;
      /* Posisi teks dalam sel ke tengah */
      vertical-align: middle;
      /* Posisi vertikal ke tengah */
    }

    .table th {
      background-color: #007bff;
      /* Warna latar belakang header */
      color: #ffffff;
      /* Warna teks header */
    }

    .btn-back-home {
      margin-top: 20px;
      margin-right: 10px;
    }

    .btn-create-appointment {
      margin-top: 20px;
    }
  </style>
</head>

<body>

  <div class="container">
    <h2>Riwayat Appointment</h2>

    <table class="table table-bordered">
      <thead>
        <tr>
          <th>No</th>
          <th>Arsitek</th>
          <th>Tanggal Appointment</th>
          <th>Pesan</th>
          <th>Zoom</th>
          <th>Laporan</th>
          <th>Status</th>
          <th>Pembayaran</th>
        </tr>
      </thead>
      <tbody>
        <?php
      if ($appointments->num_rows > 0) {
          $count = 1;
          // Output data dari setiap baris hasil query
          while ($row = mysqli_fetch_assoc($appointments)) {
            $catatan = !empty($row['catatan']) ? $row['catatan'] : '-';
            $lampiran = !empty($row['lampiran']) ? "<a href='architect/{$row['lampiran']}' target='_blank'>Lihat Lampiran</a>" : '';
            $item = json_encode($row);
            $link = !empty($row['link']) ? '<a href="' . $row['link'] . '" target="_blank">Gabung</a>' : '-';

            echo "<tr>";
            echo "<td>{$count}</td>";
            echo "<td>{$row['nama']}</td>";
            echo "<td>{$row['date']}</td>";
            echo "<td>{$row['message']}</td>";
            echo "<td>$link</td>";
            echo "<td>
                    <p>{$catatan}</p>
                    {$lampiran}
                  </td>";
            echo "<td>{$row['status']}</td>";
            echo "<td><button class='btn btn-primary btn-payment' data-item='$item'>Bayar</button></td>";
            echo "</tr>";
            $count++;
        }
      } else {
          echo "<tr><td colspan='5'>Belum ada riwayat appointment.</td></tr>";
      }

      // Menutup koneksi database
      $conn->close();
      ?>
      </tbody>
    </table>

    <a href="index.php" class="btn btn-primary btn-back-home">Kembali ke Home</a>

  </div>

  <div id="paymentModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Ringkasan Pembayaran</h5>
        </div>
        <div class="modal-body">
          <h5 id="arsitek">Arsitek</h5>
          <p id="date" class="text-secondary">Tanggal</p>
          <hr>
          <div class="d-flex justify-content-between align-items-center">
            <p>Biaya</p>
            <p class="fw-bold">Rp. 50.000</p>
          </div>
          <div class="d-flex justify-content-between align-items-center">
            <p>Biaya Layanan</p>
            <p class="fw-bold">Rp. 2.000</p>
          </div>
          <div class="d-flex justify-content-between align-items-center">
            <p>Kupon Diskon</p>
            <p class="fw-bold">Rp. -1.000</p>
          </div>
          <div class="d-flex justify-content-between align-items-center">
            <p>Total Pembayaran</p>
            <p class="fw-bold">Rp. 51.000</p>
          </div>
          <hr>
          <h4>Metode Pembayaran</h4>
          <div class="d-flex justify-content-between align-items-center">
            <img src="img/GoPay.png" width="70" alt="Gopay">
            <input type="radio" name="payment">
          </div>
          <div class="d-flex justify-content-between align-items-center">
            <img src="img/ovo.png" width="50" alt="Ovo">
            <input type="radio" name="payment">
          </div>
          <div class="d-flex justify-content-between align-items-center">
            <img src="img/spay.png" width="70" alt="Spay">
            <input type="radio" name="payment">
          </div>
        </div>
        <div class="modal-footer d-flex justify-content-between align-items-center">
          <p>Total Pembayaran : Rp. 51.000</p>
          <a href="?bayar=true" class="btn btn-primary">Bayar & Konfirmasi</a>
        </div>
      </div>
    </div>
  </div>

  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="architect/libs/bower/jquery/dist/jquery.js"></script>
  <script>
    $('.btn-payment').click(function () {
				var item = $(this).data('item');
				$('#paymentModal').modal('show');
        $('#arsitek').text(item.nama);
        $('#date').text(item.date);
			});
  </script>
</body>

</html>