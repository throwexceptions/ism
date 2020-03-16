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
                            <div class="col-md-12 row">
                                <div class="col-md-4 mt-4">
                                    <form action="{{ route('pricelist.upload') }}" method="POST"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group row">
                                            <div class="col-md-12 mb-2">
                                                <input type="text" name="subject" class="form-control" placeholder="Insert Subject Here...">
                                            </div>
                                            <div class="col-md-12 mb-2">
                                                <input type="file" name="excel_file" class="form-control-file">
                                            </div>
                                            <div class="col-md-12 mb-2">
                                                <button class="btn btn-sm btn-primary">
                                                    <i class="fa fa-upload"></i>
                                                    Upload Now
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-8">
                                    <table id="table-pricelist" class="table table-striped nowrap"
                                           style="width:100%"></table>
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
                    overview: {},
                }
            },
            methods: {
                destroy() {
                    var $this = this;
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.value) {
                            $.ajax({
                                url: "{{ route('pricelist.destroy') }}",
                                method: 'POST',
                                data: $this.overview,
                                success(value) {
                                    Swal.fire('Deleted!', 'Your file has been deleted.', 'success');
                                    $this.dt.draw();
                                }
                            });
                        }
                    });
                },
            },
            mounted() {
                var $this = this;
                $this.dt = $('#table-pricelist').DataTable({
                    processing: true,
                    serverSide: true,
                    scrollX: true,
                    responsive: true,
                    order: [[1, 'desc']],
                    ajax: {
                        url: "{{ route('pricelist.table') }}",
                        method: "POST",
                    },
                    columns: [
                        {
                            data: function (value) {
                                return '<div class="btn-group btn-group-sm shadow-sm" role="group" aria-label="Basic example">' +
                                    '<a href="/download/pricelist/' + value.id + '" target="_blank" class="btn btn-primary"><i class="fa fa-download"></i></a>' +
                                    '<button type="button" class="btn btn-danger btn-destroy"><i class="fa fa-trash"></i></button>' +
                                    '</div>'
                            },
                            searchable: false,
                            bSortable: false,
                            title: 'Action'
                        },
                        {data: 'id', name: 'price_lists.id', title: 'ID'},
                        {data: 'subject', name: 'price_lists.subject', title: 'Subject'},
                        {data: 'filename', name: 'price_lists.filename', title: 'Filename'},
                        {data: 'assigned_to', name: 'price_lists.assigned_to', title: 'Uploaded By'},
                    ],
                    drawCallback: function () {
                        $('table .btn').on('click', function () {
                            let data = $(this).parent().parent().parent();
                            let hold = $this.dt.row(data).data();
                            $this.overview = hold;
                            console.log(hold);
                        });

                        $('.btn-destroy').on('click', function () {
                            $this.destroy();
                        });
                    }
                });

            }
        });
    </script>
@endsection