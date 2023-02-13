
@extends('admin.layouts.main')
@section('content')

    <div class="content-body">
        <div class="container-fluid">
            <!-- row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body d-flex">
                        </div>                        
                        <label id="timer"></label>  
                        <div class="card-body">
                            <div class="table-responsive" id="datatable-Fuel">
                                <table class=" table table-bordered table-striped table-hover datatable datatable-Fuel">
                                    <thead>
                                        <tr>                                          
                                            <th>
                                                Name
                                            </th>
                                            <th>
                                                Shift
                                            </th>                                        
                                        </tr>
                                    </thead>
                                    <tbody>
                                                                                                                    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
@parent
@php
    $url = isset(request()->test_id) ? route('shifts.index') . '?test_id=1' : route('shifts.index');
    if(isset(request()->bid) && isset(request()->test_id)) {
        $url = $url . "&bid=" . request()->bid;
    } elseif (isset(request()->bid)) {
        $url = $url . "?bid=" . request()->bid;
    }
@endphp
<script>

    function shiftManagement(id){

                $.ajax({
                url: '{{ route("shift-management") }}',
                type: 'POST',
                data: {
                 
                    "_token" : "{{ csrf_token() }}",
                    'data' : {
                        'id'       : id,
                    },
                },
                success : function(data) {

                if(($(".shift_id_"+parseInt(id))[0])){
                  
                  clearInterval(window['clock_interval'+id]);
                  $("#clock_"+id).hide();
            
                   
                }      
                else{
                    $("#clock_"+id).html("");
                    $("#clock_"+id).show();
                    window['clock'+id] = new Clock(0,0,0);
                    document.getElementById("clock_"+id).innerHTML="0:0:0";
                    window['clock_interval'+id] = setInterval(function(){
                        document.getElementById("clock_"+id).innerHTML=window['clock'+id].timer();

                    },1000);
                }                                 
                $("#shift_"+id).html(data);
                },
                error : function(data) {
                  
                }
            });        
    }
    var url = "{{ $url }}";
    url = url.replace(/&amp;/g, '&');
    let timerIds=[];

    class Clock {
      constructor(hour, minute, second) {
        this.hour = hour;
        this.minute = minute;
        this.second = second;
      }
      timer() {
            this.second+=1;
            if(this.second==60){
                this.second=0;
                this.minute+=1;
            }
            if(this.minute==60){
                this.minute=0;
                this.hour+=1;
            }

            return this.hour+":"+this.minute+":"+this.second;
        }  
    }

    $(function () {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

        let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: false,
                aaSorting: [],
                ajax: url,
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'shift', name: 'shift','searchable' : false,},
           
                ],
                order: [[ 0, 'asc' ]],
                pageLength: 10,
                destroy: true,
                "drawCallback": function() {
                     $('.timer').each(function(i, obj) {
                        let idStr = this.id;
                        let id = idStr.split("_");      
                        var timerInstances=[];                  
                        if(!timerIds.includes(id[1])){
                            var str="",c=0;
                            timerIds.push(id[1]); 
                            
                            $('.timer').each(function(i2, obj) {
                                let idStr2 = this.id;
                                let id2 = idStr2.split("_");   

                                if(id[1]==id2[1]){
                                    c+=1;
                                    str+=this.innerHTML;
                                    if(c!=3){
                                        str+=",";
                                    }

                                }                             
                                                                                        
                            });
         
                            let timer_sec = str.split(",");
                            let idShift=parseInt(id[1]);
                            window['clock'+idShift] = new Clock(parseInt(timer_sec[0]),parseInt(timer_sec[1]),parseInt(timer_sec[2]));
                            document.getElementById("clock_"+id[1]).innerHTML="0:0:0";
                            window['clock_interval'+idShift] = setInterval(function(){
                                document.getElementById("clock_"+id[1]).innerHTML=window['clock'+idShift].timer();

                            },1000);                           
                        }
                        
                        
                     }); 
                },

      
            };

        $('.datatable-Fuel').DataTable(dtOverrideGlobals);


        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });

    });
</script>
@endsection
