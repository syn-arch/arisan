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
                    <a href="javascrip:void(0)" class="btn btn-danger hapus_bulk_riwayat_penjualan"><i class="fa fa-trash"></i> Hapus</a>
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
                            <div class="form-group <?php if(form_error('id_outlet')) echo 'has-error'?>">
                                <label for="id_outlet">Outlet</label>
                                <select name="id_outlet" id="id_outlet" class="form-control">
                                    <option value="">Semua Outlet</option>
                                    <?php foreach ($outlet as $row): ?>
                                        <option value="<?php echo $row['id_outlet'] ?>"><?php echo $row['nama_outlet'] ?></option>
                                    <?php endforeach ?>
                                </select>
                                <?php echo form_error('id_outlet', '<small style="color:red">','</small>') ?>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-danger btn-block">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
                <br><br>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Faktur</th>
                                <th>Tanggal</th>
                                <th>Agen</th>
                                <th>Kelompok</th>
                                <th>Total Bayar</th>
                                <th>Cash</th>
                                <th>Sisa Bayar</th>
                                <th>Status</th>
                                <th><i class="fa fa-gears"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($laporan[0]['faktur_penjualan']): ?>

                                <?php foreach ($laporan as $index => $row): ?>
                                    <tr>
                                        <td><?php echo $index += 1 ?></td>
                                        <td><?php echo $row['faktur_penjualan'] ?></td>
                                        <td><?php echo $row['tgl'] ?></td>
                                        <td><?php echo $row['nama_karyawan'] ?></td>
                                        <td><?php echo $row['nama_pelanggan'] ?></td>
                                        <td><?php echo number_format($row['total_bayar']) ?></td>
                                        <td><?php echo number_format($row['cash']) ?></td>
                                        <td><?php echo number_format($row['sisa_bayar']) ?></td>
                                        <?php if ($row['status'] == 'Lunas'): ?>
                                            <td> <button class="btn btn-success"><?php echo $row['status'] ?></button></td>
                                        <?php else: ?>
                                            <td> <button class="btn btn-warning"><?php echo $row['status'] ?></button></td>
                                        <?php endif ?>
                                        <td>
                                            <a title="invoice" class="btn btn-flat btn-info" href="<?php echo base_url('penjualan/invoice/') . $row['faktur_penjualan'] ?>"><i class="fa fa-eye"></i></a>
                                            <a title="ubah transaksi" class="btn btn-flat btn-primary" href="<?php echo base_url('penjualan/ubah/') . $row['faktur_penjualan'] ?>"><i class="fa fa-edit"></i></a>
                                            <a title="daftar pembayaran" class="btn btn-flat btn-success" href="<?php echo base_url('penjualan/pembayaran/') . $row['faktur_penjualan'] ?>"><i class="fa fa-list"></i></a>
                                            <a title="hapus penjualan" class="btn btn-flat btn-danger hapus_riwayat_penjualan" data-href="<?php echo base_url('penjualan/hapus_penjualan/') . $row['faktur_penjualan'] ?>"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            <?php endif ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const dari = '<?php echo $this->input->get('dari') ?>'
    const sampai = '<?php echo $this->input->get('sampai') ?>'
    const id_outlet = '<?php echo $this->input->get('id_outlet') ?>'
    const level = '<?php echo $this->session->userdata('level') ?>'
</script>