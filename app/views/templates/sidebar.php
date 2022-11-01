<div class="container sidebar">
    <div class="row">
        <div class="col-1 col-sm-1 col-md-3">

            <ul class="nav flex-column">
                <?php if ($_SESSION['level'] == 0) : ?>


                    <li class="nav-item pb-2">
                        <a class="nav-link <?php if ($data['halaman'] == 'dashboard') : echo 'active';
                                            endif; ?>" aria-current="page" href="<?= BASEURL ?>Dashboardupbu">
                            <i class="fas fa-tachometer-alt"></i>
                            <label class="d-none d-sm-none  d-md-inline-block" for="">Dashboard</label>
                        </a>
                    </li>
                    <li class="nav-item pb-2">
                        <a class="nav-link <?php if ($data['halaman'] == 'tenan') : echo 'active';
                                            endif; ?>" href="<?= BASEURL ?>Dashboardupbu/tenan">
                            <i class="fas fa-store-alt"></i>
                            <label class="d-none d-sm-none  d-md-inline-block" for="">Tenan
                            </label>
                        </a>
                    </li>

                    <li class="nav-item pb-2">
                        <a class="nav-link <?php if ($data['halaman'] == 'billingtenan') : echo 'active';
                                            endif; ?>" href="<?= BASEURL ?>Dashboardupbu/billingtenan">
                            <i class="fas fa-file-invoice-dollar"></i>
                            <label class="d-none d-sm-none  d-md-inline-block" for="">Tagihan & Billing</label>
                        </a>
                    </li>



                    <li class="nav-item pb-2">
                        <a class="nav-link <?php if ($data['halaman'] == 'akuntenan') : echo 'active';
                                            endif; ?>" href="<?= BASEURL ?>Dashboardupbu/akuntenan">
                            <i class="fas fa-users"></i>
                            <label class="d-none d-sm-none  d-md-inline-block" for="">Akun Tenan</label>
                        </a>
                    </li>
                    <li class="nav-item pb-2">
                        <a class="nav-link <?php if ($data['halaman'] == 'profil') : echo 'active';
                                            endif; ?>" href="<?= BASEURL ?>Dashboardupbu/profil">
                            <i class="fas fa-user-cog"></i>
                            <label class="d-none d-sm-none  d-md-inline-block" for="">
                                Profil Setting
                            </label>
                        </a>
                    </li>

                    <li class="nav-item pb-2">
                        <a class="nav-link <?php if ($data['halaman'] == 'keluar') : echo 'active';
                                            endif; ?>" href="<?= BASEURL ?>logout/logout">
                            <i class="fas fa-power-off"></i>
                            <label class="d-none d-sm-none  d-md-inline-block" for="">
                                Keluar</label>
                        </a>
                    </li>


                <?php elseif ($_SESSION['level'] == 1) : ?>

                    <li class="nav-item pb-2">
                        <a class="nav-link <?php if ($data['halaman'] == 'dashboard') : echo 'active';
                                            endif; ?>" aria-current="page" href="<?= BASEURL ?>dashboard">
                            <i class="fas fa-tachometer-alt"></i>
                            <label class="d-none d-sm-none  d-md-inline-block" for="">
                                Dashboard
                            </label>
                        </a>
                    </li>

                    <li class="nav-item pb-2">
                        <a class="nav-link <?php if ($data['halaman'] == 'keluar') : echo 'active';
                                            endif; ?>" href="<?= BASEURL ?>logout/logout">
                            <i class="fas fa-power-off"></i>
                            <label class="d-none d-sm-none  d-md-inline-block" for="">
                                Keluar</label>
                        </a>
                    </li>


                <?php elseif ($_SESSION['level'] == 2) : ?>

                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>