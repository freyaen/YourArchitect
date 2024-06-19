<?php
require_once '../db_connect.php';
require_once 'layout/_top.php';

$result = mysqli_query($conn, "SELECT appointments.*, appointments.id AS id_appointment, user.* FROM appointments LEFT JOIN user USING(id_user) LEFT JOIN reports ON reports.appointment_id = appointments.id");

?>

<section class="section">
  <div class="section-header d-flex justify-content-between">
    <h1>Riwayat Appointment</h1>
    <div class="btn-group" role="group" aria-label="Export buttons">
      <a href="export_pdf.php" class="btn btn-danger mr-3">Export to PDF</a>
      <a href="export_excel.php" class="btn btn-success">Export to Excel</a>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-hover table-striped w-100" id="table-1">
              <thead>
                <tr class="text-center">
                  <th>No</th>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Date</th>
                  <th>Message</th>
                  <th>Status</th>
                  <th>Laporan</th>
                  <th>Link Zoom</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                while ($data = mysqli_fetch_array($result)) :
                  $link = !empty($data['link']) ? '<a href="' . $data['link'] . '" target="_blank">Gabung</a>' : '-';
                  $catatan = !empty($data['catatan']) ? $data['catatan'] : '-';
                  $lampiran = !empty($data['lampiran']) ? "<a href='../architect/{$data['lampiran']}' target='_blank'>Lihat Lampiran</a>" : '';
                  $id = $data['id'];
                ?>
                <tr class="text-center">
                  <td><?= $no ?></td>
                  <td><?= $data['nama'] ?></td>
                  <td><?= $data['email'] ?></td>
                  <td><?= $data['no_hp'] ?></td>
                  <td><?= $data['date'] ?></td>
                  <td><?= $data['message'] ?></td>
                  <td>
                    <?php
                    if ($data['status'] == 'approved') {
                      echo '<span class="badge badge-success">Approved</span>';
                    } elseif ($data['status'] == 'cancelled') {
                      echo '<span class="badge badge-danger">Cancelled</span>';
                    } else {
                      echo '<span class="badge badge-secondary">' . ucfirst($data['status']) . '</span>';
                    }
                    ?>
                  </td>
                  <td>
                    <p><?= $catatan ?></p>
                    <?= $lampiran ?>
                  </td>
                  <td>
                    <?= $link ?>
                    <button class="btn btn-primary btn-zoom" data-id="<?= $data['id_appointment']?>">Edit</button>
                  </td>
                </tr>
                <?php
                  $no++;
                endwhile;
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div id="zoomModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Link Zoom</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="zoomForm" enctype="multipart/form-data">
          <input type="hidden" name="appointment_id" id="appointment_id">
          <div class="form-group">
            <label for="link">Link</label>
            <input type="text" class="form-control" id="link" name="link">
          </div>
          <button type="submit" class="btn btn-primary">Buat Link</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php
require_once 'layout/_bottom.php';
?>

<?php
if (isset($_SESSION['info'])) {
  if ($_SESSION['info']['status'] == 'success') {
?>
<script>
  iziToast.success({
    title: 'Sukses',
    message: `<?= $_SESSION['info']['message'] ?>`,
    position: 'topCenter',
    timeout: 5000
  });
</script>
<?php
  } else {
?>
<script>
  iziToast.error({
    title: 'Gagal',
    message: `<?= $_SESSION['info']['message'] ?>`,
    timeout: 5000,
    position: 'topCenter'
  });
</script>
<?php
  }
  unset($_SESSION['info']);
}
?>
<script>
  $('.btn-zoom').click(function () {
    var id = $(this).data('id');
    console.log($(this));
    $('#appointment_id').val(id);
    $('#zoomModal').modal('show');
  });

  $('#zoomForm').submit(function (event) {
    event.preventDefault();

    $.ajax({
      url: 'submit_zoom.php',
      type: 'POST',
      data: {
        appointment_id: $('#appointment_id').val(),
        link: $('#link').val()
      },
      success: function (response) {
        var res = JSON.parse(response);
        if (res.success) {
          $('#zoomModal').modal('hide');
          location.reload();
        } else {
          alert('Error: ' + res.error);
        }
      },
      error: function () {
        alert('An error occurred. Please try again.');
      }
    });
  });
</script>
<script src="../assets/js/page/modules-datatables.js"></script>
