var save_method,table;function changeModel(){"1"==$("#model").val()?($(".div_tanggal_mulai").hide(),$(".div_tanggal_akhir").hide(),$(".div_bulan").show(),$(".div_tahun").hide()):"3"==$("#model").val()?($(".div_tanggal_mulai").show(),$(".div_tanggal_akhir").show(),$(".div_bulan").hide(),$(".div_tahun").hide()):"2"==$("#model").val()?($(".div_tahun").show(),$(".div_tanggal_mulai").hide(),$(".div_tanggal_akhir").hide(),$(".div_bulan").hide()):($(".div_tanggal_mulai").hide(),$(".div_tanggal_akhir").hide(),$(".div_bulan").hide(),$(".div_tahun").hide())}function save(){var a=!1,i="";"1"==$("#model").val()?""!=$("#bulan").val()?""!=$("#tahun").val()?a=!0:i="Silahkan memilih Tahun terlebih dahulu":i="Silahkan memilih Bulan terlebih dahulu":"3"==$("#model").val()?""!=$("#tanggal_mulai").val()&&""!=$("#tanggal_akhir").val()?a=!0:i="Silahkan memilih Tanggal Awal dan AKhir terlebih dahulu":"2"==$("#model").val()&&(""!=$("#tahun2").val()?a=!0:i="Silahkan memilih Tahun terlebih dahulu"),a?$("#submit_form").submit():(Swal.fire(i),exit)}function cetak(){let a=new URLSearchParams(window.location.search);var i=a.get("model");i?window.open(base_url+"lap_penerimaan_klinik/cetak_data?model="+i+"&start="+a.get("start")+"&end="+a.get("end")+"&bulan="+a.get("bulan")+"&tahun="+a.get("tahun")+"&tahun2="+a.get("tahun2")+"&jenis=laporan_klinik","_blank"):Swal.fire("Silahkan Pilih Periode Terlebih dahulu")}$(document).ready(function(){$("input.numberinput").bind("keypress",function(a){return 8==a.which||0==a.which||!(a.which<48||57<a.which)||46==a.which});var a=$("#model").val(),i=$("#tanggal_awal").val(),l=$("#tanggal_akhir").val(),n=$("#bulan").val(),h=$("#tahun").val(),e=$("#tahun2").val();"1"==a?($(".div_tanggal_mulai").hide(),$(".div_tanggal_akhir").hide(),$(".div_bulan").show(),$(".div_tahun").hide()):"3"==a?($(".div_tanggal_mulai").show(),$(".div_tanggal_akhir").show(),$(".div_bulan").hide(),$(".div_tahun").hide()):"2"==a?($(".div_tahun").show(),$(".div_tanggal_mulai").hide(),$(".div_tanggal_akhir").hide(),$(".div_bulan").hide()):($(".div_tanggal_mulai").hide(),$(".div_tanggal_akhir").hide(),$(".div_bulan").hide(),$(".div_tahun").hide()),a&&$.ajax({type:"post",url:base_url+"lap_penerimaan_klinik/tabel_laporan",data:{model:a,start:i,end:l,bulan:n,tahun:h,tahun2:e},dataType:"JSON",success:function(a){$("#tabel_lap_penjualan tbody").html(a.data)}})});