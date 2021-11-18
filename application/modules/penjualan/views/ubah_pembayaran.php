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
                        <a href="<?php echo base_url('penjualan/pembayaran/' . $faktur_penjualan) ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-2">
                    </div>
                    <div class="col-md-8">
                      <form method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id_pembayaran" value="<?php echo $pembayaran['id_pembayaran'] ?>">
                        <input type="hidden" name="faktur_penjualan" value="<?php echo $faktur_penjualan ?>">
                        <input type="hidden" name="metode_pembayaran" value="Cash">
                        <input type="hidden" name="no_debit">
                        <input type="hidden" name="no_kredit">
                        <div class="form-group">
                            <label for="">Tanggal</label>
                            <input type="text" class="form-control" value="<?php echo date('Y-m-d H:i:s') ?>" readonly>
                        </div>
                        <div class="form-group <?php if(form_error('nominal')) echo 'has-error'?>">
                            <label for="nominal">Nominal</label>
                            <input type="text" id="nominal" name="nominal" class="form-control nominal " placeholder="Nominal" value="<?php echo $pembayaran['nominal'] ?>" readonly>
                            <?php echo form_error('nominal', '<small style="color:red">','</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="">Periode</label>
                            <input type="text" class="form-control" value="<?php echo $pembayaran['periode_ke'] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <br>
                            <input type="radio" name="status_bayar" id="sudah" value="SUDAH BAYAR" <?php echo $pembayaran['status_bayar'] == 'SUDAH BAYAR' ? 'checked' : '' ?>>
                            <label for="sudah">SUDAH BAYAR</label>
                            <br></br>
                            <input type="radio" name="status_bayar" id="BELUM" value="BELUM BAYAR" <?php echo $pembayaran['status_bayar'] == 'BELUM BAYAR' ? 'checked' : '' ?>>
                            <label for="BELUM">BELUM BAYAR</label>
                        </div>
                        <div class="form-group">
                          <button type="submit" class="btn btn-primary btn-block">Submit</button>
                      </div>
                  </form>  
              </div>
          </div>
      </div>
  </div>
</div>
</div>
