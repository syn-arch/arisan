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
            <a href="<?php echo base_url('master/barang') ?>" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Kembali</a>
          </div>
        </div>
      </div>
      <div class="box-body">
       <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
         <form method="POST" enctype="multipart/form-data">
          <div class="form-group <?php if(form_error('id_barang')) echo 'has-error'?>">
            <label for="id_barang">ID barang</label>
            <input autocomplete="off" readonly="" type="text" id="id_barang" name="id_barang" class="form-control id_barang " placeholder="ID barang" value="<?php echo $barang['id_barang']?>">
            <?php echo form_error('id_barang', '<small style="color:red">','</small>') ?>
          </div>
          <div class="form-group <?php if(form_error('nama_barang')) echo 'has-error'?>">
            <label for="nama_barang">Nama Barang</label>
            <input autocomplete="off" type="text" id="nama_barang" name="nama_barang" class="form-control nama_barang " placeholder="Nama Barang" value="<?php echo $barang['nama_barang'] ?>">
            <?php echo form_error('nama_barang', '<small style="color:red">','</small>') ?>
          </div>
          <div class="form-group <?php if(form_error('nama_pendek')) echo 'has-error'?>">
            <label for="nama_pendek">Nama Pendek</label>
            <input autocomplete="off" type="text" id="nama_pendek" name="nama_pendek" class="form-control nama_pendek " placeholder="Nama Pendek" value="<?php echo $barang['nama_pendek'] ?>">
            <?php echo form_error('nama_pendek', '<small style="color:red">','</small>') ?>
          </div>
          <div class="form-group <?php if(form_error('id_kategori')) echo 'has-error'?>">
           <label for="id_kategori">Kategori</label>
           <select name="id_kategori" id="id_kategori" class="form-control">
             <option value="">-- Silahkan Pilih Kategori ---</option>
             <?php foreach ($kategori as $row): ?>
               <option value="<?php echo $row['id_kategori'] ?>" <?php echo $barang['id_kategori'] == $row['id_kategori'] ? 'selected' : '' ?>><?php echo $row['nama_kategori'] ?></option>
             <?php endforeach ?>
           </select>
           <?php echo form_error('id_kategori', '<small style="color:red">','</small>') ?>
         </div>
         <div class="form-group <?php if(form_error('id_supplier')) echo 'has-error'?>">
           <label for="id_supplier">Supplier</label>
           <select name="id_supplier" id="id_supplier" class="form-control">
            <option value="">-- Silahkan Pilih Supplier ---</option>
            <?php foreach ($supplier as $row): ?>
             <option value="<?php echo $row['id_supplier'] ?>" <?php echo $barang['id_supplier'] == $row['id_supplier'] ? 'selected' : '' ?>><?php echo $row['nama_supplier'] ?></option>
           <?php endforeach ?>
         </select>
         <?php echo form_error('id_supplier', '<small style="color:red">','</small>') ?>
       </div>
       <div class="form-group <?php if(form_error('satuan')) echo 'has-error'?>">
        <label for="satuan">Satuan</label>
        <input autocomplete="off" type="text" id="satuan" name="satuan" class="form-control satuan " placeholder="Satuan" value="<?php echo $barang['satuan'] ?>">
        <?php echo form_error('satuan', '<small style="color:red">','</small>') ?>
      </div>
      <div class="form-group <?php if(form_error('harga_pokok')) echo 'has-error'?>">
        <label for="harga_pokok">Harga Pokok</label>
        <input autocomplete="off" type="number" id="harga_pokok" name="harga_pokok" class="form-control harga_pokok " placeholder="Harga Pokok" value="<?php echo $barang['harga_pokok'] ?>">
        <?php echo form_error('harga_pokok', '<small style="color:red">','</small>') ?>
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
            <label for="golongan_1">Harga Jual</label>
            <input autocomplete="off" type="number" id="golongan_1" name="golongan_1" class="form-control golongan_1 <?php if(form_error('golongan_1')) echo 'is-invalid'?>" placeholder="Golongan 1" value="<?php echo $barang['golongan_1'] ?>">
            <?php echo form_error('golongan_1', '<small style="color:red">','</small>') ?>
          </div>
        </div>  
        <div class="col-md-4">
          <div class="form-group">
            <label for="profit_1">Laba</label>
            <input autocomplete="off" readonly="" type="number" id="profit_1" name="profit_1" class="form-control profit_1 <?php if(form_error('profit_1')) echo 'is-invalid'?>" placeholder="Profit 1" value="<?php echo $barang['profit_1'] ?>">
            <?php echo form_error('profit_1', '<small style="color:red">','</small>') ?>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label for="qty_1">Qty 1</label>
            <input readonly autocomplete="off" type="text" id="qty_1" name="qty_1" class="form-control qty_1 <?php if(form_error('qty_1')) echo 'is-invalid'?>" placeholder="Qty 1" value="<?php echo $barang['qty_1'] ?>">
            <?php echo form_error('qty_1', '<small style="color:red">','</small>') ?>
          </div>
        </div>
      </div>
      <input type="hidden" name="golongan_2">
      <input type="hidden" name="profit_2">
      <input type="hidden" name="qty_2">
      <input type="hidden" name="golongan_3">
      <input type="hidden" name="profit_3">
      <input type="hidden" name="qty_3">
      <input type="hidden" name="golongan_4">
      <input type="hidden" name="profit_4">
      <input type="hidden" name="qty_4">
      <div class="form-group <?php if(form_error('stok')) echo 'has-error'?>">
        <label for="stok">Stok</label>
        <input readonly autocomplete="off" type="text" id="stok" name="stok" class="form-control stok " placeholder="Stok" value="<?php echo $barang['stok'] ?>">
        <?php echo form_error('stok', '<small style="color:red">','</small>') ?>
      </div>
     <input type="hidden" name="diskon">
      <div class="form-group <?php if(form_error('barcode')) echo 'has-error'?>">
        <label for="barcode">Barcode</label>
        <input autocomplete="off" type="text" id="barcode" name="barcode" class="form-control barcode " placeholder="Barcode" value="<?php echo $barang['barcode'] ?>">
        <?php echo form_error('barcode', '<small style="color:red">','</small>') ?>
      </div>
      <div class="form-group <?php if(form_error('gambar')) echo 'has-error'?>">
        <label for="gambar">Gambar</label>
        <input autocomplete="off" type="file" id="gambar" name="gambar" class="form-control gambar " placeholder="Gambar" value="<?php echo $barang['gambar'] ?>">
        <?php echo form_error('gambar', '<small style="color:red">','</small>') ?>
      </div>
      <div class="form-group">
        <img src="<?php echo base_url('assets/img/barang/') . $barang['gambar'] ?>" alt="" class="img-responsive">
      </div>
      <div class="form-group">
       <button type="submit" class="btn btn-danger btn-block">Submit</button>
     </div>
   </form>
 </div>
</div>
</div>
</div>
</div>
</div>
