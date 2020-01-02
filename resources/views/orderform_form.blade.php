@extends('admin_layout')

@section('content')
    <div id='app' class="container-fluid">

        <!-- Content Row -->
        <div class="row">

            <div class="col-lg-12 mb-4">
                <!-- Approach -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Order Form</h6>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-center mb-3">
                            <div class="col-md-auto">
                                <h1>Warehouse Order Form</h1>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Customer</label>
                                    <select class="form-control form-control-sm select2-customer">
                                    </select>
                                    <input v-show="viewType == 2" type="text" class="form-control form-control-sm"
                                           v-model="overview.customer_name">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Account Executive</label>
                                    <input type="text" class="form-control form-control-sm"
                                           v-model="overview.acct_exec">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Prepared By</label>
                                    <input type="text" class="form-control-plaintext form-control-sm"
                                           v-model="overview.prepared_by">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>No.</label>
                                    <input type="text" class="form-control form-control-sm"
                                           v-model="overview.no">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>S.O.</label>
                                    <input type="text" class="form-control form-control-sm"
                                           v-model="overview.so_no">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>P.O.</label>
                                    <input type="text" class="form-control form-control-sm"
                                           v-model="overview.po_no">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Stock Card In</label>
                                    <input type="text" class="form-control form-control-sm"
                                           v-model="overview.stock_card_in">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Plate No.</label>
                                    <input type="text" class="form-control form-control-sm"
                                           v-model="overview.plate_no">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Driver</label>
                                    <input type="text" class="form-control form-control-sm"
                                           v-model="overview.driver">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <h4>Product Details</h4>
                                <hr>
                            </div>
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <caption v-if="viewType != 2">
                                            <button class="btn btn-sm btn-success" data-toggle="modal"
                                                    data-target="#productModal">Add Product
                                        </caption>
                                        <thead>
                                        <th v-for="column in columns">@{{ column }}</th>
                                        </thead>
                                        <tbody>
                                        <tr v-for="(product, index) in products">
                                            <td><input readonly type="text" class="form-control-plaintext form-control-sm"
                                                       v-model="product.product_name"></td>
                                            <td><input type="text" class="form-control form-control-sm"
                                                       style="width: 100%;" v-model="product.notes"></td>
                                            <td><input type="text" class="form-control form-control-sm"
                                                       style="width: 40px;" v-model="product.qty"></td>
                                            <td>
                                                <button v-show="viewType != 2" class="btn btn-sm btn-block btn-danger" @click="remove(index)">
                                                    <i class="fa fa-ban"></i></button>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <a href="{{ route('orderform') }}" class="btn btn-warning">Back</a>
                                <button class="btn btn-info" v-if="viewType == 1" @click="store">Save New</button>
                                <button class="btn btn-primary" v-if="viewType == 0" @click="update">Update Now</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="productModal" class="modal" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Find a Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form>
                                    <div class="form-group">
                                        <label class="control-label">Products</label>
                                        <select class="form-control select2-product">
                                        </select>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal" @click="addRow()">Insert
                        </button>
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
                    viewType: 0,
                    columns: [
                        'Product', 'Notes', 'Qty', 'Action'
                    ],
                    sub_total: 0,
                    overview: {!! $orderform !!},
                    products: {!! $product_details !!},
                }
            },
            methods: {
                store() {
                    var $this = this;
                    $.ajax({
                        url: '{{ route('orderform.store') }}',
                        method: 'POST',
                        data: {
                            overview: $this.overview,
                            products: $this.products,
                        },
                        success: function (value) {
                            Swal.fire(
                                'Good job!',
                                'Operation is successful.',
                                'success'
                            ).then((result) => {
                                if (result.value) {
                                    window.location = '{{ route('orderform') }}'
                                }
                            })
                        }
                    })

                },
                update() {
                    var $this = this;
                    $.ajax({
                        url: '{{ route('orderform.update') }}',
                        method: 'POST',
                        data: {
                            overview: $this.overview,
                            products: $this.products,
                        },
                        success: function (value) {
                            Swal.fire(
                                'Good job!',
                                'Operation is successful.',
                                'success'
                            ).then((result) => {
                                if (result.value) {
                                    window.location = '{{ route('orderform') }}'
                                }
                            })
                        }
                    })
                },
                remove(product) {
                    this.products.splice(product, 1);
                },
                addRow() {
                    this.products.push(
                        {
                            product_id: $('.select2-product').find(':selected').val(),
                            product_name: $('.select2-product').find(':selected').text(),
                            product_code: '',
                            notes: '',
                            qty: 0,
                            unit_cost: 0,
                            vendor_price: 0,
                            discount_item: ''
                        }
                    );
                    $('.select2-product').val(null).trigger('change');
                },
            },
            mounted() {
                var $this = this;

                $('.select2-product').select2({
                    width: '100%',
                    ajax: {
                        url: '{{ route('product.list') }}',
                        method: 'POST',
                        dataType: 'json'
                    }
                });

                $('.select2-customer').select2({
                    width: '100%',
                    ajax: {
                        url: '{{ route('customer.list') }}',
                        method: 'POST',
                        dataType: 'json'
                    }
                }).on('select2:select', function (e) {
                    var data = e.params.data;
                    $this.overview.customer_id = data.id;
                });

                var newOption = new Option($this.overview.customer_name, $this.overview.customer_id, true, true);
                $('.select2-customer').append(newOption).trigger('change');

                if ('{{ Route::currentRouteName() }}' == 'orderform.detail') {
                    this.viewType = 0;
                }
                else if ('{{ Route::currentRouteName() }}' == 'orderform.create') {
                    this.viewType = 1;
                }
                else if ('{{ Route::currentRouteName() }}' == 'orderform.view') {
                    this.viewType = 2;
                    $('label').addClass('font-weight-bold');
                    $('.form-control').addClass('form-control-plaintext').removeClass('form-control');
                    $('.select2').attr('hidden','hidden');
                }
            }
        });
    </script>
@endsection