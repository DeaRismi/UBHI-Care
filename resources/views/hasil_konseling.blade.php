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
            <label class="card-title mb-3" style="font-size: 20px">Hasil Konseling</label>

            <div class="row mb-3">
                <div class="col-12">
                    <input type="text" id="searchInput" class="form-control" placeholder="Cari berdasarkan NRP atau Nama Mahasiswa">
                </div>
            </div>

            <div class="row">



                <div class="table-responsive">
                    <table class="table table-bordered w-100" id="dtTable">
                        <thead>
                            <tr>
                                <th>NRP</th>
                                <th>Nama</th>
                                <th>Tanggal</th>
                                <th>Waktu</th>
                                <th>Status</th>

                                <th>
                                    Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($hasil_konseling as $item)
                            <tr>
                                <td> {{$item->NRP}}</td>
                                <td> {{$item->NAMA_MAHASISWA}}</td>
                                <td> {{$item->TANGGAL_KOSONG}}</td>
                                <td> {{$item->WAKTU_KOSONG}}</td>
                                <td> {{$item->STATUS_PENGAJUAN}}</td>
                                <td>
                                    @if($item->STATUS_PENGAJUAN=='Mengajukan')

                                    <button type="button"
                                        class="btn btn-input-hasil waves-effect waves-light"
                                        data-json='<?= htmlspecialchars(json_encode($item), ENT_QUOTES, 'UTF-8') ?>'
                                        onclick="openInputHasil(this)">
                                        Input Hasil
                                    </button>

                                    @endif
                                    <!-- Tombol Riwayat Hasil: warna biru -->
                                     <form  action="{{ url('riwayat') }}" method="POST" enctype="multipart/form-data">

                 @csrf
    <input type="hidden" name="id_mahasiswa" id="id_mahasiswa" value="{{ $item->NRP }}">
    <button type="submit" class="btn btn-info waves-effect waves-light">
        Riwayat Hasil
    </button>
                                     </form>
                                    <!-- Tombol Hasil: warna hijau -->
                                    <button type="button"
                                        data-json='<?= htmlspecialchars(json_encode($item), ENT_QUOTES, 'UTF-8') ?>'
                                        onclick="openHasil(this)"
                                        class="btn btn-success waves-effect waves-light">
                                        Hasil
                                    </button>

                                </td>
                            </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="openInputHasil" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Input Hasil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-user" action="hasil_konseling/insert" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id_pengajuan" id="id_pengajuan" value="{{ $item->ID_PENGAJUAN }}">


                        <div class="form-group mb-3">
                            <label> Nama <span class="text-danger">*</span></label>
                            <input placeholder="Nama" type="text" name="nama" class="form-control" disabled>
                        </div>
                        <div class="form-group mb-3">
                            <label>NRP <span class="text-danger">*</span></label>
                            <input placeholder="NRP" type="number" name="nrp" class="form-control" disabled>
                        </div>

                        <div class="form-group mb-3">
                            <label>Program Studi<span class="text-danger">*</span></label>
                            <input placeholder="Program Studi" type="text" name="prodi" class="form-control" disabled>
                        </div>

                        <div class="form-group mb-3">
                            <label>Keluhan <span class="text-danger">*</span></label>
                            <input placeholder="Keluhan" type="text" name="keluhan" class="form-control" disabled>
                        </div>
                        <div class="form-group mb-3">
                            <label>Hasil Konseling<span class="text-danger">*</span></label>
                            <input placeholder="Keluhan" type="text" name="hasil_konseling" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label>Catatan Tambahan<span class="text-danger">*</span></label>
                            <input placeholder="Keluhan" type="text" name="catatan_tambahan" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Tambahkan</button>

                        </div>

                    </div>

                </form>
            </div>
        </div>
    </div>
    <div class="modal" id="openHasil" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hasil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-user" action="hasil_konseling/gethasil" method="GET" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id_konseling" value="" readonly>
                        <div class="form-group mb-3">
                            <label>Hasil Konseling<span class="text-danger">*</span></label>
                            <input placeholder="Keluhan" id="hasil_konseling" name="hasil_konseling" class="form-control" disabled>
                        </div>
                        <div class="form-group mb-3">
                            <label>Catatan Tambahan<span class="text-danger">*</span></label>
                            <input id="catatan_tambahan" placeholder="Keluhan" type="text" name="catatan_tambahan" class="form-control" disabled>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <script>
        function openInputHasil(button) {
            var data = JSON.parse(button.getAttribute('data-json'));
            console.log(data);
            $('input[name="nama"]').val(data.NAMA_MAHASISWA);
            $('input[name="nrp"]').val(data.NRP);
            $('input[name="prodi"]').val(data.PRODI);
            $('input[name="id_pengajuan"]').val(data.ID_PENGAJUAN);
            $('input[name="keluhan"]').val(data.DESKRIPSI_KELUHAN);
            $('#openInputHasil').modal('show');
        }

        function openHasil(button) {
            const data = JSON.parse(button.getAttribute('data-json'));
            console.log(data);

            if (data.HASIL_KONSELING && data.CATATAN_KONSELING) {
                $('#hasil_konseling').val(data.HASIL_KONSELING);
                $('#catatan_tambahan').val(data.CATATAN_KONSELING); // or CATATAN_TAMBAHAN if your DB uses that
                $('#id_konseling').val(data.ID_KONSELING);
                $('#openHasil').modal('show');
            } else {
                // Fetch via AJAX if not in data-json
                $.get('hasil_konseling/gethasil', {
                    id_konseling: data.ID_KONSELING
                }, function(response) {
                    if (response.data) {
                        $('#hasil_konseling').val(response.data.HASIL_KONSELING);
                        $('#catatan_tambahan').val(response.data.CATATAN_KONSELING);
                        $('#id_konseling').val(data.ID_KONSELING);
                        $('#openHasil').modal('show');
                    }
                });
            }
        }

        // Pencarian dinamis by NRP atau Nama
        $('#searchInput').on('keyup', function() {
            var value = $(this).val().toLowerCase();
            $('#dtTable tbody tr').filter(function() {
                $(this).toggle(
                    $(this).text().toLowerCase().indexOf(value) > -1
                );
            });
        });
    </script>
