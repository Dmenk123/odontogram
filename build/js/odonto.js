function save_formulir(){var i=base_url+"rekam_medik/save_formulir_odonto?id_reg="+id_reg,a=$("#form-odonto")[0],l=new FormData(a);$("#btnSave").prop("disabled",!0),$("#btnSave").text("Menyimpan Data"),swalConfirmDelete.fire({title:"Perhatian !!",text:"Apakah anda yakin dengan data ini ?",type:"warning",showCancelButton:!0,confirmButtonText:"Ya",cancelButtonText:"Tidak",reverseButtons:!0}).then(a=>{a.value?$.ajax({type:"POST",enctype:"multipart/form-data",url:i,data:l,dataType:"JSON",processData:!1,contentType:!1,cache:!1,timeout:6e5,success:function(a){if(a.status)swal.fire("Sukses!!",a.pesan,"success"),$('[name="sebelas"]').val(a.old_data.sebelas),$('[name="dua_belas"]').val(a.old_data.dua_belas),$('[name="tiga_belas"]').val(a.old_data.tiga_belas),$('[name="empat_belas"]').val(a.old_data.empat_belas),$('[name="lima_belas"]').val(a.old_data.lima_belas),$('[name="enam_belas"]').val(a.old_data.enam_belas),$('[name="tujuh_belas"]').val(a.old_data.tujuh_belas),$('[name="delapan_belas"]').val(a.old_data.delapan_belas),$('[name="dua_satu"]').val(a.old_data.dua_satu),$('[name="dua_dua"]').val(a.old_data.dua_dua),$('[name="dua_tiga"]').val(a.old_data.dua_tiga),$('[name="dua_empat"]').val(a.old_data.dua_empat),$('[name="dua_lima"]').val(a.old_data.dua_lima),$('[name="dua_enam"]').val(a.old_data.dua_enam),$('[name="dua_tujuh"]').val(a.old_data.dua_tujuh),$('[name="dua_delapan"]').val(a.old_data.dua_delapan),$('[name="tiga_satu"]').val(a.old_data.tiga_satu),$('[name="tiga_dua"]').val(a.old_data.tiga_dua),$('[name="tiga_tiga"]').val(a.old_data.tiga_tiga),$('[name="tiga_empat"]').val(a.old_data.tiga_empat),$('[name="tiga_lima"]').val(a.old_data.tiga_lima),$('[name="tiga_enam"]').val(a.old_data.tiga_enam),$('[name="tiga_tujuh"]').val(a.old_data.tiga_tujuh),$('[name="tiga_delapan"]').val(a.old_data.tiga_delapan),$('[name="occlusi"]').val(a.old_data.occlusi),$('[name="torus_palatinus"]').val(a.old_data.torus_palatinus),$('[name="torus_mandibularis"]').val(a.old_data.torus_mandibularis),$('[name="palatum"]').val(a.old_data.palatum),$('[name="diastema"]').val(a.old_data.diastema),$('[name="keterangan_diastema"]').val(a.old_data.keterangan_diastema),$('[name="gigi_anomali"]').val(a.old_data.gigi_anomali),$('[name="keterangan_gigi_anomali"]').val(a.old_data.keterangan_gigi_anomali),$("#lain_lain").val(a.old_data.lain_lain),$('[name="d"]').val(a.old_data.d),$('[name="m"]').val(a.old_data.m),$('[name="f"]').val(a.old_data.f),$('[name="jumlah_foto"]').val(a.old_data.jumlah_foto),$('[name="jumlah_rontgen"]').val(a.old_data.jumlah_rontgen);else{for(var i=0;i<a.inputerror.length;i++)"jabatans"!=a.inputerror[i]?($('[name="'+a.inputerror[i]+'"]').addClass("is-invalid"),$('[name="'+a.inputerror[i]+'"]').next().text(a.error_string[i]).addClass("invalid-feedback")):$($("#jabatans").data("select2").$container).addClass("has-error");$("#btnSave").prop("disabled",!1),$("#btnSave").text("Simpan")}},error:function(a){console.log("ERROR : ",a),$("#btnSave").prop("disabled",!1),$("#btnSave").text("Simpan"),reset_modal_form(),$(".modal").modal("hide")}}):a.dismiss===Swal.DismissReason.cancel&&swalConfirm.fire("Dibatalkan","Aksi Dibatalakan","error")})}function reloadFormOdonto(){$.ajax({url:base_url+"rekam_medik/load_formulir?id_reg="+id_reg,type:"POST",dataType:"JSON",success:function(a){$('[name="sebelas"]').val(a.old_data.sebelas),$('[name="dua_belas"]').val(a.old_data.dua_belas),$('[name="tiga_belas"]').val(a.old_data.tiga_belas),$('[name="empat_belas"]').val(a.old_data.empat_belas),$('[name="lima_belas"]').val(a.old_data.lima_belas),$('[name="enam_belas"]').val(a.old_data.enam_belas),$('[name="tujuh_belas"]').val(a.old_data.tujuh_belas),$('[name="delapan_belas"]').val(a.old_data.delapan_belas),$('[name="dua_satu"]').val(a.old_data.dua_satu),$('[name="dua_dua"]').val(a.old_data.dua_dua),$('[name="dua_tiga"]').val(a.old_data.dua_tiga),$('[name="dua_empat"]').val(a.old_data.dua_empat),$('[name="dua_lima"]').val(a.old_data.dua_lima),$('[name="dua_enam"]').val(a.old_data.dua_enam),$('[name="dua_tujuh"]').val(a.old_data.dua_tujuh),$('[name="dua_delapan"]').val(a.old_data.dua_delapan),$('[name="tiga_satu"]').val(a.old_data.tiga_satu),$('[name="tiga_dua"]').val(a.old_data.tiga_dua),$('[name="tiga_tiga"]').val(a.old_data.tiga_tiga),$('[name="tiga_empat"]').val(a.old_data.tiga_empat),$('[name="tiga_lima"]').val(a.old_data.tiga_lima),$('[name="tiga_enam"]').val(a.old_data.tiga_enam),$('[name="tiga_tujuh"]').val(a.old_data.tiga_tujuh),$('[name="tiga_delapan"]').val(a.old_data.tiga_delapan),$('[name="occlusi"]').val(a.old_data.occlusi),$('[name="torus_palatinus"]').val(a.old_data.torus_palatinus),$('[name="torus_mandibularis"]').val(a.old_data.torus_mandibularis),$('[name="palatum"]').val(a.old_data.palatum),$('[name="diastema"]').val(a.old_data.diastema),$('[name="keterangan_diastema"]').val(a.old_data.keterangan_diastema),$('[name="gigi_anomali"]').val(a.old_data.gigi_anomali),$('[name="keterangan_gigi_anomali"]').val(a.old_data.keterangan_gigi_anomali),$('[name="lain_lain"]').val(a.old_data.lain_lain),$('[name="d"]').val(a.old_data.d),$('[name="m"]').val(a.old_data.m),$('[name="f"]').val(a.old_data.f),$('[name="jumlah_foto"]').val(a.old_data.jumlah_foto),$('[name="jumlah_rontgen"]').val(a.old_data.jumlah_rontgen)},error:function(a,i,l){alert("Error get data from ajax")}})}$(document).ready(function(){$("#save").click(function(){html2canvas($("#imagesave")[0],{}).then(function(a){a=a.toDataURL("image/png");$.ajax({url:base_url+"rekam_medik/save_odontogram",type:"post",data:{image:a,id_reg:id_reg},dataType:"json",success:function(a){swalConfirm.fire("Berhasil Menyimpan Odontogram!",a.pesan,"success")},error:function(a,i,l){Swal.fire("Terjadi Kesalahan")}})})})}),$("#red").click(function(){$("#pilihanwarna").val("#ff0000")}),$("#green").click(function(){$("#pilihanwarna").val("#00ff00")}),$("#cyann").click(function(){$("#pilihanwarna").val("#00ffff")}),$("#old_brown").click(function(){$("#pilihanwarna").val("#A9A9A9")}),$("#pink").click(function(){$("#pilihanwarna").val("#ff3399")}),$("#biru_muda").click(function(){$("#pilihanwarna").val("#b3b3ff")}),$("#outline").click(function(){$("#pilihanwarna").val("outline")}),$("#pre").click(function(){$("#pilihanwarna").val("PRE")}),$("#ano").click(function(){$("#pilihanwarna").val("ANO")}),$("#une").click(function(){$("#pilihanwarna").val("UNE")}),$("#silang").click(function(){$("#pilihanwarna").val("silang")}),$("#akar").click(function(){$("#pilihanwarna").val("akar")}),$("#border").click(function(){$("#pilihanwarna").val("border")}),$("#segitiga").click(function(){$("#pilihanwarna").val("segitiga")}),$("#panah_kanan").click(function(){$("#pilihanwarna").val("panah_kanan")}),$("#panah_kiri").click(function(){$("#pilihanwarna").val("panah_kiri")}),$("#non_vital").click(function(){$("#pilihanwarna").val("non_vital")}),$("#crash").click(function(){$("#pilihanwarna").val("crash")}),$("#jemb_kiri").click(function(){$("#pilihanwarna").val("jembatan_kiri")}),$("#jemb_tengah").click(function(){$("#pilihanwarna").val("jembatan_tengah")}),$("#jemb_kanan").click(function(){$("#pilihanwarna").val("jembatan_kanan")}),$(document).ready(function(){for(var a=1;a<=16;a++)$("#barispertamakiri"+a).click(i(a,"kiri","pertama")),$("#barispertamaatas"+a).click(i(a,"atas","pertama")),$("#barispertamakanan"+a).click(i(a,"kanan","pertama")),$("#barispertamabawah"+a).click(i(a,"bawah","pertama")),$("#barispertamatengah"+a).click(i(a,"tengah","pertama")),$("#bariskeduakiri"+a).click(i(a,"kiri","kedua")),$("#bariskeduaatas"+a).click(i(a,"atas","kedua")),$("#bariskeduakanan"+a).click(i(a,"kanan","kedua")),$("#bariskeduabawah"+a).click(i(a,"bawah","kedua")),$("#bariskeduatengah"+a).click(i(a,"tengah","kedua")),$("#barisketigakiri"+a).click(i(a,"kiri","ketiga")),$("#barisketigaatas"+a).click(i(a,"atas","ketiga")),$("#barisketigakanan"+a).click(i(a,"kanan","ketiga")),$("#barisketigabawah"+a).click(i(a,"bawah","ketiga")),$("#barisketigatengah"+a).click(i(a,"tengah","ketiga")),$("#bariskeempatkiri"+a).click(i(a,"kiri","keempat")),$("#bariskeempatatas"+a).click(i(a,"atas","keempat")),$("#bariskeempatkanan"+a).click(i(a,"kanan","keempat")),$("#bariskeempatbawah"+a).click(i(a,"bawah","keempat")),$("#bariskeempattengah"+a).click(i(a,"tengah","keempat"));function i(i,l,n){return function(){var a=$("#pilihanwarna").val();"#"==a.substring(0,1)?$("#baris"+n+l+i).css("fill",$("#pilihanwarna").val()):"outline"==a?$("#baris"+n+"outline"+i).css("display","block"):"PRE"==a?($("#baris"+n+"pre"+i).css("display","block"),$("#baris"+n+"ano"+i).css("display","none"),$("#baris"+n+"une"+i).css("display","none")):"ANO"==a?($("#baris"+n+"pre"+i).css("display","none"),$("#baris"+n+"une"+i).css("display","none"),$("#baris"+n+"ano"+i).css("display","block")):"UNE"==a?($("#baris"+n+"pre"+i).css("display","none"),$("#baris"+n+"une"+i).css("display","block"),$("#baris"+n+"ano"+i).css("display","none")):"silang"==a?($("#baris"+n+"silang1"+i).css("display","block"),$("#baris"+n+"silang2"+i).css("display","block")):"border"==a?$("#baris"+n+l+i).css("stroke-width","2"):"segitiga"==a?$("#baris"+n+"segitiga"+i).css("display","block"):"panah_kanan"==a?$("#baris"+n+"panahkanan"+i).css("display","block"):"panah_kiri"==a?$("#baris"+n+"panahkiri"+i).css("display","block"):"non_vital"==a?($("#baris"+n+"segitiga"+i).css("display","block"),$("#baris"+n+"segitiga"+i).css("fill","white")):"akar"==a?($("#baris"+n+"akar1"+i).css("display","block"),$("#baris"+n+"akar2"+i).css("display","block")):"crash"==a?($("#baris"+n+"crash1"+i).css("display","block"),$("#baris"+n+"crash2"+i).css("display","block"),$("#baris"+n+"crash3"+i).css("display","block"),$("#baris"+n+"crash4"+i).css("display","block")):"jembatan_kiri"==a?($("#baris"+n+"jembtegak"+i).css("display","block"),$("#baris"+n+"jembkiri"+i).css("display","block")):"jembatan_tengah"==a?$("#baris"+n+"jembtengah"+i).css("display","block"):"jembatan_kanan"==a&&($("#baris"+n+"jembtegak"+i).css("display","block"),$("#baris"+n+"jembkanan"+i).css("display","block"))}}});