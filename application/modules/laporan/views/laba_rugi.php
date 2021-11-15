<div class="box box-danger">
	<div class="box-header with-border">
		<div class="pull-left">
			<h4 class="box-title"><?php echo $judul ?></h4>
		</div>
		<div class="pull-right">
			<?php if ($dari = $this->input->get('dari') && $sampai = $this->input->get('sampai')): ?>
				<a href="<?= base_url('laporan/cetak_laba_rugi/' . $this->input->get('dari') . '/' . $sampai . '/' . $this->input->get('id_outlet')) ?>" class="btn btn-success"><i class="fa fa-print"></i> Cetak</a>
			<?php endif ?>
			<a href="<?= base_url('laporan/penjualan') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
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
						<input type="date" name="sampai" id="dari" class="form-control" value="<?php echo $this->input->get('sampai') ?>">
					</div>
					<div class="form-group <?php if(form_error('id_outlet')) echo 'has-error'?>">
						<label for="id_outlet">Outlet</label>
						<select name="id_outlet" id="id_outlet" class="form-control">
							<option value="">Semua Outlet</option>
							<?php foreach ($outlet as $row): ?>
								<option <?php echo $row['id_outlet'] == $this->input->get('id_outlet') ? 'selected' : '' ?> value="<?php echo $row['id_outlet'] ?>"><?php echo $row['nama_outlet'] ?></option>
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
		<br>
		<br>
		<?php if ($this->input->get('dari')): ?>	
			<div class="row">
				<div class="col-md-12">
					<div class="table-responsive">
						<table class="table table-bordere">
							<tr>
								<th width="70%">Pendapatan Penjualan</th>
								<td><?php echo "Rp. " . number_format($pendapatan) ?></td>
							</tr>
							<tr>
								<th width="40%">Penjualan</th>
							</tr>
							<tr>
								<th>Potongan Penjualan</th>
								<td><?php echo "Rp. " . number_format($potongan) ?></td>
							</tr>
							<tr>
								<th width="70%">Penjualan Bersih</th>
								<td><?php echo "Rp. " . number_format($pendapatan_bersih) ?></td>
							</tr>
							<tr>
								<th width="70%">Laba Penjualan</th>
								<td><?php echo "Rp. " . number_format($harga_pokok) ?></td>
							</tr>
							<tr>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<th>Macam-macam pendapatan</th>
								<td></td>
							</tr>
							<?php foreach ($detail_pemasukan as $row): ?>
							<tr>
								<td><?php echo $row['keterangan_biaya'] ?></td>
								<td><?php echo "Rp. " . number_format($row['total_bayar']) ?></td>
							</tr>
							<?php endforeach ?>
							<tr>
								<th>Total macam-macam pendapatan</th>
								<td><?php echo "Rp. " . number_format($pemasukan) ?></td>
							</tr>
							<tr>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<th>Macam-macam pengeluaran</th>
								<td></td>
							</tr>
							<?php foreach ($detail_pengeluaran as $row): ?>
							<tr>
								<td><?php echo $row['keterangan_biaya'] ?></td>
								<td><?php echo "Rp. " . number_format($row['total_bayar']) ?></td>
							</tr>
							<?php endforeach ?>
							<tr>
								<th>Total macam-macam pengeluaran</th>
								<td><?php echo "Rp. " . number_format($pengeluaran) ?></td>
							</tr>
							<tr>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<th>Total Laba Bersih</th>
								<td><?php echo "Rp. " . number_format( $harga_pokok + $pemasukan - $pengeluaran) ?></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		<?php endif ?>
	</div>
</div>