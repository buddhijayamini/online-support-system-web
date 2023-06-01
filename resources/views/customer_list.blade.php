@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Customer') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-12">
                                <table id="customerTbl" class="table  display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Email</th>
                                            <th class="text-center">Mobile</th>
                                            <th class="text-center">Address</th>
                                            <th class="text-center">Status</th>
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

    <script type="text/javascript">
            $(document).ready(function() {
                $('#customerTbl').DataTable({
                    processing: true,
                    serverSide: true,
                    stateSave: true,
                    bDestroy: true,
                    scrollX: true,
                    ajax: {
                        url: location.url
                    },
                    columnDefs: [{
                        targets: "_all",
                        createdCell: function(td, cellData, rowData, row, col) {
                            $(td).css('text-align', 'center')
                        }
                    }],
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'id',
                            searchable: false
                        },
                        {
                            data: 'name',
                            name: 'name',
                            visible: true
                        },
                        {
                            data: 'email',
                            name: 'email',
                            visible: true
                        },
                        {
                            data: 'mobile',
                            name: 'mobile',
                            visible: true
                        },
                        {
                            data: 'address',
                            name: 'address',
                            visible: true
                        },
                        {
                            data: 'status',
                            name: 'status',
                            visible: true
                        },
                    ],
                });
            });
        </script>

@endsection

