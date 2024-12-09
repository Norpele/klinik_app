const errorMessage = document.getElementById('error-message');
    if (errorMessage) {
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: errorMessage.innerText,
            showConfirmButton: false,
            timer: 3000
        });
    }

    function cek_stock(input, stockBarang) {
        const totalBarang = parseInt(input.value);  // Jumlah barang yang diinput
    
        if (totalBarang > stockBarang) {
            Swal.fire({
                title: 'Tidak Bisa Melebihi Stock!',
                text: 'Total Barang tidak bisa melebihi stock yang tersedia',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            input.value = stockBarang; // Set jumlah barang ke nilai stok maksimal
        }
    }
    
    // Gunakan event listener 'oninput' untuk setiap input jumlah barang
    $('input[name^="cart"]').on('input', function() {
        var stockBarang = $(this).data('stock');  // Ambil stok dari data HTML
        cek_stock(this, stockBarang); // Panggil fungsi cek_stock
    });

    
    function openModal() {
     $.post("cart/list_provinsi",{}, function(res){
         $("#txprovinsi").empty()

          $("#txprovinsi").append('<option value = "">Pilih Provinsi</option>')
          $.each( res.provinsi , function ( i, v) {
          $("#txprovinsi").append('<option value = "'+ v.id+'">'+ v.nama+'</option>')             
      }
      ) 
     },'json')
    }
    function load_kota(id) {
     $.post("cart/list_kota",{ prov : id}, function(res){
         $("#txkota").empty()

          $("#txkota").append('<option value = "">Pilih Kota</option>')
          $.each( res.kota , function ( i, v) {
          $("#txkota").append('<option value = "'+ v.id+'">'+ v.nama+'</option>')             
      }
      ) 
     },'json')
    }

    function load_kecamatan(id) {
     $.post("cart/list_kecamatan",{ kota : id}, function(res){
         $("#txkecamatan").empty()

          $("#txkecamatan").append('<option value = "">Pilih kecamatan</option>')
          $.each( res.kec , function ( i, v) {
          $("#txkecamatan").append('<option value = "'+ v.id+'">'+ v.nama+'</option>')             
      }
      ) 
     },'json')
    }

    function cek_ongkir() {
        $("#txongkir").empty();
        $(".spinner").show();
        $('#dynamic-container').empty();
        $.post("cart/cek_ongkir", {
            kec_tujuan: $("#txkecamatan").val(),
            kurir: $("#txkurir").val()
        }, function(res) {
            $('#dynamic-container').empty();
            $("#txongkir").empty();
            $(".spinner").hide();
       
            $("#txongkir").append('<option value="">Pilih kecamatan</option>');

            

            $.each(res.kec, function(i, v) {
                $("#txkecamatan").append('<option value="' + v.id + '">' + v.nama + '</option>');
            });

            if(res.layanan.length > 0){
            $.each(res.layanan, function(i, v) {
                $('#dynamic-container').append(
                    '<div class="col-md-6 mb-3">' +
                        '<div class="card selectable-card" value="' + v.xid + '" data-ongkir="' + v.biaya + '" data-nama="'+ v.nama +'" data-ket="'+ v.ket+ '" data-etd = "'+v.etd+'">' +  
                            '<div class="card-body">' +
                                '<h5 class="card-title">' + v.nama + '</h5>' +
                                '<p class="card-text">' + v.ket + '</p>' +
                                '<p class="card-text" id="ongkir">Rp ' + parseInt(v.biaya) + '</p>' +
                                '<p class="card-text">Estimasi Pengiriman ' + v.etd + ' hari</p>' +
                                '<span class="checkmark">&#10003;</span>' +
                            '</div>' +
                        '</div>' +
                    '</div>'
                );
            }, 'json');
        }else{
            $('#dynamic-container').append(
                '<div class="col-md-6 mb-3">' +
                    '<div class="card selectable-card">' +  
                        '<div class="card-body">' +
                            '<h5 class="card-title"> Kurir Tidak ditemukan</h5>' +
                        '</div>' +
                    '</div>' +
                '</div>'
            );
        }
        }, 'json');
    }

    $(document).on('click', '.selectable-card', function() {
        // Hapus kelas 'selected' dari semua kartu, lalu tambahkan ke kartu yang diklik
        $('.selectable-card').removeClass('selected');
        $(this).addClass('selected');
        
        var selectedId = $(this).attr('value');
        const biaya = $(this).data('ongkir');
        const ekspedisi = $(this).data('nama');
        const ket = $(this).data('ket');
        const etd = $(this).data('etd');
        var total = $("[name='total_amount']").attr('total');
        console.log("Kartu yang dipilih:" + selectedId); // buat testing, biar tau id dari card kepanggil atau tidak
        console.log("ongkir:" + (biaya)); // buat testing, biar tau ongkir dari card kepanggil atau tidak
        console.log("total:" + (total));
        var subtotal = parseFloat(total) + parseFloat(biaya);
        console.log(subtotal);

        $("[name='kurir_ket']").val(ket);
        $("[name='kurir_ongkir']").val(biaya);
        $("[name='total_amount']").val(subtotal);

        $('#output-total').html('');

        $('#output-total').append(`
            <div class="alert alert-info w-100">
                <h5 class="mb-1">Total Pembayaran</h5>
                <p class="mb-0">
                    <strong>Total:</strong> Rp ${total.toLocaleString()}<br>
                    <strong>Ongkir:</strong> Rp ${biaya.toLocaleString()}<br>
                    <strong>Subtotal:</strong> <span class="text-success">Rp ${subtotal.toLocaleString()}</span>
                </p>
            </div>
        `);
        // $.post("cart/saveOrder", { 
        //     biaya: biaya, 
        //     subtotal: subtotal, 
        //     ekspedisi: ekspedisi, 
        //     ket: ket 
        // }, function(res) {
        //     console.log(res); 
        // }, 'json');
        
    });
    
    