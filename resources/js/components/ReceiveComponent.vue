<template>
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Receiving Management</h1>
        </div>

        <!-- Content Row -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Receiving Overview</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-success" @click="addForm">
                            <i class="fa fa-box-open"></i> Create Receivable
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
                        <h5 class="modal-title">Receivables Form</h5>
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
                                    <label class="control-form-label">PO No.</label>
                                    <input v-bind:readonly="isView" v-bind:class="{ 'form-control-plaintext': isView, 'form-control': !isView }" v-model="overview.po">
                                </div>
                                <div class="form-group">
                                    <label class="control-form-label">Supplier Name</label>
                                    <input readonly v-bind:hidden="!isView" v-bind:class="{ 'form-control-plaintext': isView, 'form-control': !isView }" v-model="overview.supplier_name">
                                    <select class="supplier-select form-control"></select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-form-label">Container No.</label>
                                    <input v-bind:readonly="isView" v-bind:class="{ 'form-control-plaintext': isView, 'form-control': !isView }" v-model="overview.container_no">
                                </div>
                                <div class="form-group">
                                    <label class="control-form-label">SO No.</label>
                                    <input v-bind:readonly="isView" v-bind:class="{ 'form-control-plaintext': isView, 'form-control': !isView }" v-model="overview.so">
                                </div>
                                <div class="form-group">
                                    <label class="control-form-label">Date Of Arrival</label>
                                    <input v-bind:readonly="isView" v-bind:class="{ 'form-control-plaintext': isView, 'form-control': !isView }" type="datetime" v-model="overview.date_arrival">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-form-label">Remarks</label>
                                    <textarea v-bind:readonly="isView" v-bind:class="{ 'form-control-plaintext': isView, 'form-control': !isView }" v-model="overview.remarks" rows="5"></textarea>
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

        <div id="batchModal" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Batching Form</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-form-label">Control No.</label>
                                    <input class="form-control-plaintext" v-model="overview.control_no" readonly>
                                </div>
                                <div class="form-group">
                                    <label class="control-form-label">PO No.</label>
                                    <input class="form-control-plaintext" v-model="overview.po" readonly>
                                </div>
                                <div class="form-group">
                                    <label class="control-form-label">Supplier Name</label>
                                    <input class="form-control-plaintext" readonly v-model="overview.supplier_name">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-form-label">Container No.</label>
                                    <input class="form-control-plaintext" v-model="overview.container_no" readonly>
                                </div>
                                <div class="form-group">
                                    <label class="control-form-label">SO No.</label>
                                    <input class="form-control-plaintext" v-model="overview.so">
                                </div>
                                <div class="form-group">
                                    <label class="control-form-label">Date Of Arrival</label>
                                    <input type="datetime" class="form-control-plaintext" v-model="overview.date_arrival">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-form-label">remarks</label>
                                    <textarea class="form-control-plaintext" v-model="overview.remarks" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="col-md-1 mt-4" v-if="!isView">
                                <button class="btn btn-primary" @click="addRow"><i class="fa fa-cart-plus"></i> Add Batch</button>
                            </div>
                            <div class="col-md-11 mt-3">
                                <table class="table table-striped nowrap">
                                    <thead>
                                        <th>Batch No.</th>
                                        <th>Product</th>
                                        <th>Qty In.</th>
                                        <th v-if="!isView">Actions</th>
                                        <th v-if="isView">Checked By</th>
                                        <th v-if="isView">Approved By</th>
                                    </thead>
                                    <tbody>
                                        <tr v-for="batch in batches">
                                            <td>{{ batch.batch_no }}</td>
                                            <td>{{ batch.product_name }}</td>
                                            <td>{{ batch.qty_in }}</td>
                                            <td v-if="!isView">
                                                <button  class="btn btn-danger btn-sm" @click="deleteRow(batch)"><i class="fa fa-ban"></i></button>
                                            </td>
                                            <td v-if="isView">
                                                <button v-if="!batch.checker" class="btn btn-success btn-sm" @click="checkedBatch(batch)"><i class="fa fa-thumbs-up"></i></button>
                                                <label v-else>{{ batch.checker }}</label>
                                            </td>
                                            <td v-if="isView">
                                                <button v-if="!batch.approver" class="btn btn-success btn-sm" @click="approvedBatch(batch)"><i class="fa fa-thumbs-up"></i></button>
                                                <label v-else>{{ batch.approver }}</label>
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

        <div id="batchRowModal" class="modal fade" role="dialog">
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
                    control_no: "",
                    container_no: "",
                    delivery_advice: "",
                    id: "",
                    po: "",
                    remarks: "",
                    so: "",
                    supplier_id: "",
                    supplier_name: "",
                },
                product : {
                    id: '',
                    name: ''
                }
            }
        },
        methods: {
            bindBatches() {
                var $this = this;
                $.ajax({
                    url: '/receivable/batches',
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
                $('#batchModal').modal('hide');
                $('#batchRowModal').modal('show');
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
            approvedBatch(batch) {
                var $this = this;
                $.ajax({
                    url: '/receivable/approved',
                    method: 'POST',
                    data: batch,
                    success: function (value) {
                        $this.dt.draw(false);
                        $this.bindBatches();
                        Swal.fire(
                            'Approve!',
                            'Batch has been approved!',
                            'success'
                        )
                    }
                });
            },
            checkedBatch(batch) {
                var $this = this;
                $.ajax({
                    url: '/receivable/checked',
                    method: 'POST',
                    data: batch,
                    success: function (value) {
                        $this.dt.draw(false);
                        $this.bindBatches();
                        Swal.fire(
                            'Approve!',
                            'Batch has been checked!',
                            'success'
                        )
                    }
                });
            },
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

            $('.supplier-select').select2({
                width: '100%',
                ajax: {
                    url: '/supplier/list',
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

            $this.dt = $('#table-receivable').DataTable({
                processing: true,
                serverSide: true,
                scrollX: true,
                order: [
                    [0, 'desc']
                ],
                ajax: {
                    url: '/receivable/table',
                    method: "POST",
                },
                columns: [{
                        title: 'Actions',
                        name: 'id',
                        width: '12%',
                        data: function (value) {
                            return "<div class=\"btn-group btn-group-sm\" role=\"group\">\n" +
                                "  <button type=\"button\" class=\"btn btn-info btn-view\"><i class='fa fa-eye'></i></button>\n" +
                                "  <button type=\"button\" class=\"btn btn-purple bg-purple btn-batch\"><i class='fa fa-dolly-flatbed'></i></button>\n" +
                                "  <button type=\"button\" class=\"btn btn-warning bg-purple btn-edit\"><i class='fa fa-edit'></i></button>\n" +
                                "  <button type=\"button\" class=\"btn btn-danger btn-destroy\"><i class='fa fa-trash-alt'></i></button>\n" +
                                "</div>";
                        }
                    },
                    {
                        data: 'id',
                        name: 'receivables.id',
                        title: 'ID'
                    },
                    {
                        data: 'container_no',
                        name: 'receivables.container_no',
                        title: 'Container No.',
                        width: '13%'
                    },
                    {
                        data: 'total',
                        name: 'total',
                        title: 'Total Qty. In'
                    },
                    {
                        data: 'po',
                        name: 'receivables.po',
                        title: 'PO No.'
                    },
                    {
                        data: 'so',
                        name: 'receivables.so',
                        title: 'SO No.'
                    },
                    {
                        data: 'date_arrival',
                        name: 'receivables.date_arrival',
                        title: 'Date Arrival'
                    },
                    {
                        data: function (value) {
                            return '<span class="badge badge-pill badge-danger d-inline-block text-truncate" style="max-width: 150px;">' +
                                value.remarks + '</span>';
                        },
                        name: 'receivables.remarks',
                        title: 'Remarks'
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
                        $('#batchModal').modal('show');
                        $('.select2').attr('hidden', true);
                        $this.bindBatches();
                    });

                    $('.btn-batch').on('click', function () {
                        let tr = $(this).parent().parent().parent()
                        let hold = $this.dt.row(tr).data();
                        $this.overview = hold;
                        $this.isView = false;
                        $('#batchModal').modal('show');
                        $('.select2').attr('hidden', false);
                        $this.bindBatches();
                    });

                    $('.btn-edit').on('click', function () {
                        let tr = $(this).parent().parent().parent()
                        let hold = $this.dt.row(tr).data();
                        $this.overview = hold;
                        $this.isView = false;
                        var newOption = new Option(hold.supplier_name, hold.supplier_id, true, true);
                        $('.supplier-select').append(newOption).trigger('change');
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
