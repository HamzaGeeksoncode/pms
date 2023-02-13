@extends('admin.layouts.main')
@section('content')
@can('fuel_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-8">
            <a class="btn btn-success" href="{{ route("expense.create") }}">
                Expense
            </a>
        </div>
    </div>
@endcan
    <div class="content-body">
        <div class="container-fluid">
            <!-- row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body d-flex">
                         <div class="row invoice-card-row">
                                                     
                        </div>
                        </div>                        
                        <div class="card-header">
                            <h4 class="card-title">Expense</h4>
                            <a href="{{ route("expense.create") }}" type="submit" class="btn btn-outline-primary add-btn">Add Expense</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive" id="datatable-Fuel">
                                <table class=" table table-bordered table-striped table-hover datatable datatable-Fuel">
                                    <thead>
                                        <tr>
                                            <th width="10">

                                            </th>
                                            <th>
                                                Expense Amount
                                            </th>
                                            <th>
                                                Expense Type
                                            </th>                                      
                                            <th>
                                                &nbsp;
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                1
                                            </td>
                                            <td>
                                                355
                                            </td>
                                            <td>
                                                Electricity
                                            </td>  
                                            <td>
                                                <div class="d-flex">
                                                    <a href="#" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
                                                    <a href="#" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                                                </div>                                                
                                            </td>                                                                  
                                        </tr>
                                        <tr>
                                            <td>
                                                2
                                            </td>
                                            <td>
                                                500
                                            </td>
                                            <td>
                                                Other
                                            </td>    
                                            <td>
                                                <div class="d-flex">
                                                    <a href="#" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
                                                    <a href="#" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                                                </div>                                                
                                            </td>                                                                                                               
                                        </tr>                                                                                                                                                                                                       
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
    $url = isset(request()->test_id) ? route('expense.index') . '?test_id=1' : route('expense.index');
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
                url: "{{ route('expense.massDestroy') }}",
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
                    {data: 'price', name: 'price'},
                    {data: 'type', name: 'types.name'},
                    {data: 'price_change_date', name: 'price_change_date'},
                    {data: 'actions', name: '{{ trans('global.actions') }}'}
                ],
                order: [[ 2, 'asc' ]],
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
                                <th width="10">

                                </th>
                                <th>
                                    {{ trans('cruds.clients.price') }}
                                </th>
                                <th>
                                    {{ trans('cruds.clients.type') }}
                                </th>
                                <th>
                                    {{ trans('cruds.clients.price_change_date') }}
                                </th>
                                <th>
                                    &nbsp;
                                </th>
                            </thead>
                        </table>
                    `);

            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            @can('fuel_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
                let deleteButton = {
                    text: deleteButtonTrans,
                    url: "{{ route('expense.massDestroy') }}",
                    className: 'btn-danger',
                    action: function (e, dt, node, config) {
                        var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
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
                                data: { ids: ids, _method: 'DELETE' }})
                                .done(function () { location.reload() })
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
                    ajax: {
                        "url": url,
                        "data": {
                            "siteId": $(this).val()
                        }
                    },
                    columns: [
                        {data: 'price', name: 'price'},
                        {data: 'type', name: 'types.name'},
                        {data: 'price_change_date', name: 'price_change_date'},
                        {data: 'actions', name: '{{ trans('global.actions') }}'}
                    ],
                    order: [[ 2, 'asc' ]],
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
