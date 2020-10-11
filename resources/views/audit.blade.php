@extends('admin_layout')

@section('content')
    <div id='app' class="container-fluid">

        <!-- Content Row -->
        <div class="row">

            <div class="col-lg-12 mb-4">
                <!-- Approach -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Audit Log</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-auto">
                            </div>
                            <div class="col-md-12 mt-3">
                                <table id="table-product" class="table table-striped  table-general nowrap" style="width:100%"></table>
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
                    overview: '',
                    categories: '',
                    category_new: ''
                }
            },
            methods: {

            },
            mounted() {
                var $this = this;
                $this.dt = $('#table-product').DataTable({
                    processing: true,
                    serverSide: true,
                    scrollX: true,
                    responsive: true,
                    pageLength: 100,
                    order: [[0, 'desc']],
                    ajax: {
                        url: "{{ route('audit.table') }}",
                        method: "POST",
                    },
                    columns: [
                        {data: 'created_at', title: 'Timestamp'},
                        {data: 'user', title: 'User'},
                        {data: 'url', title: 'URL'},
                    ],
                    drawCallback: function () {
                    }
                });
            }
        });
    </script>
@endsection
