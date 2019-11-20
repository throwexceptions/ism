<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Admin Panel</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="JavaScript:void(0);" v-on:click="panel=1" v-show="permission['view-dashboard']">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Nav Item - Batch  -->
    <li class="nav-item">
        <a class="nav-link" href="JavaScript:void(0);" v-on:click="panel=2">
            <i class="fas fa-fw fa-balance-scale"></i>
            <span>Supplier</span></a>
    </li>

    <!-- Nav Item - Batch  -->
    <li class="nav-item">
        <a class="nav-link" href="JavaScript:void(0);" v-on:click="panel=3">
            <i class="fas fa-fw fa-building"></i>
            <span>Costumers</span></a>
    </li>

    <!-- Nav Item - Products -->
    <li class="nav-item">
        <a class="nav-link" href="JavaScript:void(0);" v-on:click="panel=4">
            <i class="fas fa-fw fa-project-diagram"></i>
            <span>Products</span></a>
    </li>
    <!-- Nav Item - Batch  -->
    <li class="nav-item">
        <a class="nav-link" href="JavaScript:void(0);" v-on:click="panel=5">
            <i class="fas fa-fw fa-boxes"></i>
            <span>Receiving</span></a>
    </li>

    <!-- Nav Item - Batch  -->
    <li class="nav-item">
        <a class="nav-link" href="JavaScript:void(0);" v-on:click="panel=6">
            <i class="fas fa-fw fa-truck"></i>
            <span>Shipment</span></a>
    </li>

    <!-- Nav Item - Batch  -->
    <li class="nav-item">
        <a class="nav-link" href="JavaScript:void(0);" v-on:click="panel=7">
            <i class="fas fa-fw fa-users"></i>
            <span>Users</span></a>
    </li>

    <!-- Nav Item - Batch  -->
    <li class="nav-item">
        <a class="nav-link" href="JavaScript:void(0);" v-on:click="panel=8">
            <i class="fas fa-fw fa-history"></i>
            <span>Logs</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    {{--<!-- Heading -->--}}
    {{--<div class="sidebar-heading">--}}
        {{--Interface--}}
    {{--</div>--}}

    {{--<!-- Nav Item - Pages Collapse Menu -->--}}
    {{--<li class="nav-item">--}}
        {{--<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"--}}
           {{--aria-expanded="true" aria-controls="collapseTwo">--}}
            {{--<i class="fas fa-fw fa-cog"></i>--}}
            {{--<span>Components</span>--}}
        {{--</a>--}}
        {{--<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">--}}
            {{--<div class="bg-white py-2 collapse-inner rounded">--}}
                {{--<h6 class="collapse-header">Custom Components:</h6>--}}
                {{--<a class="collapse-item" href="buttons.html">Buttons</a>--}}
                {{--<a class="collapse-item" href="cards.html">Cards</a>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</li>--}}

    {{--<!-- Divider -->--}}
    {{--<hr class="sidebar-divider">--}}



    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>