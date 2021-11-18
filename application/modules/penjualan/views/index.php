<style>
  .penjualan-item {
    display:block;
    height:250px;
    overflow:auto;
  }
  .thead-item, .penjualan-item tr {
    display:table;
    width:100%;
    table-layout:fixed;/* even columns width , fix width of table too*/
  }
  thead {
    width: calc( 100% - 1em )/* scrollbar is average 1em/16px width, remove it from thead width */
  }
  table {
    width:400px;
  }
  .font_small {
    font-size: 14px;
  }

</style>

<div class="row">
  <div class="col-md-5">
    <div class="box box-danger">
      <div class="box-header with-border">
        <div class="pull-left">
         Tanggal : <?php echo date('d-m-Y') ?>
       </div>
       <div class="pull-right">
         Kasir : <?php echo $this->session->userdata('nama_petugas'); ?>
       </div>
     </div>
     <div class="box-body">

      <form action="<?php echo base_url('penjualan/proses') ?>" method="POST" class="form-penjualan" enctype="multipart/form-data">
        <input type="hidden" name="id_petugas" value="<?php echo $this->session->userdata('id_petugas'); ?>">
        <input type="hidden" name="faktur_penjualan" value="<?php echo $faktur_penjualan ?>">
        <input type="hidden" class="member" name="member" value="0">
        <input type="hidden" name="id_service" value="">
        <div class="pelanggan_baru"></div>
        <div class="form-group">
          <div class="input-group input-group">
            <input type="text" class="form-control barcode_pelanggan" name="barcode_pelanggan" placeholder="Barcode Pelanggan">
            <span class="input-group-btn">
              <button type="button" class="btn btn-info btn-flat"><i class="fa fa-barcode"></i></button>
            </span>
          </div>
        </div>
        <div class="form-group">
          <div class="input-group input-group">
            <select required="" name="id_karyawan" id="id_karyawan" class="form-control select2 karyawan karyawan-wrapper" width="100%">
              <?php foreach ($karyawan as $row): ?>
                <option <?php echo $this->session->userdata('id_karyawan') == $row['id_karyawan'] ? 'selected' : '' ?> value="<?php echo $row['id_karyawan'] ?>"><?php echo $row['nama_karyawan'] ?></option>
              <?php endforeach ?>
            </select>
            <span class="input-group-btn">
              <button type="button" class="btn btn-info btn-flat"><i class="fa fa-users"></i></button>
            </span>
          </div>
        </div>
        <div class="form-group">
          <div class="input-group input-group">
            <select required="" name="id_pelanggan" id="id_pelanggan" class="form-control select2 pelanggan pelanggan-wrapper">
              <?php foreach ($pelanggan as $row): ?>
                <option value="<?php echo $row['id_pelanggan'] ?>">
                  <?php echo $row['nama_pelanggan'] ?>
                </option>
              <?php endforeach ?>
            </select>
            <span class="input-group-btn">
              <button type="button" class="btn btn-info btn-flat"><i class="fa fa-users"></i></button>
            </span>
          </div>
        </div>
        <div class="row">
          <div class="col-md-2">
            <div class="form-group">
              <input type="text" class="form-control qty_brg qty_focus" placeholder="Qty" autofocus="">
            </div>
          </div>
          <div class="col-md-10">
            <div class="form-group <?php if(form_error('barcode')) echo 'has-error'?>">
              <input type="text" id="barcode" name="barcode" class="form-control barcode" placeholder="Barcode" autocomplete="off">
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="table-responsive">
            <table class="table">
              <thead class="thead-item">
                <tr>
                  <th width="30%">Nama</th>
                  <th>Harga</th>
                  <th>Diskon</th>
                  <th>Qty</th>
                  <th>Subtotal</th>
                  <th><i class="fa fa-gear"></i></th>
                </tr>
              </thead>
              <tbody class="penjualan-item">

              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="row" style="margin-top: -30px">
        <div class="col-md-12">
          <div class="table-responsive">
            <table class="table">
              <tr>
                <th>Diskon (%) | Potongan</th>
                <td><input type="number" class="form-control diskon" name="diskon" autocomplete="off" value="0"></td>
                <td><input autocomplete="off" type="text" class="form-control potongan" name="potongan" autocomplete="off" value="0"></td>
                <input type="hidden" name="potongan_rp" class="potongan_rp">
              </tr>
              <tr>
                <th>Jumlah Bayar</th>
                <td colspan="2"><input readonly="" type="text" class="form-control jumlah_bayar" name="jumlah_bayar" value="Rp. 0"></td>
              </tr>
              <input type="hidden" name="metode_pembayaran">
              <input type="hidden" name="tgl_jatuh_tempo">
              <tr>
                <th>Periode</th>
                <td colspan="2">
                  <select name="periode" id="periode" class="form-control">
                    <option value="15">15</option>
                    <option value="17">17</option>
                  </select>
                </td>
              </tr>
              <tr>
                <th>Nominal Kocokan</th>
                <td colspan="2">
                  <input type="text" name="kocokan" id="kocokan" class="form-control" placeholder="Nominal Kocokan">
                </td>
              </tr>
              <tr class="ship_nama">
                <th>Nama</th>
                <td colspan="2"><input type="text" placeholder="Nama" name="nama_pengiriman" id="nama_pengiriman" class="form-control"></td>
              </tr>
              <tr class="ship_alamat">
                <th>Alamat</th>
                <td colspan="2"><input type="text" placeholder="Alamat" name="alamat_pengiriman" id="alamat_pengiriman" class="form-control"></td>
              </tr>
              <tr class="no_kredit">
                <th>No Kredit</th>
                <td colspan="2">
                  <input type="text" name="no_kredit" id="no_kredit" class="form-control" placeholder="No Kredit">
                </td>
              </tr>
              <tr class="no_debit">
                <th>No Debit</th>
                <td colspan="2">
                  <input type="text" name="no_debit" id="no_debit" class="form-control" placeholder="No ebit">
                </td>
              </tr>
              <tr class="lampiran">
                <th>Lampiran</th>
                <td colspan="2">
                  <input type="file" name="lampiran" id="lampiran" class="form-control">
                </td>
              </tr>
              <tr>
                <td colspan="3">
                  <button type="submit" class="btn btn-primary btn-block btn-flat konfirmasi-penjualan">Konfirmasi</button>
                </td>
              </tr>
              <tr>
                <td colspan="3">
                  <button type="submit" class="btn btn-danger btn-block btn-flat batal">Batal</button>
                </td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
