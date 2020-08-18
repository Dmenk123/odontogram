<!--  DataTables -->
<script src="<?= config_item('assets') ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= config_item('assets') ?>plugins/datatables/dataTables.bootstrap.min.js"></script>

<script type="text/javascript">
  var save_method; //for save method string
  var table;
  var table2;
  var bulan;
  var tahun;

  $(document).ready(function() {
    //declare variable for row count
    var i = randString(5);
    //addrow field inside modal
    $('#btn_add_row').click(function() {
      var ambilId = $('#form_id_tbl').val();
      var ambilKeterangan = $('#form_keterangan_tbl').val();
      var ambilIdAkun = $('#form_id_akun').val();
      var ambilIJumlah = $('#form_jumlah_tbl').val();
      var ambilSatuan = $('#form_satuan_tbl').val();
      var ambilSatuanText = $("#form_satuan_tbl option:selected").text();
      if (ambilKeterangan == "" || ambilIJumlah == "" || ambilIJumlah == '0' || ambilSatuan == "" || ambilIdAkun == "") {
        alert('ada field yang tidak diisi, Mohon cek lagi!!');
      } else {
        $('#tabel_pengeluaran').append(
          '<tr class="tbl_modal_row" id="row' + i + '">' +
          '<td style="width: 40%;">' +
          '<input type="text" name="i_keterangan[]" value="' + ambilKeterangan + '" id="i_keterangan" class="form-control" required readonly style="width: 100%;">' +
          '<input type="hidden" name="i_idakun[]" value="' + ambilIdAkun + '" id="i_idakun" class="form-control" required readonly style="width: 100%;">' +
          '</td>' +
          '<td style="width: 10%;">' +
          '<input type="text" name="i_jumlah[]" value="' + ambilIJumlah + '" id="i_jumlah" class="form-control" required readonly style="width: 100%;">' +
          '</td>' +
          '<td style="width: 15%;">' +
          '<input type="text" name="i_satuan_text[]" value="' + ambilSatuanText + '" id="i_satuan_text" class="form-control" required readonly style="width: 100%;">' +
          '<input type="hidden" name="i_satuan[]" value="' + ambilSatuan + '" id="i_satuan" class="form-control" required readonly style="width: 100%;">' +
          '</td>' +
          '<td><button name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button></td>' +
          '</tr>');
        i = randString(5);

        //kosongkan field setelah append row
        $('#form_pemohon_tbl').val("");
        $('#form_id_tbl').val("");
        $('#form_keterangan_tbl').val("");
        $('#form_jumlah_tbl').val("");
        $('#form_satuan_tbl').val("");
      }
    });

    //force integer input in textfield
    $('input.numberinput').bind('keypress', function(e) {
      return (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) && e.which != 46) ? false : true;
    });

    $(document).on('click', '.btn_remove', function() {
      var button_id = $(this).attr('id');
      $('#row' + button_id + '').remove();
    });

    // select class modal apabila bs.modal hidden
    $("#modal_pengeluaran").on("hidden.bs.modal", function() {
      $('#form')[0].reset();
      //clear tr append in modal
      $('tr').remove('.tbl_modal_row');
      $('.form-group').removeClass('has-error');
      $('.help-block').empty();
    });

    <?php if ($this->input->get('bulan') != '' && $this->input->get('tahun') != '') { ?>
      bulan = <?= $this->input->get('bulan'); ?>;
      tahun = <?= $this->input->get('tahun'); ?>;
    <?php } ?>

    table = $('#tabelPengeluaran').DataTable({

      "processing": true,
      "serverSide": true,
      "order": [
        [2, 'desc']
      ],
      //load data for table content from ajax source
      "ajax": {
        "url": "<?php echo site_url('pengeluaran/list_pengeluaran/') ?>" + bulan + "/" + tahun,
        "type": "POST"
      },

      //set column definition initialisation properties
      "columnDefs": [{
        "targets": [-1], //last column
        "orderable": false, //set not orderable
      }, ],
    });

    $('#tabelTransOrderDetail').DataTable({});

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
    $('#form_keterangan_tbl').autocomplete({
      minLength: 2,
      delay: 0,
      source: '<?php echo site_url('pengeluaran/suggest_pengeluaran'); ?>',
      select: function(event, ui) {
        $('#form_id_akun').val(ui.item.id);
      }
    });

    $('#form_keterangan_tbl').click(function(event) {
      $(this).val('');
      $('#form_id_akun').val('');
    });

    //set input/textarea/select event when change value, remove class error and remove text help block
    $("input").change(function() {
      $(this).parent().parent().removeClass('has-error');
      $(this).next().empty();
    });

    //end jquery
  });

  function addPengeluaran() {
    save_method = 'add';
    $('#form')[0].reset(); //reset form on modals
    $('.form-group').removeClass('has-error'); //clear error class
    $('.help-block').empty(); //clear error string
    $('#modal_pengeluaran').modal('show'); //show bootstrap modal
    $('.modal-title').text('Transaksi Pencatatan Pengeluaran'); //set title modal
    $.ajax({
      url: "<?php echo site_url('pengeluaran/get_header_modal_form/') ?>",
      type: "GET",
      dataType: "JSON",
      success: function(data) {
        //header
        $('[name="fieldId"]').val(data.kode_pencatatan);
      }
    });
  }

  function editPengeluaran(id) {
    save_method = 'update';
    $('#form')[0].reset();
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_pengeluaran').modal('show'); // show bootstrap modal when complete loaded
    $('.modal-title').text('Edit Transaksi Pencatatan Pengeluaran');
    //Ajax Load data from ajax
    $.ajax({
      url: "<?php echo site_url('pengeluaran/edit_pengeluaran/') ?>" + id,
      type: "GET",
      dataType: "JSON",
      success: function(data) {
        console.log(data.date_header);
        //header
        $('[name="fieldId"]').val(data.data_header[0].id);
        $('[name="fieldUsername"]').val(data.data_header[0].username);
        $('[name="fieldUserid"]').val(data.data_header[0].user_id);
        $('[name="fieldPemohon"]').val(data.data_header[0].pemohon);

        //isi
        var i = randString(5);
        var key_isi = 1;
        Object.keys(data.data_isi).forEach(function() {
          $('#tabel_pengeluaran').append(
            '<tr class="tbl_modal_row" id="row' + i + '">' +
            '<td style="width: 40%;">' +
            '<input type="text" name="i_keterangan[]" value="' + data.data_isi[key_isi - 1].keterangan + '" id="i_keterangan" class="form-control" required readonly style="width: 100%;">' +
            '<input type="hidden" name="i_idakun[]" value="' + data.data_isi[key_isi - 1].kode_in_text_akun + '" id="i_idakun" class="form-control" required readonly style="width: 100%;">' +
            '</td>' +
            '<td style="width: 10%;">' +
            '<input type="text" name="i_jumlah[]" value="' + data.data_isi[key_isi - 1].qty + '" id="i_jumlah" class="form-control" required readonly style="width: 100%;">' +
            '</td>' +
            '<td style="width: 15%;">' +
            '<input type="text" name="i_satuan_text[]" value="' + data.data_isi[key_isi - 1].nama_satuan + '" id="i_satuan_text" class="form-control" required readonly style="width: 100%;">' +
            '<input type="hidden" name="i_satuan[]" value="' + data.data_isi[key_isi - 1].satuan + '" id="i_satuan" class="form-control" required readonly style="width: 100%;">' +
            '</td>' +
            '<td><button name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button></td>' +
            '</tr>'
          );

          key_isi++;
          i = randString(5);
        });

        // select class modal apabila bs.modal hidden
        $("#modal_pengeluaran").on("hidden.bs.modal", function() {
          //reset form value on modals
          $('#form')[0].reset();
          $('tr').remove('.tbl_modal_row');
          $('.form-group').removeClass('has-error'); //clear error class
          $('.help-block').empty(); //clear error string
        });
      },
      error: function(jqXHR, textStatus, errorThrown) {
        alert('Error get data from ajax');
      }
    });

  }

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
          reload_table();
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

  function deletePengeluaran(id) {
    if (confirm('Yakin hapus data ini ?')) {
      // ajax delete data to database
      $.ajax({
        url: "<?php echo site_url('pengeluaran/delete_pengeluaran') ?>/" + id,
        type: "POST",
        dataType: "JSON",
        success: function(data) {
          //if success reload ajax table
          $('#modal_form_order').modal('hide');
          alert(data.pesan);
          //call function
          reload_table();
        },
        error: function(jqXHR, textStatus, errorThrown) {
          alert('Error deleting data');
        }
      });
    }
  }
</script>