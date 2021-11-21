var save_method,table;function detail_pasien(a){$.ajax({url:base_url+"data_pasien/detail_pasien",type:"POST",dataType:"JSON",data:{id:a},success:function(t){$("#no_rm_det").text(t.old_data.no_rm),$("#nik_det").text(t.old_data.nik),$("#pasien_det").text(t.old_data.nama),$("#ttl_det").text(function(){let a=t.old_data.tanggal_lahir;return t.old_data.tempat_lahir+" / "+a.split("-").reverse().join("-")}),$("#jenkel_det").text(t.old_data.jenkel),$("#alamat_rmh_det").text(t.old_data.alamat_rumah),$("#alamat_ktr_det").text(t.old_data.alamat_kantor),$("#suku_det").text(t.old_data.suku),$("#pekerjaan_det").text(t.old_data.pekerjaan),$("#hp_det").text(t.old_data.hp),$("#telp_det").text(t.old_data.telp_rumah),$("#goldarah_det").text(t.old_data.gol_darah),$("#tekanandarah_det").text(t.old_data.tekanan_darah+" ("+t.old_data.tekanan_darah_val+")"),$("#jantung_det").text(handle_boolean(t.old_data.penyakit_jantung)),$("#diabetes_det").text(handle_boolean(t.old_data.diabetes)),$("#hepatitis_det").text(handle_boolean(t.old_data.hepatitis)),$("#haemopilia_det").text(handle_boolean(t.old_data.haemopilia)),$("#gastring_det").text(handle_boolean(t.old_data.gastring)),$("#penyakitlain_det").text(handle_boolean(t.old_data.penyakit_lainnya)),$("#alergiobat_det").text(function(){let a;return a="1"==t.old_data.alergi_obat?"Ya":"Tidak",t.old_data.alergi_obat_val?a+", "+t.old_data.alergi_obat_val:a}),$("#alergimakan_det").text(function(){let a;return a="1"==t.old_data.alergi_makanan?"Ya":"Tidak",t.old_data.alergi_makanan_val?a+", "+t.old_data.alergi_makanan_val:a}),$("#modal_detail").modal("show"),$("#modal_title_det").text("Detail Pasien")},error:function(a,t,e){alert("Error get data from ajax")}})}function reload_table(){table.ajax.reload(null,!1)}function save(){var a=$("#form_pasien")[0],a=new FormData(a);$("#btnSave").prop("disabled",!0),$("#btnSave").text("Menyimpan Data"),$.ajax({type:"POST",enctype:"multipart/form-data",url:base_url+"data_pasien/simpan_data",data:a,dataType:"JSON",processData:!1,contentType:!1,cache:!1,timeout:6e5,success:function(a){if(a.status)swal.fire("Sukses!!",a.pesan,"success"),$("#btnSave").prop("disabled",!1),$("#btnSave").text("Simpan"),window.location.href=base_url+"reg_pasien/add";else{for(var t=0;t<a.inputerror.length;t++)"pegawai"!=a.inputerror[t]?($('[name="'+a.inputerror[t]+'"]').addClass("is-invalid"),$('[name="'+a.inputerror[t]+'"]').next().text(a.error_string[t]).addClass("invalid-feedback")):$('[name="'+a.inputerror[t]+'"]').next().next().text(a.error_string[t]).addClass("invalid-feedback-select");$("#btnSave").prop("disabled",!1),$("#btnSave").text("Simpan")}},error:function(a){console.log("ERROR : ",a),$("#btnSave").prop("disabled",!1),$("#btnSave").text("Simpan")}})}function delete_pasien(t){swalConfirmDelete.fire({title:"Hapus Data Pasien ?",text:"Data Akan dihapus permanen ?",type:"warning",showCancelButton:!0,confirmButtonText:"Ya, Hapus Data !",cancelButtonText:"Tidak, Batalkan!",reverseButtons:!0}).then(a=>{a.value?$.ajax({url:base_url+"data_pasien/delete_data",type:"POST",dataType:"JSON",data:{id:t},success:function(a){swalConfirm.fire("Berhasil Hapus Pasien!",a.pesan,"success"),table.ajax.reload()},error:function(a,t,e){Swal.fire("Terjadi Kesalahan")}}):a.dismiss===Swal.DismissReason.cancel&&swalConfirm.fire("Dibatalkan","Aksi Dibatalakan","error")})}function reset_modal_form_import(){$("#form_import_excel")[0].reset(),$("#label_file_excel").text("Pilih file excel yang akan diupload")}function import_excel(){$("#modal_import_excel").modal("show"),$("#modal_import_title").text("Import data user")}function import_data_excel(){var a=$("#form_import_excel")[0],a=new FormData(a);$("#btnSaveImport").attr("disabled",!0),$("#btnSaveImport").text("Import Data"),$.ajax({type:"POST",enctype:"multipart/form-data",url:base_url+"data_pasien/import_data",data:a,dataType:"JSON",processData:!1,contentType:!1,success:function(a){a.status?swal.fire("Sukses!!",a.pesan,"success"):swal.fire("Gagal!!",a.pesan,"error"),$("#btnSaveImport").attr("disabled",!1),$("#btnSaveImport").text("Simpan"),reset_modal_form_import(),$(".modal").modal("hide"),table.ajax.reload()},error:function(a){console.log("ERROR : ",a),$("#btnSaveImport").attr("disabled",!1),$("#btnSaveImport").text("Simpan"),reset_modal_form_import(),$(".modal").modal("hide"),table.ajax.reload()}})}function handle_boolean(a){return"1"==a?"Ya":"Tidak"}$(document).ready(function(){$("input.numberinput").bind("keypress",function(a){return 8==a.which||0==a.which||!(a.which<48||57<a.which)||46==a.which}),table=$("#tabel_index").DataTable({responsive:!0,searchDelay:500,processing:!0,serverSide:!0,ajax:{url:base_url+"data_pasien/list_data",type:"POST"},columnDefs:[{targets:[-1],orderable:!1}]}),$(document).on("click",".btn_edit_status",function(){var t=$(this).attr("id"),e=$(this).val();swalConfirm.fire({title:"Ubah Status Data Pasien ?",text:"Apakah Anda Yakin ?",icon:"warning",showCancelButton:!0,confirmButtonText:"Ya, Ubah Status!",cancelButtonText:"Tidak, Batalkan!",reverseButtons:!0}).then(a=>{a.value?$.ajax({url:base_url+"data_pasien/edit_status_aktif",type:"POST",dataType:"JSON",data:{status:e,id:t},success:function(a){swalConfirm.fire("Berhasil Ubah Status Pasien!",a.pesan,"success"),table.ajax.reload()},error:function(a,t,e){Swal.fire("Terjadi Kesalahan")}}):a.dismiss===Swal.DismissReason.cancel&&swalConfirm.fire("Dibatalkan","Aksi Dibatalakan","error")})}),$(".modal").on("hidden.bs.modal",function(){reset_modal_form_import()}),$("#alergi_obat").change(function(a){a.preventDefault(),("1"==$(this).val()?$('[name="alergi_obat_val"]').attr("disabled",!1):$('[name="alergi_obat_val"]').attr("disabled",!0)).val("")}),$("#alergi_makanan").change(function(a){a.preventDefault(),("1"==$(this).val()?$('[name="alergi_makanan_val"]').attr("disabled",!1):$('[name="alergi_makanan_val"]').attr("disabled",!0)).val("")}),$("#cek_manual").change(function(){(this.checked?$('[name="no_rm"]').attr("disabled",!1):$('[name="no_rm"]').attr("disabled",!0)).val("")}),$(".mask_tanggal").mask("00/00/0000",{placeholder:"DD/MM/YYYY"}),$(".mask_rm").mask("AA.00.00")});