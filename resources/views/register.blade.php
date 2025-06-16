
<div class="main-content">
    <div class="page-header">
        <h2 class="header-title">{{ $title }}</h2>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif
    <div class="card">
        <div class="card-body">
        <form method="POST" action="{{ route('register.store') }}">
                @csrf
                <div class="form-group mb-3">
                    <label>Daftar Sebagai <span class="text-danger">*</span></label>
                    <select name="role" id="id_role" class="form-control"  onchange="toggleNRP()">
                        <option value="1">Mahasiswa</option>
                        <option value="2">Staf</option>
                        <option value="3">Dosen</option>
                    </select>
                </div>
                <div class="form-group mb-3" id="nrp_form">
                    <label>NRP <span class="text-danger">*</span></label>
                    <input type="text" name="nrp" class="form-control">
                </div>
                <div class="form-group mb-3" id="prodi_form">
                    <label>Program Studi<span class="text-danger">*</span></label>
                    <input type="text" name="prodi" class="form-control">
                </div>
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="name" class="form-control" required autofocus>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>No Telepon</label>
                    <input type="number" name="no_telepon" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <!-- <a href="{{route('register.store')}}"> <button type="button" class="btn btn-primary">Register</button></a> -->
                <button type="submit" class="btn btn-primary">Register</button>
                <a href="{{ route('login') }}" class="btn btn-link">Sudah punya akun? Login</a>
            </form>
        </div>
    </div>
</div>
<script>
    function toggleNRP() {
        var selectedRole = document.getElementById("id_role").value;
        var nrpForm = document.getElementById("nrp_form");
        var prodiForm = document.getElementById("prodi_form");

        if (selectedRole == "1") {
            nrpForm.style.display = "block";
            prodiForm.style.display = "block";
        } else {
            nrpForm.style.display = "none";
            prodiForm.style.display = "none";
        }
    }

    // Trigger saat halaman pertama kali dimuat
    window.onload = toggleNRP;
</script>
