<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: rgb(67, 100, 191);">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" style="background-color: white;" href="<?= base_url('auth'); ?>">
        <div class="sidebar-brand-icon">
            <img src=<?= base_url('assets/img/logo3.png'); ?> alt="PT Honicel Indonesia" class="card-img-top" style="width: 57px">
        </div>
        <div class="sidebar-brand-text">
            <img src=<?= base_url('assets/img/text.png'); ?> alt="PT Honicel Indonesia" class="card-img-top" style="width: 130px">
        </div>
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Query Menu -->
    <?php
    $role_id = $this->session->userdata('role');
    $querymenu = "SELECT user_menu.id, menu 
                  FROM user_menu JOIN user_access_menu
                  ON user_menu.id=user_access_menu.menu_id
                  WHERE user_access_menu.role_id = $role_id 
                  ORDER BY user_access_menu.menu_id ASC";
    $menu = $this->db->query($querymenu)->result_array();
    ?>

    <!-- Looping Menu -->

    <?php foreach ($menu as $m) : ?>
        <div class="sidebar-heading mt-3">
            <?= $m['menu']; ?>
        </div>

        <!-- SIAPKAN SUB MENU SESUAI MENU -->
        <?php
        $menuid = $m['id'];
        $querysubmenu = "SELECT * FROM user_sub_menu
                         WHERE menu_id = $menuid AND is_active = 1 ";
        $submenu = $this->db->query($querysubmenu)->result_array();
        ?>
        <?php foreach ($submenu as $sb) : ?>
            <?php if ($title == $sb['title']) : ?>
                <!-- Nav Item - Dashboard -->
                <li class="nav-item active">
                <?php else : ?>
                <li class="nav-item ">
                <?php endif; ?>
                <a class="nav-link" href="<?= base_url($sb['url']); ?>">
                    <i class="<?= $sb['icon']; ?>"></i>
                    <span><?= $sb['title']; ?></span></a>
                </li>

            <?php endforeach ?>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">

        <?php endforeach ?>




        <li class="nav-item">
            <a class="nav-link" href="" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-fw fa-sign-out-alt"></i>
                <span>Logout</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

</ul>
<!-- End of Sidebar -->