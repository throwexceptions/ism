@extends('admin_layout')

@section('content')
    <div id='app' class="container-fluid">

        <!-- Content Row -->
        <div class="row">

            <div class="col-lg-12 mb-4">
                <!-- Approach -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Product Details</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4>Product Information</h4>
                                <hr>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control form-control-sm" v-model="overview.name">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Product Code</label>
                                    <input type="text" class="form-control form-control-sm" v-model="overview.code">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Category</label>
                                    <input type="text" class="form-control form-control-sm" v-model="overview.category">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Manufacturer</label>
                                    <input type="text" class="form-control form-control-sm" v-model="overview.manufacturer">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>SKU</label>
                                    <input type="text" class="form-control form-control-sm" v-model="overview.sku">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Discontinued</label>
                                    <input type="text" class="form-control form-control-sm" v-model="overview.discontinued">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Size</label>
                                    <input type="text" class="form-control form-control-sm" v-model="overview.size">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Weight</label>
                                    <input type="text" class="form-control form-control-sm" v-model="overview.weight">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Color</label>
                                    <input type="text" class="form-control form-control-sm" v-model="overview.color">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <h4>Product Image</h4>
                                <hr>
                            </div>
                            <div class="col-md-12">
                                <div class="text-center">
                                    <img src="{{ asset('img/storage/product-placeholder.jpeg') }}" class="rounded" width="200px">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <a href="{{ route('products') }}" class="btn btn-warning">Back</a>
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
            overview: {!! $product !!},
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
        
        if('{{ Route::currentRouteName() }}' == 'product.detail') {
            this.viewType = 0;
        } 
        else if('{{ Route::currentRouteName() }}' == 'product.create') {
            this.viewType = 1;
        }
        else if('{{ Route::currentRouteName() }}' == 'product.view') {
            this.viewType = 2;
            $('label').addClass('font-weight-bold');
            $('.form-control').addClass('form-control-plaintext').removeClass('form-control');
        }
    }
});
</script>
@endsection