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
                                <input type="hidden" value="{{ Auth::user()->type }}" id="authId">
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
    <div class="modal fade" id="replyMdl" tabindex="-1" role="dialog" aria-labelledby="replyModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="replyModalLabel">Reply Message</h5>
                    {{-- <button type="button" class="close btn btn-danger" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button> --}}
                </div>
                <div class="modal-body">
                    <div class="row mt-2">
                        <input type="hidden" id="idTicket" />
                        <input type="hidden" id="idReciever" />
                        <input type="hidden" id="authUser1" value="{{ Auth::user()->username }}" />
                        <div id="msgBody"></div>
                    </div>
                    <form id="replyFrm">
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <label for="salesText" class="form-label login-purple">Reply:</label>
                                <textarea id="msgReply" class="form-control" name="msgReply" rows="3"> </textarea>
                            </div>
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
            } else {
                tbl.columns(8).visible(true);
            }

            //reply msg list view
            $(document).on("click", ".replybtn", function(e) {
                var idTicket = $(this).val();

                $.ajax({
                    type: "GET",
                    url: "/ticket-reply/" + idTicket,
                    success: function(json) {
                        $("#idTicket").val(idTicket);
                        var msgs = "";

                        json.chat.forEach(function(value) {
                            var datetime = value.created_at;
                            var dateSplit = datetime.split("T");
                            var time = dateSplit[1].split(".000000Z");
                            // console.log(value)
                            msgs +=
                                '<div class="card">' +
                                '<div class="card-body">' +
                                '<label for="" class="card-title" style="color:blue">Name: </label>' +
                                '<label for="" class="form-label" style="margin-left: 2px; color:black">&nbsp;&nbsp;' +
                                value.reply_user.name +
                                '</label>'+
                                '</div>' +
                                '<p class="card-text" style="padding-left: 20px !important">'+
                                value.reply +
                                '</p>'+
                                '<span style="padding-left: 70% !important">' +
                                dateSplit[0] +
                                "&nbsp;|&nbsp;" +
                                time[0] +
                                "</span>" +
                                "</div><br>";
                        });

                        $("#msgBody").html(msgs);
                    },
                });
            });

        });
    </script>
@endsection
