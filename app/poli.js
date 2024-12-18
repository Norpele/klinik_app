function load_data() {
  $(".spinner").show();
    $.post("poli/load_data",
        {
          
        },
        function (data) {
            $(".spinner").hide();            
            $("#table2").DataTable().clear().destroy()
            $("#table2 > tbody").html('');
           $.each(data.poli, function (idx, val) {
                html = '<tr>'
                html += '<td>' + val['id_poli'] + '</td>'
                html += '<td>' + val['name_poli'] + '</td>'
                html += ' <td><button class="btn btn-warning btn-sm btn-edit" onclick="edit_poli(' + val['id_poli'] + ')"><i class="fa-solid fa-pen-to-square"></i></button></td>'
                html += '<td><button class="btn btn-danger btn-sm " onclick="delete_table(' + val['id_poli'] + ')"><i class="fa-solid fa-trash"></i></button></td>'
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
  
  function update_poli() {
    var id = $("#loginModal").data('id');
    let txpoli = $("#txname_poli").val();

    if (txpoli === "") {
        $.alert({
          title: 'Alert!',
          content: 'Error',
      });
      } else {
        $.post('poli/update_data', { id: id, txpoli: txpoli }, function (data) {
          if (data.status === 'success') {
            Swal.fire({
              toast: true,
              position: 'top-end',
              icon: 'success',
              title: 'Poli berhasil diupdate!',
              showConfirmButton: false,
              timer: 3000
          });
            load_data();
            $("#loginModal").modal('hide');
          } else {
            Swal.fire({
              toast: true,
              position: 'top-end',
              icon: 'error',
              title: 'Poli gagal ditambahkan',
              showConfirmButton: false,
              timer: 3000
          });
    
          }
        }, 'json');
      }
  }
  
  function simpan_data() {
    let txpoli = $("#txname_poli").val();

    if ( txpoli === "") {
      Swal.fire({
        title: 'Error!',
        text: "Isi Form",
        icon: 'error',
        confirmButtonText: 'OK'
      });
    } else {
        $.post("poli/create", {  
          txpoli : txpoli,
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
                  title: 'poli berhasil ditambahkan!',
                  showConfirmButton: false,
                  timer: 3000
              });
              load_data();
            }
        }, 'json');
    }
}
  
  function edit_poli(id) {
    $.post('poli/edit_poli', { id: id }, function (data) {
      if (data.status === 'ok') {
        $("#txname_poli").val(data.data.name_poli);
        $("#loginModal").data('id', id); 
        $("#loginModal").modal('show');
        $(".btn-submit").hide();
        $(".btn-editen").show();
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
  
  function delete_table(id) {
    Swal.fire({
      title: "Apakah Kamu Ingin Mengahapus Poli?",
      text: "Menghapus Poli",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Ya, Hapus"
    }).then((result) => {
      if (result.isConfirmed) {
        $.post('poli/delete_table', { id: id }, function (data) {
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

  load_data()