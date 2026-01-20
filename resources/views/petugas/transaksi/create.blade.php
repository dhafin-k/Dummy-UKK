<x-layouts.app :title="__('Kendaraan Masuk')">
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center py-4 gap-4">
        <div>
            <flux:heading size="xl">Kendaraan Masuk Parkir</flux:heading>
            <p class="mt-1 text-sm text-neutral-600 dark:text-neutral-400">
                Input data kendaraan yang masuk area parkir.
            </p>
        </div>
        <div class="flex flex-col sm:flex-row gap-2">
            <a href="{{ route('petugas.transaksi.index') }}"
               class="inline-flex items-center gap-2 px-4 py-2 text-neutral-700 dark:text-neutral-300 hover:bg-neutral-100 dark:hover:bg-neutral-700 text-sm font-medium rounded-lg transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>
        </div>
    </div>

    <div class="mt-4 bg-white dark:bg-neutral-800 rounded-xl shadow-sm border border-neutral-200 dark:border-neutral-700 p-6">
        <form action="{{ route('petugas.transaksi.store') }}" method="POST">
            @csrf
            <div class="space-y-6">
                <!-- Pilih Kendaraan -->
                <div>
                    <label for="id_kendaraan" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">
                        Pilih Kendaraan <span class="text-red-500">*</span>
                    </label>
                    <select name="id_kendaraan" id="id_kendaraan" required
                            class="w-full px-3 py-2 border border-neutral-300 dark:border-neutral-600 rounded-lg bg-white dark:bg-neutral-900 text-neutral-900 dark:text-neutral-100 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Pilih Kendaraan</option>
                        @foreach($kendaraans as $kendaraan)
                            <option value="{{ $kendaraan->id }}" {{ old('id_kendaraan') == $kendaraan->id ? 'selected' : '' }}>
                                {{ $kendaraan->plat_nomor }} - {{ ucfirst($kendaraan->jenis_kendaraan) }} ({{ $kendaraan->pemilik }})
                            </option>
                        @endforeach
                    </select>
                    @error('id_kendaraan')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-xs text-neutral-500 dark:text-neutral-400">Pilih kendaraan yang akan masuk parkir.</p>
                </div>

                <!-- Pilih Tarif -->
                <div>
                    <label for="id_tarif" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">
                        Pilih Tarif <span class="text-red-500">*</span>
                    </label>
                    <select name="id_tarif" id="id_tarif" required
                            class="w-full px-3 py-2 border border-neutral-300 dark:border-neutral-600 rounded-lg bg-white dark:bg-neutral-900 text-neutral-900 dark:text-neutral-100 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Pilih Tarif</option>
                        @foreach($tarifs as $tarif)
                            <option value="{{ $tarif->id }}" {{ old('id_tarif') == $tarif->id ? 'selected' : '' }}>
                                {{ ucfirst($tarif->jenis_kendaraan) }} - Rp {{ number_format($tarif->tarif_per_jam, 0, ',', '.') }}/jam
                            </option>
                        @endforeach
                    </select>
                    @error('id_tarif')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-xs text-neutral-500 dark:text-neutral-400">Pilih tarif sesuai jenis kendaraan.</p>
                </div>

                <!-- Pilih Area -->
                <div>
                    <label for="id_area" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">
                        Pilih Area Parkir <span class="text-red-500">*</span>
                    </label>
                    <select name="id_area" id="id_area" required
                            class="w-full px-3 py-2 border border-neutral-300 dark:border-neutral-600 rounded-lg bg-white dark:bg-neutral-900 text-neutral-900 dark:text-neutral-100 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Pilih Area</option>
                        @foreach($areas as $area)
                            <option value="{{ $area->id }}" {{ old('id_area') == $area->id ? 'selected' : '' }}>
                                {{ $area->nama_area }} ({{ $area->terisi }}/{{ $area->kapasitas }})
                            </option>
                        @endforeach
                    </select>
                    @error('id_area')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-xs text-neutral-500 dark:text-neutral-400">Pilih area parkir yang tersedia.</p>
                </div>
            </div>

            <div class="flex justify-end gap-3 mt-8 pt-6 border-t border-neutral-200 dark:border-neutral-700">
                <a href="{{ route('petugas.transaksi.index') }}"
                   class="px-4 py-2 text-neutral-700 dark:text-neutral-300 hover:bg-neutral-100 dark:hover:bg-neutral-700 rounded-lg transition-colors">
                    Batal
                </a>
                <button type="submit"
                        class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan Transaksi
                </button>
            </div>
        </form>
    </div>
</x-layouts.app>
