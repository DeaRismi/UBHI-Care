<!-- Content Wrapper START -->
<div class="main-content">
    <div class="page-header">
        <h2 class="header-title"><?= $title ?></h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="<?= url('hasil_konseling') ?>" class="breadcrumb-item"><i
                        class="anticon anticon-home m-r-5"></i>Home</a>
                <span class="breadcrumb-item active"><?= $title ?></span>
            </nav>
        </div>
    </div>
    <?php if (!empty(session('err_msg'))) { ?>
        <div class="alert alert-danger">
            <div class="d-flex align-items-center justify-content-start">
                <span class="alert-icon">
                    <i class="anticon anticon-check-o"></i>
                </span>
                <span><?= session('err_msg') ?></span>
            </div>
        </div>
        <?php } ?>
        <?php if (!empty(session('succ_msg'))) { ?>
        <div class="alert alert-success">
            <div class="d-flex align-items-center justify-content-start">
                <span class="alert-icon">
                    <i class="anticon anticon-check-o"></i>
                </span>
                <span><?= session('succ_msg') ?></span>
            </div>
        </div>
        <?php } ?>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 align-self-center">
                    <label class="card-title" style="font-size: 20px">Jadwal Kosong</label>
                </div>
                
            </div>
            <div class="m-t-25">
                <table class="table mb-0" id="dtTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                            <th>Action</th>>
                        </tr>
                    </thead>
                    <tbody>
    <?php $no = 1; ?>
   
    @foreach ($jadwal_kosong as $jadwal)
        <tr>
            <td><?= $no++ ?></td>
        
            <td>{{ \Carbon\Carbon::parse($jadwal->TANGGAL_KOSONG)->translatedFormat('j F Y') }}</td>
            <td><?= $jadwal->WAKTU_KOSONG ?></td>
            <td>
                <button class="btn btn-primary btn-sm" onclick="openviewModal (`<?= htmlentities(json_encode(array_merge((array) $jadwal,(array) $user ))) ?>`)">Ajukan</button>
            </td>
        </tr>
    @endforeach
</tbody>

                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="openviewModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pengajuan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-user" action="pengajuan/store" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                <input type="hidden" name="id_pengajuan" value="" readonly>
                   
                    <div class="form-group mb-3">
                        <label> Nama <span class="text-danger">*</span></label>
                        <input placeholder="Nama" type="text" name="nama" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label>NRP <span class="text-danger">*</span></label>
                        <input placeholder="NRP" type="number" name="nrp" class="form-control" required>
                    </div>
                 
                    <div class="form-group mb-3">
                        <label>Program Studi<span class="text-danger">*</span></label>
                        <input placeholder="Program Studi" type="text" name="prodi" class="form-control" required>
                    </div>

                    <div class="form-group mb-3">
                        <label>Kategori Keluhan <span class="text-danger">*</span></label>
                        <select name="kategori_keluhan" id="id_keluhan" class="form-control">
                            <option value="Akademik">Akademik</option>
                            <option value="Jarang Masuk">Jarang Masuk</option>
                            <option value="Pribadi">Pribadi</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label>Keluhan<span class="text-danger">*</span></label>
                        <input placeholder="Keluhan" type="text" name="keluhan" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    
    
    function openviewModal(viewData) {
        var data = JSON.parse(viewData);
        console.log(data);
        $('input[name="nama"]').val(data.name);
        $('input[name="nrp"]').val(data.NRP);
        $('input[name="prodi"]').val(data.PRODI);
        $('input[name="id_pengajuan"]').val(data.ID_JADWAL_KOSONG);
        $('#openviewModal').modal('show')
    }
</script>
