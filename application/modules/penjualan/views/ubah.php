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

      <form action="<?php echo base_url('penjualan/proses_update') ?>" method="POST" class="form-penjualan" enctype="multipart/form-data">
        <input type="hidden" name="id_outlet" value="<?php echo $penjualan['id_outlet']; ?>">
        <input type="hidden" name="id_petugas" value="<?php echo $this->session->userdata('id_petugas'); ?>">
        <input type="hidden" name="faktur_penjualan" value="<?php echo $penjualan['faktur_penjualan'] ?>">
        <input type="hidden" name="id_service" value="">
        <?php if ($penjualan['jenis'] == 'member'): ?>
          <input type="hidden" class="member" name="member" value="1">
        <?php else: ?>
          <input type="hidden" class="member" name="member" value="0">
        <?php endif ?>
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
            <select required="" name="id_karyawan" id="id_karyawan" class="form-control select2 karyawan karyawan-wrapper">
              <?php foreach ($karyawan as $row): ?>
                <option <?php echo $penjualan['id_karyawan'] == $row['id_karyawan'] ? 'selected' : '' ?> value="<?php echo $row['id_karyawan'] ?>"><?php echo $row['nama_karyawan'] ?></option>
              <?php endforeach ?>
            </select>
            <span class="input-group-btn">
              <button type="button" class="btn btn-info btn-flat"><i class="fa fa-users"></i></button>
            </span>
          </div>
        </div>
        <div class="form-group">
          <div class="input-group input-group">
            <select required="" name="id_pelanggan" id="id_pelanggan" class="form-control pelanggan">
              <?php foreach ($pelanggan as $row): ?>
                <option 
                <?php  
                echo $penjualan['id_pelanggan'] == $row['id_pelanggan'] ? 'selected' : ''; ?> 

                value="<?php echo $row['id_pelanggan'] ?>">
                <?php echo $row['nama_pelanggan'] ?>
              <?php endforeach ?>
            </select>
            <span class="input-group-btn">
              <button type="button"  class="btn btn-info btn-flat"><i class="fa fa-users"></i></button>
            </span>
          </div>
        </div>
        <div class="form-group">
          <div class="input-group input-group">
            <select required="" name="jenis_paket" id="jenis_paket" class="form-control select2">
              <option value="JUARA ARISAN" <?php echo $penjualan['jenis_paket'] == 'JUARA ARISAN' ? 'selected' : '' ?>>JUARA ARISAN</option>
              <option value="JUARA PAKET REGULER" <?php echo $penjualan['jenis_paket'] == 'JUARA PAKET REGULER' ? 'selected' : '' ?>>JUARA PAKET REGULER</option>
              <option value="JUARA PAKET NON REGULER" <?php echo $penjualan['jenis_paket'] == 'JUARA PAKET NON REGULER' ? 'selected' : '' ?>>JUARA PAKET NON REGULER</option>
              <option value="JUARA PAKET SATUAN" <?php echo $penjualan['jenis_paket'] == 'JUARA PAKET SATUAN' ? 'selected' : '' ?>>JUARA PAKET SATUAN</option>
            </select>
            <span class="input-group-btn">
              <button type="button" class="btn btn-info btn-flat"><i class="fa fa-users"></i></button>
            </span>
          </div>
        </div>
        <div class="row">
          <div class="col-md-2">
            <div class="form-group">
              <input type="text" class="form-control qty_brg" placeholder="Qty" autofocus="">
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

                <?php if ($kunci_penjualan == 1): ?>
                  <?php foreach ($detail_penjualan as $row): ?>
                    <?php 

                    $this->db->select($row['type_golongan'] . ' AS harga_jual');
                    $harga_jual = $this->db->get_where('barang', ['id_barang' => $row['id_barang']])->row()->harga_jual;

                    $rpdiskon = ($row['diskon'] / 100) * $harga_jual;
                    $tot = $harga_jual - $rpdiskon;
                    $harga_brg = $tot;
                    $harga_asli = $harga_jual;
                    ?>
                    <tr data-id="<?php echo $row['id_barang'] ?>">
                      <input type="hidden" name="id_barang[]" value="<?php echo $row['id_barang'] ?>">
                      <input type="hidden" name="type_golongan[]" value="<?php echo $row['type_golongan'] ?>">
                      <input data-subtot="<?php echo $row['id_barang'] ?>" type="hidden" name="total_harga[]" value="<?php echo $row['total_harga'] ?>">
                      <td width="30%"><?php echo $row['nama_pendek'] ?></td>
                      <td><?php echo number_format($harga_asli) ?></td>
                      <td><?php echo $row['diskon'] ?></td>
                      <td><input readonly class="form-control qty" name="jumlah[]" data-id="<?php echo $row['id_barang'] ?>" data-harga="<?php echo $harga_brg ?>" type="number" value="<?php echo $row['jumlah'] ?>" style="width: 5em"></td>
                      <td class="subtotal" data-kode="<?php echo $row['id_barang'] ?>"><?php echo number_format($row['total_harga']) ?></td>
                      <td>
                        <a class="btn btn-danger fa fa-trash hapus_kunci_brg" data-type="hapus" data-harga="<?php echo $harga_brg ?>" data-qty="<?php echo $row['jumlah'] ?>" data-id="<?php echo $row['id_barang'] ?>"></a>
                        <a class="btn btn-warning fa fa-edit ubah_kunci_brg" data-type="ubah" data-harga="<?php echo $harga_brg ?>" data-qty="<?php echo $row['jumlah'] ?>" data-id="<?php echo $row['id_barang'] ?>"></a>
                      </td>
                    </tr>
                  <?php endforeach ?>
                <?php endif ?>

                <?php if ($kunci_penjualan == 0): ?>
                  <?php foreach ($detail_penjualan as $row): ?>
                    <?php 

                    $this->db->select($row['type_golongan'] . ' AS harga_jual');
                    $harga_jual = $this->db->get_where('barang', ['id_barang' => $row['id_barang']])->row()->harga_jual;

                    $rpdiskon = ($row['diskon'] / 100) * $harga_jual;
                    $tot = $harga_jual - $rpdiskon;
                    $harga_brg = $tot;
                    $harga_asli = $harga_jual;
                    ?>
                    <tr data-id="<?php echo $row['id_barang'] ?>">
                      <input type="hidden" name="id_barang[]" value="<?php echo $row['id_barang'] ?>">
                      <input type="hidden" name="type_golongan[]" value="<?php echo $row['type_golongan'] ?>">
                      <input data-subtot="<?php echo $row['id_barang'] ?>" type="hidden" name="total_harga[]" value="<?php echo $row['total_harga'] ?>">
                      <td width="30%"><?php echo $row['nama_pendek'] ?></td>
                      <td><?php echo number_format($harga_asli) ?></td>
                      <td><?php echo $row['diskon'] ?></td>
                      <td><input class="form-control qty" name="jumlah[]" data-id="<?php echo $row['id_barang'] ?>" data-harga="<?php echo $harga_brg ?>" type="number" value="<?php echo $row['jumlah'] ?>" style="width: 5em"></td>
                      <td class="subtotal" data-kode="<?php echo $row['id_barang'] ?>"><?php echo number_format($row['total_harga'], '0','','.') ?></td>
                      <td><a class="btn btn-danger btn-flat hapus-barang" data-id="<?php echo $row['id_barang'] ?>" data-harga="<?php echo $harga_brg ?>"><i class="fa fa-trash"></i></a></td>
                    </tr>
                  <?php endforeach ?>
                <?php endif ?>

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
                <td><input type="number" class="form-control diskon" name="diskon" autocomplete="off" value="<?php echo $penjualan['diskon'] ?>"></td>
                <td><input type="number" class="form-control potongan" name="potongan" autocomplete="off" value="<?php echo $penjualan['potongan'] ?>"></td>
              </tr>
              <tr>
                <th>Jumlah Bayar</th>
                <td colspan="2"><input readonly="" type="text" class="form-control jumlah_bayar" name="jumlah_bayar" value="<?php echo "Rp. " . number_format($penjualan['total_bayar']) ?>"></td>
              </tr>
              <input type="hidden" name="tgl_jatuh_tempo">
              <input type="hidden" name="nama_pengiriman">
              <input type="hidden" name="alamat_pengiriman">
              <input type="hidden" name="periode" value="17">
              <input type="hidden" name="periode_lama" value="<?php echo $penjualan['periode'] ?>">
              <tr>
                <th>Periode</th>
                <td colspan="2">
                  <select name="periode" id="periode" class="form-control">
                    <option value="17" <?php echo $penjualan['periode'] == '17' ? 'selected' : '' ?>>17</option>
                    <option value="40" <?php echo $penjualan['periode'] == '40' ? 'selected' : '' ?>>40</option>
                    <option value="44" <?php echo $penjualan['periode'] == '44' ? 'selected' : '' ?>>44</option>
                    <option value="48" <?php echo $penjualan['periode'] == '48' ? 'selected' : '' ?>>48</option>
                  </select>
                </td>
              </tr>
              <tr>
                <th>Nominal Kocokan</th>
                <td colspan="2">
                  <input type="text" name="kocokan" id="kocokan" class="form-control" placeholder="Nominal Kocokan" value="<?php echo $penjualan['kocokan'] ?>">
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
            <?php echo $penjualan['faktur_penjualan']; ?>
          </div>
          <div class="pull-right">
            <input type="text" class="total_jumlah_bayar" style="text-align: right;border:none; font-size: 50px" value="<?php echo "Rp. " . number_format($penjualan['total_bayar']) ?>">
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="box box-danger">
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

