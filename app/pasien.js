function load_data() {
    $(".spinner").show();
  $.post("pasien/load_data",
      {
        
      },
      function (data) {
          $(".spinner").hide();
          $("#table2").DataTable().clear().destroy()
          $("#table2 > tbody").html('');
         $.each(data.pasien, function (idx, val) {
              html = '<tr>'
              html += '<td>' + val['id_pasien'] + '</td>'
              html += '<td>' + val['nama_pasien'] + '</td>'
              html += '<td>' + val['umur'] + '</td>'
              html += '<td>' + val['jenis_kelamin'] + '</td>'
              html += '<td>' + val['alamat'] + '</td>'
              html += '<td>' + val['tanggal_pendaftaran'] + '</td>'
              html += '<td>' + val['no_unik_pasien'] + '</td>'
              html += '<td>' + val['bpjs'] + '</td>'
              html += ' <td><button class="btn btn-warning btn-sm btn-edit" onclick="editDataPasien(' + val['id_pasien'] + ')"><i class="fa-solid fa-pen-to-square"></i></button></td>'
              html += '<td><button class="btn btn-danger btn-sm " onclick="delete_table(' + val['id_pasien'] + ')"><i class="fa-solid fa-trash"></i></button></td>'
              html += '</tr>'
              $("#table2 > tbody").append(html);
          });
          
          $("#table2").DataTable({
              responsive: true,
              processing: true,
              pagingType: 'first_last_numbers',
              // order: [[0, 'asc']],
              dom:
                  "<'row'<'col-3'l><'col-9'f>>" +
                  "<'row dt-row'<'col-sm-12'tr>>" +
                  "<'row'<'col-4'i><'col-8'p>>",
              "language": {
                  "info": "Page _PAGE_ of _PAGES_",
                  "lengthMenu": "_MENU_",
                  "search": "",
                  "searchPlaceholder": "Search.."
              }
          });
         
      }, 'json');
}

function saveDataPasien(){
    let nama_pasien = $("#nama_pasien").val();
    let umur = $("#umur").val();
    let jenis_kelamin = $("#jenis_kelamin").val();
    let tanggal_pendaftaran = $("#tanggal_pendaftaran").val();
    let alamat = $("#alamat").val();
    let bpjs = $("#bpjs").val();

    if(nama_pasien === ""|| umur === "" || jenis_kelamin === "" ||  alamat === "" || bpjs ==="" || tanggal_pendaftaran === "" ){
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'error',
            title: 'Lengkapi Form nya',
            showConfirmButton: false,
            timer: 3000
        });
    }else {
        $.post("pasien/simpanDataPasien", {  
            nama_pasien : nama_pasien, umur : umur, jenis_kelamin : jenis_kelamin, alamat : alamat,tanggal_pendaftaran : tanggal_pendaftaran,  bpjs : bpjs
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
              } else {
                $("#loginModal").modal('hide');
                $('.modal-backdrop').remove();
                  Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: 'Data Pasien berhasil ditambahkan!',
                    showConfirmButton: false,
                    timer: 3000
                });
                load_data();
                resetform();
              }
          }, 'json');
    }
}

function editDataPasien(id) {
    $.post('pasien/edit_data_pasien', { id: id }, function (data) {
        if (data.status === 'ok') {
          $("#nama_pasien").val(data.data.nama_pasien);
          $("#umur").val(data.data.umur);
          $("#alamat").val(data.data.alamat);
          $("#jenis_kelamin").val(data.data.jenis_kelamin);
          $("#tanggal_pendaftaran").val(data.data.tanggal_pendaftaran);
          $("#bpjs").val(data.data.bpjs);
          $("#loginModal").data('id', id); 
          $("#loginModal").modal('show');
          $(".btn-submit").hide();
          $(".btn-editen").show();
          $("#tanggal_pendaftaran").prop('readonly',true);
        } else {
          Swal.fire({
            title: 'Error!',
            text: data.msg,
            icon: 'error',
            confirmButtonText: 'OK'
          });
        }
      }, 'json');
}

function update_pasien() {
    var id = $("#loginModal").data('id');
    let nama_pasien = $("#nama_pasien").val();
    let umur = $("#umur").val();
    let jenis_kelamin = $("#jenis_kelamin").val();
    let tanggal_pendaftaran = $("#tanggal_pendaftaran").val();
    let alamat = $("#alamat").val();
    let bpjs = $("#bpjs").val();

    if (nama_pasien === "" || umur === "" || jenis_kelamin === "" || tanggal_pendaftaran === "" || alamat === "" || bpjs === "") {
        $.alert({
          title: 'Alert!',
          content: 'Error',
      });
      } else {
        $.post('pasien/update_data_pasien', { id: id, nama_pasien: nama_pasien, umur : umur, jenis_kelamin : jenis_kelamin, tanggal_pendaftaran : tanggal_pendaftaran, alamat : alamat, bpjs : bpjs }, function (data) {
          if (data.status === 'success') {
            Swal.fire({
              toast: true,
              position: 'top-end',
              icon: 'success',
              title: 'Data Pasien berhasil diupdate!',
              showConfirmButton: false,
              timer: 3000
          });
            load_data();
            $("#loginModal").modal('hide');
            resetform()
          } else {
            Swal.fire({
              toast: true,
              position: 'top-end',
              icon: 'error',
              title: 'Data Pasien gagal ditambahkan',
              showConfirmButton: false,
              timer: 3000
          });
    
          }
        }, 'json');
      }
}

function delete_table(id) {
    Swal.fire({
      title: "Apakah Kamu Ingin Mengahapus Data Pasien?",
      text: "Menghapus Data Pasien",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Ya, Hapus"
    }).then((result) => {
      if (result.isConfirmed) {
        $.post('pasien/delete_table', { id: id }, function (data) {
          if (data.status === 'success') {
            Swal.fire({
              title: "Terhapus!",
              text: data.msg,
              icon: "success"
            }).then(() => {
                load_data()
            });
          } else {
            Swal.fire({
              title: "Error!",
              text: data.msg,
              icon: "error"
            });
          }
        }, 'json');
      }
    });
}
load_data();

function resetform() {
  let txnama_pasien = $("#nama_pasien").val('');
    let txpoli = $("#umur").val('');
    let dropdown = $("#jenis-kelamin").val('');
}


$(document).ready(function(){
    $(".btn-add").click(function(){
    $(".btn-editen").hide();
    });
    $(".btn-closed").click(function(){
       resetform()
    });
});