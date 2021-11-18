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
                <br><br>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" cellspacing="0" width="100%" id="table-riwayat-penjualan">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Agen</th>
                                <th>Kelompok</th>
                                <th>Total Bayar</th>
                                <th>Cash</th>
                                <th>Sisa Bayar</th>
                                <th>Status</th>
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
                                        <td><?php echo number_format($row['total_bayar']) ?></td>
                                        <td><?php echo number_format($row['cash']) ?></td>
                                        <td><?php echo number_format($row['sisa_bayar']) ?></td>
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
            </div>
        </div>
    </div>
</div>