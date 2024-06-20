<div class="modal fade" id="modalEdit{{ $item->id }}" data-backdrop="static" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <form action="{{ route('akuntan.akun.update',['id' => $item->id]) }}" method="post" enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Edit Data Akun</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @csrf
        @method('put')
        <div class="mb-3">
          <label for="exampleInputName" class="form-label">Kode Akun</label>
          <input type="number" class="form-control" name="no" value="{{ $item->kode_akun }}" id="exampleInputName">
            @error('no')
              <small>{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
          <label for="exampleInputName" class="form-label">Nama Akun</label>
          <input type="text" class="form-control" name="nama" value="{{ $item->nama_akun }}" id="exampleInputName">
            @error('nama')
              <small>{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
          <label for="exampleInputName" class="form-label">Kelompok Akun</label>
          <select class="custom-select" name="kelompok" id="inputGroupSelect02">
            @if ($item->kelompok_akuns)
              <option selected value="{{ $item->kelompok_akuns->id }}">{{ $item->kelompok_akuns->nama_kelompok_akun }}</option>
            @else
              <option selected disabled>Pilih Kelompok Akun</option>
            @endif
            @foreach ($kelompok as $itemKelompok)
              <option value="{{ $itemKelompok->id }}">{{ $itemKelompok->nama_kelompok_akun }}</option>
            @endforeach
          </select>
          @error('kelompok')
            <small>{{ $message }}</small>
          @enderror
        </div>
        <div class="mb-3">
          <label for="exampleInputName" class="form-label">Tipe Akun</label>
          <select class="custom-select" name="tipe" id="inputGroupSelect02">
            @if ($item->tipe_akuns)
              <option selected value="{{ $item->tipe_akuns->id }}">{{ $item->tipe_akuns->nama_tipe_akun }}</option>
            @else
              <option selected disabled>Pilih Tipe Akun</option>
            @endif
            @foreach ($tipe as $itemTipe)
              <option value="{{ $itemTipe->id }}">{{ $itemTipe->nama_tipe_akun }}</option>
            @endforeach
          </select>
          @error('tipe')
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
