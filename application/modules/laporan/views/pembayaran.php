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
                        <a href="<?php echo base_url('laporan/cetak_pembayaran/' . 
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
                                    <th>Tanggal</th>
                                    <th>Faktur</th>
                                    <th>Nama Agen</th>
                                    <th>Kelompok</th>
                                    <th>Periode Ke</th>
                                    <th>Nominal</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach ($laporan as $index => $row): ?>
                                    <tr>
                                        <td><?php echo $index += 1 ?></td>
                                        <td><?php echo $row['tgl'] ?></td>
                                        <td><?php echo $row['faktur_penjualan'] ?></td>
                                        <td><?php echo $row['nama_karyawan'] ?></td>
                                        <td><?php echo $row['nama_pelanggan'] ?></td>
                                        <td><?php echo $row['periode_ke'] ?></td>
                                        <td><?php echo number_format($row['nominal']) ?></td>
                                    </tr>
                                <?php endforeach ?>

                                <?php 

                                $this->db->select('sum(nominal) as total_nominal');
                                $this->db->where('date(pembayaran.tgl) >=', $this->input->get('dari'));
                                $this->db->where('date(pembayaran.tgl) <=', $this->input->get('sampai'));
                                $this->db->where('status_bayar', 'SUDAH BAYAR');
                                $this->db->join('penjualan', 'faktur_penjualan');
                                $this->db->join('karyawan', 'karyawan.id_karyawan = penjualan.id_karyawan');
                                $total_nominal = $this->db->get('pembayaran')->row()->total_nominal;

                                ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>Total</td>
                                    <td><?php echo number_format($total_nominal) ?></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                <?php endif ?>

            </div>
        </div>
    </div>
</div>