<?php
require_once 'layout/_top.php';
require_once '../db_connect.php';

$id_user = $_GET['id_user'];
$query = mysqli_query($conn, "SELECT * FROM user WHERE id_user='$id_user'");
$spesialis = $conn->query('SELECT * FROM spesialis');

?>

<section class="section">
  <div class="section-header d-flex justify-content-between">
    <h1>Ubah Data Arsitek</h1>
    <a href="./architect.php" class="btn btn-light">Kembali</a>
  </div>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <!-- Form -->
          <form action="./architect_update.php" method="post">
            <?php
            while ($row = mysqli_fetch_array($query)) {
            ?>
              <input type="hidden" name="id_user" value="<?= $row['id_user'] ?>">
              <table cellpadding="8" class="w-100">
                <tr>
                  <td>Nama</td>
                  <td><input class="form-control" type="text" name="nama" size="20" required value="<?= $row['nama'] ?>"></td>
                </tr>
                <tr>
                  <td>Alamat</td>
                  <td colspan="3"><textarea class="form-control" name="alamat" id="alamat" required><?= $row['alamat'] ?></textarea></td>
                </tr>
                <tr>
                  <td>Email</td>
                  <td><input class="form-control" type="email" name="email" size="20" required value="<?= $row['email'] ?>"></td>
                </tr>
                <tr>
                  <td>No HP</td>
                  <td><input class="form-control" type="text" name="no_hp" size="20" required value="<?= $row['no_hp'] ?>"></td>
                </tr>
                <tr>
                  <td>Spesialis</td>
                  <td>
                  <select name="id_spesialis" class="form-control" id="id_spesialis" required>
                    <option selected disabled>Pilih Spesialis</option>
                    <?php while($row = mysqli_fetch_assoc($spesialis)) : ?>
                    <option  value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                    <?php endwhile;?>
                  </select>
                  </td>
                </tr>
                <tr>
                  <td>
                    <input class="btn btn-primary d-inline" type="submit" name="proses" value="Ubah">
                    <a  href="architect.php" class="btn btn-danger">Batal</a>
                    <td>
                </tr>
              </table>
            <?php } ?>
          </form>
        </div>
      </div>
    </div>
</section>

<?php
require_once 'layout/_bottom.php';
?>
