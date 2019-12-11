@extends('admin_layout')

@section('content')
    <div id='app' class="container-fluid">

        <!-- Content Row -->
        <div class="row">

            <div class="col-lg-12 mb-4">
                <!-- Approach -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Supply Details</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4>Supply Information</h4>
                                <hr>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Product</label>
                                    <input type="text" class="form-control form-control-sm" v-model="overview.product_name">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Unit Cost</label>
                                    <input type="text" class="form-control form-control-sm" v-model="overview.unit_cost">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <a href="{{ route('supply') }}" class="btn btn-warning">Back</a>
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
            overview: {!! $supply !!},
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
        
        if('{{ Route::currentRouteName() }}' == 'supply.detail') {
            this.viewType = 0;
        } 
        else if('{{ Route::currentRouteName() }}' == 'supply.create') {
            this.viewType = 1;
        }
        else if('{{ Route::currentRouteName() }}' == 'supply.view') {
            this.viewType = 2;
            $('label').addClass('font-weight-bold');
            $('.form-control').addClass('form-control-plaintext').removeClass('form-control');
        }
    }
});
</script>
@endsection