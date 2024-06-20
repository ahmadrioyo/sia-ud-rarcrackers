<div class="modal fade" id="modalEdit{{ $d->id }}" data-backdrop="static" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <form action="{{ route('akuntan.kelompok.update',['id' => $d->id]) }}" method="post" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Edit Kelompok Akun</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          @csrf
          @method('put')
          <div class="mb-3">
            <label for="exampleInputName" class="form-label">Kode Kelompok Akun</label>
            <input type="number" class="form-control" name="no" value="{{ $d->kode_kelompok_akun }}" id="exampleInputName">
              @error('no')
                <small>{{ $message }}</small>
              @enderror
          </div>
          <div class="mb-3">
            <label for="exampleInputName" class="form-label">Nama Kelompok Akun</label>
            <input type="text" class="form-control" name="nama" value="{{ $d->nama_kelompok_akun }}" id="exampleInputName">
              @error('nama')
                <small>{{ $message }}</small>
              @enderror
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Edit</button>
        </div>
        </div>
      </div>
      </form>
    </div>
  </div>