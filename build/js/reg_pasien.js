var save_method,txtAksi,table,table2,table3;function filter_tanggal(){$.fn.DataTable.isDataTable("#tabel_index")&&$("#tabel_index").DataTable().clear().destroy();var a=$("#tgl_filter_mulai").val(),e=$("#tgl_filter_akhir").val();table=$("#tabel_index").DataTable({destroy:!0,responsive:!0,searchDelay:500,processing:!0,serverSide:!0,ajax:{url:base_url+"reg_pasien/list_data",type:"POST",data:{tgl_awal:a,tgl_akhir:e},dataType:"JSON"},columnDefs:[{targets:[-1],orderable:!1}]})}function tabel_broadcast(){$.fn.DataTable.isDataTable("#tabel_broadcast")&&$("#tabel_broadcast").DataTable().clear().destroy(),table3=$("#tabel_broadcast").DataTable({responsive:!0,searchDelay:500,processing:!0,serverSide:!1,bDestroy:!0,ajax:{url:base_url+"reg_pasien/list_data_broadcast",type:"POST"},columnDefs:[{targets:[-1],orderable:!1,checkboxes:{selectRow:!0}}],select:{style:"multi"}})}function clear_input_pasien(){$("#nik").val(""),$("#no_rm").val(""),$("#tempat_lahir").val(""),$("#tanggal_lahir").val("")}function tambah_data_asuransi(){save_method="add",datatable_asuransi(),$("#modal_form_asuransi").modal("show"),$("#modal_form_asuransi_title").text("Master Asuransi")}$(document).ready(function(){new URL(window.location.href);filter_tanggal(),$("input.numberinput").bind("keypress",function(a){return 8==a.which||0==a.which||!(a.which<48||57<a.which)||46==a.which}),$(document).on("click",".btn_edit_status",function(){var e=$(this).attr("id"),t=$(this).val();swalConfirm.fire({title:"Ubah Status Data Pasien ?",text:"Apakah Anda Yakin ?",icon:"warning",showCancelButton:!0,confirmButtonText:"Ya, Ubah Status!",cancelButtonText:"Tidak, Batalkan!",reverseButtons:!0}).then(a=>{a.value?$.ajax({url:base_url+"data_pasien/edit_status_aktif",type:"POST",dataType:"JSON",data:{status:t,id:e},success:function(a){swalConfirm.fire("Berhasil Ubah Status Pasien!",a.pesan,"success"),table.ajax.reload()},error:function(a,e,t){Swal.fire("Terjadi Kesalahan")}}):a.dismiss===Swal.DismissReason.cancel&&swalConfirm.fire("Dibatalkan","Aksi Dibatalakan","error")})}),$(".modal").on("hidden.bs.modal",function(){reset_form("form-asuransi")}),$("#nama").select2({tokenSeparators:[","," "],minimumInputLength:0,minimumResultsForSearch:5,ajax:{url:base_url+"reg_pasien/get_select_pasien",dataType:"json",type:"GET",data:function(a){return{term:a.term}},processResults:function(a){return{results:$.map(a,function(a){return{text:a.text,id:a.id,no_rm:a.no_rm,nik:a.nik,tempat_lahir:a.tempat_lahir,tanggal_lahir:a.tanggal_lahir,umur:a.umur,pemetaan:a.pemetaan}})}}}}),$("#nama").on("select2:selecting",function(a){a=a.params.args.data;$("#nik").val(a.nik),$("#no_rm").val(a.no_rm),$("#tempat_lahir").val(a.tempat_lahir);let e=a.tanggal_lahir;$("#tanggal_lahir").val(e.split("-").reverse().join("/")),$("#umur_reg").val(a.umur),$("#pemetaan").val(a.pemetaan)}),$("#dokter").select2({tokenSeparators:[","," "],minimumInputLength:0,minimumResultsForSearch:5,ajax:{url:base_url+"reg_pasien/get_select_dokter",dataType:"json",type:"GET",data:function(a){return{term:a.term}},processResults:function(a){return{results:$.map(a,function(a){return{text:a.text,id:a.id}})}}}}),$(".klinik").select2({tokenSeparators:[","," "],minimumInputLength:0,minimumResultsForSearch:5,ajax:{url:base_url+"reg_pasien/get_select_klinik",dataType:"json",type:"GET",data:function(a){return{term:a.term}},processResults:function(a){return{results:$.map(a,function(a){return{text:a.text,id:a.id}})}}}}),$(".mask_tanggal").mask("00/00/0000",{placeholder:"DD/MM/YYYY"}),$("#jam_reg").timepicker({minuteStep:1,defaultTime:time_now(),showSeconds:!0,showMeridian:!1,snapToStep:!0}),$(".mask_rm").mask("AA.00.00"),$("#jenis_penjamin").change(function(a){var e=get_uri_segment(4);a.preventDefault(),$.ajax({type:"post",url:base_url+"reg_pasien/get_data_form_penjamin",data:{jenis_penjamin:$(this).val(),id_regnya:e},dataType:"json",success:function(a){$("#div-append-form").html(a)}})}),$("#dokter").change(function(a){$("#layanan").val(null).trigger("change"),$("#layanan").select2({allowClear:!0,tokenSeparators:[","," "],minimumInputLength:0,minimumResultsForSearch:5,ajax:{url:base_url+"reg_pasien/get_select_layanan?id_dokter="+$(this).val(),dataType:"json",type:"GET",data:function(a){return{term:a.term}},processResults:function(a){return{results:$.map(a,function(a){return{text:a.text,id:a.id}})}}}})}),"undefined"!==get_uri_segment(3)&&"edit"==get_uri_segment(3)&&get_data_form_edit(),$("#form_broadcast").on("submit",function(a){a.preventDefault();a=table3.column(8).checkboxes.selected();let t=[];$.each(a,function(a,e){t[a]=e}),$.ajax({type:"post",url:base_url+"reg_pasien/send_broadcast",dataType:"JSON",data:{id:t},success:function(a){a.status?swalConfirm.fire("Sukses!!",a.pesan,"success").then(a=>{a.value&&table.ajax.reload()}):swal.fire("Gagal!!",a.pesan,"error")}})})});const datatable_asuransi=()=>{table2=$("#tabel_asuransi").DataTable({autoWidth:!1,responsive:!0,searchDelay:500,processing:!0,serverSide:!0,destroy:!0,ajax:{url:base_url+"master_asuransi/list_data",type:"POST"}})};function edit_asuransi(a){save_method="update",$.ajax({type:"get",url:base_url+"master_asuransi/edit_data",data:{id:a},dataType:"json",success:function(a){a.status?($("#id_asuransi").val(a.old_data.id),$("#nama_asuransi").val(a.old_data.nama).focus(),$("#ket_asuransi").val(a.old_data.keterangan)):swalConfirm.fire("Dibatalkan","Aksi Dibatalakan","error")}})}function get_data_form_edit(){var a=get_uri_segment(4);$.ajax({type:"post",url:base_url+"reg_pasien/get_data_form_reg",data:{enc_id:a},dataType:"json",success:function(t){if(t.status){$("#id_reg").val(t.data.id);var n=$("<option selected='selected'></option>").val(t.data.id_pasien).text(t.txt_opt_pasien);$("#nama").append(n).trigger("change"),$("#nik").val(t.data.nik),$("#no_rm").val(t.data.no_rm),$("#tempat_lahir").val(t.data.tempat_lahir);let a=t.data.tanggal_lahir;$("#tanggal_lahir").val(a.split("-").reverse().join("/")),$("#umur_reg").val(t.data.umur),$("#pemetaan").val(t.data.id_pemetaan);let e=t.data.tanggal_reg;$("#tanggal_reg").val(e.split("-").reverse().join("/")),$("#jam_reg").val(t.data.jam_reg);n=$("<option selected='selected'></option>").val(t.data.id_pegawai).text(t.txt_opt_dokter);$("#dokter").append(n).trigger("change");n=$("<option selected='selected'></option>").val(t.data.id_layanan).text(t.txt_opt_layanan);$("#layanan").append(n).trigger("change"),t.is_option_klinik?(n=$("<option selected='selected'></option>").val(t.data.id_klinik).text(t.txt_opt_klinik),$("select.klinik").append(n).trigger("change")):$("input.klinik").val(t.data.id_klinik),$("#jenis_penjamin").val(t.data.is_asuransi).change()}else window.location.href=base_url+"reg_pasien"}})}function reload_table(){table.ajax.reload(null,!1)}function reload_table2(){table2.ajax.reload(null,!1)}function reset_form(a){$(":input","#"+a).not(":button, :submit, :reset, :hidden").val("").prop("checked",!1).prop("selected",!1)}function save(){swalConfirm.fire({title:"Simpan Data ?",text:"Data Akan Disimpan",type:"warning",showCancelButton:!0,confirmButtonText:"Ya, Simpan Data !",cancelButtonText:"Tidak, Batalkan!",reverseButtons:!1}).then(a=>{var e;a.value?(e=$("#form_registrasi")[0],e=new FormData(e),$("#btnSave").prop("disabled",!0),$("#btnSave").text("Menyimpan Data"),$.ajax({type:"POST",enctype:"multipart/form-data",url:base_url+"reg_pasien/simpan_data",data:e,dataType:"JSON",processData:!1,contentType:!1,cache:!1,timeout:6e5,success:function(a){if(a.status)swalConfirm.fire("Sukses!!",a.pesan,"success").then(a=>{a.value&&($("#btnSave").prop("disabled",!1),$("#btnSave").text("Simpan"),window.location.href=base_url+"reg_pasien")});else{for(var e=0;e<a.inputerror.length;e++)0==a.is_select2[e]?($('[name="'+a.inputerror[e]+'"]').addClass("is-invalid"),$('[name="'+a.inputerror[e]+'"]').next().text(a.error_string[e]).addClass("invalid-feedback")):$('[name="'+a.inputerror[e]+'"]').next().next().text(a.error_string[e]).addClass("invalid-feedback-select");$("#btnSave").prop("disabled",!1),$("#btnSave").text("Simpan")}},error:function(a){console.log("ERROR : ",a),$("#btnSave").prop("disabled",!1),$("#btnSave").text("Simpan")}})):a.dismiss===Swal.DismissReason.cancel&&swalConfirm.fire("Dibatalkan","Aksi Dibatalakan","error")})}function simpanAsuransi(){txtAksi="add"==save_method?(url=base_url+"master_asuransi/simpan_data","Tambah Asuransi"):(url=base_url+"master_asuransi/update_data","Edit Asuransi");var a=$("#form-asuransi")[0],a=new FormData(a);$("#btnSaveAsuransi").prop("disabled",!0),$("#btnSaveAsuransi").text("Menyimpan Data"),$.ajax({type:"POST",enctype:"multipart/form-data",url:url,data:a,dataType:"JSON",processData:!1,contentType:!1,cache:!1,timeout:6e5,success:function(a){if(a.status)swal.fire("Sukses!!",a.pesan,"success");else for(var e=0;e<a.inputerror.length;e++)"pegawai"!=a.inputerror[e]?($('[name="'+a.inputerror[e]+'"]').addClass("is-invalid"),$('[name="'+a.inputerror[e]+'"]').next().text(a.error_string[e]).addClass("invalid-feedback")):$('[name="'+a.inputerror[e]+'"]').next().next().text(a.error_string[e]).addClass("invalid-feedback-select");$("#btnSaveAsuransi").prop("disabled",!1),$("#btnSaveAsuransi").text("Simpan"),reload_table2(),reset_form("form-asuransi"),save_method="add"},error:function(a){console.log("ERROR : ",a),$("#btnSaveAsuransi").prop("disabled",!1),$("#btnSaveAsuransi").text("Simpan")}})}function delete_reg(e){swalConfirmDelete.fire({title:"Hapus Data Registrasi ?",text:"Data Akan dihapus permanen ?",type:"warning",showCancelButton:!0,confirmButtonText:"Ya, Hapus Data !",cancelButtonText:"Tidak, Batalkan!",reverseButtons:!0}).then(a=>{a.value?$.ajax({url:base_url+"reg_pasien/delete_data",type:"POST",dataType:"JSON",data:{id:e},success:function(a){swalConfirm.fire("Berhasil Hapus Registrasi!",a.pesan,"success"),table.ajax.reload()},error:function(a,e,t){Swal.fire("Terjadi Kesalahan")}}):a.dismiss===Swal.DismissReason.cancel&&swalConfirm.fire("Dibatalkan","Aksi Dibatalakan","error")})}function delete_asuransi(e){swalConfirmDelete.fire({title:"Hapus Data Asuransi ?",text:"Data Akan dihapus permanen ?",type:"warning",showCancelButton:!0,confirmButtonText:"Ya, Hapus Data !",cancelButtonText:"Tidak, Batalkan!",reverseButtons:!0}).then(a=>{a.value?$.ajax({url:base_url+"master_asuransi/delete_data",type:"POST",dataType:"JSON",data:{id:e},success:function(a){swalConfirm.fire("Berhasil Hapus Data!",a.pesan,"success"),table2.ajax.reload()},error:function(a,e,t){Swal.fire("Terjadi Kesalahan")}}):a.dismiss===Swal.DismissReason.cancel&&swalConfirm.fire("Dibatalkan","Aksi Dibatalakan","error")})}function ekspor_excel(){var a=$("#tgl_filter_mulai").val(),e=$("#tgl_filter_akhir").val();window.open(base_url+"reg_pasien/export_excel?tgl_awal="+a+"&tgl_akhir="+e,"_blank")}function cetak_data(){var a=$("#tgl_filter_mulai").val(),e=$("#tgl_filter_akhir").val();window.open(base_url+"reg_pasien/cetak_data?tgl_awal="+a+"&tgl_akhir="+e,"_blank")}function handle_boolean(a){return"1"==a?"Ya":"Tidak"}function time_now(){var a=new Date;return a.getHours()+":"+a.getMinutes()+":"+a.getSeconds()}function get_uri_segment(a){var e=window.location.origin,t=window.location.pathname.split("/");return"http://localhost"==e?t[a]:t[parseInt(a)-1]}