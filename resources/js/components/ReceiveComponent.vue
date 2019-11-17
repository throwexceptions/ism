<template>
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Receiving Management</h1>
        </div>

        <!-- Content Row -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Receiving Overview</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <table id="table-batch" class="table table-hover" width="100%" cellspacing="0"></table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            var $this = this;
            $this.dt = $('#table-batch').DataTable({
                processing: true,
                serverSide: true,
                scrollX: true,
                responsive: true,
                order: [[0, 'desc']],
                ajax: {
                    url: '/receive/table',
                    method: "POST",
                },
                columns: [
                    {data: 'id', title: 'ID'},
                    {data: 'batch_no', title: 'Batch #'},
                    {data: 'container_no', title: 'Container #'},
                    {data: 'name', title: 'Product Name'},
                    {data: 'overall', title: 'Remaining Overall'},
                    {data: 'qty_in', title: 'Qnty In'},
                    {data: 'date_arrival', title: 'Date Arrival'},
                    {
                        data: function (value) {
                            return '<span class="badge badge-pill badge-danger d-inline-block text-truncate" style="max-width: 150px;">' + value.remarks + '</span>';
                        }, name:'remarks', title: 'Remarks'
                    },
                ],
                drawCallback: function () {
                    $('#table-batch tbody').on('click', 'tr', function () {
                        let hold = $this.dt.row(this).data();
                        $this.overview = hold;
                        $('#formModal').modal('show');
                        $('input[type=file]').val('');
                        console.log(hold);
                    });
                }
            });
            console.log('Component mounted.')
        }
    }
</script>