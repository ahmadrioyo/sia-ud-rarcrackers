<div class="modal fade" id="modalEdit{{ $d->id }}" data-backdrop="static" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <form action="{{ route('akuntan.tipe.update',['id' => $d->id]) }}" method="post" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Edit Tipe Akun</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          @csrf
          @method('put')
          <div class="mb-3">
            <label for="exampleInputName" class="form-label">Nama Tipe Akun</label>
            <input type="number" class="form-control" name="no" value="{{ $d->kode_tipe_akun }}" id="exampleInputName">
              @error('no')
                <small>{{ $message }}</small>
              @enderror
          </div>
          <div class="mb-3">
            <label for="exampleInputName" class="form-label">Nama Tipe Akun</label>
            <input type="text" class="form-control" name="nama" value="{{ $d->nama_tipe_akun }}" id="exampleInputName">
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