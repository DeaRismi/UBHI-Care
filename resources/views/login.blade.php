<div class="main-content">
    <div class="page-header">
        <h2 class="header-title">{{ $title }}</h2>
    </div>
    @if (session('succ_msg'))
        <div class="alert alert-success">
            {{ session('succ_msg') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route ('login_auth') }}">
                @csrf
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required autofocus>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <!-- <a href="{{ url('login_auth') }}"> -->
                <button type="submit" class="btn btn-primary">Login</button>
            <!-- </a> -->
                <a href="{{ route('register') }}" class="btn btn-link">Belum punya akun? Register</a>
            </form>
        </div>
    </div>
</div>