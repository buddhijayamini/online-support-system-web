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
                                            <th class="text-center">Reference No</th>
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

    <!-- Modal -->
    <div class="modal fade" id="replyMdl" tabindex="-1" role="dialog" aria-labelledby="replyModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="replyModalLabel">Reply Message</h5>
              {{-- <button type="button" class="close btn btn-danger" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button> --}}
            </div>
            <div class="modal-body">
              <form id="replyFrm">
                <div class="form-group">
                  <label for="receiver" class="col-form-label">Receiver:</label>
                  <input type="text" class="form-control" id="receiver">
                </div>
                <div class="form-group">
                  <label for="messageRply" class="col-form-label">Message:</label>
                  <textarea class="form-control" id="messageRply"></textarea>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
              <button type="button" id="rplyMsg" class="btn btn-primary">Send message</button>
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
                        data: 'ref_no',
                        name: 'ref_no',
                        visible: true
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
                tbl.columns(8).visible(false);
            }else{
                tbl.columns(8).visible(true);
            }

        });
    </script>
@endsection
