<x-filament-panels::page>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Konfirmasi Status Proses
        </h2>
    </x-slot>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <p>Deskripsikan secara lengkap tentang barang ini:</p>
                        <p>{{ $laporan->nama_barang }}</p>
                        
                        <form id="formKonfirmasi" method="POST" action="{{ route('simpan-jawaban-konfirmasi') }}">
                            @csrf
                            <input type="hidden" name="laporan_id" value="{{ $laporan->id }}">
                            
                            <div class="form-group">
                                <label for="jawaban" class="col-form-label">Jawaban Anda</label>
                                <textarea id="jawaban" class="form-control" name="jawaban" rows="4" required></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Kirim Jawaban</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-filament-panels::page>
