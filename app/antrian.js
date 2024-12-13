function load_data(id_poli = "") {
    $(".spinner").show();
    $.post("antrian/get_antrian_data", { id_poli: id_poli }, function (data) {
        $(".spinner").hide();
        $("#table2").DataTable().clear().destroy();
        $("#table2 > tbody").html('');

        
            $.each(data.data_antrian, function (idx, val) {
              if (val['status_antri'] == '1') {
                statusButton = '<button class="btn btn-danger" onclick="confirmUpdateStatus(' + val['id_pasien'] + ','+val['nomor_antrian']+ ',' + val['status_antri'] +')">Sedang Mengantri</button>';
            } else if (val['status_antri'] == '2') {
                statusButton = '<button class="btn btn-warning" onclick="confirmUpdateStatus(' + val['id_pasien'] + ','+ val['nomor_antrian']+', ' + val['status_antri'] +')">Dilayani</button>';
            } else if (val['status_antri'] == '3') {
                statusButton = '<button class="btn btn-primary">Selesai</button>';
            } else {
                statusButton = '<button class="btn btn-secondary">Tidak Megantri</button>';
            }            
                let html = `
                    <tr>
                        <td>${val['id_antrian']}</td>
                        <td>${val['nama_pasien']}</td>
                        <td>${val['name_poli']}</td>
                        <td>${val['nomor_antrian']}</td>
                        <td>${val['tanggal']}</td>
                       <td> ${statusButton}</td>
                    </tr>`;
                $("#table2 > tbody").append(html);
            });

        $("#table2").DataTable({
            responsive: true,
            processing: true,
            pagingType: 'first_last_numbers',
            order: [[0, 'DESC']],
            dom: "<'row'<'col-3'l><'col-9'f>>" +
                 "<'row dt-row'<'col-sm-12'tr>>" +
                 "<'row'<'col-4'i><'col-8'p>>",
            language: {
                info: "Page _PAGE_ of _PAGES_",
                lengthMenu: "_MENU_",
                search: "",
                searchPlaceholder: "Search.."
            }
        });
    }, 'json')
    get_load_nama_pasien()
}

function get_load_nama_pasien() {
    $.post('antrian/get_data_nama_pasien', function(res) {
        $("#txnama_pasien").empty();     

        $("#txnama_pasien").append('<option value="">Pilih Nama Pasien</option>');  
        
        $.each(res.data_pasien, function(i, v) {
            let no_unik_pasien = res.id_pasien;
            $("#txnama_pasien").append('<option value="'+ v.id_pasien +'">'+ v.nama_pasien +'</option>');
        });
    }, 'json');
}

function get_load_nomor_unik(id_pasien) { 
    $.post('antrian/get_nomor_unik_pasien', {id_pasien: id_pasien}, function(res) {
         if (res.success) { 
            $("#txnomor_unik").val(res.no_unik_pasien); 
        } else { 
            $("#txnomor_unik").val(''); 
        } 
    }, 'json'); 
}

function get_load_poli() {
    $.post('antrian/get_data_poli', function(res) {
        $("#txpoli").empty();
        $("#dropdown-filter").empty();
        $("#txpoli").append('<option value="">Pilih Poli</option>'); 
        $("#dropdown-filter").append('<option value="">Pilih Poli</option>'); 
        
        $.each(res.data_poli, function(i, v) {
            $("#txpoli").append('<option value="'+ v.id_poli +'">'+ v.name_poli +'</option>');
            $("#dropdown-filter").append('<option value="'+ v.id_poli +'">'+ v.name_poli +'</option>');
        });

    }, 'json');
}

function confirmUpdateStatus(id_pasien, nomor_antrian, status_antri) {
  Swal.fire({
      title: 'Update Antrian?',
      text: "Apakah Anda yakin ingin mengubah status antrian?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, update it!'
  }).then((result) => {
      if (result.isConfirmed) {
        let status_baru = ""
          if(status_antri === 1){
            status_baru = status_antri + 1;
          }else if(status_antri === 2){
            status_baru = status_antri + 1;
          }else {
            status_baru = 3;
          };

          console.log(status_baru)
          updateStatus(id_pasien, nomor_antrian, status_baru);
      }
  });
}

function updateStatus(id_pasien, nomor_antrian, status_antri) {
  $.post("antrian/update_antrian", { id_pasien: id_pasien, nomor_antrian: nomor_antrian, status_antri: status_antri }, function(response) {
      if (response.success) {
          Swal.fire(
              'Updated!',
              'Status Antrian Berhasil Diubah',
              'success'
          );
          load_data(); 
      } else {
          Swal.fire(
              'Failed!',
              'Gagal mengubah status antrian.',
              'error'
          );
      }
  }, 'json');
}


function simpan_data_antrian(){
    let txnama_pasien = $("#txnama_pasien").val();
    let txpoli = $("#txpoli").val();
    let txtanggal = $("#txtanggal").val();

    if(txnama_pasien === "" || txpoli === "" || txtanggal === ""){
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'error',
            title: 'Lengkapi Form nya',
            showConfirmButton: false,
            timer: 3000
        });
    }else{
        $.post("antrian/simpanDataAntrian", {  
            txnama_pasien : txnama_pasien, txpoli : txpoli, txtanggal : txtanggal
          },
          function (data) {
              console.log(data.status);
              if (data.status === "error") {
                Swal.fire({
                  title: 'Error!',
                  text: data.msg,
                  icon: 'error',
                  confirmButtonText: 'OK'
                });
                resetform();
              } else {
                $("#loginModal").modal('hide');
                $('.modal-backdrop').remove();
                  Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: 'Data Antrian berhasil ditambahkan!',
                    showConfirmButton: false,
                    timer: 3000
                });
                load_data();
                
                resetform();
              }
          }, 'json');
    }
}

get_load_poli()
get_load_nama_pasien()
load_data()
function resetform() {
    let txnama_pasien = $("#txnama_pasien").val('');
    let txpoli = $("#txpoli").val('');
    let dropdown = $("#dropdown-filter").val('');
    load_data()
}


$(document).ready(function () {
    $(".btn-closed").click(function () {
        resetform()
      });
    load_data();

    $("#dropdown-filter").change(function () {
        let id_poli = $(this).val(); 
        load_data(id_poli);
    });
    $("txnama_pasien").change(function () {
        let id_pasien = $(this).val();
         get_load_nomor_unik(id_pasien);
    });
});
