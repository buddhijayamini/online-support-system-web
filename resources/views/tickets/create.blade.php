@extends('layouts.app')

@section('content')
    <style>
        .swal-wide {
            width: 50px !important;
            height: 20px !important;
        }
    </style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Create Ticket') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-12">
                                <form id="addFrm" method="" action="">

                                    <div class="row mb-3">
                                        <label for="name"
                                            class="col-md-4 col-form-label text-md-end">{{ __('Customer Name') }}</label>

                                        <div class="col-md-6">
                                            <input id="name" type="text"
                                                class="form-control @error('name') is-invalid @enderror" name="name"
                                                value="{{ Auth::user()->name }}" readonly required autocomplete="name"
                                                autofocus>

                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="description"
                                            class="col-md-4 col-form-label text-md-end">{{ __('Problem Description') }}</label>

                                        <div class="col-md-6">
                                            <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description"
                                                rows="4" cols="50" required="required">{{ old('description') }}</textarea>

                                            @error('description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="email"
                                            class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>

                                        <div class="col-md-6">
                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ Auth::user()->email }}" required autocomplete="email">

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="mobile"
                                            class="col-md-4 col-form-label text-md-end">{{ __('Phone Number') }}</label>

                                        <div class="col-md-6">
                                            <input id="mobile" type="tel" class="form-control" name="mobile"
                                                required value="{{ Auth::user()->mobile }}">
                                        </div>
                                    </div>

                                    <div class="row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary" id="saveBtn">
                                                {{ __('Add') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {

            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");

            // save btn
            $("#saveBtn").click(function(e) {
                e.preventDefault();

                // $.LoadingOverlay("show");

                var description = $("#description").val();

                $.ajax({
                    type: "POST",
                    url: "/ticket-save",
                    data: {
                        _token: CSRF_TOKEN,
                        description: description,
                    },
                    success: function(json) {
                        // $.LoadingOverlay("hide");
                        if (json.status == 500) {
                            Swal.fire("Error", json.message, "error");
                            $("#addFrm").trigger("reset");
                        } else if (json.status == 200) {
                            Swal.fire("Succuss", json.message, "success");
                            $("#addFrm").trigger("reset");
                        }
                    },
                    error: function(xhr) {
                        // $.LoadingOverlay("hide");
                        Swal.fire(
                            "Error",
                            JSON.parse(xhr.responseText).message,
                            "error"
                        );
                        $("#addFrm").trigger("reset");
                    },
                });

            });

        });
    </script>
@endsection
