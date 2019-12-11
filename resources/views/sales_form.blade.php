@extends('admin_layout')

@section('content')
    <div id='app' class="container-fluid">

        <!-- Content Row -->
        <div class="row">

            <div class="col-lg-12 mb-4">
                <!-- Approach -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Sales Order Details</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4>Sales Order Information</h4>
                                <hr>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Subject</label>
                                    <input type="text" class="form-control form-control-sm" v-model="overview.subject">
                                </div>
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" class="form-control form-control-sm" v-model="overview.phone">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select type="text" class="form-control form-control-sm" v-model="overview.status">
                                        <option value="">-- Select Options --</option>
                                        <option value="Received">Received</option>
                                        <option value="Paid">Paid</option>
                                        <option value="Completed">Completed</option>
                                        <option value="Ordered">Ordered</option>
                                        <option value="Invoice">Invoice</option>
                                        <option value="Shipped">Shipped</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Customer Name</label>
                                    <input type="text" class="form-control form-control-sm" v-model="overview.customer_id">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Fax</label>
                                    <input type="text" class="form-control form-control-sm" v-model="overview.fax">
                                </div>
                                <div class="form-group">
                                    <label>Sales Order</label>
                                    <input type="text" class="form-control form-control-sm" v-model="overview.so_no">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <h4>Payment Information</h4>
                                <hr>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group" v-if="overview.payment_method == 'Check'">
                                    <label>Account Number</label>
                                    <input type="text" class="form-control form-control-sm" v-model="overview.account_no">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"  v-if="overview.payment_method == 'Check'">
                                    <label>Account Name</label>
                                    <input type="text" class="form-control form-control-sm" v-model="overview.account_name">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <h4>Address Information</h4>
                                <hr>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Location of Service</label>
                                    <textarea type="text" class="form-control form-control-sm" rows="5" v-model="overview.address" style="height: 80px;">
                                    </textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <h4>Product Details</h4>
                                <hr>
                            </div>
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <caption v-if="viewType != 2"><button class="btn btn-sm btn-success" @click="addRow()">Add Product</caption>
                                        <thead>
                                        <th v-for="column in columns">@{{ column }}</th>
                                        </thead>
                                        <tbody>
                                        <tr v-for="(product, index) in products">
                                            <td><input type="text" class="form-control form-control-sm" style="width: 180px;" v-model="product.product_name"></td>
                                            <td><input type="text" class="form-control form-control-sm" style="width: 200px;" v-model="product.product_code"></td>
                                            <td><input type="text" class="form-control form-control-sm" style="width: 230px;" v-model="product.notes"></td>
                                            <td><input type="text" class="form-control form-control-sm" style="width: 40px;" v-model="product.qty"></td>
                                            <td><input type="text" class="form-control form-control-sm" style="width: 100px;" v-model="product.unit_cost"></td>
                                            <td>@{{ (product.unit_cost * product.qty) - ((product.unit_cost * product.qty)*(product.discount_item/100)) }}</td>
                                            <td><input type="text" class="form-control form-control-sm" style="width: 120px;" v-model="product.labor_cost"></td>
                                            <td>@{{ (product.labor_cost * product.qty)}}</td>
                                            <td><input type="text" class="form-control form-control-sm" v-model="product.discount_item"></td>
                                            <td><button class="btn btn-sm btn-block btn-danger" @click="remove(index)"><i class="fa fa-ban"></i></button></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="offset-md-9 col-md-4">
                                <div class="form-group row" >
                                    <label class="col-form-label col-md-4 col-form-label-sm">Discount</label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control form-control-sm" v-model="summary.discount">
                                    </div>
                                </div>
                                <div class="form-group row" >
                                    <label class="col-form-label col-md-4 col-form-label-sm">Sub Total</label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control form-control-sm" v-model="sub_total">
                                    </div>
                                </div>
                                <div class="form-group row" >
                                    <label class="col-form-label col-md-4 col-form-label-sm">Shipping</label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control form-control-sm" v-model="summary.shipping">
                                    </div>
                                </div>
                                <div class="form-group row" >
                                    <label class="col-form-label col-md-4 col-form-label-sm">Sales Tax</label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control form-control-sm" v-model="summary.sales_tax">
                                    </div>
                                </div>
                                <div class="form-group row" >
                                    <label class="col-form-label col-md-4 col-form-label-sm">Grand Total</label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control-plaintext form-control-sm" v-bind:value="sub_total + parseFloat(summary.sales_tax) + parseFloat(summary.shipping)">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <h4>Terms & Conditions</h4>
                                <hr>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row" >
                                    <div class="col-md-12">
                                        <textarea  type="text" class="form-control form-control-sm" v-model="overview.tac" rows="5" style="height: 80px;"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <h4>Description Information</h4>
                                <hr>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row" >
                                    <div class="col-md-12">
                                        <textarea type="text" class="form-control form-control-sm" v-model="overview.description" rows="5" style="height: 80px;"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <a href="{{ route('purchase') }}" class="btn btn-warning">Back</a>
                                <button class="btn btn-info" v-if="viewType == 1" @click="store">Save New</button>
                                <button class="btn btn-primary" v-if="viewType == 0" @click="update">Update Now</button>
                            </div>
                        </div>
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
                        'Product','Vendor Product Number','Notes','Qty','Unit Cost','Discount','Unit Total', 'Labor Cost','Labor Total','Action'
                    ],
                    sub_total: 0,
                    overview: {!! $sales_order !!},
                    products: {!! $product_details !!},
                    summary: {!! $summary !!},
                }
            },
            methods: {
                store() {
                    var $this = this;
                    $.ajax({
                        url: '{{ route('purchase.store') }}',
                        method: 'POST',
                        data: {
                            overview: $this.overview,
                            products: $this.products,
                            summary: $this.summary,
                        },
                        success: function(value) {
                            Swal.fire(
                                'Good job!',
                                'Operation is successful.',
                                'success'
                            )
                        }
                    })

                },
                update() {
                    var $this = this;
                    $.ajax({
                        url: '{{ route('purchase.update') }}',
                        method: 'POST',
                        data: {
                            overview: $this.overview,
                            products: $this.products,
                            summary: $this.summary,
                        },
                        success: function(value) {
                            Swal.fire(
                                'Good job!',
                                'Operation is successful.',
                                'success'
                            )
                        }
                    })
                },
                remove(product){
                    this.products.splice(product, 1);
                },
                addRow() {
                    this.products.push(
                        {
                            product_name: '',
                            product_code: '',
                            notes: '',
                            qty: '',
                            unit_cost: '',
                            vendor_price: '',
                            discount_item: ''
                        }
                    );
                },
                subTotal() {
                    var $this=  this;
                    $this.sub_total = 0;
                    $.each($this.products, function(x,product){
                        $this.sub_total = (product.vendor_price * product.qty) - ((product.vendor_price * product.qty)*(product.discount_item/100))
                    });
                }
            },
            watch: {
                'products': {
                    deep: true,
                    handler() {
                        this.subTotal()
                    }
                }
            },
            mounted() {
                var $this = this;
                $this.subTotal();

                if('{{ Route::currentRouteName() }}' == 'sales.detail') {
                    this.viewType = 0;
                }
                else if('{{ Route::currentRouteName() }}' == 'sales.create') {
                    this.viewType = 1;
                }
                else if('{{ Route::currentRouteName() }}' == 'sales.view') {
                    this.viewType = 2;
                    $('label').addClass('font-weight-bold');
                    $('.form-control').addClass('form-control-plaintext').removeClass('form-control');
                }
            }
        });
    </script>
@endsection