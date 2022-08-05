<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <router-link to="/" class="brand-link">
        <img src="{{asset ('dist/img/logo.png') }}" alt="AdminLTE Logo" class="brand-image elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Antera Live</span>
    </router-link>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
            </div>
        </div> -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
       with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview menu-open">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-box"></i>
                        <p>
                            Inventory
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <router-link to="/inventory" class="nav-link ">
                                <i class="fas fa-boxes nav-icon green"></i>
                                <p>Data Inventory</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/kategori" class="nav-link ">
                                <i class="fas fa-clipboard-list nav-icon blue"></i>
                                <p>Data Kategori</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/lokasi" class="nav-link ">
                                <i class="fas fa-map-marker-alt nav-icon blue"></i>
                                <p>Lokasi</p>
                            </router-link>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-receipt"></i>
                        <p>
                            Manifest
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <router-link to="/manifest" class="nav-link ">
                                <i class="fas fa-cart-plus nav-icon green"></i>
                                <p>Data Manifest</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/barang-keluar" class="nav-link ">
                                <i class="fas fa-cart-plus nav-icon green"></i>
                                <p>Pengajuan Barang Keluar</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/qrstream" class="nav-link ">
                                <i class="fas fa-cart-arrow-down nav-icon blue"></i>
                                <p>Pengembalian Barang</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="modelselect" class="nav-link ">
                                <i class="fas fa-archive nav-icon orange"></i>
                                <p>History Manifest</p>
                            </router-link>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users-cog"></i>
                        <p>
                            Users
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <router-link to="/data-user" class="nav-link ">
                                <i class="fas fa-users nav-icon green"></i>
                                <p>Data User</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/data-level" class="nav-link ">
                                <i class="fas fa-layer-group nav-icon blue"></i>
                                <p>Data Level</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-sign-out-alt nav-icon red"></i>
                                <p>Logout</p>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
