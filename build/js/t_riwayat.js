function reloadFormDiagnosaRiwayat(){$("#CssLoader").removeClass("hidden"),$("#CssLoader").addClass("hidden"),table=$("#tabel_modal_diagnosa_pasien").DataTable({responsive:!0,searchDelay:500,processing:!0,serverSide:!1,bDestroy:!0,ajax:{url:base_url+"rekam_medik/riwayat_diagnosa",type:"POST",data:{id_peg:id_peg,id_psn:id_psn,id_reg:id_reg}},columnDefs:[{targets:[-1],orderable:!1}]})}function reloadFormTindakanRiwayat(){$("#CssLoader").removeClass("hidden"),$("#CssLoader").addClass("hidden"),table=$("#tabel_modal_tindakan_pasien").DataTable({responsive:!0,searchDelay:500,processing:!0,serverSide:!1,bDestroy:!0,ajax:{url:base_url+"rekam_medik/riwayat_tindakan",type:"POST",data:{id_peg:id_peg,id_psn:id_psn,id_reg:id_reg}},columnDefs:[{targets:[-1],orderable:!1}]})}function reloadFormTindakanLabRiwayat(){$("#CssLoader").removeClass("hidden"),$("#CssLoader").addClass("hidden"),table=$("#tabel_modal_tindakan_lab_pasien").DataTable({responsive:!0,searchDelay:500,processing:!0,serverSide:!1,bDestroy:!0,ajax:{url:base_url+"rekam_medik/riwayat_tindakan_lab",type:"POST",data:{id_peg:id_peg,id_psn:id_psn,id_reg:id_reg}},columnDefs:[{targets:[-1],orderable:!1}]})}$(document).ready(function(){});