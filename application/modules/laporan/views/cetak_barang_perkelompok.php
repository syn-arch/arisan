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
            <br><br>
            <?php if ($this->uri->segment(4)): ?>
              <div class="row">
                <div class="col-md-6">
                  <table class="table">
                    <tr>
                      <td>Nama Kelompok</td>
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
                    <tr>
                      <td>Nominal Kocokan</td>
                      <td><?php echo ($laporan['0']['kocokan'] ?? 0) ?></td>
                    </tr>
                    <tr>
                      <td>Total Bayar</td>
                      <td><?php echo number_format($laporan['0']['total_bayar'] ?? 0) ?></td>
                    </tr>
                  </table>
                </div>
                <div class="col-md-6">
                  <table class="table">
                    <tr>
                      <td>Nama Agen</td>
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
            <?php if ($this->uri->segment(3)): ?>

              <div class="table-responsive">
                <table class="table table-bordered table-striped" cellspacing="0" width="100%" id="table-riwayat-penjualan">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Barang</th>
                      <th>Jumlah</th>
                      <th>Harga Beli</th>
                      <th>Harga Jual</th>
                      <th>Laba</th>
                      <th>Total Harga Jual</th>
                      <th>Keterangan</th>
                      <th>Tanggal Diambil</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php foreach ($laporan as $index => $row): ?>
                      <tr>
                        <td><?php echo $index += 1 ?></td>
                        <td><?php echo $row['nama_barang'] ?></td>
                        <td><?php echo $row['jumlah'] ?></td>
                        <td><?php echo number_format($row['harga_pokok']) ?></td>
                        <td><?php echo number_format($row['golongan_1']) ?></td>
                        <td><?php echo number_format($row['laba']) ?></td>
                        <td><?php echo number_format($row['total_harga_jual']) ?></td>
                        <td><?php echo ($row['keterangan']) ?></td>
                        <td><?php echo ($row['tgl_diambil']) ?></td>
                      </tr>
                    <?php endforeach ?>

                    <?php 

                    $this->db->select('sum(harga_pokok) as total_harga_pokok');
                    $this->db->where('id_pelanggan', $this->uri->segment(4));
                    $this->db->where('id_karyawan', $this->uri->segment(3));
                    $this->db->where('jenis_paket', $this->uri->segment(5));
                    $this->db->join('barang', 'id_barang');
                    $this->db->join('penjualan', 'faktur_penjualan');
                    $total_harga_pokok = $this->db->get('detail_penjualan')->row()->total_harga_pokok;

                    $this->db->select('sum(golongan_1) as total_harga_jual');
                    $this->db->where('id_pelanggan', $this->uri->segment(4));
                    $this->db->where('id_karyawan', $this->uri->segment(3));
                    $this->db->where('jenis_paket', $this->uri->segment(5));
                    $this->db->join('barang', 'id_barang');
                    $this->db->join('penjualan', 'faktur_penjualan');
                    $total_harga_jual = $this->db->get('detail_penjualan')->row()->total_harga_jual;

                    $this->db->select('sum(profit_1 * jumlah) as total_harga_laba');
                    $this->db->where('id_pelanggan', $this->uri->segment(4));
                    $this->db->where('id_karyawan', $this->uri->segment(3));
                    $this->db->where('jenis_paket', $this->uri->segment(5));
                    $this->db->join('barang', 'id_barang');
                    $this->db->join('penjualan', 'faktur_penjualan');
                    $total_harga_laba = $this->db->get('detail_penjualan')->row()->total_harga_laba;

                    $this->db->select('sum(golongan_1 * jumlah) as total_jual');
                    $this->db->where('id_pelanggan', $this->uri->segment(4));
                    $this->db->where('id_karyawan', $this->uri->segment(3));
                    $this->db->where('jenis_paket', $this->uri->segment(5));
                    $this->db->join('barang', 'id_barang');
                    $this->db->join('penjualan', 'faktur_penjualan');
                    $total_jual = $this->db->get('detail_penjualan')->row()->total_jual;

                    ?>


                    <tr>
                      <td></td>
                      <td></td>
                      <td>Total</td>
                      <td><?php echo number_format($total_harga_pokok) ?></td>
                      <td><?php echo number_format($total_harga_jual) ?></td>
                      <td><?php echo number_format($total_harga_laba) ?></td>
                      <td><?php echo number_format($total_jual) ?></td>
                      <td></td>
                      <td></td>
                    </tr>

                  </tbody>
                </table>
              </div>
            <?php endif ?>

          </div>
        </div>
      </div>
    </div>

  </div>
</body>
</html>