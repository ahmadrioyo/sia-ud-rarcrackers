<form action="{{ route('akuntan.transaksi.store') }}" method="post" enctype="multipart/form-data">
  <div class="modal fade" id="modalTambahTransaksi" tabindex="-1" aria-labelledby="modalTambahTransaksiLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalTambahTransaksiLabel">Tambah Data Transaksi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          @csrf
          <div class="mb-3">
            <label for="namaTransaksi" class="form-label">Nama Transaksi</label>
            <input type="text" class="form-control" name="nama" id="namaTransaksi">
            @error('nama')
            <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>
          <div class="mb-3">
            <label for="tanggalTransaksi" class="form-label">Tanggal Transaksi</label>
            <input type="date" class="form-control" name="tanggal" id="tanggalTransaksi">
            @error('tanggal')
            <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>
          <div class="mb-3">
            <label for="jumlahTransaksi" class="form-label">Jumlah</label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">Rp.</span>
              </div>
              <input type="text" class="form-control" name="jumlah" id="jumlahTransaksi">
            </div>
            @error('jumlah')
            <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>
          <label for="summernote" class="form-label">Keterangan Transaksi</label>
          <div class="mb-3">
            <textarea class="summernote" name="ket"></textarea>
            @error('ket')
            <small class="text-danger">{{ $message }}</small>
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
</form>