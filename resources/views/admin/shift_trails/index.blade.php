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
                        
                        <div class="card-body">
                            <div class="table-responsive" id="datatable-Fuel">
                                <table class=" table table-bordered table-striped table-hover datatable datatable-Fuel">
                                    <thead>
                                        <tr>   
                                            <th>
                                                #
                                            </th>                                       
                                            <th>
                                                Name
                                            </th>
                                            <th>
                                                Time in
                                            </th>
                                            <th>
                                                Time out
                                            </th> 
                                            <th>
                                                Orders
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
    $url = isset(request()->test_id) ? route('shiftTrails.index') . '?test_id=1' : route('shiftTrails.index');
    if(isset(request()->bid) && isset(request()->test_id)) {
        $url = $url . "&bid=" . request()->bid;
    } elseif (isset(request()->bid)) {
        $url = $url . "?bid=" . request()->bid;
    }
@endphp
<script>


    var url = "{{ $url }}";
    url = url.replace(/&amp;/g, '&');

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
                   {data: 'id', name: 'id'},
                   {data: 'name', name: 'user.name'},
                   {data: 'time_in', name: 'time_in'},
                   {data: 'time_out', name: 'time_out'},
                   {data: 'orders', name: 'orders'},
           
                ],
                order: [[ 0, 'asc' ]],
                pageLength: 10,
                destroy: true
            };

        $('.datatable-Fuel').DataTable(dtOverrideGlobals);
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });

        document.getElementById('siteOpt').onchange = function () {
            $("#datatable-Fuel").html("");
            $("#datatable-Fuel").html(`
                        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Fuel">
                            <thead>                               
                                <th>
                                    Name
                                </th>
                                <th>
                                    Time in
                                </th>
                                <th>
                                    Time out
                                </th>  
                                <th>
                                    Orders
                                </th>                                                     
                                
                            </thead>
                        </table>
                    `);

    

            let dtOverrideGlobals = {
                    buttons: dtButtons,
                    processing: true,
                    serverSide: true,
                    retrieve: false,
                    aaSorting: [],
                    ajax: {
                        "url": url,
                        "data": {
                            "siteId": $(this).val()
                        }
                    },
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'name', name: 'user.name'},
                        {data: 'time_in', name: 'time_in'},
                        {data: 'time_out', name: 'time_out'},
                        {data: 'orders', name: 'orders'},
                                        
                       
                    ],
                    order: [[ 0, 'asc' ]],
                    pageLength: 10,
                    destroy: true
                };

            $('.datatable-Fuel').DataTable(dtOverrideGlobals);
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });
        }

    });
</script>
@endsection
