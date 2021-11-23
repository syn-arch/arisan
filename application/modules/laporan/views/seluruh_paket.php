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
                    <a href="<?php echo base_url('laporan/cetak_seluruh_paket/' . 
                    $this->input->get('dari') . '/' . 
                    $this->input->get('sampai') . '/' . 
                    $this->input->get('periode') . '/' . 
                    $this->input->get('id_pelanggan') . '/' . 
                    $this->input->get('id_karyawan') . '/' . 
                    $this->input->get('jenis_paket')
                    ) ?>" class="btn btn-success" target="_blank"><i class="fa fa-print"></i> Cetak</a>
                    <?php endif ?>
                </div>
            </div>
            <div class="box-body">
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
                                <label for="">Periode</label>
                                <select name="periode" id="periode" class="form-control">
                                    <option value="15" <?php echo $this->input->get('periode') == '15' ? 'selected' : '' ?>>15</option>
                                    <option value="17" <?php echo $this->input->get('periode') == '17' ? 'selected' : '' ?>>17</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Agen</label>
                                <select name="id_karyawan" id="id_karyawan" class="form-control id_agen_k">
                                    <option value="semua">Semua Agen</option>
                                    <?php foreach ($karyawan as $row): ?>
                                        <option value="<?php echo $row['id_karyawan'] ?>" <?php echo $this->input->get('id_karyawan') == $row['id_karyawan'] ? 'selected' : '' ?>><?php echo $row['nama_karyawan'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Kelompok</label>
                                <select name="id_pelanggan" id="id_pelanggan" class="form-control">
                                    <option value="semua">Semua Kelompok</option>
                                    <?php foreach ($pelanggan as $row): ?>
                                        <option value="<?php echo $row['id_pelanggan'] ?>" <?php echo $this->input->get('id_pelanggan') == $row['id_pelanggan'] ? 'selected' : '' ?>><?php echo $row['nama_pelanggan'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                             <div class="form-group">
                                <label for="">Jenis Paket</label>
                                <select name="jenis_paket" id="jenis_paket" class="form-control">
                                    <option value="REGULAR" <?php echo $this->input->get('jenis_paket') == 'REGULAR' ? 'selected' : '' ?>>REGULAR</option>
                                    <option value="TAHUNAN" <?php echo $this->input->get('jenis_paket') == 'TAHUNAN' ? 'selected' : '' ?>>TAHUNAN</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-danger btn-block">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
                <br><br>
                <?php if ($this->input->get('dari')): ?>

                    <?php if ($this->input->get('id_karyawan') != 'semua'): ?>
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

                    <?php if ($this->input->get('id_pelanggan') != 'semua'): ?>
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

                    <?php if ($this->input->get('periode') == '15'): ?>
                        <div class="table-responsive">
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

                    <?php if ($this->input->get('periode') == '17'): ?>
                        <div class="table-responsive">
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