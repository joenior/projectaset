@extends('layouts.main')

@section('content')

<div class="row">
    <div class="col-md-10 mx-auto">
        <a class="btn btn-secondary float-end" href="/datauser/" role="button"><i class="bi bi-arrow-left"></i> Kembali</a>
        <h1 class="h3 mb-4">Tambah User Baru</h1>
       
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <form action="/datauser" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                        <i class="bi bi-eye-slash-fill"></i>
                                    </button>
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="Roles" class="form-label">Roles</label>
                                <select class="form-select @error('Roles') is-invalid @enderror" aria-label="Default select example" name="Roles" id="Roles">
                                    <option value="admin" selected>Admin</option>
                                </select>
                                @error('Roles')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="gedung" class="form-label">Gedung</label>
                                <select class="form-select" aria-label="Default select example" id="gedung" name="gedung_id">
                                    @foreach ($gedungs as $gedung)
                                        @if (old('gedung_id') == $gedung->id)
                                            <option value="{{ $gedung->id }}" selected>{{ $gedung->nama_gedung }}</option>
                                        @else
                                            <option value="{{ $gedung->id }}">{{ $gedung->nama_gedung }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="lantai" class="form-label">Lantai</label>
                                <select class="form-select" aria-label="Default select example" id="lantai" name="lantai_id">
                                    @foreach ($lantais as $lantai)
                                        @if (old('lantai_id') == $lantai->id)
                                            <option value="{{ $lantai->id }}" selected>{{ $lantai->nama_lantai }}</option>
                                        @else
                                            <option value="{{ $lantai->id }}">{{ $lantai->nama_lantai }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="ruangan" class="form-label">Ruangan</label>
                                <select class="form-select" aria-label="Default select example" id="ruangan" name="ruangan_id">
                                    @foreach ($ruangans as $ruangan)
                                        @if (old('ruangan_id') == $ruangan->id)
                                            <option value="{{ $ruangan->id }}" selected>{{ $ruangan->nama_ruangan }}</option>
                                        @else
                                            <option value="{{ $ruangan->id }}">{{ $ruangan->nama_ruangan }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary float-end">Simpan</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');

    togglePassword.addEventListener('click', function (e) {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.querySelector('i').classList.toggle('bi-eye-fill');
        this.querySelector('i').classList.toggle('bi-eye-slash-fill');
    });
</script>

@endsection