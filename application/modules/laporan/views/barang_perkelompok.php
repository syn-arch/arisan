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
                    <?php if ($this->input->get('id_karyawan')): ?>
                        
                        <a href="<?php echo base_url('laporan/cetaK_barang_perkelompok/' . $this->input->get('faktur_penjualan')) ?>" class="btn btn-success" target="_blank"><i class="fa fa-print"></i> Cetak</a>
                    <?php endif ?>
                </div>
            </div>
            <div class="box-body">
                <?php if ($this->input->get('faktur_penjualan')): ?>
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table">
                               <tr>
                                    <td>Kelompok/Paket</td>
                                    <td><?php echo $kelompok['nama_pelanggan'] ?></td>
                                </tr>
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
                    </div>
                <?php endif ?>
                <?php if ($this->input->get('faktur_penjualan')): ?>

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
                                        <td>
                                            <form action="">
                                                <select name="keterangan" id="keterangan" class="form-control keterangan" data-brg="<?php echo $row['id_barang'] ?>" data-status="<?php echo $this->input->get('status') ?>">
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
                                $this->db->where('id_pelanggan', $this->input->get('id_pelanggan'));
                                $this->db->where('id_karyawan', $this->input->get('id_karyawan'));
                                $this->db->where('jenis_paket', $this->input->get('jenis_paket'));
                                $this->db->where('penjualan.status', $this->input->get('status'));
                                $this->db->join('barang', 'id_barang');
                                $this->db->join('penjualan', 'faktur_penjualan');
                                $total_harga_pokok = $this->db->get('detail_penjualan')->row()->total_harga_pokok;

                                $this->db->select('sum(golongan_1) as total_harga_jual');
                                $this->db->where('id_pelanggan', $this->input->get('id_pelanggan'));
                                $this->db->where('id_karyawan', $this->input->get('id_karyawan'));
                                $this->db->where('jenis_paket', $this->input->get('jenis_paket'));
                                $this->db->where('penjualan.status', $this->input->get('status'));
                                $this->db->join('barang', 'id_barang');
                                $this->db->join('penjualan', 'faktur_penjualan');
                                $total_harga_jual = $this->db->get('detail_penjualan')->row()->total_harga_jual;

                                $this->db->select('sum(profit_1 * jumlah) as total_harga_laba');
                                $this->db->where('id_pelanggan', $this->input->get('id_pelanggan'));
                                $this->db->where('id_karyawan', $this->input->get('id_karyawan'));
                                $this->db->where('jenis_paket', $this->input->get('jenis_paket'));
                                $this->db->where('penjualan.status', $this->input->get('status'));
                                $this->db->join('barang', 'id_barang');
                                $this->db->join('penjualan', 'faktur_penjualan');
                                $total_harga_laba = $this->db->get('detail_penjualan')->row()->total_harga_laba;

                                $this->db->select('sum(golongan_1 * jumlah) as total_jual');
                                $this->db->where('id_pelanggan', $this->input->get('id_pelanggan'));
                                $this->db->where('id_karyawan', $this->input->get('id_karyawan'));
                                $this->db->where('jenis_paket', $this->input->get('jenis_paket'));
                                $this->db->where('penjualan.status', $this->input->get('status'));
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
