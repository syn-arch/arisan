<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="base_url" content="<?php echo base_url() ?>">
  <title><?php echo $judul ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo base_url('vendor/lte/') ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="icon" href="<?php echo base_url('assets/img/favicon.png') ?>" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('vendor/lte/') ?>bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url('vendor/lte/') ?>bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url('vendor/lte/') ?>bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url('vendor/lte/') ?>bower_components/select2/dist/css/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('vendor/lte/') ?>dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo base_url('vendor/lte/') ?>dist/css/skins/skin-red.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body onload="window.print()">
  <div class="container">
    <div class="box box-danger">
      <div class="box-header with-border">
        <div class="pull-left">
          <h4 class="box-title"><?php echo $judul ?></h4>
        </div>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-lg-12">
            <div class="table-responsive">
              <table class="table datatable">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Kode</th>
                    <th>Barcode</th>
                    <th>Nama Barang</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                  </tr>
                </thead>
                <tbody>

                  <?php $no=1; foreach ($laporan as $row): ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['id_barang'] ?></td>
                    <td><?= $row['barcode'] ?></td>
                    <td><?= $row['nama_barang'] ?></td>
                    <td><?= "Rp. " . number_format($row['harga_pokok']) ?></td>
                    <td><?= $row['barang_terbeli'] ?></td>
                    <td><?= "Rp. " . number_format($row['total']) ?></td>
                  </tr>
                <?php endforeach ?>

              </tbody>
              <tfoot>
                <tr>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th>Total Pembelian</th>
                  <th><?= "Rp. " . number_format($total_pembelian) ?></th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>