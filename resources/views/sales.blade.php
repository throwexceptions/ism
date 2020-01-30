@extends('admin_layout')

@section('content')
    <div id='app' class="container-fluid">

        <!-- Content Row -->
        <div class="row">

            <div class="col-lg-12 mb-4">
                <!-- Approach -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Sales Overview</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{ route('sales.create') }}" class="btn btn-sm btn-success"><i
                                            class="fa fa-plus"></i> New Sales Order</a>
                            </div>
                            <div class="col-md-12 mt-3">
                                <table id="table-sales" class="table table-striped nowrap" style="width:100%"></table>
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
                                    <label class="control-label">Pick a status</label>
                                    <select class="form-control" v-model="overview.status">
                                        <option value="Shipped">Shipped</option>
                                        <option value="Returned">Returned</option>
                                    </select>
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
                        status: ""
                    }
                }
            },
            methods: {
                update() {
                    var $this = this;
                    $.ajax({
                        url: '{{ route('sales.status.update') }}',
                        method: 'POST',
                        data: $this.overview,
                        success: function (value) {
                            Swal.fire('Updated!', 'Status has been updated.', 'success');
                            $this.dt.draw();
                            $('#statusModal').modal('hide');
                        }
                    })
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
                                url: "{{ route('sales.destroy') }}",
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
                $this.dt = $('#table-sales').DataTable({
                    processing: true,
                    serverSide: true,
                    scrollX: true,
                    responsive: true,
                    order: [[1, 'desc']],
                    ajax: {
                        url: "{{ route('sales.table') }}",
                        method: "POST",
                    },
                    columns: [
                        {
                            data: function (value) {
                                if (value.status == "Quote") {
                                    edit = '<a href="/sales/detail/' + value.id + '" class="btn btn-info btn-view"><i class="fa fa-pen"></i></a>';
                                } else {
                                    edit = '';
                                }
                                return '<div class="btn-group btn-group-sm shadow-sm" role="group" aria-label="Basic example">' +
                                    '<a href="/sales/view/' + value.id + '" class="btn btn-primary btn-view"><i class="fa fa-eye"></i></a>' +
                                    edit +
                                    '<button type="button" class="btn btn-danger btn-destroy"><i class="fa fa-trash"></i></button>' +
                                    '</div>'
                            },
                            searchable: false,
                            bSortable: false,
                            title: 'Action'
                        },
                        {data: 'so_no', name: 'sales_orders.so_no', title: 'SO NO.'},
                        {
                            data: function (value) {
                                return '<div class="btn-group btn-group-sm shadow-sm" role="group" aria-label="Basic example">' +
                                    '<a href="#" class="btn btn-info btn-status">' + value.status + '</a>' +
                                    '</div>'
                            }, name: 'status', title: 'Status'
                        },
                        {data: 'customer_name', name: 'customers.name', title: 'Customer'},
                        {data: 'subject', name: 'subject', title: 'Subject'},
                        {data: 'sub_total', name: 'sub_total', title: 'Total Amount'},
                        {data: 'username', name: 'users.name', title: 'Assigned To'},
                    ],
                    drawCallback: function () {
                        $('table .btn').on('click', function () {
                            let data = $(this).parent().parent().parent();
                            let hold = $this.dt.row(data).data();
                            $this.overview = hold;
                            console.log(hold);
                        });
                        $('.btn-destroy').on('click', function () {
                            $this.destroy();
                        });
                        $('.btn-status').on('click', function () {
                            $('#statusModal').modal('show');
                        });
                    }
                });
            }
        });
    </script>
@endsection