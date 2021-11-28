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
                    <?php if ($this->input->get('jenis_paket')): ?>
                        <a href="<?php echo base_url('laporan/cetak_paket_tahunan/' . 
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
                                    <option value="semua" <?php echo $this->input->get('id_karyawan') == 'semua' ? 'selected' : '' ?>>SEMUA</option>
                                    <?php foreach ($karyawan as $row): ?>
                                        <option value="<?php echo $row['id_karyawan'] ?>" <?php echo $this->input->get('id_karyawan') == $row['id_karyawan'] ? 'selected' : '' ?>><?php echo $row['nama_karyawan'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Kelompok</label>
                                <select name="id_pelanggan" id="id_pelanggan" class="form-control">
                                    <option value="semua" <?php echo $this->input->get('id_pelanggan') == 'semua' ? 'selected' : '' ?>>SEMUA</option>
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

                <?php if ($this->input->get('id_karyawan')): ?>
                <?php if ($this->input->get('id_karyawan') != 'semua'): ?>
                    <div class="row">
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
                <?php endif ?>

                <?php if ($this->input->get('id_pelanggan')): ?>
                <?php if ($this->input->get('id_pelanggan') != 'semua'): ?>
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table">
                                <tr>
                                    <td>Kelompok/Paket</td>
                                    <td><?php echo $kelompok['nama_pelanggan'] ?></td>
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
                <?php endif ?>

                <?php if ($this->input->get('jenis_paket')): ?>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" cellspacing="0" width="100%" id="table-riwayat-penjualan">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah</th>
                                    <th>Satuan</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach ($laporan as $index => $row): ?>
                                    <tr>
                                        <td><?php echo $index += 1 ?></td>
                                        <td><?php echo $row['nama_barang'] ?></td>
                                        <td><?php echo $row['jumlah'] ?></td>
                                        <td><?php echo $row['satuan'] ?></td>
                                    </tr>
                                <?php endforeach ?>

                            </tbody>
                        </table>
                    </div>
                <?php endif ?>

            </div>
        </div>
    </div>
</div>
