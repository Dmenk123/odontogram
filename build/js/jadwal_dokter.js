var get_data=$("#get_data").val(),backend_url="<?php echo base_url(); ?>";function editDropResize(e){start=e.start.format("YYYY-MM-DD HH:mm:ss"),end=e.end?e.end.format("YYYY-MM-DD HH:mm:ss"):start,$.ajax({url:backend_url+"calendar/save",type:"POST",data:"calendar_id="+e.id+"&title="+e.title+"&start_date="+start+"&end_date="+end,dataType:"JSON",beforeSend:function(){},success:function(e){e.status?$(".notification").removeClass("alert-danger").addClass("alert-primary").find("p").html("Data success update"):$(".notification").removeClass("alert-primary").addClass("alert-danger").find("p").html("Data cant update")},error:function(e,a,t){$(".notification").removeClass("alert-primary").addClass("alert-danger").find("p").html("Wrong server, please save again")}})}function save(){$("#form_create").submit(function(){var a,n=$(this);return $.ajax({url:backend_url+"calendar/save",type:n.attr("method"),data:n.serialize(),dataType:"JSON",beforeSend:function(){n.find("button[type=submit]").html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>')},success:function(e){e.status?(a={id:e.id,title:$("#create_modal input[name=title]").val(),description:$("#create_modal textarea[name=description]").val(),start:moment($("#create_modal input[name=start_date]").val()).format("YYYY-MM-DD HH:mm:ss"),end:moment($("#create_modal input[name=end_date]").val()).format("YYYY-MM-DD HH:mm:ss"),color:$("#create_modal select[name=color]").val()},$("#calendarIO").fullCalendar("renderEvent",a,!0),$("#create_modal").modal("hide"),n[0].reset(),$(".notification").removeClass("alert-danger").addClass("alert-primary").find("p").html(e.notif)):(n.find(".alert").css("display","block"),n.find(".alert").html(e.notif)),n.find("button[type=submit]").html("Submit")},error:function(e,a,t){n.find("button[type=submit]").html("Submit"),n.find(".alert").css("display","block"),n.find(".alert").html("Wrong server, please save again")}}),!1})}function deteil(e){$("#create_modal input[name=calendar_id]").val(e.id),$("#create_modal input[name=start_date]").val(moment(e.start).format("YYYY-MM-DD")),$("#create_modal input[name=end_date]").val(moment(e.end).format("YYYY-MM-DD")),$("#create_modal input[name=title]").val(e.title),$("#create_modal input[name=description]").val(e.description),$("#create_modal select[name=color]").val(e.color),$("#create_modal .delete_calendar").show(),$("#create_modal").modal("show")}function editData(a){$("#form_create").submit(function(){var n=$(this);return $.ajax({url:backend_url+"calendar/save",type:n.attr("method"),data:n.serialize(),dataType:"JSON",beforeSend:function(){n.find("button[type=submit]").html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>')},success:function(e){e.status?(a.title=$("#create_modal input[name=title]").val(),a.description=$("#create_modal textarea[name=description]").val(),a.start=moment($("#create_modal input[name=start_date]").val()).format("YYYY-MM-DD HH:mm:ss"),a.end=moment($("#create_modal input[name=end_date]").val()).format("YYYY-MM-DD HH:mm:ss"),a.color=$("#create_modal select[name=color]").val(),$("#calendarIO").fullCalendar("updateEvent",a),$("#create_modal").modal("hide"),n[0].reset(),$("#create_modal input[name=calendar_id]").val(0),$(".notification").removeClass("alert-danger").addClass("alert-primary").find("p").html(e.notif)):(n.find(".alert").css("display","block"),n.find(".alert").html(e.notif)),n.find("button[type=submit]").html("Submit")},error:function(e,a,t){n.find("button[type=submit]").html("Submit"),n.find(".alert").css("display","block"),n.find(".alert").html("Wrong server, please save again")}}),!1})}function deleteData(a){$("#create_modal .delete_calendar").click(function(){$.ajax({url:backend_url+"calendar/delete",type:"POST",data:"id="+a.id,dataType:"JSON",beforeSend:function(){},success:function(e){e.status?($("#calendarIO").fullCalendar("removeEvents",a._id),$("#create_modal").modal("hide"),$("#form_create")[0].reset(),$("#create_modal input[name=calendar_id]").val(0),$(".notification").removeClass("alert-danger").addClass("alert-primary").find("p").html(e.notif)):($("#form_create").find(".alert").css("display","block"),$("#form_create").find(".alert").html(e.notif))},error:function(e,a,t){$("#form_create").find(".alert").css("display","block"),$("#form_create").find(".alert").html("Wrong server, please save again")}})})}$(document).ready(function(){console.log("tes "),console.log(get_data),$("#calendar_tes").fullCalendar({header:{left:"prev,next today",center:"title",right:"month,basicWeek,basicDay"},defaultDate:moment().format("YYYY-MM-DD"),editable:!0,eventLimit:!0,selectable:!0,selectHelper:!0,select:function(e,a){$("#create_modal input[name=start_date]").val(moment(e).format("YYYY-MM-DD")),$("#create_modal input[name=end_date]").val(moment(a).format("YYYY-MM-DD")),$("#create_modal").modal("show"),save(),$("#calendarIO").fullCalendar("unselect")},eventDrop:function(e,a,t){editDropResize(e)},eventResize:function(e,a,t,n){editDropResize(e)},eventClick:function(e,a){deteil(e),editData(e),deleteData(e)},events:JSON.parse(get_data)})}),$(document).on("click",".add_calendar",function(){$("#create_modal input[name=calendar_id]").val(0),$("#create_modal").modal("show")}),$(document).on("submit","#form_create",function(){var a,n=$(this);return $.ajax({url:backend_url+"calendar/save",type:n.attr("method"),data:n.serialize(),dataType:"JSON",beforeSend:function(){n.find("button[type=submit]").html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>')},success:function(e){e.status?(a={id:e.id,title:$("#create_modal input[name=title]").val(),description:$("#create_modal textarea[name=description]").val(),start:moment($("#create_modal input[name=start_date]").val()).format("YYYY-MM-DD HH:mm:ss"),end:moment($("#create_modal input[name=end_date]").val()).format("YYYY-MM-DD HH:mm:ss"),color:$("#create_modal select[name=color]").val()},$("#calendarIO").fullCalendar("renderEvent",a,!0),$("#create_modal").modal("hide"),n[0].reset(),$(".notification").removeClass("alert-danger").addClass("alert-primary").find("p").html(e.notif)):(n.find(".alert").css("display","block"),n.find(".alert").html(e.notif)),n.find("button[type=submit]").html("Submit")},error:function(e,a,t){n.find("button[type=submit]").html("Submit"),n.find(".alert").css("display","block"),n.find(".alert").html("Wrong server, please save again")}}),!1});