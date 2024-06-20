<form action="{{ route('akuntan.kelompok.store') }}" method="post" enctype="multipart/form-data">
    <div class="modal fade" id="modalTambahKelompok" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">Tambah Kelompok Akun</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                @csrf
                <div class="mb-3">
                  <label for="exampleInputName" class="form-label">Nama Kelompok Akun</label>
                  <input type="text" class="form-control" name="nama" id="exampleInputName">
                  @error('nama')
                    <small>{{ $message }}</small>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="exampleInputName" class="form-label">Kode Kelompok Akun</label>
                  <input type="number" class="form-control" value="{{ $d->kode_kelompok_akun + 1; }}" name="no" id="exampleInputName">
                  @error('no')
                    <small>{{ $message }}</small>
                  @enderror
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
              <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
  
  