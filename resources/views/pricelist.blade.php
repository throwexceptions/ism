@extends('admin_layout')

@section('content')
    <div id='app' class="container-fluid">

        <!-- Content Row -->
        <div class="row">

            <div class="col-lg-12 mb-4">
                <!-- Approach -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Price List Directory</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-auto">
                                <form action="{{ route('pricelist.upload') }}" method="POST"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <input type="file" name="excel_file" class="form-control-file">
                                        </div>
                                        <div class="col-md-auto">
                                            <button class="btn btn-sm btn-primary">Upload Now</button>
                                        </div>
                                    </div>
                                </form>
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
                return {}
            },
            methods: {},
            mounted() {
                var $this = this;

            }
        });
    </script>
@endsection