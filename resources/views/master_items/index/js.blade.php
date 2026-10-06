<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

<script>
    var start_date = '';
    var end_date = '';
    var data_per_fetch = 500;
    var data_fetched = 0;

    $(document).ready(function() {
        $('#table').DataTable({
            searching: false,
            order: [[0, 'desc']],
        });
        getData()
    });

    $('.btn-get-data').click(function() {
        getData()
    })

    function getData(){
        
        $('#loading-filter').show();
        var dataTableObj = $('#table').DataTable();
        var filter_kode = $('#filter-kode').val()
        var filter_nama = $('#filter-nama').val()
        var filter_harga_min = $('#filter-harga-min').val()
        var filter_harga_max = $('#filter-harga-max').val()
        dataTableObj.clear().draw();

        $.ajax({
            url: '{{url("master-items/search")}}',
            dataType: 'json',
            tryCount: 0,
            retryLimit: 3,
            data: 'kode=' + filter_kode + '&nama=' + filter_nama + '&hargamin=' + filter_harga_min + '&hargamax=' + filter_harga_max,
            success: function(results) {
                var data = results.data

                // Siapkan wadah untuk menampung semua baris data sekaligus
                var all_rows = [];

                $.each(data, function(index, item) {
                    array_temp = [];
                    var harga_jual = item.harga_beli + item.harga_beli * item.laba / 100;
                    harga_jual = Math.round(harga_jual)
                    // var kode = item.kode;
                    var kode_rahasia = item.encrypted_kode;

                    // var html = `<a href="{{url('master-items/view/')}}/` + kode + `" class="btn btn-primary">View</a>`

                    var html = `<a href="{{url('master-items/view/')}}/` + kode_rahasia + `" class="btn btn-primary">View</a>`

                    var img_show = item.image ? `<img src="{{ asset('images/master_items') }}/${item.image}" style="max-height: 40px; border-radius: 4px;">` : `<span class="text-muted">No Image</span>`;

                    // Susun array secara eksplisit sesuai urutan kolom tabel di HTML Anda
                    var array_temp = [
                        item.kode,          // Kolom 1: Kode
                        item.nama,          // Kolom 2: Nama
                        item.jenis,         // Kolom 3: Jenis
                        item.harga_beli,    // Kolom 4: Harga Beli
                        harga_jual,         // Kolom 5: Harga Jual (Hasil kalkulasi)
                        item.supplier,      // Kolom 6: Supplier
                        img_show,           // Kolom 7: Image (sisipkan di sini)
                        html                // Kolom 7: View / Aksi
                    ];

                    all_rows.push(array_temp);

                    // dataTableObj.row.add(array_temp).draw(true);
                });

                // Tambahkan seluruh baris sekaligus (gunakan .rows dengan huruf 's') dan draw 1 kali saja
                dataTableObj.rows.add(all_rows).draw(false);
                
                $('#loading-filter').hide();
            },
            error: function(xhr, textStatus, errorThrown) {
                this.tryCount++;
                if (this.tryCount <= this.retryLimit) {
                    $.ajax(this);
                    return;
                }
                alert('Terjadi kesalahan server, tidak dapat mengambil data')
                $('#loading-filter').hide();

                return;
            }
        })
    }
</script>