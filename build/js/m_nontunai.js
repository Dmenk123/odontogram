var table,save_method;function add_menu(){reset_modal_form(),save_method="add",$("#modal_master").modal("show"),$("#modal_title").text("Tambah Data Baru")}function reset_modal_form(){$("#form-master")[0].reset(),$(".append-opt").remove(),$("div.form-group").children().removeClass("is-invalid invalid-feedback"),$("span.help-block").text("")}function reload_table(){table.ajax.reload(null,!1)}function delete_transaksi(e){swalConfirmDelete.fire({title:"Hapus Data ?",text:"Data Akan dihapus ?",type:"warning",showCancelButton:!0,confirmButtonText:"Ya, Hapus Data !",cancelButtonText:"Tidak, Batalkan!",reverseButtons:!0}).then(a=>{a.value?$.ajax({url:base_url+"master_nontunai/delete_data",type:"POST",dataType:"JSON",data:{id:e},success:function(a){swalConfirm.fire("Berhasil Hapus Data!",a.pesan,"success"),reload_table()},error:function(a,e,t){Swal.fire("Terjadi Kesalahan")}}):a.dismiss===Swal.DismissReason.cancel&&swalConfirm.fire("Dibatalkan","Aksi Dibatalakan","error")})}$(document).ready(function(){$("#modal_master").on("hidden",function(){reset_modal_form()}),$("#form-master").submit(function(a){a.preventDefault(),$("#btnSave").prop("disabled",!0),$("#btnSave").text("Menyimpan Data ....");var a=$("#form-master")[0],e=new FormData(a);swalConfirm.fire({title:"Perhatian",text:"Apakah Anda ingin Menyimpan Transaksi ini ?",type:"warning",showCancelButton:!0,confirmButtonText:"Ya !",cancelButtonText:"Tidak !",reverseButtons:!1}).then(a=>{a.value?$.ajax({type:"POST",enctype:"multipart/form-data",url:base_url+"master_nontunai/simpan_data",data:e,dataType:"JSON",processData:!1,contentType:!1,cache:!1,timeout:6e5,success:function(a){if(a.status)swalConfirm.fire("Berhasil Menambah Data!",a.pesan,"success").then(a=>{a.value&&($("#modal_master").modal("hide"),reset_modal_form(),reload_table())});else{for(var e=0;e<a.inputerror.length;e++)"pegawai"!=a.inputerror[e]?($('[name="'+a.inputerror[e]+'"]').addClass("is-invalid"),$('[name="'+a.inputerror[e]+'"]').next().text(a.error_string[e]).addClass("invalid-feedback")):$('[name="'+a.inputerror[e]+'"]').next().next().text(a.error_string[e]).addClass("invalid-feedback-select");$("#btnSave").prop("disabled",!1),$("#btnSave").text("Simpan")}},error:function(a){console.log("ERROR : ",a),createAlert("Opps!","Terjadi Kesalahan","Coba Lagi nanti","danger",!0,!1,"pageMessages"),$("#btnSave").prop("disabled",!1),$("#btnSave").text("Simpan")}}):a.dismiss===Swal.DismissReason.cancel&&(swalConfirm.fire("Dibatalkan","Aksi Dibatalakan","error"),$("#btnSave").prop("disabled",!1),$("#btnSave").text("Simpan"))})}),table=$("#tabel_data").DataTable({responsive:!0,processing:!0,serverside:!0,ajax:{url:base_url+"master_nontunai/list_data_nontunai",type:"POST"},language:{decimal:",",thousands:"."}})});