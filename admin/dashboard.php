<?php
require_once('../db_connect.php');
require_once 'layout/_top.php';

try {
    // Initialize counts
    $total_user = $total_architect = $total_specialization = $total_appointments = 0;
    $monthly_appointments = array_fill(0, 12, 0); // Initialize an array for 12 months

    // Query untuk menghitung jumlah record dalam tabel user
    $user_result = mysqli_query($conn, "SELECT COUNT(*) FROM user");
    if ($user_result) {
        $total_user = mysqli_fetch_array($user_result)[0];
    }

    // Query untuk menghitung jumlah record dalam tabel architect
    $architect_result = mysqli_query($conn, "SELECT COUNT(*) FROM user WHERE role = 'architect'");
    if ($architect_result) {
        $total_architect = mysqli_fetch_array($architect_result)[0];
    }

    // Query untuk menghitung jumlah record dalam tabel specialization
    $specialization_result = mysqli_query($conn, "SELECT COUNT(*) FROM spesialis");
    if ($specialization_result) {
        $total_specialization = mysqli_fetch_array($specialization_result)[0];
    }

    // Query untuk menghitung jumlah record dalam tabel appointments
    $appointments_result = mysqli_query($conn, "SELECT COUNT(*) FROM appointments");
    if ($appointments_result) {
        $total_appointments = mysqli_fetch_array($appointments_result)[0];
    }

    // Query untuk menghitung jumlah appointment per bulan
    $januari = mysqli_query($conn, "SELECT COUNT(id) AS total FROM appointments WHERE MONTH(date) = 1");
    $januari = $januari->fetch_assoc();

    $februari = mysqli_query($conn, "SELECT COUNT(id) AS total FROM appointments WHERE MONTH(date) = 2");
    $februari = $februari->fetch_assoc();

    $maret = mysqli_query($conn, "SELECT COUNT(id) AS total FROM appointments WHERE MONTH(date) = 3");
    $maret = $maret->fetch_assoc();

    $april = mysqli_query($conn, "SELECT COUNT(id) AS total FROM appointments WHERE MONTH(date) = 4");
    $april = $april->fetch_assoc();
    
    $mei = mysqli_query($conn, "SELECT COUNT(id) AS total FROM appointments WHERE MONTH(date) = 5");
    $mei = $mei->fetch_assoc();
    
    $juni = mysqli_query($conn, "SELECT COUNT(id) AS total FROM appointments WHERE MONTH(date) = 6");
    $juni = $juni->fetch_assoc();
    
    $juli = mysqli_query($conn, "SELECT COUNT(id) AS total FROM appointments WHERE MONTH(date) = 7");
    $juli = $juli->fetch_assoc();
    
    $agustus = mysqli_query($conn, "SELECT COUNT(id) AS total FROM appointments WHERE MONTH(date) = 8");
    $agustus = $agustus->fetch_assoc();
    
    $september = mysqli_query($conn, "SELECT COUNT(id) AS total FROM appointments WHERE MONTH(date) = 9");
    $september = $september->fetch_assoc();
    
    $oktober = mysqli_query($conn, "SELECT COUNT(id) AS total FROM appointments WHERE MONTH(date) = 10");
    $oktober = $oktober->fetch_assoc();
    
    $november = mysqli_query($conn, "SELECT COUNT(id) AS total FROM appointments WHERE MONTH(date) = 11");
    $november = $november->fetch_assoc();
    
    $desember = mysqli_query($conn, "SELECT COUNT(id) AS total FROM appointments WHERE MONTH(date) = 12");
    $desember = $desember->fetch_assoc();
    

} catch (Exception $e) {
    // Menangkap kesalahan SQL dan menampilkan pesan kesalahan
    echo "SQL Error: " . $e->getMessage();
}
?>

<section class="section">
    <div class="section-header">
        <h1>Dashboard</h1>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <small>User</small>
                    </div>
                    <div class="card-body">
                        <?= $total_user ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                    <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <small>Architect</small>
                    </div>
                    <div class="card-body">
                        <?= $total_architect ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class="far fa-file"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <small>Specialization</small>
                    </div>
                    <div class="card-body">
                        <?= $total_specialization ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="far fa-newspaper"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <small>Appointments</small>
                    </div>
                    <div class="card-body">
                        <?= $total_appointments ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <div id="chart"></div>
    </div>
</section>

<?php
require_once 'layout/_bottom.php';
?>

<!-- Include ApexCharts -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    var options = {
      chart: {
        type: 'line',
        height: 350,
        stacked: false,
        toolbar: {
          show: false
        }
      },
      stroke: {
        curve: 'smooth'
      },
      series: [{
        name: 'Appointments',
        data: [
            <?= $januari['total'] ?>,
            <?= $februari['total'] ?>,
            <?= $maret['total'] ?>,
            <?= $april['total'] ?>,
            <?= $mei['total'] ?>,
            <?= $juni['total'] ?>,
            <?= $juli['total'] ?>,
            <?= $agustus['total'] ?>,
            <?= $september['total'] ?>,
            <?= $oktober['total'] ?>,
            <?= $november['total'] ?>,
            <?= $desember['total'] ?>,
        ]
      }],
      xaxis: {
        categories: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember']
      }
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();
  });
</script>
