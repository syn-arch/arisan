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
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-danger">
          <div class="box-header with-border">
            <div class="pull-left">
              <div class="box-title">
                <h4><?php echo $judul ?></h4>
              </div>
            </div>
          </div>
          <div class="box-body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped" cellspacing="0" width="100%" id="table-riwayat-penjualan">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Agen</th>
                    <th>Kelompok</th>
                    <th>Jenis</th>
                    <th>Total Bayar</th>
                    <th>Angsuran</th>
                    <th>Jumlah Bayar</th>
                    <th>Sisa Bayar</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if ($laporan[0]['faktur_penjualan']): ?>

                    <?php foreach ($laporan as $index => $row): ?>
                     <tr>
                      <td><?php echo $index += 1 ?></td>
                      <td><?php echo $row['tgl'] ?></td>
                      <td><?php echo $row['nama_karyawan'] ?></td>
                      <td><?php echo $row['nama_pelanggan'] ?></td>
                      <td><?php echo $row['jenis_paket'] ?></td>
                      <td><?php echo number_format($row['total_bayar']) ?></td>
                      <td><?php echo number_format($row['angsuran']) ?></td>
                      <td><?php 
                      $this->db->select('sum(nominal) as total');
                      $this->db->where('faktur_penjualan', $row['faktur_penjualan']);
                      $this->db->where('status_bayar', 'SUDAH BAYAR');
                      $cash = $this->db->get('pembayaran')->row()->total ?? 0;
                      echo number_format($cash);
                    ?></td>
                    <td><?php echo number_format($row['total_bayar'] - $cash) ?></td>
                    <?php if ($row['status'] == 'Lunas'): ?>
                      <td> <button class="btn btn-success"><?php echo $row['status'] ?></button></td>
                    <?php else: ?>
                      <td> <button class="btn btn-warning"><?php echo $row['status'] ?></button></td>
                    <?php endif ?>
                  </tr>
                <?php endforeach ?>
              <?php endif ?>

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</body>
</html>