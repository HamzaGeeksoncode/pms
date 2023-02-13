@extends('admin.layouts.main')
@section('content')

    <div class="content-body">
        <div class="container-fluid">
            <!-- row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Readings</h4>
                            <a href="{{ route("readings.create") }}" type="submit" class="btn btn-outline-primary add-btn">Add Reading</a>
                        </div>                        
                        <div class="card-body d-flex">

                        </div>                        
                        <div class="card-body">
                            <div class="table-responsive" id="datatable-reading">
                                <table class=" table table-bordered table-striped table-hover datatable datatable-reading">
                                    <thead>
                                        <tr>                                               
                                            <th>
                                                Name
                                            </th>
                                            <th>
                                                Fuel Type
                                            </th> 
                                            <th>
                                                Tank
                                            </th>
                                            <th>
                                                Pump
                                            </th>
                                            <th>
                                                Hose
                                            </th>                                                                        
                                            <th>
                                                Reading
                                            </th>                                                            
                                            <th>
                                                Litre
                                            </th>                                                           
                                            <th>
                                                &nbsp;
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
    $url = isset(request()->test_id) ? route('readings.index') . '?test_id=1' : route('readings.index');
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
        @can('fuel_delete')
            let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
            let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('readings.massDestroy') }}",
                className: 'btn-danger',
                action: function (e, dt, node, config) {
                    var ids = $.map(dt.rows({selected: true}).data(), function (entry) {
                        return entry.id
                    });

                    if (ids.length === 0) {
                        alert('{{ trans('global.datatables.zero_selected') }}')

                        return
                    }

                    if (confirm('{{ trans('global.areYouSure') }}')) {
                        $.ajax({
                            headers: {'x-csrf-token': "{{ csrf_token() }}"},
                            method: 'POST',
                            url: config.url,
                            data: {ids: ids, _method: 'DELETE'}
                        })
                            .done(function () {
                                location.reload()
                            })
                    }
                }
            }
            dtButtons.push(deleteButton)
        @endcan

        let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: false,
                aaSorting: [],
                ajax: url,
                columns: [
                        {data: 'name'     , name: 'users.name'},
                        {data: 'fuel_type',  name:'tanks.type'},
                        {data: 'tank', name: 'tanks.name'},
                        {data: 'pump', name: 'pumps.name'},
                        {data: 'hose', name: 'hoses.name'},
                        {data: 'reading', name: 'hose_val'},
                        {data: 'litre', name: 'litre'},
                        {data: 'actions', name: '{{ trans('global.actions') }}','searchable' : false,}
                ],
               
                pageLength: 10,
                destroy: true
            };

        $('.datatable-reading').DataTable(dtOverrideGlobals);
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });

        document.getElementById('siteOpt').onchange = function () {
            $("#datatable-reading").html("");
            $("#datatable-reading").html(`
                        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-reading">
                            <thead>                                                       
                                <th>
                                    Name
                                </th>
                                <th>
                                    Fuel Type
                                </th> 
                                <th>
                                    Tank
                                </th>
                                <th>
                                    Pump
                                </th>
                                <th>
                                    Hose
                                </th>                                                                        
                                <th>
                                    Reading
                                </th>                                                            
                                <th>
                                    Litre
                                </th>                                                           
                                <th>
                                    &nbsp;
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
                        {data: 'name', name: 'name','searchable' : false},
                        {data: 'fuel_type', name: 'fuel_type','searchable' : false},
                        {data: 'tank', name: 'tank','searchable' : false},
                        {data: 'pump', name: 'pump','searchable' : false},
                        {data: 'hose', name: 'hose','searchable' : false},
                        {data: 'reading', name: 'reading'},
                        {data: 'litre', name: 'litre'},
                        {data: 'actions', name: '{{ trans('global.actions') }}','searchable' : false,}
                    ],
                   
                    pageLength: 10,
                    destroy: true
                };

            $('.datatable-reading').DataTable(dtOverrideGlobals);
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });
        }

    });
</script>
@endsection