<!-- tambah pelanggan -->
<div class="modal fade" id="tambah-pelanggan" tabindex="-1" role="dialog" aria-labelledby="tambah-pelangganTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="exampleModalLongTitle">Tambah Pelanggan</h4>
      </div>
      <div class="modal-body">
        <form method="POST" class="tambah-pelanggan">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group <?php if(form_error('id')) echo 'has-error'?>">
                <label for="id">ID pelanggan</label>
                <input readonly="" type="text" id="id" name="id" class="form-control id " placeholder="ID pelanggan" value="<?php echo autoID('PLG', 'pelanggan') ?>">
                <?php echo form_error('id', '<small style="color:red">','</small>') ?>
              </div>
              <div class="form-group <?php if(form_error('nama_pelanggan')) echo 'has-error'?>">
               <label for="nama_pelanggan">Nama pelanggan</label>
               <input type="text" id="nama_pelanggan" name="nama_pelanggan" class="form-control nama_pelanggan" placeholder="Nama pelanggan" value="<?php echo set_value('nama_pelanggan') ?>">
               <?php echo form_error('nama_pelanggan', '<small style="color:red">','</small>') ?>
             </div>
             <div class="form-group <?php if(form_error('jk')) echo 'has-error'?>">
               <label for="jk">Jenis Kelamin</label><br>
               <select name="jk" id="jk" class="form-control">
                 <option value="">-- Silahkan Pilih Jenis Kelamin --</option>
                 <option value="L" <?php echo set_value('jk') == "L" ? 'selected' : '' ?>>Laki-Laki</option>
                 <option value="P" <?php echo set_value('jk') == "P" ? 'selected' : '' ?>>Perempuan</option>
               </select>
               <?php echo form_error('jk', '<small style="color:red">','</small>') ?>
             </div>
             <div class="form-group <?php if(form_error('telepon')) echo 'has-error'?>">
               <label for="telepon">Telepon</label>
               <input type="text" id="telepon" name="telepon" class="form-control telepon " placeholder="Telepon" value="<?php echo set_value('telepon') ?>">
               <?php echo form_error('telepon', '<small style="color:red">','</small>') ?>
             </div>
           </div>
           <div class="col-md-6">
             <div class="form-group <?php if(form_error('jenis')) echo 'has-error'?>">
               <label for="jenis">Jenis Pelanggan</label><br>
               <select name="jenis" id="jenis" class="form-control">
                 <option value="">-- Silahkan Pilih Jenis Pelanggan --</option>
                 <option value="Umum" <?php echo set_value('jenis') == "Umum" ? 'selected' : '' ?>>Umum</option>
                 <option value="Member" <?php echo set_value('jenis') == "Member" ? 'selected' : '' ?>>Member</option>
               </select>
               <?php echo form_error('jenis', '<small style="color:red">','</small>') ?>
             </div>
             <div class="form-group <?php if(form_error('alamat')) echo 'has-error'?>" >
               <label for="alamat">Alamat</label>
               <textarea name="alamat" id="alamat" cols="30" rows="5" class="form-control " placeholder="alamat"><?php echo set_value('alamat') ?></textarea>
               <?php echo form_error('alamat', '<small style="color:red">','</small>') ?>
             </div>

           </div>
         </div>
       </div>
       <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </form>
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

  echo "const pengaturan = " . json_encode($pengaturan) . "; ";

  echo "const judul = '" . $judul. "'; ";

  echo "const total_bayar_rp = " . $penjualan['total_bayar']. "; ";


  ?>
</script>   
