@extends('admin_layout')

@section('content')
    <div id='app' class="container-fluid">

        <!-- Content Row -->
        <div class="row">

            <div class="col-lg-6 mb-4">
                <!-- Approach -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">In Stock</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                            </div>
                            <div class="col-md-12 mt-3">
                                <table id="table-customer" class="table table-striped nowrap" style="width:100%"></table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <!-- Approach -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Out of Stock</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                            </div>
                            <div class="col-md-12 mt-3">
                                <table id="table-customer" class="table table-striped nowrap" style="width:100%"></table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <!-- Approach -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Latest PO</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                            </div>
                            <div class="col-md-12 mt-3">
                                <table id="table-customer" class="table table-striped nowrap" style="width:100%"></table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <!-- Approach -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Latest SO</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                            </div>
                            <div class="col-md-12 mt-3">
                                <table id="table-customer" class="table table-striped nowrap" style="width:100%"></table>
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
            dt: null,
            overview: {
                id: "",
                subject: "",
                recipient_email: "",
                recipient_name: "",
                message: "",
            }
        }
    },
});
</script>
@endsection