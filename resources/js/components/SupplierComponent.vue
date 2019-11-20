<template>
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Supplier Management</h1>
        </div>

        <!-- Content Row -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Supplier Overview</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-success btn-add"><i class="fa fa-plus"></i> Add New Supplier</button>
                    </div>
                    <div class="col-md-12 mt-3">
                        <table id="table-log" class="table table-striped" width="100%" cellspacing="0"></table>
                    </div>
                </div>
            </div>
        </div>

        <div id="formModal" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Supplier Detail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-form-label">Name</label>
                                <input v-bind:readonly="isView" v-bind:class="{ 'form-control-plaintext': isView, 'form-control': !isView }" v-model="overview.name">
                            </div>
                            <div class="form-group">
                                <label class="control-form-label">Email</label>
                                <input v-bind:readonly="isView" v-bind:class="{ 'form-control-plaintext': isView, 'form-control': !isView }" v-model="overview.email">
                            </div>
                            <div class="form-group">
                                <label class="control-form-label">Phone</label>
                                <input v-bind:readonly="isView" v-bind:class="{ 'form-control-plaintext': isView, 'form-control': !isView }" v-model="overview.phone">
                            </div>
                        </div>
                        <div class="col-md-6">
                    
                            <div class="form-group">
                                <label class="control-form-label">Address</label>
                                <textarea v-bind:readonly="isView" v-bind:class="{ 'form-control-plaintext': isView, 'form-control': !isView }" v-model="overview.address" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" v-if="isView == false && overview.id!=''" @click="edit">Save Changes</button>
                    <button type="button" class="btn btn-success" v-if="isView == false && overview.id==''" @click="save">Add New</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                isView: false,
                overview: {
                    id: "",
                    name: "",
                    address: "",
                    email: "",
                    phone: "",
                }
            }
        },
        methods: {
            edit() {

            },
            save() {

            },
            editDialog() {
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
                        Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                        )
                    }
                });
            }
        },
        mounted() {
            //Swal.fire('Any fool can use a computer')
            var $this = this;
            $this.dt = $('#table-log').DataTable({
                processing: true,
                serverSide: true,
                scrollX: true,
                responsive: true,
                order: [[1, 'desc']],
                ajax: {
                    url: '/supplier/table',
                    method: "POST",
                },
                columns: [
                    {
                        title: 'Actions', name: 'id', width: '10%',
                        data: function (value) {
                            return "<div class=\"btn-group btn-group-sm\" role=\"group\">\n" +
                                "  <button type=\"button\" class=\"btn btn-info btn-view\"><i class='fa fa-eye'></i></button>\n" +
                                "  <button type=\"button\" class=\"btn btn-warning btn-edit\"><i class='fa fa-edit'></i></button>\n" +
                                "  <button type=\"button\" class=\"btn btn-danger btn-destroy\"><i class='fa fa-trash-alt'></i></button>\n" +
                                "</div>";
                        }
                    },
                    {data: 'id', title: 'ID'},
                    {data: 'name', title: 'Name'},
                    {data: 'phone', title: 'Contact No.'},
                    {data: 'email', title: 'E-mail'},
                ],
                drawCallback: function () {
                    $('.btn-add').on('click', function () {
                        $this.overview = {
                            id: "",
                            name: "",
                            address: "",
                            email: "",
                            phone: "",
                        };
                        $this.isView = false;
                        $('#formModal').modal('show');
                    });

                    $('.btn-view').on('click', function () {
                        let tr = $(this).parent().parent().parent()
                        let hold = $this.dt.row(tr).data();
                        $this.overview = hold;
                        $this.isView = true;
                        $('#formModal').modal('show');
                    });

                    $('.btn-edit').on('click', function () {
                        let tr = $(this).parent().parent().parent()
                        let hold = $this.dt.row(tr).data();
                        $this.overview = hold;
                        $this.isView = false;
                        $('#formModal').modal('show');
                    });

                    $('.btn-destroy').on('click', function () {
                        let tr = $(this).parent().parent().parent()
                        let hold = $this.dt.row(tr).data();
                        $this.overview = hold;
                        $this.editDialog();
                    });
                }
            });
            console.log('Component mounted.')
        }
    }
</script>