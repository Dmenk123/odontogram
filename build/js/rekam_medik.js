let id_peg,id_psn,id_reg,pid,activeModal;function show_modal_pasien(){$("#modal_pilih_pasien").modal("show"),$("#modal_pilih_pasien_title").text("Pilih Pasien")}function cari_pasien(){var a=$("#form_cari_pasien")[0],a=new FormData(a);$.ajax({type:"POST",enctype:"multipart/form-data",url:base_url+"rekam_medik/cari_pasien",data:a,dataType:"JSON",processData:!1,contentType:!1,cache:!1,timeout:6e5,success:function(a){a.status?$("#tabel_pilih_pasien tbody").html(a.data):swalConfirm.fire("Gagal","Data Tidak Ditemukan","error")}})}function submit_pasien(a){location.href=base_url+"rekam_medik?pid="+a}function pilih_pasien(a){$.ajax({type:"post",url:base_url+"rekam_medik/hasil_pilih_pasien",data:{enc_id:a},dataType:"json",success:function(a){$("#tabel_pasien tbody").html(a.data),id_reg=a.data_id.id_reg,id_peg=a.data_id.id_peg,id_psn=a.data_id.id_psn}})}function save(n){var a="#".concat(n),e=$(a)[0],a=new FormData(e);a.append("id_peg",id_peg),a.append("id_reg",id_reg),a.append("id_psn",id_psn),"form_anamnesa"==n&&(e=CKEDITOR.instances.anamnesa.getData(),a.append("txt_anamnesa",e)),$("#btnSave").prop("disabled",!0),$("#btnSave").text("Menyimpan Data"),$.ajax({type:"POST",enctype:"multipart/form-data",url:base_url+"rekam_medik/simpan_"+n,data:a,dataType:"JSON",processData:!1,contentType:!1,cache:!1,timeout:6e5,success:function(a){if(a.status)swal.fire({title:"Sukses!!",text:a.pesan,type:"success"}).then(function(){$("#btnSave").prop("disabled",!1),$("#btnSave").text("Simpan"),"form_diagnosa"==n?reloadFormDiagnosa():"form_tindakan"==n?reloadFormTindakan():"form_logistik"==n?reloadFormLogistik():"form_kamera"==n?reloadFormKamera():"form_tindakanlab"==n?reloadFormTindakanLab():"form_pasien"==n?reloadFormPasien():$("#"+activeModal).modal("hide")});else{for(var e=0;e<a.inputerror.length;e++)0==a.is_select2[e]?($('[name="'+a.inputerror[e]+'"]').addClass("is-invalid"),$('[name="'+a.inputerror[e]+'"]').next().text(a.error_string[e]).addClass("invalid-feedback")):$('[name="'+a.inputerror[e]+'"]').next().next().text(a.error_string[e]).addClass("invalid-feedback-select");$("#btnSave").prop("disabled",!1),$("#btnSave").text("Simpan")}},error:function(a){console.log("ERROR : ",a),$("#btnSave").prop("disabled",!1),$("#btnSave").text("Simpan")}})}function cekDanSetValue(a){a=a.split("_"),$.ajax({type:"post",url:base_url+"rekam_medik/get_old_data",data:{menu:a[1],id_peg:id_peg,id_psn:id_psn,id_reg:id_reg},dataType:"json",success:function(a){"anamnesa"==a.menu?($("#form_anamnesa input[name='id_anamnesa']").val(a.data.id),$("#form_anamnesa textarea[name='anamnesa']").val(a.data.anamnesa)):"diagnosa"==a.menu?reloadFormDiagnosa():"tindakan"==a.menu?reloadFormTindakan():"logistik"==a.menu?reloadFormLogistik():"kamera"==a.menu?reloadFormKamera():"tindakanlab"==a.menu?reloadFormTindakanLab():"diskon"==a.menu?reloadFormDiskon():"odonto"==a.menu?reloadFormOdonto():"pasien"==a.menu?reloadFormPasien():"riwayat"==a.menu&&(reloadFormDiagnosaRiwayat(),reloadFormTindakanRiwayat(),reloadFormTindakanLabRiwayat())}})}function reset_form(a){$(":input","#"+a).not(":button, :submit, :reset, :hidden").val("").prop("checked",!1).prop("selected",!1)}function get_uri_segment(a){return window.location.pathname.split("/")[a]}$(document).ready(function(){let a=new URL(window.location.href);pid=a.searchParams.get("pid"),""==pid&&null==pid||pilih_pasien(pid),$("input.numberinput").bind("keypress",function(a){return 8==a.which||0==a.which||!(a.which<48||57<a.which)||46==a.which}),$(document).on("click",".div_menu",function(){var a=$(this).data("id");null==id_peg||null==id_reg||null==id_psn?Swal.fire("Mohon Pilih Pasien Terlebih Dahulu"):"div_pulangkan"==a?confirmPulangkan(pid):(activeModal=a+"_modal",cekDanSetValue(activeModal),$("#"+a+"_modal").modal("show"))})});const confirmPulangkan=e=>{swalConfirm.fire({title:"Konfirmasi Pulangkan Pasien",text:"Apakah Anda Yakin ?",type:"warning",showCancelButton:!0,confirmButtonText:"Ya !",cancelButtonText:"Tidak",reverseButtons:!1}).then(a=>{a.value?$.ajax({url:base_url+"rekam_medik/pulangkan_pasien",type:"POST",dataType:"JSON",data:{idReg:e},success:function(a){a.status?swalConfirm.fire("Berhasil Konfirmasi",a.pesan,"success").then(a=>{a.value&&location.reload()}):swalConfirm.fire("Gagal",a.pesan,"error").then(a=>{a.value&&(console.log(a),location.reload())})},error:function(a,e,n){Swal.fire("Terjadi Kesalahan")}}):a.dismiss===Swal.DismissReason.cancel&&swalConfirm.fire("Dibatalkan","Aksi Dibatalakan","error")})};