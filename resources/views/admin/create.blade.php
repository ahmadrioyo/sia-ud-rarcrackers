<form action="{{ route('admin.user.store') }}" method="post" enctype="multipart/form-data">
    <div class="modal fade" id="modalCreate" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">Tambah Data Pengguna</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                @csrf
                <div class="mb-3">
                  <label for="exampleInputName" class="form-label">Nama Pengguna</label>
                  <input type="text" class="form-control" name="nama" id="exampleInputName">
                  @error('nama')
                    <small>{{ $message }}</small>
                  @enderror
                </div>
                <div class="mb-3">
                    <label for="exampleInputName" class="form-label">Status</label>
                    <select class="custom-select" name="status" id="inputGroupSelect02">
                      <option selected disabled>---</option>
                      {{-- <option value="admin">admin</option> --}}
                      <option value="akuntan">akuntan</option>
                      <option value="owner">owner</option>
                    </select>
                  @error('status')
                    <small>{{ $message }}</small>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Password</label>
                  <input type="password" class="form-control" name="password" id="exampleInputPassword1">
                  @error('password')
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
      
  </form>
  
  