<!--  DataTables --> 
<script src="<?=config_item('assets')?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=config_item('assets')?>plugins/datatables/dataTables.bootstrap.min.js"></script>

<script type="text/javascript">
    var tipe_update; //for save method string
    var table;

$(document).ready(function() {

    //force integer input in textfield
    $('input.numberInput').bind('keypress', function (e) {
        return (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) && e.which != 46) ? false : true;
    });

    /*//datepicker
    $('#tanggalLahir').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd",
        todayHighlight: true,
        orientation: "top auto",
        todayBtn: true,
        todayHighlight: true,
    });*/

   /* //update dt_read after click
    $(document).on('click', '.linkNotif', function(){
        var id = $(this).attr('id');
        $.ajax({
            url : "<?php echo site_url('inbox/update_read/')?>/" + id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                location.href = "<?php echo site_url('inbox/index')?>";
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    });*/

    $(".gambar").change(function() {
      //console.log(this);
      var id = this.id;
      readURL(this, id);
    });

    //set input/textarea/select event when change value, remove class error and remove text help block
    $("input").change(function() {
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });

    $('#ceklistpwd').change(function() {
        if (this.checked) {
            $('#password').attr('readonly', true);
            $('#repassword').attr('readonly', true);
            $('#passwordnew').attr('readonly', true);
        } else {
            $('#password').attr('readonly', false);
            $('#repassword').attr('readonly', false);
            $('#passwordnew').attr('readonly', false);
        }
    });

//end jquery
});

function update_profil(tipe_update)
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;

    if(tipe_update == 'user') {
        url = "<?php echo site_url('profil/update_data_user')?>";
    } else {
        url = "<?php echo site_url('profil/update_data_pegawai')?>";
    }

    // Get form
    let form = $('#form_input')[0];
    let data = new FormData(form);

    // ajax adding data to database
    $.ajax({
        url : url,
        enctype: 'multipart/form-data',
        type: "POST",
        data: data,
        dataType: "JSON",
        processData: false,
        contentType: false,
        success: function(data)
        {

            if(data.status) {
                window.location.href = "<?=base_url('/profil');?>";
            }else {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    if (data.inputerror[i] != 'jabatan') {
                        $('[name="'+data.inputerror[i]+'"]').parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                    }else{
                        $($('#jabatan').data('select2').$container).addClass('has-error');
                    }
                }
            }

            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            console.log(textStatus, errorThrown);
            alert('Error adding / update data');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 

        }
    });
}

function readURL(input, id) {
  var idImg = id +'-img';
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    console.log(reader);
    reader.onload = function(e) {
      $('#'+ idImg).attr('src', e.target.result);
    }
    
    reader.readAsDataURL(input.files[0]);
  }
}
</script>