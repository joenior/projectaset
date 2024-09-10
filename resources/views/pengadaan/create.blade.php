@extends('layouts.main')

@section('content')

<div class="row">
    <div class="col-md-10 mx-auto">
        <a class="btn btn-secondary float-end" href="/pengadaan/" role="button"><i class="bi bi-arrow-left"></i> Kembali</a>
        <h1 class="h3 mb-4">Pengajuan Permintaan Barang</h1>
       
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <form id="pengadaan-form" action="/pengadaan" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                            <div id="permintaan-container">
                                <div class="permintaan-item">
                                    <div class="mb-3">
                                        <label for="nama_pengadaan_0" class="form-label">Nama Barang</label>
                                        <input type="text" class="form-control @error('nama_pengadaan') is-invalid @enderror" id="nama_pengadaan_0" name="nama_pengadaan[]" required>
                                        @error('nama_pengadaan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="quantity_0" class="form-label">Jumlah</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity_0" name="quantity[]" required>
                                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Satuan</button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li><a class="dropdown-item" href="#" onclick="setUnit(this, 'buah')">Buah</a></li>
                                                <li><a class="dropdown-item" href="#" onclick="setUnit(this, 'lembar')">Lembar</a></li>
                                                <li><a class="dropdown-item" href="#" onclick="setUnit(this, 'unit')">Unit</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li>
                                                    <div class="input-group px-2">
                                                        <input type="text" class="form-control new-unit-input" id="new_unit_0" name="new_unit[]" placeholder="Tambah Unit Baru">
                                                        <button class="btn btn-outline-secondary" type="button" onclick="addNewUnit(this)">Tambah</button>
                                                    </div>
                                                </li>
                                            </ul>
                                            <input type="hidden" name="unit[]" id="unit_0" required>
                                        </div>
                                        <div class="invalid-feedback d-none" id="unit-error-0">Satuan harus dipilih.</div>
                                        @error('quantity')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-secondary mb-3" id="add-permintaan">Tambah Permintaan</button>

                            <div class="mb-3">
                                <label for="tanggal_pengajuan" class="form-label">Tanggal Permintaan</label>
                                <input class="form-control" type="text" id="tanggal_pengajuan" value="{{ date('d/m/Y') }}" aria-label="Disabled input example" name="tanggal_pengajuan" disabled readonly>
                            </div>

                            <div class="mb-3">
                                <label for="gedung" class="form-label">Gedung</label>
                                <select class="form-select" aria-label="Default select example" id="gedung" name="gedung_id" required>
                                    <option value="" disabled selected>Pilih Gedung</option>
                                    @foreach ($gedungs as $gedung)
                                        <option value="{{ $gedung->id }}">{{ $gedung->nama_gedung }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="lantai" class="form-label">Lantai</label>
                                <select class="form-select" aria-label="Default select example" id="lantai" name="lantai_id" required>
                                    <option value="" disabled selected>Pilih Lantai</option>
                                    @foreach ($lantais as $lantai)
                                        <option value="{{ $lantai->id }}">{{ $lantai->nama_lantai }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="ruangan" class="form-label">Ruangan</label>
                                <select class="form-select" aria-label="Default select example" id="ruangan" name="ruangan_id" required>
                                    <option value="" disabled selected>Pilih Ruangan</option>
                                    @foreach ($ruangans as $ruangan)
                                        <option value="{{ $ruangan->id }}">{{ $ruangan->nama_ruangan }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" id="deskripsi" cols="30" rows="10" required></textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
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
    function setUnit(element, unit) {
        var inputGroup = element.closest('.input-group');
        console.log('setUnit called with unit:', unit);
        if (inputGroup) {
            var dropdownToggle = inputGroup.querySelector('.dropdown-toggle');
            var hiddenInput = inputGroup.querySelector('input[type="hidden"]');
            console.log('inputGroup found:', inputGroup);
            if (dropdownToggle && hiddenInput) {
                console.log('dropdownToggle and hiddenInput found:', dropdownToggle, hiddenInput);
                dropdownToggle.textContent = unit;
                hiddenInput.value = unit;
                // Hide error message if unit is selected
                var errorElement = inputGroup.querySelector('.invalid-feedback');
                if (errorElement) {
                    errorElement.classList.add('d-none');
                }
            } else {
                console.error('dropdownToggle or hiddenInput not found');
            }
        } else {
            console.error('inputGroup not found');
        }
    }

    function addNewUnit(button) {
        var inputGroup = button.closest('.input-group');
        console.log('addNewUnit called');
        var newUnitInput = inputGroup.querySelector('.new-unit-input');
        var newUnit = newUnitInput.value.trim();
        console.log('newUnit:', newUnit);

        if (newUnit) {
            // Find the correct inputGroup to set the unit
            var parentInputGroup = button.closest('.permintaan-item').querySelector('.input-group');
            setUnit(parentInputGroup.querySelector('.dropdown-toggle'), newUnit);
            newUnitInput.value = '';
        } else {
            console.error('newUnit is empty');
        }
    }

    document.getElementById('add-permintaan').addEventListener('click', function() {
        var container = document.getElementById('permintaan-container');
        var newItem = document.querySelector('.permintaan-item').cloneNode(true);
        var itemCount = document.querySelectorAll('.permintaan-item').length;
        console.log('add-permintaan clicked, itemCount:', itemCount);

        newItem.querySelectorAll('input').forEach(function(input) {
            var newId = input.id.split('_')[0] + '_' + itemCount;
            input.id = newId; // Update the id attribute
            input.name = input.name.split('[')[0] + '[]'; // Ensure the name attribute is unique
            input.value = ''; // Clear the value of cloned inputs
            console.log('Updated input:', input);
        });

        newItem.querySelectorAll('label').forEach(function(label) {
            var newFor = label.htmlFor.split('_')[0] + '_' + itemCount;
            label.htmlFor = newFor; // Update the for attribute
            console.log('Updated label:', label);
        });

        // Update the new unit input id and name
        var newUnitInput = newItem.querySelector('.new-unit-input');
        if (newUnitInput) {
            newUnitInput.id = 'new_unit_' + itemCount;
            newUnitInput.name = 'new_unit[]';
            console.log('Updated newUnitInput:', newUnitInput);
        } else {
            console.error('newUnitInput not found in newItem');
        }

        // Add error message element for new item
        var errorElement = document.createElement('div');
        errorElement.className = 'invalid-feedback d-none';
        errorElement.id = 'unit-error-' + itemCount;
        errorElement.textContent = 'Satuan harus dipilih.';
        newItem.querySelector('.input-group').appendChild(errorElement);

        container.appendChild(newItem);
        console.log('newItem appended to container');
    });

    document.getElementById('pengadaan-form').addEventListener('submit', function(event) {
        var isValid = true;
        document.querySelectorAll('input[type="hidden"][name="unit[]"]').forEach(function(input, index) {
            if (!input.value) {
                var errorElement = document.getElementById('unit-error-' + index);
                if (errorElement) {
                    errorElement.classList.remove('d-none');
                }
                isValid = false;
            }
        });

        if (!isValid) {
            event.preventDefault();
        }
    });
</script>

@endsection