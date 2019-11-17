<template>
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Users Management</h1>
        </div>

        <!-- Content Row -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Users Overview</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-success" @click="addForm"><i class="fa fa-plus"></i> Add New Users
                        </button>
                    </div>
                    <div class="col-md-12 mt-3">
                        <table id="table-user" class="table table-hover" width="100%" cellspacing="0"></table>
                    </div>
                </div>
            </div>
        </div>

        <div id="formModal" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">User Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-form-label">E-mail</label>
                                    <input type="email" class="form-control" v-model="overview.email"/>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Name</label>
                                    <input class="form-control" v-model="overview.name"/>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Password</label>
                                    <input type="password" class="form-control" v-model="overview.password"/>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Confirm Password</label>
                                    <input type="password" class="form-control"
                                           v-model="overview.password_confirmation"/>
                                    <small v-show="overview.password_confirmation != overview.password" id="emailHelp"
                                           class="form-text text-muted">Password are not equal.
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button v-show="overview.id == ''" @click="store" type="button" class="btn btn-success"
                                data-dismiss="modal">Save changes
                        </button>
                        <button v-show="overview.id != ''" @click="update" type="button" class="btn btn-info"
                                data-dismiss="modal">Update
                        </button>
                        <button v-show="overview.id != ''" @click="getAbilities" type="button" class="btn btn-warning"
                                data-dismiss="modal">Abilites
                        </button>
                        <button v-show="overview.id != ''" @click="destroy" type="button" class="btn btn-danger"
                                data-dismiss="modal">Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div id="abilitiesModal" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">User Abilities</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div v-for="value in ability_list" class="col-md-3">
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" v-model="abilities[value]">
                                    <label class="form-check-label" for="exampleCheck1">{{ value }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal" @click="updateAbilities">
                            Save changes
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
                overview: {
                    email: "",
                    id: "",
                    name: "",
                    password: "",
                    password_confirmation: "",
                },
                abilities: {},
                ability_list: {}
            };
        },
        methods: {
            addForm() {
                this.overview = {
                    email: "",
                    id: "",
                    name: "",
                    password: "",
                    password_confirmation: ""
                };
                $('#formModal').modal('show');
            },
            store() {
                var $this = this;
                $.ajax({
                    url: 'user/store',
                    method: 'POST',
                    data: $this.overview,
                    success: function (value) {
                        $this.dt.draw(false);
                    }
                });
            },
            update() {
                var $this = this;
                $.ajax({
                    url: 'user/update',
                    method: 'POST',
                    data: $this.overview,
                    success: function (value) {
                        $this.dt.draw(false);
                    }
                });
            },
            destroy() {
                var $this = this;
                $.ajax({
                    url: 'user/destroy',
                    method: 'POST',
                    data: $this.overview,
                    success: function (value) {
                        $this.dt.draw(false);
                    }
                });
            },
            getAbilities() {
                $('#abilitiesModal').modal('show');
                var $this = this;
                $.ajax({
                    url: 'user/abilities',
                    method: 'POST',
                    data: $this.overview,
                    success: function (value) {
                        $this.dt.draw(false);
                        $this.abilities = value.output;
                        $this.ability_list = value.list;
                    }
                });
            },
            updateAbilities() {
                $('#abilitiesModal').modal('show');
                var $this = this;
                $.ajax({
                    url: 'user/abilities/update',
                    method: 'POST',
                    data: {'overview': $this.overview, 'abilities': $this.abilities},
                    success: function (value) {
                        $this.dt.draw(false);
                        $this.abilities = value;
                    }
                });
            },
        },
        mounted() {
            var $this = this;
            $this.dt = $('#table-user').DataTable({
                processing: true,
                serverSide: true,
                scrollX: true,
                responsive: true,
                order: [[0, 'desc']],
                ajax: {
                    url: '/user/table',
                    method: "POST",
                },
                columns: [
                    {data: 'id', title: 'ID'},
                    {data: 'name', title: 'Name'},
                    {data: 'email', title: 'Email'},
                ],
                drawCallback: function () {
                    $('#table-user tbody').on('click', 'tr', function () {
                        let hold = $this.dt.row(this).data();
                        hold.password = "sample";
                        hold.password_confirmation = "sample";
                        $this.overview = hold;
                        $('#formModal').modal('show');
                        console.log(hold);
                    });
                }
            });
            console.log('Component mounted.')
        }
    }
</script>