@extends('admin_layout')

@section('content')
    <div id='app' class="container-fluid">

        <!-- Content Row -->
        <div class="row">

            <div class="col-lg-12 mb-4">
                <!-- Approach -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Vendor Details</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4>Basic Information</h4>
                                <hr>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Vendor Name</label>
                                    <input type="text" class="form-control form-control-sm" v-model="overview.name">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Account No.</label>
                                    <input type="text" class="form-control form-control-sm" v-model="overview.acct_no">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Website</label>
                                    <input type="text" class="form-control form-control-sm" v-model="overview.website">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" class="form-control form-control-sm" v-model="overview.phone">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Other Phone</label>
                                    <input type="text" class="form-control form-control-sm" v-model="overview.other_phone">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>E-mail</label>
                                    <input type="text" class="form-control form-control-sm" v-model="overview.email">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Parent Company</label>
                                    <input type="text" class="form-control form-control-sm" v-model="overview.parent_company">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <h4>Method Type</h4>
                                <hr>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Payment Method</label>
                                    <input type="text" class="form-control form-control-sm" v-model="overview.payment_method">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Shipping Method</label>
                                    <input type="text" class="form-control form-control-sm" v-model="overview.shipping_method">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <h4>Address Information</h4>
                                <hr>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Address</label>
                                    <textarea type="text" class="form-control form-control-sm" rows="5" v-model="overview.address" style="height: 80px;">
                                    </textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <a href="{{ route('vendor') }}" class="btn btn-warning">Back</a>
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
            overview: {!! $vendor !!},
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
    },
    mounted() {
        var $this = this;
        
        if('{{ Route::currentRouteName() }}' == 'vendor.detail') {
            this.viewType = 0;
        } 
        else if('{{ Route::currentRouteName() }}' == 'vendor.create') {
            this.viewType = 1;
        }
        else if('{{ Route::currentRouteName() }}' == 'vendor.view') {
            this.viewType = 2;
            $('label').addClass('font-weight-bold');
            $('.form-control').addClass('form-control-plaintext').removeClass('form-control');
        }
    }
});
</script>
@endsection