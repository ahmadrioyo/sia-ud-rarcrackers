<?php

namespace App\Http\Controllers;

use App\Traits;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Akun;
use App\Models\DetailJurnal;
use App\Models\Jurnal;
use App\Models\KelompokAkun;
use App\Models\TipeAkun;
use App\Models\Transaksi;
use App\Traits\HasFormatRupiah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class AkuntanController extends Controller
{
    use HasFormatRupiah;
    public function index()
    {
        return view('akuntan.index');
    }

    // akun 
    public function akun(Request $request)
    {
        $data = Akun::with('kelompok_akuns', 'tipe_akuns')->get();
        // dd($data);
        $kelompok = KelompokAkun::all();
        $tipe = TipeAkun::all();

        return view(
            'akuntan.data-akun.akun',
            compact('data', 'kelompok', 'tipe')
        );
    }
    public function storeAkun(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kelompok_akun' => 'required',
            'tipe_akun' => 'required',
            'nama' => 'required',
        ]);

        $kodeKelompokAkun = $request->kelompok_akun;
        $kodeTipeAkun = $request->tipe_akun;
        $kodeAkun = '' . $kodeKelompokAkun . '' . $kodeTipeAkun;

        $lastAkun = Akun::where('kelompok_akun_id', $request->kelompok_akun)->orderBy('created_at', 'desc')->first();

        if (!$lastAkun) {
            $lastKode = $kodeAkun . '01';
            $kode = $lastKode;
        } else {
            $lastKode = substr($lastAkun->kode_akun, 2, 2) + 1;
            $lastKode = '0' . $lastKode;
            $kode = $kodeAkun . $lastKode;
        }

        if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator)->with('failed', 'Salah mengisi data akun!');

        $data['kelompok_akun_id'] = $request->kelompok_akun;
        $data['tipe_akun_id'] = $request->tipe_akun;
        $data['nama_akun'] = $request->nama;
        $data['kode_akun'] = $kode;

        // dd($data);   
        Akun::create($data);

        return redirect()->route('akuntan.akun')->with('success', 'Berhasil menambah data akun!');
    }
    public function updateAkun(Request $request, $id)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'no' => 'required',
            'nama' => 'required',
            'kelompok' => 'required',
            'tipe' => 'required',
        ]);

        if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator)->with('failed', 'Salah mengisi data akun!');

        $data['kode_akun'] = $request->no;
        $data['nama_akun'] = $request->nama;
        $data['kelompok_akun_id'] = $request->kelompok;
        $data['tipe_akun_id'] = $request->tipe;


        Akun::whereId($id)->update($data);

        return redirect()->route('akuntan.akun')->with('success', 'Berhasil mengubah data akun!');
    }
    public function deleteakun(Request $request, $id)
    {
        $data = Akun::find($id);

        if ($data) {
            $data->delete();
        }
        return redirect()->route('akuntan.akun')->with('success', 'Berhasil menghapus data akun!');
    }

    // kelompok akun 
    public function kelompok(Request $request)
    {
        $data = new KelompokAkun;

        $data = $data->get();
        return view('akuntan.data-akun.kelompok', compact('data', 'request'));
    }
    public function storekelompok(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'no' => 'required',
        ]);

        if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator)->with('failed', 'Salah mengisi data kelompok!');

        $data['nama_kelompok_akun'] = $request->nama;
        $data['kode_kelompok_akun'] = $request->no;

        KelompokAkun::create($data);

        return redirect()->route('akuntan.kelompok')->with('success', 'Berhasil menambah data kelompok!');
    }
    public function updatekelompok(Request $request, $id)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'no' => 'required',
            'nama' => 'required',
        ]);

        if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator)->with('failed', 'Salah mengisi data kelompok!');

        $data['kode_kelompok_akun'] = $request->no;
        $data['nama_kelompok_akun'] = $request->nama;

        KelompokAkun::whereId($id)->update($data);

        return redirect()->route('akuntan.kelompok')->with('success', 'Berhasil mengubah data kelompok!');
    }
    public function deletekelompok(Request $request, $id)
    {
        $data = KelompokAkun::find($id);

        if ($data) {
            $data->delete();
        }
        return redirect()->route('akuntan.kelompok')->with('success', 'Berhasil menghapus data kelompok!');
    }

    // tipe akun 
    public function tipe(Request $request)
    {
        $data = new TipeAkun;

        $data = $data->get();
        return view('akuntan.data-akun.tipe', compact('data', 'request'));
    }
    public function storeTipe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'no' => 'required',
        ]);

        if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator)->with('failed', 'Salah mengisi data tipe!');

        $data['nama_tipe_akun'] = $request->nama;
        $data['kode_tipe_akun'] = $request->no;

        TipeAkun::create($data);

        return redirect()->route('akuntan.tipe')->with('success', 'Berhasil menambah data tipe!');
    }
    public function updatetipe(Request $request, $id)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'no' => 'required',
            'nama' => 'required',
        ]);

        if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator)->with('failed', 'Salah mengisi data tipe!');

        $data['kode_tipe_akun'] = $request->no;
        $data['nama_tipe_akun'] = $request->nama;

        TipeAkun::whereId($id)->update($data);

        return redirect()->route('akuntan.tipe')->with('success', 'Berhasil mengubah data tipe!');
    }
    public function deletetipe(Request $request, $id)
    {
        $data = TipeAkun::find($id);

        if ($data) {
            $data->delete();
        }
        return redirect()->route('akuntan.tipe')->with('success', 'Berhasil menghapus data tipe!');
    }

    // transaksi 
    public function transaksi(Request $request)
    {
        $query = Transaksi::query();
    
        if ($request->has('date_range') && !empty($request->date_range)) {
            list($startDate, $endDate) = explode(' - ', $request->date_range);
            $query->whereBetween('tanggal', [$startDate, $endDate]);
        }
    
        $data = $query->get();
    
        return view('akuntan.transaksi', compact('data'));
    }
    
    public function storeTransaksi(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'tanggal' => 'required',
            'jumlah' => 'required',
            'ket' => 'required'
        ]);
        // dd($validator);
        if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator)->with('failed', 'Salah mengisi data transaksi!');

        $data['nama_transaksi_perkiraan'] = $request->nama;
        $data['tanggal'] = $request->tanggal;
        $data['jumlah'] = (int)str_replace('.','', $request->jumlah);
        $data['keterangan'] = $request->ket;

        Transaksi::create($data);

        return redirect()->route('akuntan.transaksi')->with('success', 'Berhasil menambah data transaksi!');
    }
    public function updatetransaksi(Request $request, $id)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'tanggal' => 'nullable',
            'jumlah' => 'required',
            'ket' => 'required'
        ]);
        // dd($validator);
        if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator)->with('failed', 'Salah mengisi data transaksi!');

        $data['nama_transaksi_perkiraan'] = $request->nama;
        $data['tanggal'] = $request->tanggal;
        $data['jumlah'] = (int)str_replace('.','', $request->jumlah);
        $data['keterangan'] = $request->ket;

        // dd($data);

        Transaksi::whereId($id)->update($data);

        return redirect()->route('akuntan.transaksi')->with('success', 'Berhasil mengubah data transaksi!');
    }
    public function deletetransaksi(Request $request, $id)
    {
        $data = Transaksi::find($id);

        if ($data) {
            $data->delete();
        }
        return redirect()->route('akuntan.transaksi')->with('success', 'Berhasil menghapus data transaksi!');
    }

    // jurnal
    public function jurnal(Request $request)
    {
        $data = Jurnal::with(['detail_jurnal.akun','detail_jurnal.transaksi'])
            ->when($request->has(['start_date', 'end_date']), function ($query) use ($request) {
                $query->whereHas('detail_jurnal', function ($subQuery) use ($request) {
                    $subQuery->whereBetween('tanggal', [$request->start_date, $request->end_date]);
                });
            })
            ->get();
            
        $akun = Akun::all();
        $transaksi = Transaksi::orderBy('created_at', 'desc')->get();
    
        $totalDebit = $data->flatMap(function ($jurnal) {
            return $jurnal->detail_jurnal->pluck('debit')->filter();
        })->sum();
    
        $totalKredit = $data->flatMap(function ($jurnal) {
            return $jurnal->detail_jurnal->pluck('kredit')->filter();
        })->sum();


        if ($request->has(['start_date']) && $request->start_date) {
            $start_date = \Carbon\Carbon::parse($request->start_date)->formatLocalized('%B %Y');
            $period = $start_date;
        }else{
            $period = '';
        }
    
        if ($request->get('export') == 'pdf') {
            $pdf = PDF::loadView('pdf.jurnal', compact('data', 'totalDebit', 'totalKredit', 'period', 'akun', 'transaksi'));
            return $pdf->stream('Laporan Jurnal | UD. RAR Crackers.pdf');
        }
    
        return view('akuntan.jurnal', compact('data', 'totalDebit', 'totalKredit', 'period', 'akun', 'transaksi'));
    }
    
    public function search(Request $request)
    {
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');
    
        $journals = Jurnal::whereBetween('tanggal', [$startDate, $endDate])
            ->with('detail_jurnal.akun', 'detail_jurnal.transaksi')
            ->get();
    
        return response()->json($journals);
    }
    
    public function tambahjurnal(Request $request)
    {
        $data = Jurnal::with('detail_jurnal.akun', 'detail_jurnal.transaksi')->get();
        $akun = Akun::all();
        $transaksi = Transaksi::orderBy('created_at', 'desc')->get();

        return view('akuntan.form.tambahJurnal', compact('data', 'akun', 'transaksi'));
    }
    public function storejurnal(Request $request)
    {
        // dd($request->inputs);
        $validator = Validator::make($request->all(), [
            'tanggal' => 'required|date|unique:jurnals,tanggal',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator)->with('failed', 'Salah mengisi data jurnal!');
        }

        try {
            // dd($request->inputs);

            $jurnal = new Jurnal();
            $jurnal->tanggal = $request->tanggal;
            if ($jurnal->save()) {
                $id_jurnal = $jurnal->id;
                foreach ($request->inputs as $input => $value) {
                    $detailJurnal = new DetailJurnal();
                    $detailJurnal->jurnal_id = $id_jurnal;
                    $detailJurnal->transaksi_id = $value['transaksi'];
                    $detailJurnal->akun_id = $value['akun'];
                    $debitValue = isset($value['debit']) && $value['debit'] !== '' ? str_replace('.', '', $value['debit']) : null;
                    $detailJurnal->debit = $debitValue !== '' ? (int)$debitValue : null;
                    $kreditValue = isset($value['kredit']) && $value['kredit'] !== '' ? str_replace('.', '', $value['kredit']) : null;
                    $detailJurnal->kredit = $kreditValue !== '' ? (int)$kreditValue : null;
                    if (!$detailJurnal->save()) {
                        throw new \Exception('Gagal menambah data detail jurnal!');
                    }
                }
            } else {
                throw new \Exception('Gagal menambah data jurnal!');
            }
         
            return redirect()->route('akuntan.jurnal')->with('success', 'Berhasil menambah data jurnal!');
        } catch (\Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
    }

    public function editjurnal(Request $request, $id)
    {
        $data = Jurnal::with('detail_jurnal.akun', 'detail_jurnal.transaksi')->find($id);
        if (!$data) {
            return redirect()->route('akuntan.jurnal')->with('failed', 'Data jurnal tidak ditemukan.');
        }
        // dd($data);
    
        $akun = Akun::all();
        $transaksi = Transaksi::orderBy('created_at', 'desc')->get();
        return view('akuntan.form.editJurnal', compact('data', 'akun', 'transaksi'));
    }
    
    public function updateJurnal(Request $request, $id)
    {
        // dd($request->inputs);
        $validator = Validator::make($request->all(), [
            'tanggal' => 'required|date',
            Rule::unique('jurnals', 'tanggal')->ignore($id),
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator)->with('failed', 'Salah mengisi data jurnal!');
        }
    
        try {
            $jurnal = Jurnal::find($id);
            if (!$jurnal) {
                return redirect()->route('akuntan.jurnal')->with('failed', 'Data jurnal tidak ditemukan.');
            }
    
            $jurnal->tanggal = $request->tanggal;
            $jurnal->save();
    
            $jurnal->detail_jurnal()->delete();
    
            foreach ($request->inputs as $input) {
                $detailJurnal = new DetailJurnal();
                $detailJurnal->jurnal_id = $jurnal->id;
                $detailJurnal->transaksi_id = $input['transaksi'];
                $detailJurnal->akun_id = $input['akun'];
                $debitValue = isset($input['debit']) && $input['debit'] !== '' ? str_replace('.', '', $input['debit']) : null;
                $detailJurnal->debit = $debitValue !== '' ? (int)$debitValue : null;
                $kreditValue = isset($input['kredit']) && $input['kredit'] !== '' ? str_replace('.', '', $input['kredit']) : null;
                $detailJurnal->kredit = $kreditValue !== '' ? (int)$kreditValue : null;
                $detailJurnal->save();
            }
    
            return redirect()->route('akuntan.jurnal')->with('success', 'Berhasil memperbarui data jurnal!');
        } catch (\Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
    }
    public function deletejurnal(Request $request, $id)
    {
        $data = Jurnal::with('detail_jurnal.akun', 'detail_jurnal.transaksi')->find($id);

        if ($data) {
            $data->delete();
        }
        return redirect()->route('akuntan.jurnal')->with('success', 'Berhasil menghapus data jurnal!');
    }

    // buku besar 
    public function bukubesar(Request $request)
    {
        $start_date = $request->get('start_date', null);
        $end_date = $request->get('end_date', null);
        $selectedAccount = $request->get('selected_account', null);
    
        $query = Jurnal::with(['detail_jurnal.akun.kelompok_akuns', 'detail_jurnal.transaksi']);
    
        if ($start_date && $end_date) {
            $query->whereBetween('tanggal', [$start_date, $end_date]);
        }
    
        $data = $query->get();
    
        $groupedData = $data->map(function ($jurnal) {
            return $jurnal->detail_jurnal->map(function ($detail) use ($jurnal) {
                return (object) [
                    'tanggal' => $jurnal->tanggal,
                    'transaksi' => $detail->transaksi,
                    'debit' => $detail->debit,
                    'kredit' => $detail->kredit,
                    'saldo' => 0,
                    'akun' => $detail->akun,
                    'kelompok_akun' => $detail->akun->kelompok_akuns->nama_kelompok_akun,
                ];
            });
        })->flatten()->groupBy(function ($item) {
            return $item->akun->kode_akun . ' - ' . $item->akun->nama_akun;
        })->sortKeys();
    
        foreach ($groupedData as $group => $entries) {
            $saldo = 0;
            foreach ($entries as $entry) {
                $kelompokAkun = $entry->kelompok_akun;
    
                if ($kelompokAkun == 'Harta' || $kelompokAkun == 'Beban') {
                    $saldo += $entry->debit - $entry->kredit;
                } elseif ($kelompokAkun == 'Modal' && $entry->akun->nama_akun == 'Prive') {
                    $saldo += $entry->debit - $entry->kredit;
                } elseif ($kelompokAkun == 'Hutang' || $kelompokAkun == 'Modal' || $kelompokAkun == 'Pendapatan') {
                    $saldo += $entry->kredit - $entry->debit;
                }
                $entry->saldo = $saldo;
            }
        }

        if ($selectedAccount) {
            $groupedData = $groupedData->filter(function ($entries, $key) use ($selectedAccount) {
                return $key == $selectedAccount;
            });
        }
    
        $period = '';
        if ($start_date && $end_date) {
            $start_date_formatted = \Carbon\Carbon::parse($start_date)->formatLocalized('%B %Y');
            $period = "$start_date_formatted";
        }
        
        if ($request->get('export') == 'pdf') {
            $pdf = PDF::loadView('pdf.buku-besar', compact('groupedData', 'period'));
            return $pdf->stream('Laporan Buku Besar | UD. RAR Crackers.pdf');
        }
        
        if ($request->ajax()) {
            return view('akuntan.table.buku-besar', compact('groupedData', 'period'))->render();
        } else {
            return view('akuntan.buku-besar', compact('groupedData', 'period'))->render();
        }
    }
        
    // laba rugi 
    public function labaRugi(Request $request)
    {
        $start_date = $request->get('start_date', null);
        $end_date = $request->get('end_date', null);
    
        $pendapatanQuery = Akun::with(['detail_jurnal.jurnal'])
            ->whereHas('kelompok_akuns', function ($query) {
                $query->where('nama_kelompok_akun', 'Pendapatan');
            });
    
        $bebanQuery = Akun::with(['detail_jurnal.jurnal'])
            ->whereHas('kelompok_akuns', function ($query) {
                $query->where('nama_kelompok_akun', 'Beban');
            });
    
        if ($start_date && $end_date) {
            $pendapatanQuery->whereHas('detail_jurnal.jurnal', function ($query) use ($start_date, $end_date) {
                $query->whereBetween('tanggal', [$start_date, $end_date]);
            });
    
            $bebanQuery->whereHas('detail_jurnal.jurnal', function ($query) use ($start_date, $end_date) {
                $query->whereBetween('tanggal', [$start_date, $end_date]);
            });
        }
    
        $pendapatan = $pendapatanQuery->get()->map(function ($akun) use ($start_date, $end_date) {
            $total = $akun->detail_jurnal->sum(function ($detail) use ($start_date, $end_date) {
                if ($detail->jurnal->tanggal >= $start_date && $detail->jurnal->tanggal <= $end_date) {
                    return $detail->kredit - $detail->debit;
                }
                return 0;
            });
        
            return [
                'kode_akun' => $akun->kode_akun,
                'nama_akun' => $akun->nama_akun,
                'total' => $total,
            ];
        });
    
        $beban = $bebanQuery->get()->map(function ($akun) use ($start_date, $end_date) {
            $total = $akun->detail_jurnal->sum(function ($detail) use ($start_date, $end_date) {
                if ($detail->jurnal->tanggal >= $start_date && $detail->jurnal->tanggal <= $end_date) {
                    return $detail->debit - $detail->kredit;
                }
                return 0;
            });
        
            return [
                'kode_akun' => $akun->kode_akun,
                'nama_akun' => $akun->nama_akun,
                'total' => $total,
            ];
        });
    
        $totalPendapatan = $pendapatan->sum('total');
        $totalBeban = $beban->sum('total');
        $labaBersih = $totalPendapatan - $totalBeban;
    
        $period = '';
        if ($start_date && $end_date) {
            $start_date_formatted = \Carbon\Carbon::parse($start_date)->formatLocalized('%B %Y');
            $period = "$start_date_formatted";
        }
    
        $data = [
            'pendapatan' => $pendapatan,
            'beban' => $beban,
            'totalPendapatan' => $totalPendapatan,
            'totalBeban' => $totalBeban,
            'labaBersih' => $labaBersih,
            'period' => $period,
        ];
    
        if ($request->get('export') == 'pdf') {
            $pdf = PDF::loadView('pdf.laba-rugi', $data);
            return $pdf->stream('Laporan Laba Rugi | UD. RAR Crackers.pdf');
        }
    
        if ($request->ajax()) {
            return view('akuntan.table.laba-rugi', $data)->render();
        }
    
        return view('akuntan.laba-rugi', $data);
    }
       
    // perubahan modal 
    public function perubahanmodal(Request $request)
    {
        $start_date = $request->get('start_date', null);
        $end_date = $request->get('end_date', null);
    
        $modalAwalQuery = Akun::where('nama_akun', 'Modal/Ekuitas Pemilik')->with(['detail_jurnal.jurnal']);

        $modalTambahanQuery = Akun::where('nama_akun', 'Modal Tambahan')->with(['detail_jurnal.jurnal']);
        
        $penguranganModalQuery = Akun::where('nama_akun', 'Prive')->with(['detail_jurnal.jurnal']);
        
        if ($start_date && $end_date) {
            $modalAwalQuery->whereHas('detail_jurnal.jurnal', function ($query) use ($start_date, $end_date) {
                $query->whereBetween('tanggal', [$start_date, $end_date]);
            });
        
            $modalTambahanQuery->whereHas('detail_jurnal.jurnal', function ($query) use ($start_date, $end_date) {
                $query->whereBetween('tanggal', [$start_date, $end_date]);
            });
        
            $penguranganModalQuery->whereHas('detail_jurnal.jurnal', function ($query) use ($start_date, $end_date) {
                $query->whereBetween('tanggal', [$start_date, $end_date]);
            });
        }
        
        $modalAwal = $modalAwalQuery->get()->sum(function ($akun) use ($start_date, $end_date) {
            return $akun->detail_jurnal->sum(function ($detail) use ($start_date, $end_date) {
                if ($detail->jurnal->tanggal >= $start_date && $detail->jurnal->tanggal <= $end_date) {
                    return $detail->kredit - $detail->debit;
                }
            });
        });
        
        $modalTambahan = $modalTambahanQuery->get()->sum(function ($jurnal) use ($start_date, $end_date){
            return $jurnal->detail_jurnal->sum(function ($detail) use ($start_date, $end_date){
                if ($detail->jurnal->tanggal >= $start_date && $detail->jurnal->tanggal <= $end_date) {
                    return $detail->kredit - $detail->debit;
                }
            });
        });
        
        $penguranganModal = $penguranganModalQuery->get()->sum(function ($jurnal) use ($start_date, $end_date){
            return $jurnal->detail_jurnal->sum(function ($detail) use ($start_date, $end_date){
                if ($detail->jurnal->tanggal >= $start_date && $detail->jurnal->tanggal <= $end_date) {
                    return $detail->debit - $detail->kredit;
                }
            });
        });        

        $pendapatanQuery = Akun::with(['detail_jurnal.jurnal'])
        ->whereHas('kelompok_akuns', function ($query) {
            $query->where('nama_kelompok_akun', 'Pendapatan');
        });

        $bebanQuery = Akun::with(['detail_jurnal.jurnal'])
            ->whereHas('kelompok_akuns', function ($query) {
                $query->where('nama_kelompok_akun', 'Beban');
            });

        if ($start_date && $end_date) {
            $pendapatanQuery->whereHas('detail_jurnal.jurnal', function ($query) use ($start_date, $end_date) {
                $query->whereBetween('tanggal', [$start_date, $end_date]);
            });

            $bebanQuery->whereHas('detail_jurnal.jurnal', function ($query) use ($start_date, $end_date) {
                $query->whereBetween('tanggal', [$start_date, $end_date]);
            });
        }

        $pendapatan = $pendapatanQuery->get()->map(function ($akun) use ($start_date, $end_date) {
            $total = $akun->detail_jurnal->sum(function ($detail) use ($start_date, $end_date) {
                if ($detail->jurnal->tanggal >= $start_date && $detail->jurnal->tanggal <= $end_date) {
                    return $detail->kredit - $detail->debit;
                }
                return 0;
            });
        
            return [
                'total' => $total,
            ];
        });

        $beban = $bebanQuery->get()->map(function ($akun) use ($start_date, $end_date) {
            $total = $akun->detail_jurnal->sum(function ($detail) use ($start_date, $end_date) {
                if ($detail->jurnal->tanggal >= $start_date && $detail->jurnal->tanggal <= $end_date) {
                    return $detail->debit - $detail->kredit;
                }
                return 0;
            });
        
            return [
                'total' => $total,
            ];
        });

        $totalPendapatan = $pendapatan->sum('total');
        $totalBeban = $beban->sum('total');
        $labaRugi = $totalPendapatan - $totalBeban;
            
        $modalAkhir = $modalAwal + $modalTambahan + ($labaRugi - $penguranganModal);
    
        $modalData = [
            'modal_awal' => 'Rp. ' . number_format($modalAwal, 0, ',', '.'),
            'modal_tambahan' => 'Rp. ' . number_format($modalTambahan, 0, ',', '.'),
            'pengurangan_modal' => 'Rp. ' . number_format($penguranganModal, 0, ',', '.'),
            'laba_rugi' => 'Rp. ' . number_format($labaRugi, 0, ',', '.'),
            'modal_akhir' => 'Rp. ' . number_format($modalAkhir, 0, ',', '.'),
        ];
    
        $period = '-';
        if ($start_date && $end_date) {
            $start_date_formatted = \Carbon\Carbon::parse($start_date)->formatLocalized('%B %Y');
            $period = "$start_date_formatted";
        }
    
        if ($request->ajax()) {
            return response()->json(['data' => $modalData, 'period' => $period]);
        }
    
        if ($request->get('export') == 'pdf') {
            $pdf = PDF::loadView('pdf.perubahan-modal', ['data' => $modalData, 'period' => $period]);
            return $pdf->stream('Laporan Perubahan Modal | UD. RAR Crackers.pdf');
        }
    
        return view('akuntan.perubahan-modal', ['data' => $modalData, 'period' => $period]);
    }
    
    // arus kas 
    public function aruskas(Request $request)
    {
        $start_date = $request->get('start_date', null);
        $end_date = $request->get('end_date', null);

        $pendapatanQuery = Akun::with(['detail_jurnal.jurnal'])
            ->whereHas('kelompok_akuns', function ($query) {
                $query->where('nama_kelompok_akun', 'Pendapatan');
            });
    
        $bebanQuery = Akun::with(['detail_jurnal.jurnal'])
            ->whereHas('kelompok_akuns', function ($query) {
                $query->where('nama_kelompok_akun', 'Beban');
            });
    
        if ($start_date && $end_date) {
            $pendapatanQuery->whereHas('detail_jurnal.jurnal', function ($query) use ($start_date, $end_date) {
                $query->whereBetween('tanggal', [$start_date, $end_date]);
            });
    
            $bebanQuery->whereHas('detail_jurnal.jurnal', function ($query) use ($start_date, $end_date) {
                $query->whereBetween('tanggal', [$start_date, $end_date]);
            });
        }
    
        $pendapatan = $pendapatanQuery->get()->map(function ($akun) use ($start_date, $end_date){
            $total = $akun->detail_jurnal->sum(function ($detail) use ($start_date, $end_date) {
                if ($detail->jurnal->tanggal >= $start_date && $detail->jurnal->tanggal <= $end_date) {
                    return $detail->kredit - $detail->debit;
                }
            });
    
            return [
                'total' => $total,
            ];
        });
    
        $beban = $bebanQuery->get()->map(function ($akun) use ($start_date, $end_date){
            $total = $akun->detail_jurnal->sum(function ($detail) use ($start_date, $end_date){
                if ($detail->jurnal->tanggal >= $start_date && $detail->jurnal->tanggal <= $end_date) {
                    return $detail->debit - $detail->kredit;
                }
            });
    
            return [
                'total' => $total,
            ];
        });
    
        $totalPendapatan = $pendapatan->sum('total');
        $totalBeban = $beban->sum('total');
        $labaRugi = $totalPendapatan - $totalBeban;

        $hutangQuery = Akun::whereHas('kelompok_akuns', function ($query) {
            $query->where('nama_kelompok_akun', 'Hutang');
        })->with(['detail_jurnal' => function ($query) use ($start_date, $end_date) {
            if ($start_date && $end_date) {
                $query->whereHas('jurnal', function ($subQuery) use ($start_date, $end_date) {
                    $subQuery->whereBetween('tanggal', [$start_date, $end_date]);
                });
            }
        }]);
        
        $hutang = $hutangQuery->get()->sum(function ($akun) {
            return $akun->detail_jurnal->sum(function ($detail) {
                return $detail->kredit - $detail->debit;
            });
        });

        $arusKasOperasional = $labaRugi - $hutang;

        $saldoAwalKasQuery = Akun::where('nama_akun', 'Modal/Ekuitas Pemilik')->with(['detail_jurnal' => function ($query) use ($start_date, $end_date) {
            if ($start_date && $end_date) {
                $query->whereHas('jurnal', function ($subQuery) use ($start_date, $end_date) {
                    $subQuery->whereBetween('tanggal', [$start_date, $end_date]);
                });
            }
        }]);
        
        $saldoAwalKas = $saldoAwalKasQuery->get()->sum(function ($akun) use ($start_date, $end_date) {
            return $akun->detail_jurnal->sum(function ($detail) use ($start_date, $end_date){
                if ($detail->jurnal->tanggal >= $start_date && $detail->jurnal->tanggal <= $end_date) {
                    return $detail->kredit - $detail->debit;
                }
            });
        });

        $modalTambahanQuery = Akun::where('nama_akun', 'Modal Tambahan')->with(['detail_jurnal' => function ($query) use ($start_date, $end_date) {
            if ($start_date && $end_date) {
                $query->whereHas('jurnal', function ($subQuery) use ($start_date, $end_date) {
                    $subQuery->whereBetween('tanggal', [$start_date, $end_date]);
                });
            }
        }]);
        
        $modalTambahan = $modalTambahanQuery->get()->sum(function ($akun) use($start_date, $end_date) {
            return $akun->detail_jurnal->sum(function ($detail) use ($start_date, $end_date){
                if ($detail->jurnal->tanggal >= $start_date && $detail->jurnal->tanggal <= $end_date) {
                    return $detail->kredit - $detail->debit;
                }
            });
        });

        $penguranganModalQuery = Akun::where('nama_akun', 'Prive')->with(['detail_jurnal' => function ($query) use ($start_date, $end_date) {
            if ($start_date && $end_date) {
                $query->whereHas('jurnal', function ($subQuery) use ($start_date, $end_date) {
                    $subQuery->whereBetween('tanggal', [$start_date, $end_date]);
                });
            }
        }]);
        
        $penguranganModal = $penguranganModalQuery->get()->sum(function ($akun) use ($start_date,$end_date){
            return $akun->detail_jurnal->sum(function ($detail) use ($start_date, $end_date){
                if ($detail->jurnal->tanggal >= $start_date && $detail->jurnal->tanggal <= $end_date) {
                    return $detail->debit - $detail->kredit;
                }
            });
        });

        $arusKasPembiayaan = ($saldoAwalKas + $modalTambahan) - $penguranganModal;

        $saldoAkhirKas =  $arusKasOperasional + $arusKasPembiayaan;

        $period = '-';
        if ($start_date && $end_date) {
            $start_date_formatted = \Carbon\Carbon::parse($start_date)->formatLocalized('%B %Y');
            $period = "$start_date_formatted";
        }

        $data = [
            'saldoAwalKas' => 'Rp. ' . number_format($saldoAwalKas, 0, ',', '.'),
            'arusKasOperasional' => 'Rp. ' . number_format($arusKasOperasional, 0, ',', '.'),
            'arusKasPembiayaan' => 'Rp. ' . number_format($arusKasPembiayaan, 0, ',', '.'),
            'saldoAkhirKas' => 'Rp. ' . number_format($saldoAkhirKas, 0, ',', '.'),
            'hutang' =>'Rp. ' . number_format($hutang, 0, ',', '.'), 
            'modalTambahan' =>'Rp. ' . number_format($modalTambahan, 0, ',', '.'), 
            'penguranganModal' =>'Rp. ' . number_format($penguranganModal, 0, ',', '.'),
        ];
        if ($request->ajax()) {
            return response()->json(['data' => $data, 'period'=> $period]);
        }

        if ($request->get('export') == 'pdf') {
            $pdf = PDF::loadView('pdf.arus-kas', ['data' => $data, 'period'=> $period]);
            return $pdf->stream('Laporan Arus Kas | UD. RAR Crackers.pdf');
        }

        return view('akuntan.arus-kas', ['data' => $data, 'period'=> $period]);
    }

    // neraca keuangan
    public function neracakeuangan(Request $request)
    {
        $start_date = $request->get('start_date', null);
        $end_date = $request->get('end_date', null);
    
        $detailJurnals = DetailJurnal::with('akun.kelompok_akuns')
            ->when($start_date && $end_date, function ($query) use ($start_date, $end_date) {
                $query->whereHas('jurnal', function ($subQuery) use ($start_date, $end_date) {
                    $subQuery->whereBetween('tanggal', [$start_date, $end_date]);
                });
            })
            ->get();
    
        $totalPerAkun = [];
        $groupedData = [];
        $totalAktiva = 0;
        $totalHutang = 0;
        $totalModal = 0;
    
        foreach ($detailJurnals as $detailJurnal) {
            $namaAkun = $detailJurnal->akun->nama_akun;
            $kelompokAkun = $detailJurnal->akun->kelompok_akuns->nama_kelompok_akun;
            $debit = $detailJurnal->debit;
            $kredit = $detailJurnal->kredit;
    
            $total = $kelompokAkun === 'Harta' ? ($debit - $kredit) : ($kredit - $debit);
    
            if (isset($totalPerAkun[$namaAkun])) {
                $totalPerAkun[$namaAkun] += $total;
            } else {
                $totalPerAkun[$namaAkun] = $total;
            }
    
            if (!isset($groupedData[$namaAkun])) {
                $groupedData[$namaAkun] = [
                    'nama_akun' => $namaAkun,
                    'kelompok' => $kelompokAkun,
                    'totalDebit' => 0,
                    'totalKredit' => 0
                ];
            }
    
            $groupedData[$namaAkun]['totalDebit'] += $debit;
            $groupedData[$namaAkun]['totalKredit'] += $kredit;
    
            if ($kelompokAkun === 'Harta') {
                $totalAktiva += $total;
            } elseif ($kelompokAkun === 'Hutang') {
                $totalHutang += $total;
            } elseif ($kelompokAkun === 'Modal') {
                $totalModal += $total;
            }
        }
    
        $pendapatanQuery = Akun::with(['detail_jurnal.jurnal'])
            ->whereHas('kelompok_akuns', function ($query) {
                $query->where('nama_kelompok_akun', 'Pendapatan');
            });
    
        $bebanQuery = Akun::with(['detail_jurnal.jurnal'])
            ->whereHas('kelompok_akuns', function ($query) {
                $query->where('nama_kelompok_akun', 'Beban');
            });
    
        if ($start_date && $end_date) {
            $pendapatanQuery->whereHas('detail_jurnal.jurnal', function ($query) use ($start_date, $end_date) {
                $query->whereBetween('tanggal', [$start_date, $end_date]);
            });
    
            $bebanQuery->whereHas('detail_jurnal.jurnal', function ($query) use ($start_date, $end_date) {
                $query->whereBetween('tanggal', [$start_date, $end_date]);
            });
        }
    
        $pendapatan = $pendapatanQuery->get()->map(function ($akun) use ($start_date, $end_date) {
            return $akun->detail_jurnal->sum(function ($detail) use ($start_date, $end_date) {
                return $detail->jurnal->tanggal >= $start_date && $detail->jurnal->tanggal <= $end_date ? $detail->kredit - $detail->debit : 0;
            });
        });
    
        $beban = $bebanQuery->get()->map(function ($akun) use ($start_date, $end_date) {
            return $akun->detail_jurnal->sum(function ($detail) use ($start_date, $end_date) {
                return $detail->jurnal->tanggal >= $start_date && $detail->jurnal->tanggal <= $end_date ? $detail->debit - $detail->kredit : 0;
            });
        });
    
        $totalPendapatan = $pendapatan->sum();
        $totalBeban = $beban->sum();
        $labaRugi = $totalPendapatan - $totalBeban;
    
        $totalModal += $labaRugi;
    
        $totalPasiva = $totalHutang + $totalModal;
    
        $period = '-';
        if ($start_date && $end_date) {
            $start_date_formatted = \Carbon\Carbon::parse($start_date)->formatLocalized('%B %Y');
            $period = "$start_date_formatted";
        }
    
        if ($request->ajax()) {
            return response()->json(compact('totalPerAkun', 'groupedData', 'totalAktiva', 'totalPasiva', 'labaRugi', 'totalHutang', 'totalModal', 'period'));
        }
    
        if ($request->get('export') == 'pdf') {
            $pdf = PDF::loadView('pdf.neraca-keuangan', compact('totalPerAkun', 'groupedData', 'totalAktiva', 'totalPasiva', 'labaRugi', 'totalHutang', 'totalModal', 'period'));
            return $pdf->stream('Laporan Neraca Keuangan | UD. RAR Crackers.pdf');
        }
    
        return view('akuntan.neraca-keuangan', compact('totalPerAkun', 'groupedData', 'totalAktiva', 'totalPasiva', 'labaRugi', 'totalHutang', 'totalModal', 'period'));
    }    
}