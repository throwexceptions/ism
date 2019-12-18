@extends('admin_layout')

@section('content')
    <div id='app' class="container-fluid">

        <!-- Content Row -->
        <div class="row">

            <div class="col-lg-12 mb-4">
                <!-- Approach -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Role Details</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Role</label>
                                    <input class="form-control form-control-sm" v-model="role">
                                </div>
                            </div>
                            {{--BATCH PROCESS--}}
                            <div class="col-md-12 row">
                                <div class="col-md-12 mt-4">
                                    <h3>Batch Process Permissions</h3>
                                    <hr>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            <label class="switch">
                                                <input type="checkbox" v-model="abilities.batch_process">
                                                <span class="slider"></span>
                                            </label>
                                        </div>
                                        <div class="col-md-auto">
                                            <label class="switch-label">Batch Process</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            <label class="switch">
                                                <input type="checkbox" v-model="abilities.batch_process_create">
                                                <span class="slider"></span>
                                            </label>
                                        </div>
                                        <div class="col-md-auto">
                                            <label class="switch-label">Create</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            <label class="switch">
                                                <input type="checkbox" v-model="abilities.batch_process_retrieve">
                                                <span class="slider"></span>
                                            </label>
                                        </div>
                                        <div class="col-md-auto">
                                            <label class="switch-label">Retrieve</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            <label class="switch">
                                                <input type="checkbox" v-model="abilities.batch_process_update">
                                                <span class="slider"></span>
                                            </label>
                                        </div>
                                        <div class="col-md-auto">
                                            <label class="switch-label">Update</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            <label class="switch">
                                                <input type="checkbox" v-model="abilities.batch_process_delete">
                                                <span class="slider"></span>
                                            </label>
                                        </div>
                                        <div class="col-md-auto">
                                            <label class="switch-label">Delete</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <a href="{{ route('role') }}" class="btn btn-warning">Back</a>
                                <button class="btn btn-success" v-if="viewType != 2" @click="store">Save</button>
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
                    viewType: 0,
                    role: '{!! $role !!}',
                    abilities: {!! $abilities !!},
                }
            },
            methods: {
                store() {
                    var $this = this;
                    $.ajax({
                        url: '{{ route('role.store') }}',
                        method: 'POST',
                        data: {role: $this.role, abilities: $this.abilities},
                        success: function (value) {
                            Swal.fire(
                                'Good job!',
                                'Operation is successful.',
                                'success'
                            ).then((result) => {
                                if (result.value) {
                                    window.location = '{{ route('role') }}'
                                }
                            })
                        }
                    })

                },
                update() {
                    var $this = this;
                    $.ajax({
                        url: '{{ route('role.abilities') }}',
                        method: 'POST',
                        data: {role: $this.role, abilities: $this.abilities},
                        success: function (value) {
                            Swal.fire(
                                'Good job!',
                                'Operation is successful.',
                                'success'
                            ).then((result) => {
                                if (result.value) {
                                    window.location = '{{ route('role') }}'
                                }
                            })
                        }
                    })
                },
            },
            mounted() {
                var $this = this;

                if ('{{ Route::currentRouteName() }}' == 'role.detail') {
                    this.viewType = 0;
                }
                else if ('{{ Route::currentRouteName() }}' == 'role.create') {
                    this.viewType = 1;
                }
                else if ('{{ Route::currentRouteName() }}' == 'role.view') {
                    this.viewType = 2;
                    $('label').addClass('font-weight-bold');
                    $('.form-control').addClass('form-control-plaintext').removeClass('form-control');
                }
            }
        });
    </script>
@endsection