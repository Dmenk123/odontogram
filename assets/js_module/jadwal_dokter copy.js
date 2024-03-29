
    var get_data        = $('#get_data').val();
    $('#jam_mulai').timepicker({
        minuteStep: 1,
        // defaultTime: time_now(),
        showSeconds: false,
        showMeridian: false,
        snapToStep: true
    });

    $('#jam_akhir').timepicker({
        minuteStep: 1,
        // defaultTime: time_now(),
        showSeconds: false,
        showMeridian: false,
        snapToStep: true
    });
    $(document).ready(function() {
        console.log('tes ');
        console.log(get_data);
        $('#datepick').datepicker({
            format: 'yyyy-mm-dd',
            startDate: '-3d'
        })

        $(".add-more").click(function(){ 
            var html = $(".copy").html();
            $(".after-add-more").after(html);
        });
        $("body").on("click",".remove",function(){ 
            $(this).parents(".control-group").remove();
        });

      
        $('#calendarIO').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,basicWeek,basicDay'
            },
    
            defaultDate: moment().format('YYYY-MM-DD'),
            editable: true,
                eventLimit: true, // allow "more" link when too many events
                selectable: true,
                html: true,
                selectHelper: true,
                select: function(start, end) {
                    $('#create_modal input[name=tanggal]').val(moment(start).format('YYYY-MM-DD'));
                    $('#create_modal').modal('show');
                    save();
                    $('#calendarIO').fullCalendar('unselect');
                },
                eventDrop: function(event, delta, revertFunc) { // si changement de position
                    editDropResize(event);
                },
                eventResize: function(event,dayDelta,minuteDelta,revertFunc) { // si changement de longueur
                    editDropResize(event);
                },
                eventClick: function(event, element)
                {
                    deteil(event);
                    editData(event);
                    deleteData(event);
                },
                events: JSON.parse(get_data)
            });
    });

    $(document).on('click', '.add_calendar', function(){
        $('#create_modal input[name=calendar_id]').val(0);
        $('#create_modal').modal('show');  
    })

    $(document).on('submit', '#form_create', function(){

        var element = $(this);
        var eventData;
        $.ajax({
            url     : base_url+'jadwal_dokter/save',
            type    : element.attr('method'),
            data    : element.serialize(),
            dataType: 'JSON',
            beforeSend: function()
            {
                element.find('button[type=submit]').html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>');
            },
            success: function(data)
            {
                if(data.status)
                {   
                    eventData = {
                        id          : data.id,
                        title       : data.id_dokter,
                        description : '',
                        start       : moment(data.tanggal),
                        end         : moment(data.tanggal),
                        color       : $('#create_modal select[name=color]').val()
                    };
                        $('#calendarIO').fullCalendar('renderEvent', eventData, true); // stick? = true
                        $('#create_modal').modal('hide');
                        element[0].reset();
                        $('.notification').removeClass('alert-danger').addClass('alert-primary').find('p').html(data.notif);
                    }
                    else
                    {
                        element.find('.alert').css('display', 'block');
                        element.find('.alert').html(data.notif);
                    }
                    element.find('button[type=submit]').html('Submit');
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    element.find('button[type=submit]').html('Submit');
                    element.find('.alert').css('display', 'block');
                    element.find('.alert').html('Wrong server, please save again');
                }         
            });
        return false;
    })

    function editDropResize(event)
    {
        start = event.start.format('YYYY-MM-DD HH:mm:ss');
        if(event.end)
        {
            end = event.end.format('YYYY-MM-DD HH:mm:ss');
        }
        else
        {
            end = start;
        }
        
        $.ajax({
            url     : base_url+'jadwal_dokter/save',
            type    : 'POST',
            data    : 'calendar_id='+event.id+'&title='+event.title+'&start_date='+start+'&end_date='+end,
            dataType: 'JSON',
            beforeSend: function()
            {
            },
            success: function(data)
            {
                if(data.status)
                {   
                    $('.notification').removeClass('alert-danger').addClass('alert-primary').find('p').html('Data success update');
                }
                else
                {
                    $('.notification').removeClass('alert-primary').addClass('alert-danger').find('p').html('Data cant update');
                }
                
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                $('.notification').removeClass('alert-primary').addClass('alert-danger').find('p').html('Wrong server, please save again');
            }         
        });
    }

    function save()
    {
        $('#form_create').submit(function(){
            var element = $(this);
            var eventData;
            $.ajax({
                url     : base_url+'jadwal_dokter/save',
                type    : element.attr('method'),
                data    : element.serialize(),
                dataType: 'JSON',
                beforeSend: function()
                {
                    element.find('button[type=submit]').html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>');
                },
                success: function(data)
                {
                    if(data.status)
                    {   
                        eventData = {
                            id          : data.id,
                            title       : data.id_dokter,
                            description : '',
                            start       : moment(data.tanggal),
                            end         : moment(data.tanggal),
                            color       : $('#create_modal select[name=color]').val()
                        };

                        $('#calendarIO').fullCalendar('renderEvent', eventData, true); // stick? = true
                        $('#create_modal').modal('hide');
                        element[0].reset();
                        $('.notification').removeClass('alert-danger').addClass('alert-primary').find('p').html(data.notif);
                    }
                    else
                    {
                        element.find('.alert').css('display', 'block');
                        element.find('.alert').html(data.notif);
                    }
                    element.find('button[type=submit]').html('Submit');
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    element.find('button[type=submit]').html('Submit');
                    element.find('.alert').css('display', 'block');
                    element.find('.alert').html('Wrong server, please save again');
                }         
            });
            return false;
        })
    }

    function deteil(event)
    {
        $.ajax({
            url : base_url + 'jadwal_dokter/edit_jadwal',
            type: "POST",
            dataType: "JSON",
            data : {id:event.id},
            success: function(data)
            {
                $('#create_modal input[name=calendar_id]').val(event.id);  
                $('#create_modal input[name=tanggal]').val(moment(data.old_data.tanggal).format('DD/MM/YYYY'));
                $('#create_modal input[name=id_dokter]').val(data.old_data.id_dokter);
                // $('#create_modal input[name=id_klinik]').val(data.old_data.id_klinik);
                $('#create_modal select[name=color]').val(event.color);

                $('[name="jam_mulai"]').val(data.old_data.jam_mulai);
                $('[name="jam_akhir"]').val(data.old_data.jam_akhir);
                $('#create_modal .delete_calendar').show();
                $('#create_modal').modal('show');
    
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
        // $('#create_modal input[name=calendar_id]').val(event.id);
        // $('#create_modal input[name=start_date]').val(moment(event.start).format('YYYY-MM-DD'));
        // $('#create_modal input[name=end_date]').val(moment(event.end).format('YYYY-MM-DD'));
        // $('#create_modal input[name=title]').val(event.title);
        // $('#create_modal input[name=description]').val(event.description);
        // $('#create_modal select[name=color]').val(event.color);
        // $('#create_modal .delete_calendar').show();
        // $('#create_modal').modal('show');
    }

    function editData(event)
    {
        $('#form_create').submit(function(){
            var element = $(this);
            var eventData;
            $.ajax({
                url     : base_url+'jadwal_dokter/save',
                type    : element.attr('method'),
                data    : element.serialize(),
                dataType: 'JSON',
                beforeSend: function()
                {
                    element.find('button[type=submit]').html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>');
                },
                success: function(data)
                {
                    if(data.status)
                    {   
                        event.title         = data.id_dokter;
                        event.description   = '';
                        event.start         = moment(data.tanggal);
                        event.end           = moment(data.tanggal);
                        event.color         = $('#create_modal select[name=color]').val();
                        $('#calendarIO').fullCalendar('updateEvent', event);

                        $('#create_modal').modal('hide');
                        element[0].reset();
                        $('#create_modal input[name=calendar_id]').val(0)
                        $('.notification').removeClass('alert-danger').addClass('alert-primary').find('p').html(data.notif);
                    }
                    else
                    {
                        element.find('.alert').css('display', 'block');
                        element.find('.alert').html(data.notif);
                    }
                    element.find('button[type=submit]').html('Submit');
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    element.find('button[type=submit]').html('Submit');
                    element.find('.alert').css('display', 'block');
                    element.find('.alert').html('Wrong server, please save again');
                }         
            });
            return false;
        })
    }

    function add_schedule()
    {
        // reset_modal_form();
        save_method = 'add';
        $('#modal_schedule').modal('show');
        $('#modal_title').text('Buat Jadwal Praktik Dokter Baru'); 
    }

    function deleteData(event)
    {
        $('#create_modal .delete_calendar').click(function(){
            $.ajax({
                url     : base_url+'jadwal_dokter/delete',
                type    : 'POST',
                data    : 'id='+event.id,
                dataType: 'JSON',
                beforeSend: function()
                {
                },
                success: function(data)
                {
                    if(data.status)
                    {   
                        $('#calendarIO').fullCalendar('removeEvents',event._id);
                        $('#create_modal').modal('hide');
                        $('#form_create')[0].reset();
                        $('#create_modal input[name=calendar_id]').val(0)
                        $('.notification').removeClass('alert-danger').addClass('alert-primary').find('p').html(data.notif);
                    }
                    else
                    {
                        $('#form_create').find('.alert').css('display', 'block');
                        $('#form_create').find('.alert').html(data.notif);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    $('#form_create').find('.alert').css('display', 'block');
                    $('#form_create').find('.alert').html('Wrong server, please save again');
                }         
            });
        })
    }

    function reset_modal_form()
    {
        $('#form-schedule')[0].reset();
        $('.append-opt').remove(); 
        $('div.form-group').children().removeClass("is-invalid invalid-feedback");
        $('span.help-block').text('');
        $('#div_pass_lama').css("display","none");
    }
