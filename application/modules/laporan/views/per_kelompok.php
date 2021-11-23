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
                        
                        <a href="<?php echo base_url('laporan/cetak_per_kelompok/' . 
                        $this->input->get('id_karyawan') . '/' . 
                        $this->input->get('id_pelanggan') . '/' . 
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
                                <label for="">Agen</label>
                                <select name="id_karyawan" id="id_karyawan" class="form-control id_agen_k">
                                    <?php foreach ($karyawan as $row): ?>
                                        <option value="<?php echo $row['id_karyawan'] ?>" <?php echo $this->input->get('id_karyawan') == $row['id_karyawan'] ? 'selected' : '' ?>><?php echo $row['nama_karyawan'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Kelompok</label>
                                <select name="id_pelanggan" id="id_pelanggan" class="form-control">
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
                <?php if ($this->input->get('id_pelanggan')): ?>
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
                <?php if ($this->input->get('id_karyawan')): ?>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" cellspacing="0" width="100%" id="table-riwayat-penjualan">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Periode Ke</th>
                                    <th>Nominal</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach ($laporan as $index => $row): ?>
                                    <tr>
                                        <td><?php echo $index += 1 ?></td>
                                        <td><?php echo $row['status_bayar'] == 'SUDAH BAYAR' ? ($row['tgl']) : '' ?></td>
                                        <td><?php echo $row['periode_ke'] ?></td>
                                        <td><?php echo $row['status_bayar'] == 'SUDAH BAYAR' ? number_format($row['nominal']) : '' ?></td>
                                        <?php if ($row['status_bayar'] == 'SUDAH BAYAR'): ?>
                                            <td> <button class="btn btn-success"><?php echo $row['status_bayar'] ?></button></td>
                                        <?php else: ?>
                                            <td> <button class="btn btn-warning"><?php echo $row['status_bayar'] ?></button></td>
                                        <?php endif ?>
                                    </tr>
                                <?php endforeach ?>

                                <?php 

                                $this->db->select_sum('nominal', 'jumlah');
                                $this->db->where('id_pelanggan', $this->input->get('id_pelanggan'));
                                $this->db->where('id_karyawan', $this->input->get('id_karyawan'));
                                $this->db->where('status_bayar', 'SUDAH BAYAR');
                                $this->db->join('penjualan', 'faktur_penjualan');
                                $jumlah_bayar =  $this->db->get('pembayaran')->row()->jumlah;

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
                                    <td><?php echo number_format($laporan['0']['total_bayar'] - $jumlah_bayar) ?></td>
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