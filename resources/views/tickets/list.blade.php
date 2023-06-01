@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Ticket') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-12">
                                <input type="hidden" value="{{ Auth::user()->type }}" id="authId" >
                                <table id="ticketTbl" class="table  display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Email</th>
                                            <th class="text-center">Mobile</th>
                                            <th class="text-center">Problem Description</th>
                                            <th class="text-center">Date Time</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Action</th>
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
            var tbl = $('#ticketTbl').DataTable({
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
                    className: 'dt-center'
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
                        data: 'description',
                        name: 'description',
                        visible: true
                    },
                    {
                        data: 'datetime',
                        name: 'datetime',
                        visible: true
                    },
                    {
                        data: 'status',
                        name: 'status',
                        visible: true
                    },
                    {
                        data: 'action',
                        name: 'action',
                        visible: true
                    },
                ],
            });

            // console.log($('#authId').val())
            if ($('#authId').val() == 1) {
                tbl.columns(7).visible(false);
            }else{
                tbl.columns(7).visible(true);
            }

        });
    </script>
@endsection
