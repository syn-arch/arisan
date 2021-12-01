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
                    <?php if ($this->input->get('dari')): ?>
                        <a href="<?php echo base_url('laporan/cetak_barang_diterima/' . 
                        $this->input->get('dari') . '/' . 
                        $this->input->get('sampai') 
                        ) ?>" class="btn btn-success" target="_blank"><i class="fa fa-print"></i> Cetak</a>
                    <?php endif ?>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-lg-6">
                        <form action="">
                            <div class="form-group">
                                <label for="">Dari</label>
                                <input type="date" class="form-control" name="dari" id="dari" value="<?php echo $this->input->get('dari') ?>">
                            </div>
                            <div class="form-group">
                                <label for="">Sampai</label>
                                <input type="date" class="form-control" name="sampai" id="sampai" value="<?php echo $this->input->get('sampai') ?>">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-danger btn-block">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
                <?php if ($this->input->get('dari')): ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped datatable" cellspacing="0" width="100%" id="table-riwayat-penjualan">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Satuan</th>
                                    <th>Jumlah</th>
                                    <th>Harga Beli</th>
                                    <th>Harga Jual</th>
                                    <th>Laba</th>
                                    <th>Total Harga Jual</th>
                                    <th>Tanggal Diambil</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach ($laporan as $index => $row): ?>
                                    <tr>
                                        <td><?php echo $index += 1 ?></td>
                                        <td><?php echo $row['nama_barang'] ?></td>
                                        <td><?php echo $row['satuan'] ?></td>
                                        <td><?php echo $row['jumlah'] ?></td>
                                        <td><?php echo number_format($row['harga_pokok']) ?></td>
                                        <td><?php echo number_format($row['golongan_1']) ?></td>
                                        <td><?php echo number_format($row['laba']) ?></td>
                                        <td><?php echo number_format($row['total_harga_jual']) ?></td>
                                        <td><?php echo ($row['tgl_diambil']) ?></td>
                                    </tr>
                                <?php endforeach ?>

                                <?php 
                                $this->db->select('sum(jumlah) as total_jumlah');
                                $this->db->where('date(detail_penjualan.tgl_diambil) >=', $this->input->get('dari'));
                                $this->db->where('date(detail_penjualan.tgl_diambil) <=', $this->input->get('sampai'));
                                $this->db->join('barang', 'id_barang');
                                $this->db->join('penjualan', 'faktur_penjualan');
                                $total_jumlah = $this->db->get('detail_penjualan')->row()->total_jumlah;

                                $this->db->select('sum(harga_pokok) as total_harga_pokok');
                                $this->db->where('date(detail_penjualan.tgl_diambil) >=', $this->input->get('dari'));
                                $this->db->where('date(detail_penjualan.tgl_diambil) <=', $this->input->get('sampai'));
                                $this->db->join('barang', 'id_barang');
                                $this->db->join('penjualan', 'faktur_penjualan');
                                $total_harga_pokok = $this->db->get('detail_penjualan')->row()->total_harga_pokok;

                                $this->db->select('sum(golongan_1) as total_harga_jual');
                                $this->db->where('date(detail_penjualan.tgl_diambil) >=', $this->input->get('dari'));
                                $this->db->where('date(detail_penjualan.tgl_diambil) <=', $this->input->get('sampai'));
                                $this->db->join('barang', 'id_barang');
                                $this->db->join('penjualan', 'faktur_penjualan');
                                $total_harga_jual = $this->db->get('detail_penjualan')->row()->total_harga_jual;

                                $this->db->select('sum(profit_1 * jumlah) as total_harga_laba');
                                $this->db->where('date(detail_penjualan.tgl_diambil) >=', $this->input->get('dari'));
                                $this->db->where('date(detail_penjualan.tgl_diambil) <=', $this->input->get('sampai'));
                                $this->db->join('barang', 'id_barang');
                                $this->db->join('penjualan', 'faktur_penjualan');
                                $total_harga_laba = $this->db->get('detail_penjualan')->row()->total_harga_laba;

                                $this->db->select('sum(golongan_1 * jumlah) as total_jual');
                                $this->db->where('date(detail_penjualan.tgl_diambil) >=', $this->input->get('dari'));
                                $this->db->where('date(detail_penjualan.tgl_diambil) <=', $this->input->get('sampai'));
                                $this->db->join('barang', 'id_barang');
                                $this->db->join('penjualan', 'faktur_penjualan');
                                $total_jual = $this->db->get('detail_penjualan')->row()->total_jual;

                                ?>

                            </tbody>
                            <tfoot>
                                 <tr>
                                    <td></td>
                                    <td></td>
                                    <td>Total</td>
                                    <td><?php echo number_format($total_jumlah) ?></td>
                                    <td><?php echo number_format($total_harga_pokok) ?></td>
                                    <td><?php echo number_format($total_harga_jual) ?></td>
                                    <td><?php echo number_format($total_harga_laba) ?></td>
                                    <td><?php echo number_format($total_jual) ?></td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                <?php endif ?>

            </div>
        </div>
    </div>
</div>