<div class="col-md-7">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-danger">
        <div class="box-header with-border">
          <div class="pull-left">
            <?php echo $faktur_penjualan ?>
          </div>
          <div class="pull-right">
            <input type="text" class="total_jumlah_bayar" style="text-align: right;border:none; font-size: 50px" value="Rp. 0">
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="box box-danger">
        <div class="box-header with-border">
          <div class="box-body">
           <div class="row">
            <div class="col-md-12">
              <div class="table-responsive">
                <table class="table" id="table-cari-barang" width="100%">
                  <thead>
                    <tr>
                      <th>Kode Barang</th>
                      <th>Barcode</th>
                      <th>Nama Barang</th>
                      <th>Harga</th>
                      <th>Stok</th>
                      <th><i class="fa fa-plus"></i></th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<div class="modal fade" id="modal-barang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="exampleModalLongTitle">Cari Barang</h5>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="table-responsive">
              <table class="table" id="table-cari-barang" width="100%">
                <thead>
                  <tr>
                    <th>Kode Barang</th>
                    <th>Barcode</th>
                    <th>Nama Barang</th>
                    <th>Stok</th>
                    <th><i class="fa fa-plus"></i></th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>

<input type="hidden" name="ubah_brg" class="ubah_brg">
<input type="hidden" name="id_brg" class="id_brg">
<input type="hidden" name="qty_brg" class="qty_brg">
<input type="hidden" name="harga_brg" class="harga_brg">

<div class="modal fade" id="input_password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="exampleModalLongTitle">Masukan Password</h5>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <input type="password" class="form-control input_password" placeholder="Masukan Password">
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>


<script>
  <?php 

  $pengaturan = $this->db->get('pengaturan')->row_array();

  echo "const pengaturan = " . json_encode($pengaturan). "; ";

  echo "const judul = '" . $judul . "';";

  ?>
</script>
