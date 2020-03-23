@extends('admin_layout')

@section('content')
    <div id='app' class="container-fluid">

        <!-- Content Row -->
        <div class="row">

            <div class="col-lg-12 mb-4">
                <!-- Approach -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Vendor Overview</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{ route('vendor.create') }}" class="btn btn-sm btn-success"><i
                                            class="fa fa-plus"></i> New Vendor</a>
                                <a href="{{ route('vendor.printable') }}" target="_blank" class="btn btn-sm btn-info"><i class="fa fa-download"></i> Vendor List</a>
                            </div>
                            <div class="col-md-12 mt-3">
                                <table id="table-vendor" class="table table-striped nowrap" style="width:100%"></table>
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
                                url: "{{ route('vendor.destroy') }}",
                                method: 'POST',
                                data: $this.overview,
                                success(value) {
                                    Swal.fire('Deleted!', 'Your file has been deleted.', 'success');
                                    $this.dt.draw();
                                }
                            });
                        }
                    });
                }
            },
            mounted() {
                var $this = this;
                $this.dt = $('#table-vendor').DataTable({
                    processing: true,
                    serverSide: true,
                    scrollX: true,
                    responsive: true,
                    pageLength: 100,
                    order: [[1, 'desc']],
                    ajax: {
                        url: "{{ route('vendor.table') }}",
                        method: "POST",
                    },
                    columns: [
                        {
                            data: function (value) {
                                return '<div class="btn-group btn-group-sm shadow-sm" role="group" aria-label="Basic example">' +
                                    '<a href="/vendors/view/' + value.id + '" class="btn btn-primary btn-view"><i class="fa fa-eye"></i></a>' +
                                    '<a href="/vendors/detail/' + value.id + '" class="btn btn-info btn-view"><i class="fa fa-pen"></i></a>' +
                                    '<button type="button" class="btn btn-danger btn-destroy"><i class="fa fa-trash"></i></button>' +
                                    '</div>'
                            },
                            searchable: false,
                            bSortable: false,
                            title: 'Action'
                        },
                        {data: 'id', name: 'vendors.id', title: 'ID'},
                        {data: 'name', title: 'Vendor Name'},
                        {data: 'contact_person', title: 'Contact Person'},
                        {data: 'username', name: 'users.name', title: 'Created By'},
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