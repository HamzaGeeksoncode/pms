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
                        <div class="card-header">
                            <h4 class="card-title">Pumps</h4>
                            <a href="{{ route("pumps.create") }}" type="submit" class="btn btn-outline-primary add-btn">Add Pump</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive" id="datatable-Fuel">
                                <table class=" table table-bordered table-striped table-hover datatable datatable-Fuel">
                                    <thead>
                                        <tr>                                          
                                            <th>
                                                Name
                                            </th>
                                            <th>
                                                Tank
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
    $url = isset(request()->test_id) ? route('pumps.index') . '?test_id=1' : route('pumps.index');
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
                    {data: 'name', name: 'name'},
                    {data: 'tank', name: 'pumpTank.name'},
                    {data: 'actions', name: '{{ trans('global.actions') }}','searchable' : false,}
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



    });
</script>
@endsection
