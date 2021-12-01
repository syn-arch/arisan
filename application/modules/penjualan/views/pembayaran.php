<div class="row">
    <div class="col-xs-12">
        <div class="box box-danger">
            <div class="box-header with-border">
                <div class="pull-left">
                    <div class="box-title">
                        <h4><?php echo $judul ?></h4>
                    </div>
                </div>
                <div class="pull-right">
                    <div class="box-title">
                        <a href="<?php echo base_url('penjualan/riwayat_penjualan') ?>" class="btn btn-success"><i class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table">
                            <tr>
                                <td>Kelompok/Paket</td>
                                <td><?php echo $penjualan['nama_pelanggan'] ?></td>
                            </tr>
                            <tr>
                                <td>Nama Agen</td>
                                <td><?php echo $penjualan['nama_karyawan'] ?></td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td><?php echo $penjualan['alamat'] ?></td>
                            </tr>
                            <tr>
                                <td>Telepon</td>
                                <td><?php echo $penjualan['telepon'] ?></td>
                            </tr>
                            <tr>
                                <td>Nominal Kocokan</td>
                                <td><?php echo ($penjualan['kocokan']) ?></td>
                            </tr>
                            <tr>
                                <td>Total Bayar</td>
                                <td><?php echo number_format($penjualan['total_bayar']) ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table">

                        </table>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" cellspacing="0" width="100%" >
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Periode Ke</th>
                                <th>Nominal</th>
                                <th>Status</th>
                                <th><i class="fa fa-cogs"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($pembayaran as $row): ?>
                                <tr>
                                    <td><?php echo $i++ ?></td>
                                    <td><?php echo $row['status_bayar'] == 'SUDAH BAYAR' ? ($row['tgl']) : '' ?></td>
                                    <td><?php echo ($row['periode_ke']) ?></td>
                                    <td><?php echo "Rp. " . number_format($row['nominal']) ?></td>
                                    <?php if ($row['status_bayar'] == 'SUDAH BAYAR'): ?>
                                        <td><button class="btn btn-success"><?php echo $row['status_bayar'] ?></button></td>
                                    <?php else: ?>
                                        <td><button class="btn btn-danger"><?php echo $row['status_bayar'] ?></button></td>
                                    <?php endif ?>
                                    <td>
                                        <a href="<?php echo base_url('penjualan/ubah_pembayaran/' . $row['id_pembayaran']) ?>" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>

                            <?php endforeach ?>
                            <?php 

                            $this->db->select('sum(nominal) as total');
                            $this->db->where('faktur_penjualan', $penjualan['faktur_penjualan']);
                            $this->db->where('status_bayar', 'SUDAH BAYAR');
                            $jumlah_bayar = $this->db->get('pembayaran')->row()->total;

                            ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>Jumlah Bayar</td>
                                <td><?php echo number_format($jumlah_bayar) ?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>Sisa Bayar</td>
                                <td><?php echo number_format($penjualan['total_bayar'] - $jumlah_bayar) ?></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
