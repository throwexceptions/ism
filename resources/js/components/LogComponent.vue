<template>
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Logs Management</h1>
        </div>

        <!-- Content Row -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Logs Overview</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <table id="table-log" class="table table-hover" width="100%" cellspacing="0"></table>
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
            $this.dt = $('#table-log').DataTable({
                processing: true,
                serverSide: true,
                scrollX: true,
                responsive: true,
                order: [[0, 'desc']],
                ajax: {
                    url: '/log/table',
                    method: "POST",
                },
                columns: [
                    {data: 'id', title: 'ID'},
                    {data: 'user_id', title: 'User ID'},
                    {
                        data: function (value) {
                            return '<span class="badge badge-pill badge-success d-inline-block text-truncate" style="max-width: 150px;">' + value.remarks + '</span>';
                        }, name:'remarks', title: 'Remarks'
                    },
                ],
                drawCallback: function () {
                    $('#table-log tbody').on('click', 'tr', function () {
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