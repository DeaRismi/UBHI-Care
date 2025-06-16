<div class="side-nav">
    <div class="side-nav-inner">
        <ul class="side-nav-menu scrollable">
            <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="<?= url('dashboard') ?>"
                    style="<?= $title == 'Dashboard' ? 'color: #4b94f7 ; background-color: #e2edfe' : '' ?>;">
                    <span class="icon-holder">
                        <i class="anticon anticon-dashboard"
                            style="<?= $title == 'Dashboard' ? 'color: #4b94f7;' : '' ?>;"></i>
                    </span>
                    <span class="title">Dashboard</span>
                </a>
            </li>
            @if(session('users')[0]['id_role'] == 1)

                <li class="nav-item dropdown">
                    <a class="dropdown-toggle" href="<?= url('/pengajuan') ?>"
                        style="<?= $title == 'Pengajuan' ? 'color: #4b94f7 ; background-color: #e2edfe' : '' ?>;">
                        <span class="icon-holder">
                            <i class="anticon anticon-book" style="<?= $title == 'Pengajuan' ? 'color: #4b94f7;' : '' ?>;"></i>
                        </span>
                        <span class="title">Pengajuan</span>
                        <span class="arrow">
                        </span>
                    </a>
                </li>
            @endif
            @if(session('users')[0]['id_role'] == 2)
                <li class="nav-item dropdown">
                    <a class="dropdown-toggle" href="<?= url('jadwal_kosong') ?>"
                        style="<?= $title == 'Jadwal Kosong' ? 'color: #4b94f7 ; background-color: #e2edfe' : '' ?>;">
                        <span class="icon-holder">
                            <i class="anticon anticon-book" style="<?= $title == 'Jadwal Kosong' ? 'color: #4b94f7;' : '' ?>;"></i>
                        </span>
                        <span class="title">Jadwal Kosong</span>
                        <span class="arrow">
                        </span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="dropdown-toggle" href="<?= url('hasil_konseling') ?>"
                        style="<?= $title == 'Hasil Konseling' ? 'color: #4b94f7 ; background-color: #e2edfe' : '' ?>;">
                        <span class="icon-holder">
                            <i class="anticon anticon-gold"
                                style="<?= $title == 'Hasil Konseling' ? 'color: #4b94f7;' : '' ?>;"></i>
                        </span>
                        <span class="title">Hasil Konseling</span>
                        <span class="arrow">
                        </span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="dropdown-toggle" href="<?= url('pemanggilan') ?>"
                        style="<?= $title == 'Pemanggilan' ? 'color: #4b94f7 ; background-color: #e2edfe' : '' ?>;">
                        <span class="icon-holder">
                            <i class="anticon anticon-user" style="<?= $title == 'Pemanggilan' ? 'color: #4b94f7;' : '' ?>;"></i>
                        </span>
                        <span class="title">Pemanggilan</span>
                    </a>
                </li>
            @endif
            @if(session('users')[0]['id_role'] == 3)
                <li class="nav-item dropdown">
                    <a class="dropdown-toggle" href="<?= url('saran_pemanggilan') ?>"
                        style="<?= $title == 'Saranf' ? 'color: #4b94f7 ; background-color: #e2edfe' : '' ?>;">
                        <span class="icon-holder">
                            <i class="anticon anticon-check" style="<?= $title == 'Saran' ? 'color: #4b94f7;' : '' ?>;"></i>
                        </span>
                        <span class="title">Saran</span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="dropdown-toggle" href="<?= url('hasil_konseling') ?>"
                        style="<?= $title == 'Hasil Konseling' ? 'color: #4b94f7 ; background-color: #e2edfe' : '' ?>;">
                        <span class="icon-holder">
                            <i class="anticon anticon-gold"
                                style="<?= $title == 'Hasil Konseling' ? 'color: #4b94f7;' : '' ?>;"></i>
                        </span>
                        <span class="title">Hasil Konseling</span>
                        <span class="arrow">
                        </span>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</div>
<!-- Side Nav END -->

<!-- Page Container START -->


<!-- Page Container START -->
<div class="page-container">