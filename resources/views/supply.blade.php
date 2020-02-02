@extends('admin_layout')

@section('content')
    <div id='app' class="container-fluid">

        <!-- Content Row -->
        <div class="row">

            <div class="col-lg-12 mb-4">
                <!-- Approach -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Supplies Overview</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 mt-3">
                                <table id="table-supplies" class="table table-striped nowrap" style="width:100%"></table>
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
                        method:'POST',
                        data: $this.overview,
                        success(value) {
                            Swal.fire('Deleted!','Your file has been deleted.','success');
                            $this.dt.draw();
                        }
                    });
                }
            });
        }
    },
    mounted() {
        var $this = this;
            $this.dt = $('#table-supplies').DataTable({
                processing: true,
                serverSide: true,
                scrollX: true,
                responsive: true,
                order: [[0, 'desc']],
                ajax: {
                    url: "{{ route('supply.table') }}",
                    method: "POST",
                },
                columns: [
                    {data: 'manual_id', name:'products.manual_id', title: 'Product ID'},
                    {data: 'product_name', name:'products.name', title: 'Product'},
                    {data: 'selling_price', name:'products.selling_price', title: 'Unit Price'},
                    {data: 'quantity', name:'supplies.quantity', title: 'Quantity'},
                    {data: 'po_count', bSortable:false,bSearchable:false, title: 'PO'},
                    {data: 'so_count', bSortable:false,bSearchable:false, title: 'SO'},
                    
                ],
                drawCallback: function () {
                    $('table .btn').on('click', function(){
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