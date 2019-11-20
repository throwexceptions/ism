<template>
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Product Management</h1>
            <!--<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">-->
            <!--<i class="fas fa-download fa-sm text-white-50"></i> Generate Report-->
            <!--</a>-->
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Product Overview</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-success btn-add">
                            <i class="fa fa-plus"></i> Add New Product
                        </button>
                    </div>
                    <div class="col-md-12 mt-3">
                        <div class="table-responsive">
                            <table id="table-products" class="table table-striped" width="100%"
                                   cellspacing="0"></table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="formModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Product Detail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="form-data" enctype="multipart/form-data">
                            <div class="row">
                                <div v-show="overview.id != '' && overview.path" class="col-md-12" >
                                    <img v-bind:src="'app/public/' + overview.path" class="rounded img-thumbnail" width="200" height="200">
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Name</label>
                                        <input v-bind:readonly="isView" v-bind:class="{ 'form-control-plaintext': isView, 'form-control': !isView }" name="name" v-model="overview.name">
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label">Pack Quantity</label>
                                        <input v-bind:readonly="isView" v-bind:class="{ 'form-control-plaintext': isView, 'form-control': !isView }" name="pack_qty" v-model="overview.pack_qty">
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label">Size</label>
                                        <input v-bind:readonly="isView" v-bind:class="{ 'form-control-plaintext': isView, 'form-control': !isView }" name="size" v-model="overview.size">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Thickness</label>
                                        <input v-bind:readonly="isView" v-bind:class="{ 'form-control-plaintext': isView, 'form-control': !isView }" name="size" v-model="overview.thickness">
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label">Type</label>
                                        <input v-bind:readonly="isView" v-bind:class="{ 'form-control-plaintext': isView, 'form-control': !isView }" name="type" v-model="overview.type">
                                    </div>
                                    <div class="form-group" v-show="!isView">
                                        <label for="exampleFormControlFile1">Example file input</label>
                                        <input type="file" class="form-control-file" id="exampleFormControlFile1">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button v-show="isView == false && overview.id != ''" @click="update" type="button" class="btn btn-primary" data-dismiss="modal">
                            Update
                        </button>
                        <button v-show="isView == false && overview.id == ''" @click="store" type="button" class="btn btn-success"
                                data-dismiss="modal">
                            Save As New
                        </button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Close
                        </button>
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
                dt: null,
                root: this.$root.$options,
                overview: {
                    created_at: "",
                    deleted_at: null,
                    id: "",
                    name: "",
                    pack_qty: "",
                    size: "",
                    thickness: "",
                    type: "",
                    updated_at: "",
                }
            };
        },
        methods: {
            destroy() {

            },
            update() {
                var $this = this;
                var formData = new FormData();
                formData.append('file', $('input[type=file]')[0].files[0]);
                formData.append('name', $this.overview.name);
                formData.append('pack_qty', $this.overview.pack_qty);
                formData.append('size', $this.overview.size);
                formData.append('thickness', $this.overview.thickness);
                formData.append('type', $this.overview.type);
                formData.append('id', $this.overview.id);
                $.ajax({
                    url: '/product/update',
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (value) {
                        $this.dt.draw();
                    }
                });
            },
            store() {
                var $this = this;
                var formData = new FormData();
                formData.append('file', $('input[type=file]')[0].files[0]);
                formData.append('name', $this.overview.name);
                formData.append('pack_qty', $this.overview.pack_qty);
                formData.append('size', $this.overview.size);
                formData.append('thickness', $this.overview.thickness);
                formData.append('type', $this.overview.type);
                $.ajax({
                    url: '/product/store',
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (value) {
                        $this.dt.draw();
                    }
                });
            },
            destroyDialog() {
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
            var $this = this;
            $this.dt = $('#table-products').DataTable({
                processing: true,
                serverSide: true,
                scrollX: true,
                responsive: true,
                order: [[0, 'desc']],
                ajax: {
                    url: '/product/table',
                    method: "POST",
                },
                columns: [
                    {
                        title: 'Actions', name: 'id', width: '12%',
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
                    {data: 'pack_qty', title: 'Pack Quantity'},
                    {data: 'size', title: 'Size'},
                    {data: 'thickness', title: 'Thickness'},
                    {data: 'type', title: 'Type'},
                    {data: 'created_at', title: 'Date Inserted'},
                ],
                drawCallback: function () {
                    
                    $('.btn-add').on('click', function () {
                        $this.overview = {
                            path: "",
                            deleted_at: null,
                            id: "",
                            name: "",
                            pack_qty: "",
                            size: "",
                            thickness: "",
                            type: "",
                            updated_at: "",
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
                        $this.destroyDialog();
                    });
                }
            });
            console.log('Component mounted.')
        }
    }
</script>