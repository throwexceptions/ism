@extends('admin_layout')

@section('content')
    <div id='app' class="container-fluid">

        <!-- Content Row -->
        <div class="row">

            <div class="col-lg-12 mb-4">
                <!-- Approach -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Product Returns</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{ route('return.create') }}" class="btn btn-sm btn-success"><i
                                        class="fa fa-plus"></i> New Product Return</a>
                            </div>
                            <div class="col-md-12 mt-3">
                                <table id="table-inquiry" class="table table-striped nowrap" style="width:100%"></table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="statusModal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Status</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Return Type</label>
                                    <select class="form-control form-control-sm" v-model="overview.status">
                                        <option value="">-- Select Type --</option>
                                        <option value="received">Received</option>
                                        <option value="rma pull out">RMA Pull Out</option>
                                        <option value="rma returned">RMA Returned</option>
                                        <option value="released">Released</option>
                                        <option value="refund">Refund</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" @click="updateStatus">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="remarksModal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Remarks</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Remarks</label>
                                    <textarea class="form-control" v-model="overview.remarks">

                                    </textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" @click="update">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const app = new Vue({
            el: '#app',
            data() {
                return {
                    dt: null,
                    overview: {
                        id: "",
                        status: "",
                    }
                }
            },
            methods: {
                updateStatus() {
                    var $this = this;
                    $.ajax({
                        url: '{{ route('return.status.update') }}',
                        method: 'POST',
                        data: $this.overview,
                        success: function (value) {
                            Swal.fire('Updated!', 'Status has been updated.', 'success');
                            $this.dt.draw();
                            $('#statusModal').modal('hide');
                        }
                    });
                },
                update() {
                    var $this = this;
                    $.ajax({
                        url: '{{ route('return.update') }}',
                        method: 'POST',
                        data: $this.overview,
                        success: function (value) {
                            Swal.fire('Updated!', 'Remarks has been updated.', 'success');
                            $this.dt.draw();
                            $('#remarksModal').modal('hide');
                        }
                    });
                },
                destroy() {
                    var $this = this;
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.value) {
                            $.ajax({
                                url: "{{ route('return.destroy') }}",
                                method: 'POST',
                                data: $this.overview,
                                success(value) {
                                    Swal.fire('Deleted!', 'Your file has been deleted.', 'success');
                                    $this.dt.draw();
                                }
                            });
                        }
                    });
                }
            },
            mounted() {

                var $this = this;
                $this.dt = $('#table-inquiry').DataTable({
                    processing: true,
                    serverSide: true,
                    scrollX: true,
                    responsive: true,
                    order: [[1, 'desc']],
                    ajax: {
                        url: "{{ route('return.table') }}",
                        method: "POST",
                    },
                    columns: [
                        {
                            data: function (value) {
                                return '<div class="btn-group btn-group-sm shadow-sm" role="group" aria-label="Basic example">' +
                                    '<a href="/return/view/' + value.id + '" class="btn btn-primary btn-view"><i class="fa fa-eye"></i></a>' +
                                    '<button type="button" class="btn btn-danger btn-destroy"><i class="fa fa-trash"></i></button>' +
                                    '</div>'
                            },
                            searchable: false,
                            bSortable: false,
                            title: 'Action'
                        },
                        {data: 'pr_no', name: 'pr_no', title: 'PR NO.'},
                        {data: 'so_no', name: 'so_no', title: 'Reference SO NO.'},
                        {data: 'customer_name', name: 'customer_name', title: 'Customer Name'},
                        {
                            data: function (value) {
                                if (value.status == null)
                                    hold = 'NONE';
                                else
                                    hold = value.status.toUpperCase();

                                return '<div class="btn-group btn-group-sm shadow-sm btn-block" role="group">' +
                                    '<a href="#" class="btn btn-info btn-status">' + hold + '</a>' +
                                    '</div>'
                            }, name: 'status', title: 'Status'
                        },
                        {
                            data: function (value) {
                                return value.status_created_at;
                            }, name: 'return_statuses.updated_at', title: 'Date Status'
                        },
                        {
                            data: function (value) {
                                return value.created_at;
                            }, name: 'return_statuses.created_at', title: 'Date Created'
                        },
                        {data: 'return_type', name: 'return_type', title: 'Return Type'},
                        {
                            data: function (value) {
                                return '<div class="btn-group shadow-none btn-block" role="group">' +
                                    '<a href="#" class="btn p-0 btn-remarks btn-link text-truncate" ' +
                                    'style="max-width: 120px; box-shadow: 0 0 0 !important;">'
                                    + value.remarks + '</a>' +
                                    '</div>'
                            }, name: 'remarks', title: 'Remarks'
                        },
                        {data: 'username', name: 'users.name', title: 'Assigned To'},
                    ],
                    drawCallback: function () {
                        $('table .btn').on('click', function () {
                            let data = $(this).parent().parent().parent();
                            let hold = $this.dt.row(data).data();
                            $this.overview = hold;
                        });

                        $('.btn-destroy').on('click', function () {
                            $this.destroy();
                        });

                        $('.btn-status').on('click', function () {
                            $('#statusModal').modal('show');
                        });
                        $('.btn-remarks').on('click', function () {
                            $('#remarksModal').modal('show');
                        });
                    }
                });
            }
        });
    </script>
@endsection
