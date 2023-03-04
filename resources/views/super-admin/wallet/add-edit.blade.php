@extends('layouts.app')
@section('title', 'Add Wallet Money')
@section('content')
    <div class="main-content-wrap d-flex flex-column sidenav-open">
        <div class="breadcrumb">
            <h1>Add Wallet Money</h1>

        </div>
        <div class="separator-breadcrumb border-top"></div>

        <div class="row mb-4">
            <div class="col-md-12 mb-4">
                <div class="card text-left">
                    <div class="card-body p-4">
                        <form method="post" id="form" action="javascript:void(0)" enctype="multipart/form-data">
                            @csrf
                            @if (!empty($wallet))
                                <input name="id" type="hidden" value="{{ @$wallet->id }}">
                            @endif
                            {{-- @dd($wallet->user_id) --}}
                            <div class="row">
                                <div class="col-lg-6">
                                    <div>
                                        <div class="mb-3">
                                            <label for="example-state-input" class="form-label">Company Admin Name</label>
                                            <select class="form-control" name="user_id" id="user_id">
                                                {{-- <option>Select Admin</option> --}}
                                                @if (!empty($wallet->user_id)){
                                                    <option value="{{ $wallet->user_id }}">
                                                        {{ $wallet->UserInfo->first_name ? $wallet->UserInfo->first_name : '' }}
                                                    </option>
                                                }@else{
                                                    <option>Select Admin</option>
                                                    @foreach ($user as $row)
                                                        <option value="{{ $row->id }}">{{ $row->first_name }}</option>
                                                    @endforeach
                                                    }
                                                @endif

                                            </select>
                                            <span id="user-id-error" class="error text-danger"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mt-3 mt-lg-0">
                                        <div class="mb-3">
                                            <label for="example-amount-input" class="form-label">Wallet Amount</label>
                                            <input class="form-control" name="amount" type="number" id="amount"
                                                value="{{ @$wallet->amount }}" placeholder="Enter wallet Amount">
                                            <span id="amount-error" class="error text-danger"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-center mt-5">
                                <div class="col-sm-2">
                                    <div>
                                        <a href="{{ url('super-admin/wallet') }}" class="btn btn-primary w-md">Cancel</a>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div>
                                        <button type="submit" id="btnSubmit" class="btn btn-success w-md">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#form').on('submit', function(e) {
            $('.error').text('');
            e.preventDefault()
            showButtonLoader('btnSubmit', 'Submit', 'disable');
            let formValue = new FormData(this);
            $.ajax({
                type: "post",
                url: "{{ url('super-admin/save-wallet') }}",
                data: formValue,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log('response', response);
                    if (response.success) {
                        message('success', response.message);
                        setTimeout(function() {
                            window.location.href = "{{ url('super-admin/wallet') }}";
                        }, 2000);
                    } else {
                        message('error', response.message);
                    }
                    showButtonLoader('btnSubmit', 'Submit', 'enable');
                },
                error: function(response) {
                    let error = response.responseJSON;
                    if (!error) {
                        error = JSON.parse(response.responseText);
                    }
                    if (error.errors.user_id) {
                        $('#user-id-error').text(error.errors.user_id[0])
                    }
                    if (error.errors.amount) {
                        $('#amount-error').text(error.errors.amount[0])
                    }
                    if (error.errors.phone) {
                        $('#phone-error').text(error.errors.phone[0])
                    }
                    if (error.errors.email) {
                        $('#email-error').text(error.errors.email[0])
                    }

                    showButtonLoader('btnSubmit', 'Submit', 'enable');
                },
            });
        })
    </script>


@endsection
