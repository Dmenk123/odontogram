var save_method,table;function add_pegawai(){reset_modal_form(),save_method="add",$("#modal_pegawai_form").modal("show"),$("#modal_title").text("Tambah Pegawai Baru")}function edit_pegawai(a){reset_modal_form(),save_method="update",$.ajax({url:base_url+"master_pegawai/edit_pegawai",type:"POST",dataType:"JSON",data:{id:a},success:function(a){$('[name="id_pegawai"]').val(a.old_data.id),$('[name="nama"]').val(a.old_data.nama),$('[name="alamat"]').val(a.old_data.alamat),$('[name="telp1"]').val(a.old_data.telp_1),$('[name="telp2"]').val(a.old_data.telp_2),$('[name="jabatan"]').val(a.old_data.id_jabatan),"1"==a.old_data.is_owner&&$('[name="is_owner"]').prop("checked",!0),$("#modal_pegawai_form").modal("show"),$("#modal_title").text("Edit Data Pegawai")},error:function(a,e,t){alert("Error get data from ajax")}})}function reload_table(){table.ajax.reload(null,!1)}function save(){var a,t="add"==save_method?(a=base_url+"master_pegawai/add_data_pegawai","Tambah Pegawai"):(a=base_url+"master_pegawai/update_data_pegawai","Edit Pegawai"),e=$("#form-pegawai")[0],e=new FormData(e);$("#btnSave").prop("disabled",!0),$("#btnSave").text("Menyimpan Data"),$.ajax({type:"POST",enctype:"multipart/form-data",url:a,data:e,dataType:"JSON",processData:!1,contentType:!1,cache:!1,timeout:6e5,success:function(a){if(a.status)swal.fire("Sukses!!","Aksi "+t+" Berhasil","success"),$("#btnSave").prop("disabled",!1),$("#btnSave").text("Simpan"),reset_modal_form(),$(".modal").modal("hide"),reload_table();else{for(var e=0;e<a.inputerror.length;e++)"jabatans"!=a.inputerror[e]?($('[name="'+a.inputerror[e]+'"]').addClass("is-invalid"),$('[name="'+a.inputerror[e]+'"]').next().text(a.error_string[e]).addClass("invalid-feedback")):$($("#jabatans").data("select2").$container).addClass("has-error");$("#btnSave").prop("disabled",!1),$("#btnSave").text("Simpan")}},error:function(a){console.log("ERROR : ",a),$("#btnSave").prop("disabled",!1),$("#btnSave").text("Simpan"),reset_modal_form(),$(".modal").modal("hide")}})}function delete_pegawai(e){swalConfirmDelete.fire({title:"Hapus Data Pegawai ?",text:"Data Akan dihapus permanen ?",type:"warning",showCancelButton:!0,confirmButtonText:"Ya, Hapus Data !",cancelButtonText:"Tidak, Batalkan!",reverseButtons:!0}).then(a=>{a.value?$.ajax({url:base_url+"master_pegawai/delete_pegawai",type:"POST",dataType:"JSON",data:{id:e},success:function(a){swalConfirm.fire("Berhasil Hapus Pegawai!",a.pesan,"success"),table.ajax.reload()},error:function(a,e,t){Swal.fire("Terjadi Kesalahan")}}):a.dismiss===Swal.DismissReason.cancel&&swalConfirm.fire("Dibatalkan","Aksi Dibatalakan","error")})}function reset_modal_form(){$("#form-pegawai")[0].reset(),$(".append-opt").remove(),$("div.form-group").children().removeClass("is-invalid invalid-feedback"),$("span.help-block").text(""),$("#div_pass_lama").css("display","none")}function reset_modal_form_import(){$("#form_import_excel")[0].reset(),$("#label_file_excel").text("Pilih file excel yang akan diupload")}function import_excel(){$("#modal_import_excel").modal("show"),$("#modal_import_title").text("Import data pegawai")}function import_data_excel(){var a=$("#form_import_excel")[0],a=new FormData(a);$("#btnSaveImport").prop("disabled",!0),$("#btnSaveImport").text("Import Data"),$.ajax({type:"POST",enctype:"multipart/form-data",url:base_url+"master_pegawai/import_data_master",data:a,dataType:"JSON",processData:!1,contentType:!1,success:function(a){a.status?swal.fire("Sukses!!",a.pesan,"success"):swal.fire("Gagal!!",a.pesan,"error"),$("#btnSaveImport").prop("disabled",!1),$("#btnSaveImport").text("Simpan"),reset_modal_form_import(),$(".modal").modal("hide"),table.ajax.reload()},error:function(a){console.log("ERROR : ",a),$("#btnSaveImport").prop("disabled",!1),$("#btnSaveImport").text("Simpan"),reset_modal_form_import(),$(".modal").modal("hide"),table.ajax.reload()}})}$(document).ready(function(){$("input.numberinput").bind("keypress",function(a){return 8==a.which||0==a.which||!(a.which<48||57<a.which)||46==a.which}),table=$("#tabel_pegawai").DataTable({responsive:!0,searchDelay:500,processing:!0,serverSide:!0,ajax:{url:base_url+"master_pegawai/list_pegawai",type:"POST"},columnDefs:[{targets:[-1],orderable:!1}]}),$(document).on("click",".btn_edit_status",function(){var e=$(this).attr("id"),t=$(this).val();swalConfirmDelete.fire({title:"Ubah Status Data Pegawai ?",text:"Apakah Anda Yakin ?",type:"warning",showCancelButton:!0,confirmButtonText:"Ya, Ubah Status!",cancelButtonText:"Tidak, Batalkan!",reverseButtons:!0}).then(a=>{a.value?$.ajax({url:base_url+"master_pegawai/edit_status_pegawai",type:"POST",dataType:"JSON",data:{status:t,id:e},success:function(a){swalConfirm.fire("Berhasil Ubah Status Pegawai!",a.pesan,"success"),table.ajax.reload()},error:function(a,e,t){Swal.fire("Terjadi Kesalahan")}}):a.dismiss===Swal.DismissReason.cancel&&swalConfirm.fire("Dibatalkan","Aksi Dibatalakan","error")})}),$(".modal").on("hidden.bs.modal",function(){reset_modal_form(),reset_modal_form_import()})});