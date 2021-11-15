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
      <div class="col-md-12">
        <h2 class="text-center">
          Laporan Laba Rugi <?php echo $this->uri->segment(3) . ' Sampai ' . $this->uri->segment(4) ?>
        </h2>
        <h4>Outlet : <?php echo $outlet['nama_outlet'] ?? 'Semua Outlet' ?></h4>
        <div class="table-responsive">
          <table class="table table-bordere">
              <tr>
                <th width="70%">Pendapatan Penjualan</th>
                <td><?php echo "Rp. " . number_format($pendapatan) ?></td>
              </tr>
              <tr>
                <th width="40%">Penjualan</th>
              </tr>
              <tr>
                <th>Potongan Penjualan</th>
                <td><?php echo "Rp. " . number_format($potongan) ?></td>
              </tr>
              <tr>
                <th width="70%">Penjualan Bersih</th>
                <td><?php echo "Rp. " . number_format($pendapatan_bersih) ?></td>
              </tr>
              <tr>
                <th width="70%">Laba Penjualan</th>
                <td><?php echo "Rp. " . number_format($harga_pokok) ?></td>
              </tr>
              <tr>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <th>Macam-macam pendapatan</th>
                <td></td>
              </tr>
              <?php foreach ($detail_pemasukan as $row): ?>
              <tr>
                <td><?php echo $row['keterangan_biaya'] ?></td>
                <td><?php echo "Rp. " . number_format($row['total_bayar']) ?></td>
              </tr>
              <?php endforeach ?>
              <tr>
                <th>Total macam-macam pendapatan</th>
                <td><?php echo "Rp. " . number_format($pemasukan) ?></td>
              </tr>
              <tr>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <th>Macam-macam pengeluaran</th>
                <td></td>
              </tr>
              <?php foreach ($detail_pengeluaran as $row): ?>
              <tr>
                <td><?php echo $row['keterangan_biaya'] ?></td>
                <td><?php echo "Rp. " . number_format($row['total_bayar']) ?></td>
              </tr>
              <?php endforeach ?>
              <tr>
                <th>Total macam-macam pengeluaran</th>
                <td><?php echo "Rp. " . number_format($pengeluaran) ?></td>
              </tr>
              <tr>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <th>Total Laba Bersih</th>
                <td><?php echo "Rp. " . number_format( $harga_pokok + $pemasukan - $pengeluaran) ?></td>
              </tr>
            </table>
        </div>
      </div>
    </div>
  </div>
</body>
</html>