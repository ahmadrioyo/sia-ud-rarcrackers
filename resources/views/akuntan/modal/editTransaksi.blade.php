<div class="modal fade" id="modalEdit{{ $item->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <form action="{{ route('akuntan.transaksi.update',['id' => $item->id]) }}" method="post" enctype="multipart/form-data">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel">Edit Data Transaksi</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  @csrf
                  @method('put')
                  <div class="mb-3">
                      <label for="exampleInputName" class="form-label">Nama Transaksi</label>
                      <input type="text" class="form-control" value="{{ $item->nama_transaksi_perkiraan }}" name="nama" id="exampleInputName">
                      @error('nama')
                      <small>{{ $message }}</small>
                      @enderror
                  </div>
                  <div class="mb-3">
                      <p for="exampleInputName" class="form-label">Tanggal</p>
                      <input type="date" class="form-control" value="{{ $item->tanggal->format('Y-m-d') }}" name="tanggal" id="exampleInputName">
                      @error('tanggal')
                      <small>{{ $message }}</small>
                      @enderror
                  </div>
                  <label for="exampleInputName" class="form-label">Jumlah</label>
                  <div class="input-group mb-3">
                      <div class="input-group-prepend">
                          <span class="input-group-text">Rp.</span>
                      </div>
                      <input type="text" class="form-control" name="jumlah" value="{{ number_format($item->jumlah, 2, ',', '.') }}" id="editJumlah{{ $item->id }}">
                  </div>
                  <label for="exampleInputName" class="form-label">Keterangan Transaksi</label>
                  <div class="mb-3">
                      <textarea class="summernote" name="ket">{{ $item->keterangan }}</textarea>
                  </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                  <button type="submit" class="btn btn-primary">Edit</button>
              </div>
          </div>
      </form>
  </div>
</div>