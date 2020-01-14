@extends('admin_layout')

@section('content')
    <div id='app' class="container-fluid">

        <!-- Content Row -->
        <div class="row">

            <div class="col-lg-12 mb-4">
                <!-- Approach -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Preference</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            {{--Editables--}}
                            <div class="col-md-12 mt-3 row">
                                <div class="col-md-12">
                                    <h3>Editables</h3>
                                    <hr>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" v-model="overview.so_textbox">
                                        <label class="form-check-label">SO Textbox</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" v-model="overview.po_textbox">
                                        <label class="form-check-label">PO Textbox</label>
                                    </div>
                                </div>
                            </div>
                            {{--Auto ID Generated--}}
                            <div class="col-md-12 mt-3 row">
                                <div class="col-md-12">
                                    <h3>Auto Generated</h3>
                                    <hr>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" v-model="overview.so_auto">
                                        <label class="form-check-label">SO No.</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" v-model="overview.po_auto">
                                        <label class="form-check-label">PO No.</label>
                                    </div>
                                </div>
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
                    overview: {!!  $build !!},
                }
            },
            methods: {
                update() {
                    var $this = this;
                    $.ajax({
                        url: '{{ route('preference.update') }}',
                        method: 'POST',
                        data: $this.overview,
                        success: function (value) {

                        }
                    });
                }
            },
            watch: {
                'overview': {
                    deep: true,
                    handler() {
                        this.update()
                    }
                }
            },
            mounted() {
            }
        });
    </script>
@endsection