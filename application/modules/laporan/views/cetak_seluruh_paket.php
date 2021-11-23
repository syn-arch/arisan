<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="base_url" content="<?php echo base_url() ?>">
  <title><?php echo $judul ?></title>
  <!-- Tell the browser to be a to screen width -->
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
            <?php if ($this->uri->segment(3)): ?>

              <?php if ($this->uri->segment(6) != 'semua'): ?>
                <div class="row">
                  <div class="col-md-6">
                    <table class="table">
                      <tr>
                        <td>Nama</td>
                        <td><?php echo $agen['nama_karyawan'] ?></td>
                      </tr>
                      <tr>
                        <td>Alamat</td>
                        <td><?php echo $agen['alamat'] ?></td>
                      </tr>
                      <tr>
                        <td>Telepon</td>
                        <td><?php echo $agen['telepon'] ?></td>
                      </tr>
                    </table>
                  </div>
                </div>
              <?php endif ?>

              <?php if ($this->uri->segment(7) != 'semua'): ?>
                <div class="row">
                  <div class="col-md-6">
                    <table class="table">
                      <tr>
                        <td>Nama</td>
                        <td><?php echo $kelompok['nama_pelanggan'] ?></td>
                      </tr>
                      <tr>
                        <td>Alamat</td>
                        <td><?php echo $kelompok['alamat'] ?></td>
                      </tr>
                      <tr>
                        <td>Telepon</td>
                        <td><?php echo $kelompok['telepon'] ?></td>
                      </tr>
                    </table>
                  </div>
                </div>
              <?php endif ?>

              <?php if ($this->uri->segment(5) == 15): ?>
                <div class="table-a">
                  <table class="table table-bordered table-striped" cellspacing="0" width="100%" id="table-riwayat-penjualan">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Agen</th>
                        <th>Kelompok</th>
                        <th>Total Bayar</th>
                        <th>Laba</th>
                        <th>Bayar 1</th>
                        <th>Bayar 2</th>
                        <th>Bayar 3</th>
                        <th>Bayar 4</th>
                        <th>Bayar 5</th>
                        <th>Bayar 6</th>
                        <th>Bayar 7</th>
                        <th>Bayar 8</th>
                        <th>Bayar 9</th>
                        <th>Bayar 10</th>
                        <th>Bayar 11</th>
                        <th>Bayar 12</th>
                        <th>Bayar 13</th>
                        <th>Bayar 14</th>
                        <th>Bayar 15</th>
                        <th>Jumlah</th>
                        <th>Sisa Bayar</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if ($laporan): ?>

                        <?php foreach ($laporan as $index => $row): ?>
                          <?php 
                          $this->db->order_by('periode_ke', 'asc');
                          $this->db->where('faktur_penjualan', $row['faktur_penjualan']);
                          $pembayaran = $this->db->get('pembayaran')->result_array();

                          $this->db->select_sum('nominal', 'jumlah_bayar');
                          $this->db->where('status_bayar', 'SUDAH BAYAR');
                          $this->db->where('faktur_penjualan', $row['faktur_penjualan']);
                          $jumlah_bayar = $this->db->get('pembayaran')->row()->jumlah_bayar;

                          $this->db->select('sum(profit_1 * jumlah) as laba');
                          $this->db->join('barang', 'id_barang');
                          $this->db->group_by('faktur_penjualan');
                          $this->db->where('faktur_penjualan', $row['faktur_penjualan']);
                          $laba = $this->db->get('detail_penjualan')->row()->laba;

                          ?>
                          <tr>
                            <td><?php echo $index += 1 ?></td>
                            <td><?php echo $row['nama_karyawan'] ?></td>
                            <td><?php echo $row['nama_pelanggan'] ?></td>
                            <td><?php echo number_format($row['total_bayar']) ?></td>
                            <td><?php echo number_format($laba) ?></td>
                            <?php foreach ($pembayaran as $p): ?>
                              <td><?php echo ($p['status_bayar']) ?></td>
                            <?php endforeach ?>
                            <td><?php echo number_format($jumlah_bayar) ?></td>
                            <td><?php echo number_format($row['total_bayar'] - $jumlah_bayar) ?></td>
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

              <?php endif ?>

              <?php if ($this->uri->segment(5) == 17): ?>
                <div class="table-a">
                  <table class="table table-bordered table-striped" cellspacing="0" width="100%" id="table-riwayat-penjualan">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Agen</th>
                        <th>Kelompok</th>
                        <th>Total Bayar</th>
                        <th>Laba</th>
                        <th>Bayar 1</th>
                        <th>Bayar 2</th>
                        <th>Bayar 3</th>
                        <th>Bayar 4</th>
                        <th>Bayar 5</th>
                        <th>Bayar 6</th>
                        <th>Bayar 7</th>
                        <th>Bayar 8</th>
                        <th>Bayar 9</th>
                        <th>Bayar 10</th>
                        <th>Bayar 11</th>
                        <th>Bayar 12</th>
                        <th>Bayar 13</th>
                        <th>Bayar 14</th>
                        <th>Bayar 15</th>
                        <th>Bayar 16</th>
                        <th>Bayar 17</th>
                        <th>Jumlah</th>
                        <th>Sisa Bayar</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if ($laporan): ?>

                        <?php foreach ($laporan as $index => $row): ?>
                          <?php 
                          $this->db->order_by('periode_ke', 'asc');
                          $this->db->where('faktur_penjualan', $row['faktur_penjualan']);
                          $pembayaran = $this->db->get('pembayaran')->result_array();

                          $this->db->select_sum('nominal', 'jumlah_bayar');
                          $this->db->where('status_bayar', 'SUDAH BAYAR');
                          $this->db->where('faktur_penjualan', $row['faktur_penjualan']);
                          $jumlah_bayar = $this->db->get('pembayaran')->row()->jumlah_bayar;

                          $this->db->select('sum(profit_1 * jumlah) as laba');
                          $this->db->join('barang', 'id_barang');
                          $this->db->group_by('faktur_penjualan');
                          $this->db->where('faktur_penjualan', $row['faktur_penjualan']);
                          $laba = $this->db->get('detail_penjualan')->row()->laba;
                          ?>
                          <tr>
                            <td><?php echo $index += 1 ?></td>
                            <td><?php echo $row['nama_karyawan'] ?></td>
                            <td><?php echo $row['nama_pelanggan'] ?></td>
                            <td><?php echo number_format($row['total_bayar']) ?></td>
                            <td><?php echo number_format($laba) ?></td>
                            <?php foreach ($pembayaran as $p): ?>
                              <td><?php echo ($p['status_bayar']) ?></td>
                            <?php endforeach ?>
                            <td><?php echo number_format($jumlah_bayar) ?></td>
                            <td><?php echo number_format($row['total_bayar'] - $jumlah_bayar) ?></td>
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

              <?php endif ?>

            <?php endif ?>

          </div>
        </div>
      </div>
    </div>
</body>
</html>