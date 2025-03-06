@extends('layouts.moderator')

@section('content')

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <h2 class="mb-4">Student List</h2>

        <!-- Filter Form -->
        <form method="GET" action="{{ route('moderator.index') }}" class="mb-3 row">
            <!-- HSC Group Filter -->
            <div class="col-md-3">
                <label for="hsc_group">Filter by HSC Group:</label>
                <select name="hsc_group" id="hsc_group" class="form-control" onchange="this.form.submit()">
                    <option value="">All Groups</option>
                    @foreach($hscGroups as $group)
                        @if($group)
                            <option value="{{ $group }}" {{ request('hsc_group') == $group ? 'selected' : '' }}>
                                {{ $group }}
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>

            <!-- Transaction Status Filter -->
            <div class="col-md-3">
                <label for="transaction_status">Transaction Status:</label>
                <select name="transaction_status" id="transaction_status" class="form-control"
                        onchange="this.form.submit()">
                    <option value="">All</option>
                    <option value="1" {{ request('transaction_status') === '1' ? 'selected' : '' }}>Paid</option>
                    <option value="0" {{ request('transaction_status') === '0' ? 'selected' : '' }}>Unpaid</option>
                </select>
            </div>

            <!-- Approval Status Filter -->
            <div class="col-md-3">
                <label for="approved">Approval Status:</label>
                <select name="approved" id="approved" class="form-control" onchange="this.form.submit()">
                    <option value="">All</option>
                    <option value="1" {{ request('approved') === '1' ? 'selected' : '' }}>Approved</option>
                    <option value="0" {{ request('approved') === '0' ? 'selected' : '' }}>Not Approved</option>
                </select>
            </div>
        </form>

        <!-- Data Table -->
        <table class="table table-bordered">
            <thead class="bg-info text-white">
            <tr>
                <th>Name</th>
                <th>Father Name</th>
                <th>SSC <br>Board Name</th>
                <th>SSC <br> Group</th>
                <th>SSC <br> Roll</th>
                <th>HSC Group</th>
                <th>Mobile</th>
                <th>Transaction Status</th>
                <th>Approval Status</th>
            </tr>
            </thead>
            <tbody>
            @forelse($data as $student)
                <tr>
                    <td>{{ $student['name'] }}</td>
                    <td>{{ $student['father_name'] }}</td>
                    <td>{{ $student['board_name'] }}</td>
                    <td>{{ $student['ssc_group'] }}</td>
                    <td>{{ $student['roll'] }}</td>
                    <td>{{ $student['hsc_group'] }}</td>
                    <td>{{ $student['mobile'] }}</td>
                    <td>
                        @if($student['transaction_status'] == 1)
                            <span class="badge badge-success">Paid</span>
                        @else
                            <span class="badge badge-danger">Unpaid</span>
                            <button class="btn btn-success pay-btn"
                                    data-user="{{ json_encode($student['transaction']) }}"
                                    data-name="{{ $student['name'] }}"
                                    data-amount="{{ optional($student['transaction'])->transaction_amount }}"
                                    data-id="{{ optional($student['transaction'])->id }}"
                                    data-transaction_number="{{ optional($student['transaction'])->transaction_number }}"
                                    data-status="{{ optional($student['transaction'])->transaction_status }}"
                                    data-toggle="modal" data-target="#payModal">
                                Pay
                            </button>
                        @endif

                    </td>
                    <td>
                        @if($student['approved'] == 1)
                            <span class="badge badge-primary">Approved</span>
                        @else
                            <span class="badge badge-warning">Not Approved</span>
                        @endif
                        <a href="{{route('students.view-student',$student['user_id'])}}" target="_blank">
                            <button class="btn btn-warning">View</button>
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">No data available</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <div class="modal fade" id="payModal" tabindex="-1" role="dialog" aria-labelledby="payModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="payModalLabel">Process Payment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="paymentForm" action="{{ route('payment.process') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="transaction_id" id="transaction_id">
                        <input type="hidden" name="user_id" id="user_id">

                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" id="user_name" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label>Amount</label>
                            <input type="number" name="transaction_amount" id="transaction_amount" class="form-control"
                                   required readonly>
                        </div>
                        <div class="form-group">
                            <label>Transaction Number</label>
                            <input type="text" name="transaction_number" id="transaction_number" class="form-control"
                                   required readonly>
                        </div>
                        <div class="form-group">
                            <label>Bank Name</label>
                            <select class="form-control" id="bank_name" name="bank_name" required>
                                <option value="sonali_bank">Sonali Bank</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Transaction Date</label>
                            <input type="date" name="transaction_date" id="transaction_date" class="form-control"
                                   required>
                        </div>
                        <input type="hidden" name="transaction_status" value="1"> <!-- Mark as Paid -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Confirm Payment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $(".pay-btn").on("click", function () {
                var user = $(this).data("user");
                var name = $(this).data("name");
                var amount = $(this).data("amount");
                var transactionId = $(this).data("id");
                var transaction_number = $(this).data("transaction_number");

                $("#user_name").val(name);
                $("#transaction_amount").val(amount || '');
                $("#transaction_id").val(transactionId);
                $("#transaction_number").val(transaction_number);
            });
        });
    </script>



@endsection
