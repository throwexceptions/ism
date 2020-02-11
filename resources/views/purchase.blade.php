@extends('admin_layout')

@section('content')
    <div id='app' class="container-fluid">

        <!-- Content Row -->
        <div class="row">

            <div class="col-lg-12 mb-4">
                <!-- Approach -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Purchase Order Overview</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{ route('purchase.create') }}" class="btn btn-sm btn-success"><i
                                            class="fa fa-plus"></i> New Purchase Order</a>
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
                                    <label class="control-label">Pick a status</label>
                                    <select class="form-control" v-model="overview.status">
                                        <option value="Ordered">Ordered</option>
                                        <option value="Received">Received</option>
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

        <div id="paymentModal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Payment Status</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Pick a status</label>
                                    <select class="form-control" v-model="overview.payment_status">
                                            <option value="">-- Select Options --</option>
                                            <option value="PAID">PAID</option>
                                            <option value="UNPAID">UNPAID</option>
                                            <option value="PAID WITH BALANCE">PAID WITH BALANCE</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" @click="updatePayment">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="vatTypeModal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Vat Type</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Pick a type</label>
                                    <select class="form-control" v-model="overview.vat_type">
                                        <option value="">-- Select Options --</option>
                                        <option value="VAT EX">VAT EX</option>
                                        <option value="VAT INC">VAT INC</option>
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
                        status: "",
                    }
                }
            },
            methods: {
                updatePayment() {
                    var $this = this;
                    $.ajax({
                        url: '{{ route('purchase.payment.status.update') }}',
                        method: 'POST',
                        data: $this.overview,
                        success: function (value) {
                            Swal.fire('Updated!', 'Payment Status has been updated.', 'success');
                            $this.dt.draw();
                            $('#paymentModal').modal('hide');
                        }
                    })
                },
                update() {
                    var $this = this;
                    $.ajax({
                        url: '{{ route('purchase.status.update') }}',
                        method: 'POST',
                        data: $this.overview,
                        success: function (value) {
                            Swal.fire('Updated!', 'Status has been updated.', 'success');
                            $this.dt.draw();
                            $('#statusModal').modal('hide');
                            $('#vatTypeModal').modal('hide');
                            $('#paymentModal').modal('hide');
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
                                url: "{{ route('purchase.destroy') }}",
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
                        url: "{{ route('purchase.table') }}",
                        method: "POST",
                    },
                    columns: [
                        {
                            data: function (value) {
                                if(value.status == 'Ordered') {
                                    edit = '<a href="/purchase/detail/' + value.id + '" class="btn btn-info btn-view"><i class="fa fa-pen"></i></a>';
                                } else {
                                    edit = '';
                                }
                                return '<div class="btn-group btn-group-sm shadow-sm" role="group" aria-label="Basic example">' +
                                    '<a href="/purchase/view/' + value.id + '" class="btn btn-primary btn-view"><i class="fa fa-eye"></i></a>' +
                                    edit +
                                    '<button type="button" class="btn btn-danger btn-destroy"><i class="fa fa-trash"></i></button>' +
                                    '</div>'
                            },
                            searchable: false,
                            bSortable: false,
                            title: 'Action'
                        },
                        {
                            data: function(value){
                                return '<div class="btn-group btn-group-sm shadow-sm" role="group" aria-label="Basic example">' +
                                    '<a href="#" class="btn btn-info btn-vat">' + value.vat_type + '</a>' +
                                    '</div>'
                            }, name: 'purchase_infos.vat_type', title: 'VAT Type'
                        },
                        {
                            data: function (value) {
                                return '<div class="btn-group btn-group-sm shadow-sm" role="group" aria-label="Basic example">' +
                                    '<a href="#" class="btn btn-info btn-payment">' + value.payment_status + '</a>' +
                                    '</div>'
                            }, name: 'payment_status', title: 'Payment Status'
                        },
                        {data: 'po_no', name: 'purchase_infos.po_no', title: 'PO NO.'},
                        {
                            data: function (value) {
                                return '<div class="btn-group btn-group-sm shadow-sm" role="group" aria-label="Basic example">' +
                                    '<a href="#" class="btn btn-info btn-status">' + value.status + '</a>' +
                                    '</div>'
                            }, name: 'status', title: 'Status'
                        },
                        {data: 'subject', title: 'Project Cost Center'},
                        {data: 'vendor_name', name: 'vendors.name', title: 'Vendor Name'},
                        {data: 'grand_total', name: 'summaries.grand_total', title: 'Total Amount'},
                        {data: 'name', name: 'users.name', title: 'Assigned To'},
                        {data: 'created_at', name: 'purchase_infos.created_at', title: 'Date Created'},
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
                        $('.btn-payment').on('click', function () {
                            $('#paymentModal').modal('show');
                        });
                        $('.btn-vat').on('click', function () {
                            $('#vatTypeModal').modal('show');
                        });
                    }
                });
            }
        });
    </script>
@endsection