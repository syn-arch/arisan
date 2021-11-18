$(function(){

	const petugasTable = $('#table-riwayat-penjualan').dataTable({ 
		"processing": true,
		"serverSide": true,
		"pageLength" : 50,
		"order": [],
		"ajax": {
			"url": base_url + "penjualan/get_riwayat_penjualan_data/" + dari + '/' + sampai + '/' + id_outlet,
			"type": "POST"
		},
		"columns": [
		{
			orderable : false,
			"data": "faktur_penjualan",
			"render" : function(data, type, row){
				return `<input type="checkbox" class="data_checkbox" name="faktur_penjualan[]" value="${data}">`
			}
		},
		{
			"data" : "faktur_penjualan"
		},
		{
			"data" : "tgl",
		},
		{
			"data": "nama_pelanggan",
		},
		{
			"data": "nama_karyawan",
		},
		{
			"data": "total_bayar",
			render: $.fn.dataTable.render.number( '.', '.', 0, '')
		},
		{
			"data" : "status",
			"render" : function(data, type, row) {
				if(data == 'Lunas'){
					return `<button class="btn btn-success">LUNAS</button>`
				}
				return `<button class="btn btn-warning">BELUM LUNAS</button>`
			}
		},
		{
			searchable : false,
			"data": "faktur_penjualan",
			"render" : function(data, type, row) {
				if (level == 'Admin') {
					return `<a title="invoice" class="btn btn-flat btn-info" href="${base_url}penjualan/invoice/${data}"><i class="fa fa-eye"></i></a>
					<a title="ubah transaksi" class="btn btn-flat btn-primary" href="${base_url}penjualan/ubah/${data}"><i class="fa fa-edit"></i></a>
					<a title="daftar pembayaran" class="btn btn-flat btn-success" href="${base_url}penjualan/pembayaran/${data}"><i class="fa fa-list"></i></a>
					<a title="hapus penjualan" class="btn btn-flat btn-danger hapus_riwayat_penjualan" data-href="${base_url}penjualan/hapus_penjualan/${data}"><i class="fa fa-trash"></i></a>
					`
				}else{
					return `<a title="invoice" class="btn btn-flat btn-info" href="${base_url}penjualan/invoice/${data}"><i class="fa fa-eye"></i></a>
					`
				}
			}
		}
		],
	})

	$(document).on('click', '.hapus_riwayat_penjualan', function(){
		hapus($(this).data('href'))
	})

})