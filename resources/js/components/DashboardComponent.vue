<template>
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <!--<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">-->
            <!--<i class="fas fa-download fa-sm text-white-50"></i> Generate Report-->
            <!--</a>-->
        </div>

        <!-- Content Row -->
        <div class="row" hidden>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Fast Moving Products
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">View here</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Low Storage
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">View here</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Out of Stock
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">View here</div>
                                    </div>
                                    <!--<div class="col">-->
                                    <!--<div class="progress progress-sm mr-2">-->
                                    <!--<div class="progress-bar bg-info" role="progressbar" style="width: 50%"-->
                                    <!--aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>-->
                                    <!--</div>-->
                                    <!--</div>-->
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Over Stock
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    View here
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Today's Shipment
                            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm float-right">
                                <i class="fas fa-download fa-sm text-white-50"></i> Report
                            </a>
                        </h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                               <th>column1</th>
                               <th>column2</th>
                               <th>column3</th>
                               <th>column4</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>sample1</td>
                                    <td>sample2</td>
                                    <td>sample3</td>
                                    <td>sample4</td>
                                </tr>
                                <tr>
                                    <td>sample1</td>
                                    <td>sample2</td>
                                    <td>sample3</td>
                                    <td>sample4</td>
                                </tr>
                                <tr>
                                    <td>sample1</td>
                                    <td>sample2</td>
                                    <td>sample3</td>
                                    <td>sample4</td>
                                </tr>
                                <tr>
                                    <td>sample1</td>
                                    <td>sample2</td>
                                    <td>sample3</td>
                                    <td>sample4</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Shipment Returned
                            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm float-right">
                                <i class="fas fa-download fa-sm text-white-50"></i> Report
                            </a>
                        </h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                            <th>column1</th>
                            <th>column2</th>
                            <th>column3</th>
                            <th>column4</th>
                            </thead>
                            <tbody>
                            <tr>
                                <td>sample1</td>
                                <td>sample2</td>
                                <td>sample3</td>
                                <td>sample4</td>
                            </tr>
                            <tr>
                                <td>sample1</td>
                                <td>sample2</td>
                                <td>sample3</td>
                                <td>sample4</td>
                            </tr>
                            <tr>
                                <td>sample1</td>
                                <td>sample2</td>
                                <td>sample3</td>
                                <td>sample4</td>
                            </tr>
                            <tr>
                                <td>sample1</td>
                                <td>sample2</td>
                                <td>sample3</td>
                                <td>sample4</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Product Out Of Stock
                            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm float-right">
                                <i class="fas fa-download fa-sm text-white-50"></i> Report
                            </a>
                        </h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                            <th>column1</th>
                            <th>column2</th>
                            <th>column3</th>
                            <th>column4</th>
                            </thead>
                            <tbody>
                            <tr>
                                <td>sample1</td>
                                <td>sample2</td>
                                <td>sample3</td>
                                <td>sample4</td>
                            </tr>
                            <tr>
                                <td>sample1</td>
                                <td>sample2</td>
                                <td>sample3</td>
                                <td>sample4</td>
                            </tr>
                            <tr>
                                <td>sample1</td>
                                <td>sample2</td>
                                <td>sample3</td>
                                <td>sample4</td>
                            </tr>
                            <tr>
                                <td>sample1</td>
                                <td>sample2</td>
                                <td>sample3</td>
                                <td>sample4</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>