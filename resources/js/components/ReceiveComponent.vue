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
                            <i class="fa fa-box-open"></i> New Receivables
                        </button>
                    </div>
                    <div class="col-md-12 mt-3">
                        <div class="table-responsive">
                            <table id="table-batch" class="table table-hover"  style="width:100%"
                                   cellspacing="0"></table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="formModal" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Receivables Form</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-form-label">Name</label>
                                    <input class="form-control" v-model="overview.name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-form-label">Batch No.</label>
                                    <input class="form-control" v-model="overview.batch_no">
                                </div>
                                <div class="form-group">
                                    <label class="control-form-label">Container No.</label>
                                    <input class="form-control" v-model="overview.container_no">
                                </div>
                                <div class="form-group">
                                    <label class="control-form-label">Customer</label>
                                    <select class="customer-select form-control"></select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-form-label">Quantity In</label>
                                    <input class="form-control" v-model="overview.qty_in">
                                </div>
                                <div class="form-group">
                                    <label class="control-form-label">Date Of Arrival</label>
                                    <input type="datetime" class="form-control" v-model="overview.date_arrival">
                                </div>
                                <div class="form-group">
                                    <label class="control-form-label">Product</label>
                                    <select class="product-select form-control"></select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-form-label">remarks</label>
                                    <textarea class="form-control" v-model="overview.remarks" rows="5"></textarea>
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
    </div>
</template>

<script>
    export default {
        data() {
            return {
                overview: {
                    id: "",
                    name: "",
                    batch_no: "",
                    container_no: "",
                    customer_id: "",
                    qty_in: "",
                    date_arrival: "",
                    overall: "",
                    product_id: "",
                    remarks: "",
                    updated_at: "",
                    created_at: "",
                    customer_name: "",
                }
            }
        },
        methods:{
            addForm() {
                $('#formModal').modal('show');
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
                            results: $.map(data, function(value) {
                                return {id: value.id, text: value.name};
                            })
                        };
                    }
                },
            });

            $('.customer-select').select2({
                width: '100%',
                ajax: {
                    url: '/customer/list',
                    method: 'POST',
                    dataType: 'json',
                    processResults: function (data) {
                        return {
                            results: $.map(data, function(value) {
                                return {id: value.id, text: value.name};
                            })
                        };
                    }
                },
            });

            $this.dt = $('#table-batch').DataTable({
                processing: true,
                serverSide: true,
                scrollX: true,
                responsive: true,
                order: [[0, 'desc']],
                ajax: {
                    url: '/receive/table',
                    method: "POST",
                },
                columns: [
                    {data: 'id', title: 'ID'},
                    {data: 'batch_no', title: 'Batch No.', width: '10%'},
                    {data: 'container_no', title: 'Container No.', width: '13%'},
                    {data: 'name', title: 'Product Name'},
                    {data: 'overall', title: 'Remaining Overall', width: '18%'},
                    {data: 'qty_in', title: 'Qty. In'},
                    {data: 'date_arrival', title: 'Date Arrival'},
                    {
                        data: function (value) {
                            return '<span class="badge badge-pill badge-danger d-inline-block text-truncate" style="max-width: 150px;">' + value.remarks + '</span>';
                        }, name:'remarks', title: 'Remarks'
                    },
                ],
                drawCallback: function () {
                    $('#table-batch tbody').on('click', 'tr', function () {
                        let hold = $this.dt.row(this).data();
                        $this.overview = hold;
                        $('#formModal').modal('show');
                        $('input[type=file]').val('');
                        console.log(hold);
                        var newOption = new Option(hold.name, hold.product_id, true, true);
                        $('.product-select').append(newOption).trigger('change');
                        var newOption = new Option(hold.customer_name, hold.customer_id, true, true);
                        $('.customer-select').append(newOption).trigger('change');
                    });
                }
            });
            console.log('Component mounted.')
        }
    }
</script>