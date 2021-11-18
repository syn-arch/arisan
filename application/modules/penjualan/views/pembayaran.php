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
                <div class="table-responsive">
                    <table class="table table-bordered table-striped datatable" cellspacing="0" width="100%" >
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
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
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
