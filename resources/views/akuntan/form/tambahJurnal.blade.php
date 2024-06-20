@extends('layouts.main')
@section('css')
  <style>
    .select2-container--default .select2-selection--single {
        width: 100% !important;
        height: calc(1.5em + .75rem + 2px);
        border: 1px solid #ced4da;
        border-radius: .25rem;
        padding: .375rem .75rem;
    }
  </style>
@endsection
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Jurnal</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Akuntan</a></li>
                        <li class="breadcrumb-item">Jurnal</a></li>
                        <li class="breadcrumb-item active">Tambah Jurnal</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>Tambah Jurnal</h3>
                        </div>
                        <div class="card-body">
                            <form id="jurnalForm" action="{{ route('akuntan.jurnal.store') }}" method="post">
                                @csrf
                                <div class="form-group col-2">
                                    <label for="tanggal">Tanggal Transaksi</label>
                                    <input type="date" class="form-control" name="tanggal" required>
                                </div>
                                <div class="mt-3">
                                    <table class="table" id="jurnal">
                                        <thead style="background-color: #17a2b8">
                                            <tr style="color: white">
                                                <th>Akun</th>
                                                <th>Keterangan</th>
                                                <th>Debit</th>
                                                <th>Kredit</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="form-group">
                                                        <select class="form-control select2" name="inputs[0][akun]" style="width: 100%" required>
                                                            <option selected disabled>Pilih Akun</option>
                                                            @foreach ($akun as $item)
                                                                <option value="{{ $item->id }}">{{ $item->nama_akun }} [{{ $item->kode_akun }}]</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <select class="form-control select2" name="inputs[0][transaksi]" style="width: 100%;" required>
                                                            <option selected disabled>Pilih Transaksi</option>
                                                            @foreach ($transaksi as $item)
                                                                <option value="{{ $item->id }}">{{ $item->nama_transaksi_perkiraan }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Rp.</span>
                                                        </div>
                                                        <input type="text" class="form-control debit-input" name="inputs[0][debit]" min="0">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Rp.</span>
                                                        </div>
                                                        <input type="text" class="form-control kredit-input" name="inputs[0][kredit]" min="0">
                                                    </div>
                                                </td>
                                                <td><button type="button" name="add" id="add" class="btn btn-outline-info"><i class="fas fa-plus"></i> Tambah Baris</button></td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td><a href="{{ route('akuntan.jurnal') }}" type="submit" class="btn btn-outline-info"><i class="fas fa-chevron-circle-left"></i> Kembali</a> <button type="submit" class="btn btn-success"><i class="fas fa-plus"></i> Tambah Jurnal</button></td>
                                                <td></td>
                                                <td id="totalDebit">Rp. 0</td>
                                                <td id="totalKredit">Rp. 0</td>
                                                <td></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('scripts')

<script>
    var i = 0;

    function initializeSelect2() {
        $('.select2').select2({
            width: '100%'
        });
    }

    function toggleAndFormatInputs() {
        $('.debit-input').off('input').on('input', function() {
            var $this = $(this);
            var $row = $this.closest('tr');
            var $kreditInput = $row.find('.kredit-input');
            
            if ($this.val()) {
                $kreditInput.prop('disabled', true);
            } else {
                $kreditInput.prop('disabled', false);
            }

            formatCurrency($this);
            hitungTotal();
        });

        $('.kredit-input').off('input').on('input', function() {
            var $this = $(this);
            var $row = $this.closest('tr');
            var $debitInput = $row.find('.debit-input');

            if ($this.val()) {
                $debitInput.prop('disabled', true);
            } else {
                $debitInput.prop('disabled', false);
            }

            formatCurrency($this);
            hitungTotal();
        });
    }

    function formatCurrency(input) {
        let value = input.val().replace(/\D/g, '');
        value = value.replace(/^0+/, '');

        if (value) {
            input.val(new Intl.NumberFormat('id-ID', {
                style: 'decimal',
            }).format(value).replace(/,/g, '.'));
        } else {
            input.val('');
        }
    }

    function hitungTotal() {
        var totalDebit = 0;
        var totalKredit = 0;

        $('.debit-input').each(function() {
            var nilai = $(this).val().replace(/\D/g, '');
            nilai = nilai == '' ? 0 : parseInt(nilai);
            totalDebit += nilai;
        });

        $('.kredit-input').each(function() {
            var nilai = $(this).val().replace(/\D/g, '');
            nilai = nilai == '' ? 0 : parseInt(nilai);
            totalKredit += nilai;
        });

        $('#totalDebit').text('Rp ' + totalDebit.toLocaleString('id-ID'));
        $('#totalKredit').text('Rp ' + totalKredit.toLocaleString('id-ID'));
    }

    $('#add').click(function() {
        ++i;
        $('#jurnal tbody').append(
            `<tr>
                <td>
                    <div class="form-group">
                        <select class="form-control select2" name="inputs[${i}][akun]" style="width: 100%" required>
                            <option selected disabled>Pilih Akun</option>
                            @foreach ($akun as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_akun }} [{{ $item->kode_akun }}]</option>
                            @endforeach
                        </select>
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <select class="form-control select2" name="inputs[${i}][transaksi]" style="width: 100%;" required>
                            <option selected disabled>Pilih Transaksi</option>
                            @foreach ($transaksi as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_transaksi_perkiraan }}</option>
                            @endforeach
                        </select>
                    </div>
                </td>
                <td>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rp.</span>
                        </div>
                        <input type="text" class="form-control debit-input" name="inputs[${i}][debit]" min="0">
                    </div>
                </td>
                <td>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rp.</span>
                        </div>
                        <input type="text" class="form-control kredit-input" name="inputs[${i}][kredit]" min="0">
                    </div>
                </td>
                <td><button type="button" class="btn btn-outline-danger remove-table-row"><i class="fas fa-minus"></i></button></td>
            </tr>`
        );
        toggleAndFormatInputs();
        initializeSelect2();
        hitungTotal($this);
    });

    $(document).on('click', '.remove-table-row', function() {
        $(this).closest('tr').remove();
    });

    $(document).ready(function() {
        toggleAndFormatInputs();  
        initializeSelect2();
        hitungTotal();

        $('#jurnalForm').submit(function(event) {
            var totalDebit = parseInt($('#totalDebit').text().replace(/\D/g, ''));
            var totalKredit = parseInt($('#totalKredit').text().replace(/\D/g, ''));

            if (totalDebit !== totalKredit) {
                event.preventDefault();
                alert('Total debit dan kredit harus sama!');
            }
        });
        
        @if($message = Session::get('failed'))
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "{{ $message }}",
        });
        @endif

        @if($message = Session::get('success'))
        Swal.fire({
            icon: "success",
            text: "{{ $message }}",
        });
        @endif
    });
</script>
@endsection
