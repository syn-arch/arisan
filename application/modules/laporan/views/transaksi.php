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
                    <?php if (!$this->input->get('faktur_penjualan')): ?>
                        <a href="<?php echo base_url('laporan/cetak_transaksi/' . $this->input->get('dari') . '/' . $this->input->get('sampai')) ?>" class="btn btn-success" target="_blank"><i class="fa fa-print"></i> Cetak</a>
                    <?php else: ?>
                        <a href="<?php echo base_url('laporan/transaksi') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                    <?php endif ?>
                </div>
            </div>
            <div class="box-body">
                <?php if (!$this->input->get('faktur_penjualan')): ?>                    
                    <div class="row">
                        <div class="col-lg-6">
                            <form action="">
                                <div class="form-group">
                                    <label for="">Dari Tanggal</label>
                                    <input type="date" name="dari" id="dari" class="form-control" value="<?php echo $this->input->get('dari') ?>">
                                </div>
                                <div class="form-group">
                                    <label for="">Sampai Tanggal</label>
                                    <input type="date" name="sampai" id="sampai" class="form-control" value="<?php echo $this->input->get('sampai') ?>">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-danger btn-block">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php endif ?>
                <br><br>
                <?php if ($this->input->get('faktur_penjualan')): ?>
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table">
                               <tr>
                                <td>Kelompok/Paket</td>
                                <td><?php echo $transaksi['nama_pelanggan'] ?></td>
                            </tr>
                            <tr>
                                <td>Nama Agen</td>
                                <td><?php echo $transaksi['nama_karyawan'] ?></td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td><?php echo $transaksi['alamat'] ?></td>
                            </tr>
                            <tr>
                                <td>Telepon</td>
                                <td><?php echo $transaksi['telepon'] ?></td>
                            </tr>
                            <tr>
                                <td>Nominal Kocokan</td>
                                <td><?php echo ($transaksi['kocokan']) ?></td>
                            </tr>
                            <tr>
                                <td>Total Bayar</td>
                                <td><?php echo number_format($transaksi['total_bayar']) ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
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

                            <?php foreach ($detail_transaksi as $index => $row): ?>
                                <tr>
                                    <td><?php echo $index += 1 ?></td>
                                    <td><?php echo $row['nama_barang'] ?></td>
                                    <td><?php echo $row['jumlah'] ?></td>
                                    <td><?php echo number_format($row['harga_pokok']) ?></td>
                                    <td><?php echo number_format($row['golongan_1']) ?></td>
                                    <td><?php echo number_format($row['laba']) ?></td>
                                    <td><?php echo number_format($row['total_harga_jual']) ?></td>
                                    <td>
                                        <form action="">
                                            <select name="keterangan" id="keterangan" class="form-control keterangan" data-brg="<?php echo $row['id_barang'] ?>" data-faktur="<?php echo $row['faktur_penjualan'] ?>">
                                                <option value="DITERIMA" <?php echo $row['keterangan'] == 'DITERIMA' ? 'selected' : '' ?>>DITERIMA</option>
                                                <option value="BELUM DITERIMA" <?php echo $row['keterangan'] == 'BELUM DITERIMA' ? 'selected' : '' ?>>BELUM DITERIMA</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td><?php echo ($row['tgl_diambil']) ?></td>
                                </tr>
                            <?php endforeach ?>

                            <?php 

                            $this->db->select('sum(harga_pokok) as total_harga_pokok');
                            $this->db->where('faktur_penjualan', $transaksi['faktur_penjualan']);
                            $this->db->join('barang', 'id_barang');
                            $this->db->join('penjualan', 'faktur_penjualan');
                            $total_harga_pokok = $this->db->get('detail_penjualan')->row()->total_harga_pokok;

                            $this->db->select('sum(golongan_1) as total_harga_jual');
                            $this->db->where('faktur_penjualan', $transaksi['faktur_penjualan']);
                            $this->db->join('barang', 'id_barang');
                            $this->db->join('penjualan', 'faktur_penjualan');
                            $total_harga_jual = $this->db->get('detail_penjualan')->row()->total_harga_jual;

                            $this->db->select('sum(profit_1 * jumlah) as total_harga_laba');
                            $this->db->where('faktur_penjualan', $transaksi['faktur_penjualan']);
                            $this->db->join('barang', 'id_barang');
                            $this->db->join('penjualan', 'faktur_penjualan');
                            $total_harga_laba = $this->db->get('detail_penjualan')->row()->total_harga_laba;

                            $this->db->select('sum(golongan_1 * jumlah) as total_jual');
                            $this->db->where('faktur_penjualan', $transaksi['faktur_penjualan']);
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

            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped datatable" cellspacing="0" width="100%" id="table-riwayat-penjualan">
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
                                <th>Aksi</th>
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
                                    <td>
                                        <a href="<?php echo base_url('laporan/transaksi?faktur_penjualan=') . $row['faktur_penjualan'] ?>" class="btn btn-primary">
                                            Detail Barang
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
        <?php endif ?>

    </div>
</div>
</div>
</div>