<template>
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Shipments Management</h1>
        </div>

        <!-- Content Row -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Shipments Overview</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-success" @click="addForm">
                            <i class="fa fa-shipping-fast"></i> Create Shipment
                        </button>
                    </div>
                    <div class="col-md-12 mt-3">
                        <table id="table-receivable" class="table table-striped nowrap" style="width:100%" cellspacing="0">
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div id="formModal" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Shipment Form</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-form-label">Control No.</label>
                                    <input v-bind:readonly="isView" v-bind:class="{ 'form-control-plaintext': isView, 'form-control': !isView }" v-model="overview.control_no">
                                </div>
                                <div class="form-group">
                                    <label class="control-form-label">DR No.</label>
                                    <input v-bind:readonly="isView" v-bind:class="{ 'form-control-plaintext': isView, 'form-control': !isView }" v-model="overview.dr_no">
                                </div>
                                <div class="form-group">
                                    <label class="control-form-label">Sales Representative</label>
                                    <input v-bind:readonly="isView" v-bind:class="{ 'form-control-plaintext': isView, 'form-control': !isView }" v-model="overview.sales_rep">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-form-label">Customer Name</label>
                                    <input readonly v-bind:hidden="!isView" v-bind:class="{ 'form-control-plaintext': isView, 'form-control': !isView }" v-model="overview.customer_id">
                                    <select class="customer-select form-control"></select>
                                </div>
                                <div class="form-group">
                                    <label class="control-form-label">Delivery Date</label>
                                    <input type="date" v-bind:readonly="isView" v-bind:class="{ 'form-control-plaintext': isView, 'form-control': !isView }" v-model="overview.delivery_date">
                                </div>
                                <div class="form-group">
                                    <label class="control-form-label">TIN</label>
                                    <input v-bind:readonly="isView" v-bind:class="{ 'form-control-plaintext': isView, 'form-control': !isView }" v-model="overview.tin">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-form-label">Address</label>
                                    <textarea v-bind:readonly="isView" v-bind:class="{ 'form-control-plaintext': isView, 'form-control': !isView }" v-model="overview.address" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="cartModal" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Cart Form</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-form-label">Control No.</label>
                                    <input v-bind:readonly="isView" v-bind:class="{ 'form-control-plaintext': isView, 'form-control': !isView }" v-model="overview.control_no">
                                </div>
                                <div class="form-group">
                                    <label class="control-form-label">DR No.</label>
                                    <input v-bind:readonly="isView" v-bind:class="{ 'form-control-plaintext': isView, 'form-control': !isView }" v-model="overview.dr_no">
                                </div>
                                <div class="form-group">
                                    <label class="control-form-label">Sales Representative</label>
                                    <input v-bind:readonly="isView" v-bind:class="{ 'form-control-plaintext': isView, 'form-control': !isView }" v-model="overview.sales_rep">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-form-label">Customer Name</label>
                                    <input readonly v-bind:hidden="!isView" v-bind:class="{ 'form-control-plaintext': isView, 'form-control': !isView }" v-model="overview.customer_name">
                                    <select class="customer-select form-control select2"></select>
                                </div>
                                <div class="form-group">
                                    <label class="control-form-label">Delivery Date</label>
                                    <input type="date" v-bind:readonly="isView" v-bind:class="{ 'form-control-plaintext': isView, 'form-control': !isView }" v-model="overview.delivery_date">
                                </div>
                                <div class="form-group">
                                    <label class="control-form-label">TIN</label>
                                    <input v-bind:readonly="isView" v-bind:class="{ 'form-control-plaintext': isView, 'form-control': !isView }" v-model="overview.tin">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-form-label">Address</label>
                                    <textarea v-bind:readonly="isView" v-bind:class="{ 'form-control-plaintext': isView, 'form-control': !isView }" v-model="overview.address" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="col-md-1 mt-4" v-if="!isView">
                                <button class="btn btn-primary" @click="addRow"><i class="fa fa-cart-plus"></i> Add Item</button>
                            </div>
                            <div class="col-md-11 mt-3">
                                <table class="table table-striped nowrap">
                                    <thead>
                                        <th>ID</th>
                                        <th>Product</th>
                                        <th>Qty In.</th>
                                        <th v-if="!isView">Actions</th>
                                        <th v-if="isView">Checked By</th>
                                        <th v-if="isView">Guarded By</th>
                                        <th v-if="isView">Delivered</th>
                                    </thead>
                                    <tbody>
                                        <tr v-for="batch in batches">
                                            <td>{{ batch.id }}</td>
                                            <td>{{ batch.product_name }}</td>
                                            <td>{{ batch.qty_out }}</td>
                                            <td v-if="!isView">
                                                <button  class="btn btn-danger btn-sm" @click="deleteRow(batch)"><i class="fa fa-ban"></i></button>
                                            </td>
                                            <td v-if="isView">
                                                <button v-if="!batch.checker" class="btn btn-success btn-sm" @click="checked(batch)"><i class="fa fa-thumbs-up"></i></button>
                                                <label v-else>{{ batch.checker }}</label>
                                            </td>
                                            <td v-if="isView">
                                                <button v-if="!batch.approver" class="btn btn-success btn-sm" @click="guarded(batch)"><i class="fa fa-thumbs-up"></i></button>
                                                <label v-else>{{ batch.guard_by }}</label>
                                            </td>
                                            <td v-if="isView">
                                                <button v-if="!batch.approver" class="btn btn-success btn-sm" @click="delivered(batch)"><i class="fa fa-thumbs-up"></i></button>
                                                <button v-if="!batch.approver" class="btn btn-danger btn-sm" @click="notDelivered(batch)"><i class="fa fa-thumbs-down"></i></button>
                                                <label v-else>{{ batch.guard_by }}</label>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button v-if="!isView" type="button" class="btn btn-primary">Save Batch</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="cartRowModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Batching Form</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-form-label">Batch No.</label>
                                    <input class="form-control" v-model="batch_row.batch_no">
                                </div>
                                <div class="form-group">
                                    <label class="control-form-label">Product</label>
                                    <select class="product-select form-control"></select>
                                </div>
                                <div class="form-group">
                                    <label class="control-form-label">Qty In.</label>
                                    <input class="form-control" v-model="batch_row.qty_in">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" @click="addToRow">Add To Row</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                isView: false,
                batch_row: {
                    batch_no: '',
                    product_id: '',
                    product_name: '',
                    qty_in: '',
                },
                batches : [
                ],
                overview: {
                    customer_id:"",
                    customer_name:"",
                    delivery_date:"",
                    dr_no:"",
                    id:"",
                    sales_rep:"",
                    total:"",
                },
                product : {
                    id: '',
                    name: ''
                }
            }
        },
        methods: {
            destroyDialog() {
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
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }
                });
            },
            bindBatches() {
                var $this = this;
                $.ajax({
                    url: '/shipment/items',
                    method: 'POST',
                    data: $this.overview,
                    success: function (value) {
                        $this.dt.draw(false);
                        $this.batches = value;
                    }
                });
            },
            addRow() {
                $('.product-select').val('').trigger('change');
                $('#cartModal').modal('hide');
                $('#cartRowModal').modal('show');
                this.batch_row = {
                    batch_no: '',
                    product_id: '',
                    product_name: '',
                    qty_in: '',
                };
            },
            deleteRow(batch) {
                this.batches.splice(this.batches.indexOf(batch), 1);
            },
            addToRow() {
                this.batch_row.product_name = this.product.name;
                this.batch_row.product_id = this.product.id;
                $('#batchModal').modal('show');
                $('#batchRowModal').modal('hide');
                this.batches.push(this.batch_row);
            },
            addForm() {
                $('#formModal').modal('show');
                this.overview = {
                    control_no: "",
                    container_no: "",
                    delivery_advice: "",
                    id: "",
                    po: "",
                    remarks: "",
                    so: "",
                    supplier_id: "",
                    supplier_name: "",
                }
                $('.supplier-select').val('').trigger('change');
            },
            guarded(item) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, I\'ve guarded this',
                }).then((result) => {
                    if (result.value) {
                        Swal.fire(
                            'Delivered!',
                            'Item was received.',
                            'success'
                        )
                    }
                });
            },
            checked(item) {
                var $this = this;
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, I\'ve checked this',
                }).then((result) => {
                    if (result.value) {
                        Swal.fire(
                            'Delivered!',
                            'Item was received.',
                            'success'
                        )
                    }
                });
                // $.ajax({
                //     url: '/shipment/checked',
                //     method: 'POST',
                //     data: item,
                //     success: function (value) {
                //         $this.dt.draw(false);
                //         $this.bindBatches();
                //         Swal.fire(
                //             'Approve!',
                //             'Batch has been checked!',
                //             'success'
                //         )
                //     }
                // });
            },
            delivered(item) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, confirm delivered it!',
                }).then((result) => {
                    if (result.value) {
                        Swal.fire(
                            'Delivered!',
                            'Item was received.',
                            'success'
                        )
                    }
                });
            },
            notDelivered(batch) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, return it!',
                }).then((result) => {
                    if (result.value) {
                        Swal.fire(
                            'Not Delivered!',
                            'Item was returned.',
                            'success'
                        )
                    }
                });
            }
        },
        mounted() {
            var $this = this;

            $('.product-select').select2({
                width: '100%',
                ajax: {
                    url: '/product/list',
                    method: 'POST',
                    dataType: 'json',
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (value) {
                                return {
                                    id: value.id,
                                    text: value.name
                                };
                            })
                        };
                    }
                },
            });

            $('.product-select').on('select2:select', function (e) {
                var data = e.params.data;
                $this.product.name = data.text;
                $this.product.id = data.id;
            });

            $('.customer-select').select2({
                width: '100%',
                ajax: {
                    url: '/customer/list',
                    method: 'POST',
                    dataType: 'json',
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (value) {
                                return {
                                    id: value.id,
                                    text: value.name
                                };
                            })
                        };
                    }
                },
            });

            $('.customer-select').on('select2:select', function (e) {
                var data = e.params.data;
                $this.product.name = data.text;
                $this.product.id = data.id;
            });

            $this.dt = $('#table-receivable').DataTable({
                processing: true,
                serverSide: true,
                scrollX: true,
                order: [
                    [0, 'desc']
                ],
                ajax: {
                    url: '/shipment/table',
                    method: "POST",
                },
                columns: [{
                        title: 'Actions',
                        name: 'id',
                        width: '12%',
                        data: function (value) {
                            return "<div class=\"btn-group btn-group-sm\" role=\"group\">\n" +
                                "  <button type=\"button\" class=\"btn btn-info btn-view\"><i class='fa fa-eye'></i></button>\n" +
                                "  <button type=\"button\" class=\"btn btn-purple bg-purple btn-cart\"><i class='fa fa-truck-loading'></i></button>\n" +
                                "  <button type=\"button\" class=\"btn btn-warning bg-purple btn-edit\"><i class='fa fa-edit'></i></button>\n" +
                                "  <button type=\"button\" class=\"btn btn-danger btn-destroy\"><i class='fa fa-trash-alt'></i></button>\n" +
                                "</div>";
                        }
                    },
                    {
                        data: 'id',
                        name: 'id',
                        title: 'ID'
                    },
                    {
                        data: 'dr_no',
                        name: 'dr_no',
                        title: 'DR No.'
                    },
                    {
                        data: 'total',
                        name: 'qty.total',
                        title: 'Total Qty Out',
                        width: '13%'
                    },
                    {
                        data: 'sales_rep',
                        name: 'sales_rep',
                        title: 'Sales Representative',
                        width: '13%'
                    },
                    {
                        data: 'customer_name',
                        name: 'customers.name',
                        title: 'Customer Name.'
                    },
                ],
                drawCallback: function () {
                    $('.btn-checked').on('click', function () {
                        let tr = $(this).parent().parent();
                        let hold = $this.dt.row(tr).data();
                        $this.overview = hold;
                        Swal.fire({
                            title: 'Are you sure?',
                            text: 'Batch No. ' + hold.batch_no + ' will be checked.',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, checked it!'
                        }).then((result) => {
                            if (result.value) {
                                $this.checkedBatch();
                            }
                        });
                    });

                    $('.btn-approved').on('click', function () {
                        let tr = $(this).parent().parent();
                        let hold = $this.dt.row(tr).data();
                        $this.overview = hold;
                        Swal.fire({
                            title: 'Are you sure?',
                            text: 'Batch No. ' + hold.batch_no + ' will be approved.',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, approve it!'
                        }).then((result) => {
                            if (result.value) {
                                $this.approvedBatch();
                            }
                        });
                    });

                    $('.btn-view').on('click', function () {
                        let tr = $(this).parent().parent().parent()
                        let hold = $this.dt.row(tr).data();
                        $this.overview = hold;
                        $this.isView = true;
                        var newOption = new Option(hold.supplier_name, hold.supplier_id, true, true);
                        $('.supplier-select').append(newOption).trigger('change');
                        $('#cartModal').modal('show');
                        $('.select2').attr('hidden', true);
                        $this.bindBatches();
                    });

                    $('.btn-cart').on('click', function () {
                        let tr = $(this).parent().parent().parent()
                        let hold = $this.dt.row(tr).data();
                        $this.overview = hold;
                        $this.isView = false;
                        $('#cartModal').modal('show');
                        $('.select2').attr('hidden', true);
                        console.log(hold)
                        $this.bindBatches();
                    });

                    $('.btn-edit').on('click', function () {
                        let tr = $(this).parent().parent().parent()
                        let hold = $this.dt.row(tr).data();
                        $this.overview = hold;
                        $this.isView = false;
                        var newOption = new Option(hold.customer_name, hold.customer_id, true, true);
                        $('.customer-select').append(newOption).trigger('change');
                        $('#formModal').modal('show');
                        $('.select2').attr('hidden', false);
                    });

                    $('.btn-destroy').on('click', function () {
                        let tr = $(this).parent().parent().parent()
                        let hold = $this.dt.row(tr).data();
                        $this.overview = hold;
                        $this.destroyDialog();
                    });
                }
            });
            console.log('Component mounted.')
        }
    }

</script>
