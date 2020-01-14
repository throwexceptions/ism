@extends('admin_layout')

@section('content')
    <div id='app' class="container-fluid">

        <!-- Content Row -->
        <div class="row">

            <div class="col-lg-12 mb-4">
                <!-- Approach -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">User Details</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control form-control-sm" v-model="overview.name">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>E-mail</label>
                                    <input type="text" class="form-control form-control-sm" v-model="overview.email">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <a href="{{ route('users') }}" class="btn btn-warning">Back</a>
                                <button class="btn btn-info" v-if="viewType == 1" @click="store">Save New</button>
                                <button class="btn btn-primary" v-if="viewType == 0" @click="update">Update Now</button>
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
                    overview: {!! $user !!},
                }
            },
            methods: {
                store() {
                    var $this = this;
                    $.ajax({
                        url: '{{ route('user.store') }}',
                        method: 'POST',
                        data: $this.overview,
                        success: function(value) {
                            Swal.fire(
                                'Good job!',
                                'Operation is successful.',
                                'success'
                            ).then((result) => {
                                if (result.value) {
                                    window.location = '{{ route('users') }}'
                                }
                            })
                        }
                    })

                },
                update() {
                    var $this = this;
                    $.ajax({
                        url: '{{ route('user.update') }}',
                        method: 'POST',
                        data: $this.overview,
                        success: function(value) {
                            Swal.fire(
                                'Good job!',
                                'Operation is successful.',
                                'success'
                            ).then((result) => {
                                if (result.value) {
                                    window.location = '{{ route('users') }}'
                                }
                            })
                        }
                    })
                },
            },
            mounted() {
                var $this = this;

                if('{{ Route::currentRouteName() }}' == 'user.detail') {
                    this.viewType = 0;
                }
                else if('{{ Route::currentRouteName() }}' == 'user.create') {
                    this.viewType = 1;
                }
                else if('{{ Route::currentRouteName() }}' == 'user.view') {
                    this.viewType = 2;
                    $('label').addClass('font-weight-bold');
                    $('.form-control').addClass('form-control-plaintext').removeClass('form-control');
                }
            }
        });
    </script>
@endsection