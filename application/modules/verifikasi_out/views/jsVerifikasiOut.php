<!--  DataTables -->
<script src="<?= config_item('assets') ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= config_item('assets') ?>plugins/datatables/dataTables.bootstrap.min.js"></script>

<script type="text/javascript">
  var save_method; //for save method string
  var table;
  var table2;
  var acc = document.getElementsByClassName("accordion");
  var acr;
  var grandTotal = 0;
  var bulan;
  var tahun;

  $(document).ready(function() {
    //declare variable for row count
    var i = randString(5);

    <?php if ($this->input->get('bulan') != '' && $this->input->get('tahun') != '') { ?>
      bulan = <?= $this->input->get('bulan'); ?>;
      tahun = <?= $this->input->get('tahun'); ?>;
    <?php } ?>

    //force integer input in textfield
    $('input.numberinput').bind('keypress', function(e) {
      return (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) && e.which != 46) ? false : true;
    });

    //datatables  
    // tabel verifikasi
    table = $('#tabelVerifikasi').DataTable({

      "processing": true,
      "serverSide": true,
      "order": [
        [2, 'desc']
      ],
      //load data for table content from ajax source
      "ajax": {
        "url": "<?php echo site_url('verifikasi_out/list_verifikasi/') ?>" + bulan + "/" + tahun,
        "type": "POST"
      },

      //set column definition initialisation properties
      "columnDefs": [{
        "targets": [-1], //last column
        "orderable": false, //set not orderable
      }, ],
    });

    // tabel verifikasi
    table2 = $('#tabelVerifikasiFinish').DataTable({

      "processing": true,
      "serverSide": true,
      "order": [
        [2, 'desc']
      ],
      //load data for table content from ajax source
      "ajax": {
        "url": "<?php echo site_url('verifikasi_out/list_verifikasi_finish/') ?>" + bulan + "/" + tahun,
        "type": "POST"
      },

      //set column definition initialisation properties
      "columnDefs": [{
        "targets": [-1], //last column
        "orderable": false, //set not orderable
      }, ],
    });

    //select2
    /*$(".i_akun").select2({
      ajax: {
        url: '<?php echo site_url('verifikasi_out/suggest_kode_akun'); ?>/',
        dataType: 'json',
        delay: 250,
        processResults: function(data) {
          return {
            results: data
          };
        },
        cache: true
      },
    });*/

    //datepicker
    $('#form_tanggal_order').datepicker({
      autoclose: true,
      format: "yyyy-mm-dd",
      todayHighlight: true,
      orientation: "top auto",
      todayBtn: true,
      todayHighlight: true,
    });

    //autocomplete
    $('#form_nama_barang_order').autocomplete({
      minLength: 2,
      delay: 0,
      source: '<?php echo site_url('trans_order/suggest_barang'); ?>',
      select: function(event, ui) {
        $('#form_id_barang_order').val(ui.item.id_barang);
        $('#form_nama_satuan_order').val(ui.item.nama_satuan);
        $('#form_id_satuan_order').val(ui.item.id_satuan);
      }
    });

    //set input/textarea/select event when change value, remove class error and remove text help block
    $("input").change(function() {
      $(this).parent().parent().removeClass('has-error');
      $(this).next().empty();
    });

    //mask money
    $('.mask-currency').maskMoney({
      precision: 0
    });

    //tabs
    var hash = window.location.hash;
    hash && $('ul.nav a[href="' + hash + '"]').tab('show');

    $('.nav-tabs a').click(function(e) {
      $(this).tab('show');
      var scrollmem = $('body').scrollTop();
      window.location.hash = this.hash;
      $('html,body').scrollTop(scrollmem);
    });


    //end jquery
  });

  function readURL(input, id) {
    var idImg = id + '-img';
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      console.log(reader);
      reader.onload = function(e) {
        $('#' + idImg).attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
    }
  }

  $(".i_gambar").change(function() {
    //console.log(this);
    var id = this.id;
    readURL(this, id);
  });

  function randString(angka) {
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    for (var i = 0; i < angka; i++)
      text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
  }

  function reloadPage() {
    location.reload();
  }

  function reload_table() {
    table.ajax.reload(null, false); //reload datatable ajax 
  }

  function reload_table2() {
    table2.ajax.reload(null, false); //reload datatable ajax 
  }

  function save() {
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled', true); //set button disable 
    var url;
    var tipe_simpan;

    if (save_method == 'add') {
      url = "<?php echo site_url('pengeluaran/add_pengeluaran') ?>";
      tipe_simpan = 'tambah';
    } else {
      url = "<?php echo site_url('pengeluaran/update_pengeluaran') ?>";
      tipe_simpan = 'update';
    }

    // ajax adding data to database
    $.ajax({
      url: url,
      type: "POST",
      data: $('#form').serialize(),
      dataType: "JSON",
      success: function(data) {
        if (data.status) //if success close modal and reload ajax table
        {
          if (tipe_simpan == 'tambah') {
            alert(data.pesan_tambah);
          } else {
            alert(data.pesan_update);
          }

          $('#modal_pengeluaran').modal('hide');
          reloadPage();
        } else {
          for (var i = 0; i < data.inputerror.length; i++) {
            $('[name="' + data.inputerror[i] + '"]').parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
            //parent once if element from form-group, if any div inside form-group, just make another parent
            $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]); //select span help-block class set text error string
            //alert(data.error_string[i]);
          }
        }
        $('#btnSave').text('save'); //change button text
        $('#btnSave').attr('disabled', false); //set button enable 
      },
      error: function(jqXHR, textStatus, errorThrown) {
        alert('Error adding / update data');
        //$('#modal_form_order').modal('hide');
        $('#btnSave').text('save'); //change button text
        $('#btnSave').attr('disabled', false); //set button enable 
      }
    });
  }

  function deleteVerifyFinish(id) {
    if (confirm('Anda yakin Hapus Data Ini ?')) {
      // ajax delete data to database
      $.ajax({
        url: "<?php echo site_url('verifikasi_out/hapus_verifikasi_out_finish') ?>/" + id,
        type: "POST",
        dataType: "JSON",
        success: function(data) {
          alert(data.pesan);
          reloadPage();
        },
        error: function(jqXHR, textStatus, errorThrown) {
          alert('Error deleting data');
        }
      });
    }
  }

  function hargaTotal(key) {
    var harga = $('#i_harga-' + key).maskMoney('unmasked')[0];
    var totalHarga = harga * parseInt($('#i_qty-' + key).val());
    //set harga total masked
    $('#i_harga_total-' + key).maskMoney('mask', totalHarga);
    //set harga raw
    $('#i_harga_raw-' + key).val(harga);
    $('#i_harga_total_raw-' + key).val(totalHarga);
  }

  function eventCeklis(checkbox, key) {
    if (checkbox.checked == true) {
      if ($('#i_harga_total_raw-' + key).val() == '') {
        grandTotal = parseInt(grandTotal) + 0;
      } else {
        grandTotal = parseInt(grandTotal) + parseInt($('#i_harga_total_raw-' + key).val());
      }

      $('#i_harga-' + key).prop('readonly', true);
    } else {
      if ($('#i_harga_total_raw-' + key).val() == '') {
        grandTotal = parseInt(grandTotal) - 0;
      } else {
        grandTotal = parseInt(grandTotal) - parseInt($('#i_harga_total_raw-' + key).val());
      }

      $('#i_harga-' + key).prop('readonly', false);
    }

    $('#grand_total').text(numberWithCommas(grandTotal));
    //$('#grand_total').text('Rp. ' + grandTotal.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));
  }

  function numberWithCommas(x) {
    var parts = x.toFixed(0).split(".");
    return 'Rp. ' + parts[0].replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.") + (parts[1] ? "," + parts[1] : "");
  }

  for (acr = 0; acr < acc.length; acr++) {
    acc[acr].addEventListener("click", function() {
      this.classList.toggle("active");
      var panel = this.nextElementSibling;
      if (panel.style.display === "block") {
        panel.style.display = "none";
      } else {
        panel.style.display = "block";
      }
    });
  }
</script>