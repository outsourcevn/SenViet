<div class="content">
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>"><i>Trang chủ</i></a></li>
            <?php foreach($breadcrumb as $_item):?>
                <li><a href="<?php echo $_item['href'];?>"><i><?php echo $_item['title'];?></i></a></li>
            <?php endforeach;?>
        </ol>
        <div class="col-lg-12">
            <div class="col-lg-12" style="border-bottom: 1px dashed #aeaeae;">
                <p class="company-heading"><?php echo $_item['title'];?></p>
            </div>
            <br/>
        </div>
        <div class="clearfix"></div>
        <br/>
        <div class="col-lg-12">
            <div id="working_calendar"></div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#working_calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                defaultDate: '<?php echo date('Y-m-d');?>',
                editable: false,
                eventLimit: true, // allow "more" link when too many events
                lang: 'vi',
                events: {
                    url: '/calendar/event_schedule/',
                    error: function() {
                        $('#script-warning').show();
                    }
                },
                loading: function(bool) {
                    $('#loading').toggle(bool);
                }
            });

        });
    </script>
</div>