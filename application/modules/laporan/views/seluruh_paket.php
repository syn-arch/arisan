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
                            <input type="hidden" name="periode" value="17">
                            <div class="form-group">
                                <label for="">Agen</label>
                                <select name="id_karyawan" id="id_karyawan" class="form-control id_agen_k select2">
                                    <option value="semua">Semua Agen</option>
                                    <?php foreach ($karyawan as $row): ?>
                                        <option value="<?php echo $row['id_karyawan'] ?>" <?php echo $this->input->get('id_karyawan') == $row['id_karyawan'] ? 'selected' : '' ?>><?php echo $row['nama_karyawan'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Kelompok</label>
                                <select name="id_pelanggan" id="id_pelanggan" class="form-control select2">
                                    <option value="semua">Semua Kelompok</option>
                                    <?php foreach ($pelanggan as $row): ?>
                                        <option value="<?php echo $row['id_pelanggan'] ?>" <?php echo $this->input->get('id_pelanggan') == $row['id_pelanggan'] ? 'selected' : '' ?>><?php echo $row['nama_pelanggan'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Jenis Paket</label>
                                <select name="jenis_paket" id="jenis_paket" class="form-control">
                                   <option value="JUARA ARISAN" <?php echo $this->input->get('jenis_paket') == 'JUARA ARISAN' ? 'selected' : '' ?>>JUARA ARISAN</option>
                                   <option value="JUARA PAKET REGULER" <?php echo $this->input->get('jenis_paket') == 'JUARA PAKET REGULER' ? 'selected' : '' ?>>JUARA PAKET REGULER</option>
                                   <option value="JUARA PAKET NON REGULER" <?php echo $this->input->get('jenis_paket') == 'JUARA PAKET NON REGULER' ? 'selected' : '' ?>>JUARA PAKET NON REGULER</option>
                                   <option value="JUARA PAKET SATUAN" <?php echo $this->input->get('jenis_paket') == 'JUARA PAKET SATUAN' ? 'selected' : '' ?>>JUARA PAKET SATUAN</option>
                               </select>
                           </div>
                           <div class="form-group">
                               <label for="">Periode</label>
                               <select name="periode" id="periode" class="form-control">
                                <option value="17" <?php echo $this->input->get('periode') == '17' ? 'selected' : '' ?>>17</option>
                                <option value="40" <?php echo $this->input->get('periode') == '40' ? 'selected' : '' ?>>40</option>
                                <option value="44" <?php echo $this->input->get('periode') == '44' ? 'selected' : '' ?>>44</option>
                                <option value="48" <?php echo $this->input->get('periode') == '48' ? 'selected' : '' ?>>48</option>
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

                <?php if ($this->input->get('id_pelanggan') != 'semua'): ?>
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table">
                               <tr>
                                <td>Kelompok/Paket</td>
                                <td><?php echo $kelompok['nama_pelanggan'] ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            <?php endif ?>

            <div class="table-responsive">
                <table class="table table-bordered table-striped" cellspacing="0" width="100%" id="example">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Agen</th>
                            <th>Kelompok</th>
                            <th>Total Bayar</th>
                            <th>Laba</th>
                            <th>Jumlah</th>
                            <th>Sisa Bayar</th>
                            <th>Status</th>
                            <?php for($i = 1; $i <= $this->input->get('periode'); $i++): ?>
                                <th>Bayar <?php echo $i ?></th>
                            <?php endfor ?>
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
                                    <td><?php echo number_format($jumlah_bayar) ?></td>
                                    <td><?php echo number_format($row['total_bayar'] - $jumlah_bayar) ?></td>

                                    <?php if ($row['status'] == 'Lunas'): ?>
                                        <td> <button class="btn btn-success"><?php echo $row['status'] ?></button></td>
                                    <?php else: ?>
                                        <td> <button class="btn btn-warning"><?php echo $row['status'] ?></button></td>
                                    <?php endif ?>

                                    <?php foreach ($pembayaran as $p): ?>
                                        <?php if ($p['status_bayar'] == 'SUDAH BAYAR'): ?>
                                            <td><button class="btn btn-success"><i class="fa fa-check"></i></button></td>
                                        <?php else: ?>
                                            <td><button class="btn btn-danger"><i class="fa fa-times"></i></button></td>
                                        <?php endif ?>
                                    <?php endforeach ?>
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

<script>
   $('#example').DataTable( {
    "scrollX": true
} );
</script>