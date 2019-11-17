<template>
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Customer Management</h1>
        </div>

        <!-- Content Row -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Customer Overview</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <table id="table-customer" class="table table-hover" width="100%" cellspacing="0"></table>
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
            $this.dt = $('#table-customer').DataTable({
                processing: true,
                serverSide: true,
                scrollX: true,
                responsive: true,
                order: [[0, 'desc']],
                ajax: {
                    url: '/customer/table',
                    method: "POST",
                },
                columns: [
                    {data: 'id', title: 'ID'},
                    {data: 'name', title: 'Name'},
                    {data: 'email', title: 'Email'},
                    {data: 'contact_no', title: 'Contact No.'},
                ],
                drawCallback: function () {
                    $('#table-customer tbody').on('click', 'tr', function () {
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