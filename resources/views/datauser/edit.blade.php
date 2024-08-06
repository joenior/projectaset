@extends('layouts.main')

@section('content')
    <h1 class="h3 mb-4">Edit Data User</h1>
    <div class="row">
        <div class="col-md-10 mx-auto">
            <a class="btn btn-secondary float-end" href="/datauser/" role="button"><i class="bi bi-arrow-left"></i> Kembali</a>
            <div class="card">
                <div class="card-body">
                    <form action="/datauser/{{ $user->id }}" method="POST" enctype="multipart/form-data">
                        @method('put')
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="Roles" class="form-label">Roles</label>
                            <select class="form-select @error('Roles') is-invalid @enderror" aria-label="Default select example" name="Roles" id="Roles">
                                <option value="admin" {{ old('Roles', $user->Roles) == 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                            @error('Roles')
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
                            <label for="gedung" class="form-label">Gedung</label>
                            <select class="form-select" aria-label="Default select example" id="gedung" name="gedung_id">
                                @foreach ($gedungs as $gedung)
                                    <option value="{{ $gedung->id }}" {{ old('gedung_id', $user->gedung_id) == $gedung->id ? 'selected' : '' }}>{{ $gedung->nama_gedung }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="lantai" class="form-label">Lantai</label>
                            <select class="form-select" aria-label="Default select example" id="lantai" name="lantai_id">
                                @foreach ($lantais as $lantai)
                                    <option value="{{ $lantai->id }}" {{ old('lantai_id', $user->lantai_id) == $lantai->id ? 'selected' : '' }}>{{ $lantai->nama_lantai }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="ruangan" class="form-label">Ruangan</label>
                            <select class="form-select" aria-label="Default select example" id="ruangan" name="ruangan_id">
                                @foreach ($ruangans as $ruangan)
                                    <option value="{{ $ruangan->id }}" {{ old('ruangan_id', $user->ruangan_id) == $ruangan->id ? 'selected' : '' }}>{{ $ruangan->nama_ruangan }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary float-end">Simpan</button>

                    </form>
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