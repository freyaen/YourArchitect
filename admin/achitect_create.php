<?php
require_once 'layout/_top.php';
require_once '../db_connect.php';

$spesialis = $conn->query('SELECT * FROM spesialis');
?>

<section class="section">
  <div class="section-header d-flex justify-content-between">
    <h1>Tambah Arsitek</h1>
    <a href="./architect.php" class="btn btn-light">Kembali</a>
  </div>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <!-- Form -->
          <form action="./architect_store.php" method="POST">
            <table cellpadding="8" class="w-100">

              <tr>
                <td>Nama</td>
                <td><input class="form-control" type="text" name="nama" size="20" required></td>
              </tr>

              <tr>
                <td>Alamat</td>
                <td colspan="3"><textarea class="form-control" name="alamat" id="alamat" required></textarea></td>
              </tr>

              <tr>
                <td>Email</td>
                <td><input class="form-control" type="email" name="email" size="20" required></td>
              </tr>

              <tr>
                <td>No HP</td>
                <td><input class="form-control" type="text" name="no_hp" size="20" required></td>
              </tr>

              <tr>
                <td>Password</td>
                <td><input class="form-control" type="password" name="password" size="20" required></td>
              </tr>

              <tr>
                <td>Spesialis</td>
                <td>
                  <select name="id_spesialis" class="form-control" id="id_spesialis" required>
                    <option selected disabled>Pilih Spesialis</option>
                    <?php while($row = mysqli_fetch_assoc($spesialis)) : ?>
                    <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                    <?php endwhile;?>
                  </select>
                </td>
              </tr>

              <tr>
                <td>
                  <input class="btn btn-primary" type="submit" name="proses" value="Simpan">
                    <a  href="architect.php" class="btn btn-danger">Batal</a>
                </td>
              </tr>

            </table>
          </form>
        </div>
      </div>
    </div>
</section>

<?php
require_once 'layout/_bottom.php';
?>