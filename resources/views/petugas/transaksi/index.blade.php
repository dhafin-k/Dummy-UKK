<x-layouts.app :title="__('Transaksi')">
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center py-4 gap-4">
        <div>
            <flux:heading size="xl">Transaksi</flux:heading>
            <p class="mt-1 text-sm text-neutral-600 dark:text-neutral-400">
                Kelola transaksi kendaraan masuk dan keluar parkir
            </p>
        </div>
        <div class="flex flex-col sm:flex-row gap-2">
            <a href="{{ route('petugas.transaksi.create', ['id_area' => request()->query('area')]) }}" wire:navigate.hover
                class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Kendaraan Masuk
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="mb-4 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg">
            <p class="text-sm text-green-800 dark:text-green-200">{{ session('success') }}</p>
        </div>
    @endif
    @if (session('error'))
        <div class="mb-4 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg">
            <p class="text-sm text-green-800 dark:text-green-200">{{ session('error') }}</p>
        </div>
    @endif

    <div
        class="mt-4 bg-white dark:bg-neutral-800 rounded-xl shadow-sm border border-neutral-200 dark:border-neutral-700">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-neutral-50 dark:bg-neutral-900/50 border-b border-neutral-200 dark:border-neutral-700">
                    <tr>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider w-16">
                            No</th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider w-16">
                            Plat Nomor</th>
                        <th
                            class="px-6 py-3 text-center text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider w-16">
                            Area</th>
                        <th
                            class="px-6 py-3 text-center text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider w-16">
                            Waktu Masuk</th>
                        <th
                            class="px-6 py-3 text-center text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider w-16">
                            Waktu Keluar</th>
                        <th
                            class="px-6 py-3 text-center text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider w-16">
                            Durasi</th>
                        <th
                            class="px-6 py-3 text-center text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider w-16">
                            Biaya</th>
                        <th
                            class="px-6 py-3 text-center text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider w-16">
                            Status</th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider w-48">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">
                    @forelse($transaksis as $index => $transaksi)
                        <tr class="hover:bg-neutral-50 dark:hover:bg-neutral-800/50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral-900 dark:text-neutral-100">
                                {{ $transaksis->firstItem() + $index }}
                            </td>
                            {{-- <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ $transaksi->jenis_kendaraan == 'mobil' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400' : '' }}
                                    {{ $transaksi->jenis_kendaraan == 'motor' ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' : '' }}
                                    {{ $transaksi->jenis_kendaraan == 'lainnya' ? 'bg-gray-100 text-gray-800 dark:bg-gray-900/30 dark:text-gray-400' : '' }}">
                                    {{ ucfirst($transaksi->jenis_kendaraan) }}
                                </span>
                            </td> --}}

                            <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral-600 dark:text-neutral-400">
                                <div class="flex flex-col">
                                    <span class="text-sm font-medium text-neutral-900 dark:text-neutral-100">
                                        {{ $transaksi->kendaraan->plat_nomor }}
                                    </span>
                                    <span class="text-xs text-neutral-500 dark:text-neutral-400">
                                        {{ ucfirst($transaksi->kendaraan->jenis_kendaraan) }} -
                                        {{ $transaksi->kendaraan->warna }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-6 py-4 text-sm whitespace-nowrap text-neutral-900 dark:text-neutral-100">
                                    {{ $transaksi->area->nama_area }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-6 py-4 text-sm whitespace-nowrap text-neutral-600 dark:text-neutral-400">
                                    {{ $transaksi->waktu_masuk->format('d M Y, H:i') }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-6 py-4 text-sm whitespace-nowrap text-neutral-600 dark:text-neutral-400">
                                    {{ $transaksi->waktu_keluar ? $transaksi->waktu_keluar->format('d M Y, H:i') : '-' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-6 py-4 text-sm whitespace-nowrap text-neutral-900 dark:text-neutral-100">
                                    {{ $transaksi->durasi_jam ? $transaksi->durasi_jam . 'jam' : '-' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($transaksi->biaya_total)
                                    <span class="text-sm font-semibold text-green-600 dark:text-green-400">
                                        Rp {{ number_format($transaksi->biaya_total, 0, ',', '.') }}
                                    </span>
                                @else
                                    <span class="text-sm text-neutral-500">-</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ $transaksi->status == 'masuk' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400' : ' bg-green-100 text-green-800  dark:bg-green-900/30 dark:text-green-400' }}">
                                    {{ ucfirst($transaksi->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <div class="flex gap-2">
                                    @if ($transaksi->status == 'masuk')
                                        <form action="{{ route('petugas.transaksi.update', $transaksi) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin mengupdate transaksi?')"
                                            class="inline">
                                            @csrf
                                            @method('PUT')

                                            <input type="hidden" name="id_kendaraan" value="{{ $transaksi->id_kendaraan }}" />
                                            <input type="hidden" name="id_tarif" value="{{ $transaksi->id_tarif }}" />
                                            <input type="hidden" name="id_area" value="{{ $transaksi->id_area }}" />
                                            <button type="submit"
                                                class="inline-flex items-center gap-1 px-3 py-1.5 text-green-600 hover:text-green-800 dark:text-green-400 dark:hover:text-green-300 hover:bg-green-50 dark:hover:bg-green-900/20 rounded-md transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                                </svg>
                                                Keluar
                                            </button>
                                        </form>
                                    @else
                                        <a href="{{ route('petugas.transaksi.cetak-struk', $transaksi->id) }}" 
                                           target="_blank"
                                           class="inline-flex items-center gap-1 px-3 py-1.5 text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 hover:bg-blue-50 dark:hover:bg-blue-900/20 rounded-md transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                    d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                                            </svg>
                                            Cetak Struk
                                        </a>
                                    @endif
                                    <form action="{{ route('petugas.transaksi.destroy', $transaksi) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus transaksi ini?')"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center gap-1 px-3 py-1.5 text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-md transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        Belum ada data transaksi.
                                    </p>
                                    <a href="{{ route('petugas.transaksi.create') }}"
                                        class="mt-2 inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
                                        Tambah Transaksi Pertama
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($transaksis->hasPages())
            <div class="px-6 py-4 border-t border-neutral-200 dark:border-neutral-700">
                {{ $transaksis->links() }}
            </div>
        @endif
    </div>
</x-layouts.app>
