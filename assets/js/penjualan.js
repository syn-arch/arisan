$(function () {

    $('.qty_brg').focus();

    $('#table-cari-barang').dataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": base_url + "barang/get_harga_barang_json/",
            "type": "POST"
        },
        "columns": [
            { "data": "id_barang" },
            { "data": "barcode" },
            { "data": "nama_barang" },
            {
                "data": "golongan_1",
                render: $.fn.dataTable.render.number('.', '.', 0, '')

            },
            { "data": "stok_q" },
            {
                "data": "id_barang",
                render: function (data, type, row) {
                    return `<button class="btn btn-info tambah-barang" data-id="${data}"><i class="fa fa-cart-plus"></i></button>`
                }
            }
        ],
    });

    // slight update to account for browsers not supporting e.which
    function disableF5(e) {
        if ((e.which || e.keyCode) == 116) {
            e.preventDefault();
            swal({
                title: "Apakah anda yakin?",
                text: "Transaksi akan dibatalkan!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    location.reload(true)
                }
            });
        }
    };

    // disable refresh
    $(document).on("keydown", disableF5);

    $('.hold-penjualan').click(function (e) {
        e.preventDefault();
        $('.form-penjualan').attr('action', base_url + 'penjualan/proses/true');
        $('.form-penjualan').submit();
    })

    $('.ship_nama').hide()
    $('.ship_alamat').hide()

    $('#kirim').click(function () {
        if ($(this).prop('checked') == true) {
            $('.ship_nama').show()
            $('.ship_alamat').show()
        } else {
            $('.ship_nama').hide()
            $('.ship_alamat').hide()
        }
    })

    $('.no_debit').hide()
    $('.no_kredit').hide()
    $('.lampiran').hide()

    $('.metode_pembayaran').change(function () {
        const val = $(this).val()
        if (val == 'Cash') {
            $('.no_debit').hide()
            $('.no_kredit').hide()
            $('.lampiran').hide()
        } else {
            $('.no_debit').show()
            $('.no_kredit').show()
            $('.lampiran').show()
        }
    })

    function get_subtotal() {
        let total = 0;
        $(document).find('.subtotal').each(function (index, element) {
            total += parseInt($(element).text().replace('Rp. ', '').replace('.', '').replace('.', '').replace('.', ''));
        });

        return total;
    }

    function tambah_lagi(id_barang, harga_jual, golongan, qtyPlus) {

        item = $.parseJSON($.ajax({
            url: base_url + 'barang/get_barang/' + id_barang + '/' + golongan,
            dataType: "json",
            async: false
        }).responseText);

        item.diskon == null ? diskon = 0 : diskon = item.diskon;

        harga = item.harga_jual - (diskon / 100) * item.harga_jual;

        $(document).find('td[data-secret="' + id_barang + '"]').text(toRupiah(harga_jual, true));
        $(document).find('input[data-id="' + id_barang + '"]').attr('data-harga', harga_jual);
        $(document).find('input[data-golongan="' + id_barang + '"]').val(golongan);

        $('input[data-id="' + id_barang + '"]').val(qtyPlus);

        $(document).find('input[data-subtot="' + id_barang + '"]').val(qtyPlus * harga);
        $(document).find('td[data-kode="' + id_barang + '"]').html(toRupiah(qtyPlus * harga, true));

        if (pengaturan.kunci_penjualan == 1) {
            $('a[data-id="' + data.id_barang + '"]').attr('data-qty', qtyPlus);
        }
    }

    function tambah_chart(id, qty = '1') {

        if (qty == '') {
            qty = 1;
        } else {
            qty = parseFloat(qty)
        }

        $.get(base_url + 'barang/get_brg/' + id, function (res) {
            data = JSON.parse(res)
            if (data == null) {
                swal({
                    title: "Error!",
                    text: "Barang tidak ditemukan silahkan cari lagi!",
                    icon: "error",
                    timer: 1500
                });
                $('.barcode').val('');
                $('.qty_brg').focus();
                return
            }

            let { qty_1, qty_2, qty_3, qty_4 } = data

            if (qty_1 == null) qty_1 = 0;
            if (qty_2 == null) qty_2 = 0;
            if (qty_3 == null) qty_3 = 0;
            if (qty_4 == null) qty_4 = 0;

            if (qty >= qty_1 && qty_1 != 0) {
                harga_jual = data.golongan_1
                golongan = 'golongan_1'
            }

            if (qty >= qty_2 && qty_2 != 0) {
                harga_jual = data.golongan_2
                golongan = 'golongan_2'
            }

            if (qty >= qty_3 && qty_3 != 0) {
                harga_jual = data.golongan_3
                golongan = 'golongan_3'
            }

            if (qty >= qty_4 && qty_4 != 0) {
                harga_jual = data.golongan_4
                golongan = 'golongan_4'
            }

            data.diskon == null ? diskon = 0 : diskon = data.diskon;

            harga_brg = harga_jual - (diskon / 100) * harga_jual;

            let subtot = qty * harga_brg;

            const cari = $(document).find('tr[data-id="' + data.id_barang + '"]');

            if (cari.length > 0) {

                const quantity = $('input[data-id="' + data.id_barang + '"]').val();
                const qtyPlus = parseFloat(quantity) + qty;

                if (qty_2 != 0) {
                    if (qtyPlus >= qty_1 && qtyPlus < qty_2) {
                        tambah_lagi(data.id_barang, data.golongan_1, 'golongan_1', qtyPlus)
                    }
                } else {
                    if (qtyPlus >= qty_1 && qty_1 != 0) {
                        tambah_lagi(data.id_barang, data.golongan_1, 'golongan_1', qtyPlus)
                    }
                }

                if (qty_3 != 0) {
                    if (qtyPlus >= qty_2 && qtyPlus < qty_3) {
                        tambah_lagi(data.id_barang, data.golongan_2, 'golongan_2', qtyPlus)
                    }
                } else {
                    if (qtyPlus >= qty_2 && qty_2 != 0) {
                        tambah_lagi(data.id_barang, data.golongan_2, 'golongan_2', qtyPlus)
                    }
                }

                if (qty_4 != 0) {
                    if (qtyPlus >= qty_3 && qtyPlus < qty_4) {
                        tambah_lagi(data.id_barang, data.golongan_3, 'golongan_3', qtyPlus)
                    }
                } else {
                    if (qtyPlus >= qty_3 && qty_3 != 0) {
                        tambah_lagi(data.id_barang, data.golongan_3, 'golongan_3', qtyPlus)
                    }
                }

                if (qtyPlus >= qty_4 && qty_4 != 0) {
                    tambah_lagi(data.id_barang, data.golongan_4, 'golongan_4', qtyPlus)
                }

            } else {

                let html;

                if (pengaturan.kunci_penjualan == 1) {
                    html =
                        `
					<tr data-id="${data.id_barang}">
					<input type="hidden" name="id_barang[]" value="${data.id_barang}">
					<input data-golongan="${data.id_barang}" type="hidden" name="type_golongan[]" value="${golongan}">
					<input data-subtot="${data.id_barang}" type="hidden" name="total_harga[]" value="${subtot}">
					<td width="30%">${data.nama_pendek}</td>
					<td data-secret="${data.id_barang}" class="harga_brg">${toRupiah(harga_jual, true)}</td>
					<td>${diskon}</td>
					<td>
					<input autocomplete="off" readonly class="form-control qty" name="jumlah[]" data-id="${data.id_barang}" data-harga="${harga_brg}" type="number" value="${qty}" style="width: 5em">
					</td>
					<td class="subtotal" data-kode="${data.id_barang}">${toRupiah(subtot, true)}</td>
					<td>
					<a class="btn btn-danger fa fa-trash hapus_kunci_brg" data-type="hapus" data-harga="${harga_brg}" data-qty="${qty}" data-id="${data.id_barang}"></a>
					<a class="btn btn-warning fa fa-edit ubah_kunci_brg" data-type="ubah" data-harga="${harga_brg}" data-qty="${qty}" data-id="${data.id_barang}"></a>
					</td>
					</tr>
					`
                } else {
                    html = `
					<tr data-id="${data.id_barang}">
					<input type="hidden" name="id_barang[]" value="${data.id_barang}">
					<input data-golongan="${data.id_barang}" type="hidden" name="type_golongan[]" value="${golongan}">
					<input data-subtot="${data.id_barang}" type="hidden" name="total_harga[]" value="${subtot}">
					<td width="30%">${data.nama_pendek}</td>
					<td data-secret="${data.id_barang}" class="harga_brg">${toRupiah(harga_jual, true)}</td>
					<td>${diskon}</td>
					<td>
					<input autocomplete="off" class="form-control qty" name="jumlah[]" data-id="${data.id_barang}" data-harga="${harga_brg}" type="number" value="${qty}" style="width: 5em">
					</td>
					<td class="subtotal" data-kode="${data.id_barang}">${toRupiah(subtot, true)}</td>
					<td><a class="btn btn-danger btn-flat hapus-barang" data-id="${data.id_barang}" data-harga="${harga_brg}"><i class="fa fa-trash"></i></a></td>
					</tr>
					`;
                }

                $('.penjualan-item').append(html);
            }

            $('.jumlah_bayar').val(toRupiah(get_subtotal()));
            $('.total_jumlah_bayar').val(toRupiah(get_subtotal()));

            $('.qty_brg').val('');
            $('.qty_brg').focus();

            updateKembalian();

        });
    }

    $(document).on('click', '.hapus_kunci_brg', function () {
        $('#input_password').modal('show');
        $('.input_password').focus()
        $('.id_brg').val($(this).data('id'));
        $('.harga_brg').val($(this).data('harga'));
        $('.qty_brg').val($(this).data('qty'));
        $('.ubah_brg').val(0)
    })

    $(document).on('click', '.ubah_kunci_brg', function () {
        $('#input_password').modal('show');
        $('.input_password').focus()
        $('.id_brg').val($(this).data('id'));
        $('.harga_brg').val($(this).data('harga'));
        $('.qty_brg').val($(this).data('qty'));
        $('.ubah_brg').val(1)
    })

    function hapus_brg() {
        $.ajax({
            method: 'post',
            url: base_url + 'penjualan/verify_password',
            data: {
                password: $('.input_password').val()
            },
            success: function (res) {
                if (res == 'false') {
                    swal({
                        title: "Error!",
                        text: "Password yang anda masukan salah!",
                        icon: "error",
                        timer: 1500
                    });
                    $('.input_password').val('')
                } else {

                    const id = $('.id_brg').val();
                    const harga = $('.harga_brg').val();
                    const qty = $('.qty_brg').val();

                    $('tr[data-id="' + id + '"]').remove();

                    $('.harga').html('Rp. 0');

                    $('.jumlah_bayar').val(toRupiah(get_subtotal()));
                    $('.total_jumlah_bayar').val(toRupiah(get_subtotal()));
                    $('.barcode').focus();
                    $('.input_password').val('')
                }
            }
        })
    }

    function ubah_brg() {
        $.ajax({
            method: 'post',
            url: base_url + 'penjualan/verify_password',
            data: {
                password: $('.input_password').val()
            },
            success: function (res) {
                if (res == 'false') {
                    swal({
                        title: "Error!",
                        text: "Password yang anda masukan salah!",
                        icon: "error",
                        timer: 1500
                    });
                    $('.input_password').val('')
                } else {
                    const id_brg = $('.id_brg').val();
                    $('input[data-id="' + id_brg + '"]').removeAttr('readonly')
                    $('.input_password').val('')
                }
            }
        })
    }

    $('.input_password').keyup(function (e) {
        const ubah = $('.ubah_brg').val()
        if (e.keyCode == 13) {
            e.preventDefault();
            if (ubah == 0) {
                hapus_brg();
            } else {
                ubah_brg();
            }
            $('#input_password').modal('hide');
        }
    })

    function updateKembalian() {
        let subtotal = get_subtotal();
        const cash = $(document).find('.cash').val();
        if (parseFloat(cash) > 0) {
            const baru = cash - subtotal;
            $('.kembalian').val(toRupiah(baru));
        }
    }


    $(document).on('click', '.tambah-barang', function () {
        const id = $(this).data('id');
        const qty = $('.qty_brg').val();
        tambah_chart(id, qty);
    })

    $(document).on('click', '.hapus-barang', function (e) {
        e.preventDefault();

        $(this).closest('tr').remove();
        $('.harga').html('Rp. 0');

        const id = $(this).data('id');

        const harga = $(this).closest('tr[data-id="' + id + '"]').find('input[data-id="' + id + '"]').attr('data-harga');
        const qty = $(this).closest('tr[data-id="' + id + '"]').find('input[data-id="' + id + '"]').val();

        const jumlah = parseFloat(harga) * parseFloat(qty);
        const jumlah1 = get_subtotal() + jumlah;
        const jumlah2 = parseFloat(jumlah1) - jumlah;

        $('.jumlah_bayar').val(toRupiah(jumlah2));
        $('.total_jumlah_bayar').val(toRupiah(jumlah2));
        $('.barcode').focus();
        updateKembalian();
    })

    $(document).on('click', '.batal', function (e) {
        e.preventDefault();
        $('.penjualan-item').html('');
        $('.harga').html('Rp. 0');
        $('.kembalian').html('');
        $('.cash').val('');
        $('.kembalian').val('');
        $('.qty_brg').val('');
        $('.jumlah_bayar').val('Rp. 0');
        $('.total_jumlah_bayar').val('Rp. 0');
        $('.barcode').focus();
    })


    $('.cash').keyup(function (e) {
        $(this).val(formatRupiah($(this).val()));

        cash = $(this).val().replace('.', '').replace('.', '').replace('.', '');
        const jumlah = parseFloat($('.jumlah_bayar').val().replace('Rp. ', '').replace('.', '').replace('.', '').replace('.', ''));

        const member = $('.member').val();

        jumlahAkhir = jumlah;

        let kembalian = toRupiah(parseFloat(cash) - parseFloat(jumlahAkhir));
        if (kembalian == 'Rp. NaN') {
            kembalian = "Rp. 0";
        }
        $('.kembalian').val(kembalian);
    })

    function hitung_kembali(id, golongan, jumlah) {

        item = $.parseJSON($.ajax({
            url: base_url + 'barang/get_barang/' + id + '/' + golongan,
            dataType: "json",
            async: false
        }).responseText);

        item.diskon ? diskon = item.diskon : diskon = 0;

        _rpdiskon = (diskon / 100) * item.harga_jual;
        harga = item.harga_jual - _rpdiskon;
        harga_asli = item.harga_jual;

        $(document).find('input[data-golongan="' + id + '"]').val(golongan);
        $(document).find('td[data-secret="' + id + '"]').text(toRupiah(harga_asli, true));
        $(document).find('input[data-id="' + id + '"]').attr('data-harga', harga_asli);

        const jumlahHarga = parseFloat(jumlah) * parseFloat(harga);

        $(document).find('td[data-kode="' + id + '"]').html(toRupiah(jumlahHarga, true));

        $('.jumlah_bayar').val(toRupiah(get_subtotal()));
        $('.total_jumlah_bayar').val(toRupiah(get_subtotal()));

        updateKembalian();
    }

    $(document).on('keyup change', '.qty', function (e) {

        jmlBayar = get_subtotal() ? get_subtotal() : 0

        let jumlah = $(this).val() ? $(this).val() : 1

        jumlah = parseFloat(jumlah)

        const id = $(this).data('id')

        $.get(base_url + 'barang/get_brg/' + id, function (res) {
            data = JSON.parse(res)

            let { qty_1, qty_2, qty_3, qty_4 } = data;

            if (qty_1 == null) qty_1 = 0;
            if (qty_2 == null) qty_2 = 0;
            if (qty_3 == null) qty_3 = 0;
            if (qty_4 == null) qty_4 = 0;

            if (qty_2 != 0) {
                if (jumlah >= qty_1 && jumlah < qty_2) {
                    hitung_kembali(data.id_barang, 'golongan_1', jumlah)
                }
            } else {
                if (jumlah >= qty_1 && qty_1 != 0) {
                    hitung_kembali(data.id_barang, 'golongan_1', jumlah)
                }
            }

            if (qty_3 != 0) {
                if (jumlah >= qty_2 && jumlah < qty_3) {
                    hitung_kembali(data.id_barang, 'golongan_2', jumlah)
                }
            } else {
                if (jumlah >= qty_2 && qty_2 != 0) {
                    hitung_kembali(data.id_barang, 'golongan_2', jumlah)
                }
            }

            if (qty_4 != 0) {
                if (jumlah >= qty_3 && jumlah < qty_4) {
                    hitung_kembali(data.id_barang, 'golongan_3', jumlah)
                }
            } else {
                if (jumlah >= qty_3 && qty_3 != 0) {
                    hitung_kembali(data.id_barang, 'golongan_3', jumlah)
                }
            }

            if (jumlah >= qty_4 && qty_4 != 0) {
                hitung_kembali(data.id_barang, 'golongan_4', jumlah)
            }

        });

    });

    $(document).on('keydown', '.qty', function (e) {
        if (e.which == 13) {
            $('.barcode').focus();
            return false;
        }
    })

    $('.diskon').keyup(function (e) {
        let diskon = $(this).val() ? $(this).val() : 0;

        const jumlahbayar = get_subtotal() ? get_subtotal() : 0;

        let harga_sikon = (diskon / 100) * jumlahbayar;

        if (harga_sikon == 'Nan') harga_sikon = 0;

        let potongan = $('.potongan').val() ? $('.potongan').val() : 0;

        let hasilDiskon = toRupiah(parseFloat(jumlahbayar) - parseFloat(harga_sikon) - parseFloat(potongan));
        if (hasilDiskon == 'Rp. NaN') hasilDiskon = "Rp. 0"
        $('.jumlah_bayar').val(hasilDiskon);
    });

    $('.potongan').keyup(function (e) {

        $(this).val(formatRupiah($(this).val()));

        const jumlahbayar = get_subtotal();

        let diskon = $('.diskon').val() || 0;

        const harga_sikon = (parseFloat(diskon) / 100) * jumlahbayar;

        potongan_rupiah = $(this).val().replace('.', '').replace('.', '').replace('.', '');
        let hasilDiskon = toRupiah(parseFloat(jumlahbayar) - harga_sikon - parseFloat(potongan_rupiah));
        if (hasilDiskon == 'Rp. NaN') hasilDiskon = "Rp. 0"

        $('.jumlah_bayar').val(hasilDiskon);
    })

    $('.barcode').keydown(function (e) {
        const id = $(this).val();
        const qty = $('.qty_brg').val();
        if (e.which == '13') {
            e.preventDefault();
            e.stopPropagation();
            tambah_chart(id, qty);
            $(this).val('');
            $(this).focus();
        }
    })

    $('.barcode_pelanggan').keydown(function (e) {
        if (e.keyCode == 13) {
            e.preventDefault();
            const barcode = $(this).val();
            $.get(base_url + 'pelanggan/get_pelanggan/' + barcode, function (res) {
                if (res == 'null') {
                    swal({
                        title: "Error!",
                        text: "Pelanggan tidak ditemukan!",
                        icon: "error",
                        timer: 1500
                    });
                } else {
                    const data = JSON.parse(res)
                    $.get(base_url + 'penjualan/get_limit_pelanggan/' + data.id_pelanggan, function (response) {
                        if (response == 'true') {
                            swal({
                                title: "Error!",
                                text: "Pelanggan masih memiliki piutang!",
                                icon: "error",
                                timer: 1500
                            });
                        } else {
                            $('.pelanggan').val(data.id_pelanggan)
                        }
                    });
                }
            });
            $(this).val('')
        }
    })

    $('.kategori').change(function () {
        let id = $(this).val();
        let golongan = $('.golongan').val();
        if (id == '') {
            id = 'SEMUA'
        }
        $('.barang-kategori').empty()

        $.get(base_url + 'barang/get_barang_by_kategori/' + id + '/' + golongan, function (res) {
            const data = JSON.parse(res);
            $(data).each(function (index, el) {
                let gambar;
                if (el.gambar == '' || el.gambar == null) {
                    gambar = `<img src="${base_url}assets/img/barang/noimage.jpg" alt="barang" class="img-responsive">`;
                } else {
                    gambar = `<img src="${base_url}assets/img/barang/${el.gambar}" alt="barang" class="img-responsive">`;
                }
                harga = toRupiah(el.harga_jual);
                $('.barang-kategori').append(
                    `
				<tr>
				<td>${gambar}</td>
				<td>${el.nama_pendek}</td>
				<td>${harga}</td>
				<td><button class="btn btn-info tambah-barang" data-id="${el.id_barang}"><i class="fa fa-cart-plus"></i></button></td>
				</tr>
				`
                );
            });
        })
    });

    $('.cari_barang').keyup(function (e) {
        const name = $(this).val();
        let golongan = $('.golongan').val();
        $('.barang-kategori').empty()

        if (e.keyCode == 13) {
            $.get(base_url + 'barang/get_barang_by_barcode/' + name + '/' + golongan, function (res) {
                const data = JSON.parse(res);
                if (data.length == 0) {
                    $('.barang-kategori').html('<tr><td colspan="4"><h5 class="text-center">Data Tidak Ditemukan</td></tr>');
                }
                $(data).each(function (index, el) {
                    let gambar;
                    if (el.gambar == '' || el.gambar == null) {
                        gambar = `<img src="${base_url}assets/img/barang/noimage.jpg" alt="barang" class="img-responsive">`;
                    } else {
                        gambar = `<img src="${base_url}assets/img/barang/${el.gambar}" alt="barang" class="img-responsive">`;
                    }
                    let harga;
                    harga = toRupiah(el.harga_jual);
                    $('.barang-kategori').append(
                        `
					<tr>
					<td>${gambar}</td>
					<td>${el.nama_pendek}</td>
					<td>${harga}</td>
					<td><button class="btn btn-info tambah-barang" data-id="${el.id_barang}"><i class="fa fa-cart-plus"></i></button></td>
					</tr>
					`
                    );
                });
            })
        } else {
            $.get(base_url + 'barang/get_barang_by_name/' + name + '/' + golongan, function (res) {
                const data = JSON.parse(res);
                if (data.length == 0) {
                    $('.barang-kategori').html('<tr><td colspan="4"><h5 class="text-center">Data Tidak Ditemukan</td></tr>');
                }
                $(data).each(function (index, el) {
                    let gambar;
                    if (el.gambar == '' || el.gambar == null) {
                        gambar = `<img src="${base_url}assets/img/barang/noimage.jpg" alt="barang" class="img-responsive" width="100%">`;
                    } else {
                        gambar = `<img src="${base_url}assets/img/barang/${el.gambar}" alt="barang" class="img-responsive" width="100%">`;
                    }
                    harga = toRupiah(el.harga_jual);
                    $('.barang-kategori').append(
                        `
					<tr>
					<td>${gambar}</td>
					<td>${el.nama_pendek}</td>
					<td>${harga}</td>
					<td><button class="btn btn-info tambah-barang" data-id="${el.id_barang}"><i class="fa fa-cart-plus"></i></button></td>
					</tr>
					`
                    );
                });
            })
        }
    });

    $('.form-control.input-sm').keyup(function (e) {
        if (e.keyCode == 13) {
            table = $(document).find("#table-cari-barang");
            tr = $(table).find('tr')
            td = $(tr).find('td')
            id = td[0].innerHTML;
            qty = $('.qty_brg').val()
            tambah_chart(id, qty);
            $(this).val('')
        }
    });

    function shortcut(e) {
        if (e.keyCode == 112) { // F1
            e.preventDefault();
            $('.form-control.input-sm').focus()
        }
        if (e.keyCode == 113) { // F2
            e.preventDefault();
            $('.diskon').focus()
        }
        if (e.keyCode == 114) { // F3
            e.preventDefault();
            $('.qty_focus').focus()
        }
        if (e.keyCode == 115) { // F4
            e.preventDefault();
            $('.cash').focus()
        }
    }

    // shortcut
    $(document).on('keyup keydown', 'input', function (e) {
        shortcut(e);
    });

    $(document).on('keyup keydown', function (e) {
        shortcut(e);
    });

});
