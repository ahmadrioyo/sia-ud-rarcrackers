<form action="{{ route('akuntan.akun.store') }}" method="post" enctype="multipart/form-data">
    <div class="modal fade" id="modalTambahAkun" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">Tambah Akun</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputName" class="form-label">Kelompok Akun</label>
                    <select class="custom-select" name="kelompok_akun" id="kelompok_akun">
                      <option selected disabled>---</option>
                      @foreach ($kelompok as $item)
                          <option value="{{ $item->id }}">{{ $item->nama_kelompok_akun }}</option>
                      @endforeach
                    </select>
                    @error('kelompok_akun')
                      <small>{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="exampleInputName" class="form-label">Tipe Akun</label>
                    <select class="custom-select" name="tipe_akun" id="tipe_akun">
                      <option selected disabled>---</option>
                      @foreach ($tipe as $d)
                          <option value="{{ $d->id }}">{{ $d->nama_tipe_akun }}</option>
                      @endforeach
                    </select>
                    @error('tipe_akun')
                      <small>{{ $message }}</small>
                    @enderror
                </div>                
                <div class="mb-3">
                  <label for="exampleInputName" class="form-label">Nama Akun</label>
                  <input type="text" class="form-control" name="nama" id="exampleInputName">
                  @error('nama')
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