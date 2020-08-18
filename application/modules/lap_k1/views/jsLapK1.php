<!-- DataTables -->
<script src="<?=config_item('assets')?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=config_item('assets')?>plugins/datatables/dataTables.bootstrap.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {

	//set input/textarea/select event when change value, remove class error and remove text help block
	$("input").change(function() {
		$(this).parent().parent().removeClass('has-error');
		$(this).next().empty();
	});


    //datatable
    $('#tblLaporanMutasiDetail').DataTable({
        "pageLength": 50,
         "order": [],
    });
});	

function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax 
}

</script>	