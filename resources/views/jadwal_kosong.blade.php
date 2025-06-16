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
                <div class="col-md-6 d-flex justify-content-md-end justify-content-end align-items-center">
                    <div class="mt-3 mt-md-0">
                        <button type="button" class="btn btn-primary" onclick="addModal()">
                            <i class="mdi mdi-plus me-1"></i>
                            Add Jadwal</button>
                    </div>
                </div>
            </div>
            <div class="m-t-25">
                <table class="table mb-0" id="dtTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $number = 0; ?>

                        @foreach ($jadwal as $item)
                            <?php $number++; ?>
                            <tr>
                                <td><?= $number ?></td>
                                <td><?= $item->TANGGAL_KOSONG ?></td>
                            
                                <td><?= $item->WAKTU_KOSONG ?></td>
                                <td><?= $item->STATUS ==0?'Ada':'Tidak ada'?></td>
                                <td>
                                    
                                    <button type="button"
                                        onclick="opendeleteModal(<?= htmlentities(json_encode($item)) ?>)"
                                        class="btn btn-subtle-danger waves-effect waves-light">
                                        <i class="bx bx-trash font-size-16 align-middle"></i>
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

{{-- Start Modal Add --}}
<div class="modal" id="updateModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Ebook</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-user" action="jadwal_kosong/insert" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
            
                   
                    <div class="form-group mb-3">
                        <label> Tanggal Kosong <span class="text-danger">*</span></label>
                        <input placeholder="10000" type="date" name="tanggal_kosong" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label>Waktu Kosong <span class="text-danger">*</span></label>
                        <input placeholder="Genre" type="time" name="waktu_kosong" class="form-control" required>
                    </div>
                 
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal" id="addModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Jadwal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-user" action="jadwal_kosong/insert" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
            
                   
                    <div class="form-group mb-3">
                        <label> Tanggal Kosong <span class="text-danger">*</span></label>
                        <input placeholder="10000" type="date" name="tanggal_kosong" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label>Waktu Kosong <span class="text-danger">*</span></label>
                        <input placeholder="Genre" type="time" name="waktu_kosong" class="form-control" required>
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
    $('#dtTable').DataTable()
    function addModal() {
        $('#addModal').modal('show')
    }
</script>
