<x-layouts.app :title="__('Dashboard')">
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center py-4 gap-4">
        <div>
            <flux:heading size="xl">Dashboard</flux:heading>
            <p class="mt-1 text-sm text-neutral-600 dark:text-neutral-400">
                Rekap dan statistik sistem parkir
            </p>
        </div>
    </div>

    <!-- Filter Tanggal -->
    <div class="mb-4 bg-white dark:bg-neutral-800 rounded-xl shadow-sm border border-neutral-200 dark:border-neutral-700 p-6">
        <form method="GET" action="{{ route('dashboard') }}" class="flex flex-wrap gap-4 items-end">
            <div class="flex-1 min-w-[200px]">
                <label class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">
                    Tanggal Mulai
                </label>
                <input type="date" name="start_date" value="{{ $startDate }}" 
                    class="w-full px-4 py-2 border border-neutral-300 dark:border-neutral-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-neutral-700 dark:text-white">
            </div>
            <div class="flex-1 min-w-[200px]">
                <label class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">
                    Tanggal Akhir
                </label>
                <input type="date" name="end_date" value="{{ $endDate }}" 
                    class="w-full px-4 py-2 border border-neutral-300 dark:border-neutral-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-neutral-700 dark:text-white">
            </div>
            <div>
                <button type="submit" 
                    class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                    Filter
                </button>
            </div>
        </form>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
        <!-- Total Transaksi -->
        <div class="bg-white dark:bg-neutral-800 rounded-xl shadow-sm border border-neutral-200 dark:border-neutral-700 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400">Total Transaksi</p>
                    <p class="text-2xl font-bold text-neutral-900 dark:text-white mt-1">{{ number_format($totalTransaksi) }}</p>
                </div>
                <div class="p-3 bg-blue-100 dark:bg-blue-900/30 rounded-lg">
                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
            </div>
            <div class="mt-3 flex gap-4 text-xs">
                <span class="text-yellow-600 dark:text-yellow-400">Masuk: {{ $transaksiMasuk }}</span>
                <span class="text-green-600 dark:text-green-400">Keluar: {{ $transaksiKeluar }}</span>
            </div>
        </div>

        <!-- Total Pendapatan -->
        <div class="bg-white dark:bg-neutral-800 rounded-xl shadow-sm border border-neutral-200 dark:border-neutral-700 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400">Total Pendapatan</p>
                    <p class="text-2xl font-bold text-neutral-900 dark:text-white mt-1">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
                </div>
                <div class="p-3 bg-green-100 dark:bg-green-900/30 rounded-lg">
                    <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Kendaraan -->
        <div class="bg-white dark:bg-neutral-800 rounded-xl shadow-sm border border-neutral-200 dark:border-neutral-700 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400">Total Kendaraan</p>
                    <p class="text-2xl font-bold text-neutral-900 dark:text-white mt-1">{{ number_format($totalKendaraan) }}</p>
                </div>
                <div class="p-3 bg-purple-100 dark:bg-purple-900/30 rounded-lg">
                    <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Kapasitas Parkir -->
        <div class="bg-white dark:bg-neutral-800 rounded-xl shadow-sm border border-neutral-200 dark:border-neutral-700 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400">Kapasitas Tersedia</p>
                    <p class="text-2xl font-bold text-neutral-900 dark:text-white mt-1">{{ number_format($kapasitasTersedia) }} / {{ number_format($kapasitasTotal) }}</p>
                </div>
                <div class="p-3 bg-orange-100 dark:bg-orange-900/30 rounded-lg">
                    <svg class="w-6 h-6 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
            </div>
            <div class="mt-3">
                <div class="w-full bg-neutral-200 dark:bg-neutral-700 rounded-full h-2">
                    <div class="bg-orange-600 h-2 rounded-full" style="width: {{ $kapasitasTotal > 0 ? ($terisiTotal / $kapasitasTotal * 100) : 0 }}%"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Admin Only Stats -->
    @if($user->role === 'admin')
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-4">
        <!-- Statistik Per Petugas -->
        <div class="bg-white dark:bg-neutral-800 rounded-xl shadow-sm border border-neutral-200 dark:border-neutral-700 p-6">
            <h3 class="text-lg font-semibold text-neutral-900 dark:text-white mb-4">Statistik Per Petugas</h3>
            <div class="space-y-3">
                @forelse($statistikPerPetugas as $petugas)
                <div class="flex justify-between items-center p-3 bg-neutral-50 dark:bg-neutral-700/50 rounded-lg">
                    <span class="text-sm font-medium text-neutral-700 dark:text-neutral-300">{{ $petugas->name }}</span>
                    <span class="text-sm font-bold text-blue-600 dark:text-blue-400">{{ $petugas->total_transaksi }} transaksi</span>
                </div>
                @empty
                <p class="text-sm text-neutral-500 dark:text-neutral-400 text-center py-4">Belum ada data</p>
                @endforelse
            </div>
        </div>

        <!-- Statistik Per Area -->
        <div class="bg-white dark:bg-neutral-800 rounded-xl shadow-sm border border-neutral-200 dark:border-neutral-700 p-6">
            <h3 class="text-lg font-semibold text-neutral-900 dark:text-white mb-4">Statistik Per Area Parkir</h3>
            <div class="space-y-3">
                @forelse($statistikArea as $area)
                <div class="p-3 bg-neutral-50 dark:bg-neutral-700/50 rounded-lg">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-sm font-medium text-neutral-700 dark:text-neutral-300">{{ $area->nama_area }}</span>
                        <span class="text-xs text-neutral-500 dark:text-neutral-400">{{ $area->terisi }}/{{ $area->kapasitas }}</span>
                    </div>
                    <div class="flex justify-between text-xs">
                        <span class="text-neutral-600 dark:text-neutral-400">{{ $area->total_transaksi }} transaksi</span>
                        <span class="text-green-600 dark:text-green-400 font-semibold">Rp {{ number_format($area->pendapatan_area ?? 0, 0, ',', '.') }}</span>
                    </div>
                </div>
                @empty
                <p class="text-sm text-neutral-500 dark:text-neutral-400 text-center py-4">Belum ada area parkir</p>
                @endforelse
            </div>
        </div>
    </div>
    @else
    <!-- Statistik Per Area untuk non-admin -->
    <div class="bg-white dark:bg-neutral-800 rounded-xl shadow-sm border border-neutral-200 dark:border-neutral-700 p-6 mb-4">
        <h3 class="text-lg font-semibold text-neutral-900 dark:text-white mb-4">Statistik Per Area Parkir</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @forelse($statistikArea as $area)
            <div class="p-4 bg-neutral-50 dark:bg-neutral-700/50 rounded-lg">
                <div class="flex justify-between items-center mb-2">
                    <span class="text-sm font-medium text-neutral-700 dark:text-neutral-300">{{ $area->nama_area }}</span>
                    <span class="text-xs text-neutral-500 dark:text-neutral-400">{{ $area->terisi }}/{{ $area->kapasitas }}</span>
                </div>
                <div class="flex justify-between text-xs">
                    <span class="text-neutral-600 dark:text-neutral-400">{{ $area->total_transaksi }} transaksi</span>
                    <span class="text-green-600 dark:text-green-400 font-semibold">Rp {{ number_format($area->pendapatan_area ?? 0, 0, ',', '.') }}</span>
                </div>
            </div>
            @empty
            <p class="text-sm text-neutral-500 dark:text-neutral-400 text-center py-4 col-span-full">Belum ada area parkir</p>
            @endforelse
        </div>
    </div>
    @endif

    <!-- Transaksi Terbaru -->
    <div class="mt-4 bg-white dark:bg-neutral-800 rounded-xl shadow-sm border border-neutral-200 dark:border-neutral-700">
        <div class="p-6 border-b border-neutral-200 dark:border-neutral-700">
            <h3 class="text-lg font-semibold text-neutral-900 dark:text-white">Transaksi Terbaru</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-neutral-50 dark:bg-neutral-900/50 border-b border-neutral-200 dark:border-neutral-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider w-16">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">Plat Nomor</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">Area</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">Waktu Masuk</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">Biaya</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">
                    @forelse($transaksiTerbaru as $index => $transaksi)
                    <tr class="hover:bg-neutral-50 dark:hover:bg-neutral-800/50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral-900 dark:text-neutral-100">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-neutral-900 dark:text-neutral-100">{{ $transaksi->kendaraan->plat_nomor }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral-600 dark:text-neutral-400">{{ $transaksi->area->nama_area }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral-600 dark:text-neutral-400">{{ $transaksi->waktu_masuk->format('d M Y, H:i') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                {{ $transaksi->status == 'masuk' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400' : 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' }}">
                                {{ ucfirst($transaksi->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-right font-semibold text-green-600 dark:text-green-400">
                            {{ $transaksi->biaya_total ? 'Rp ' . number_format($transaksi->biaya_total, 0, ',', '.') : '-' }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center gap-3">
                                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    Belum ada transaksi pada periode ini
                                </p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.app>

        <form method="GET" action="{{ route('dashboard') }}" class="flex flex-wrap gap-4 items-end">
            <div class="flex-1 min-w-[200px]">
                <label class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">
                    Tanggal Mulai
                </label>
                <input type="date" name="start_date" value="{{ $startDate }}" 
                    class="w-full px-4 py-2 border border-neutral-300 dark:border-neutral-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-neutral-700 dark:text-white">
            </div>
            <div class="flex-1 min-w-[200px]">
                <label class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">
                    Tanggal Akhir
                </label>
                <input type="date" name="end_date" value="{{ $endDate }}" 
                    class="w-full px-4 py-2 border border-neutral-300 dark:border-neutral-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-neutral-700 dark:text-white">
            </div>
            <div>
                <button type="submit" 
                    class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                    Filter
                </button>
            </div>
        </form>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <!-- Total Transaksi -->
        <div class="bg-white dark:bg-neutral-800 rounded-xl shadow-sm border border-neutral-200 dark:border-neutral-700 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400">Total Transaksi</p>
                    <p class="text-2xl font-bold text-neutral-900 dark:text-white mt-1">{{ number_format($totalTransaksi) }}</p>
                </div>
                <div class="p-3 bg-blue-100 dark:bg-blue-900/30 rounded-lg">
                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
            </div>
            <div class="mt-3 flex gap-4 text-xs">
                <span class="text-yellow-600 dark:text-yellow-400">Masuk: {{ $transaksiMasuk }}</span>
                <span class="text-green-600 dark:text-green-400">Keluar: {{ $transaksiKeluar }}</span>
            </div>
        </div>

        <!-- Total Pendapatan -->
        <div class="bg-white dark:bg-neutral-800 rounded-xl shadow-sm border border-neutral-200 dark:border-neutral-700 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400">Total Pendapatan</p>
                    <p class="text-2xl font-bold text-neutral-900 dark:text-white mt-1">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
                </div>
                <div class="p-3 bg-green-100 dark:bg-green-900/30 rounded-lg">
                    <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Kendaraan -->
        <div class="bg-white dark:bg-neutral-800 rounded-xl shadow-sm border border-neutral-200 dark:border-neutral-700 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400">Total Kendaraan</p>
                    <p class="text-2xl font-bold text-neutral-900 dark:text-white mt-1">{{ number_format($totalKendaraan) }}</p>
                </div>
                <div class="p-3 bg-purple-100 dark:bg-purple-900/30 rounded-lg">
                    <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Kapasitas Parkir -->
        <div class="bg-white dark:bg-neutral-800 rounded-xl shadow-sm border border-neutral-200 dark:border-neutral-700 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400">Kapasitas Tersedia</p>
                    <p class="text-2xl font-bold text-neutral-900 dark:text-white mt-1">{{ number_format($kapasitasTersedia) }} / {{ number_format($kapasitasTotal) }}</p>
                </div>
                <div class="p-3 bg-orange-100 dark:bg-orange-900/30 rounded-lg">
                    <svg class="w-6 h-6 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
            </div>
            <div class="mt-3">
                <div class="w-full bg-neutral-200 dark:bg-neutral-700 rounded-full h-2">
                    <div class="bg-orange-600 h-2 rounded-full" style="width: {{ $kapasitasTotal > 0 ? ($terisiTotal / $kapasitasTotal * 100) : 0 }}%"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Admin Only Stats -->
    @if($user->role === 'admin')
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <!-- Statistik Per Petugas -->
        <div class="bg-white dark:bg-neutral-800 rounded-xl shadow-sm border border-neutral-200 dark:border-neutral-700 p-6">
            <h3 class="text-lg font-semibold text-neutral-900 dark:text-white mb-4">Statistik Per Petugas</h3>
            <div class="space-y-3">
                @forelse($statistikPerPetugas as $petugas)
                <div class="flex justify-between items-center p-3 bg-neutral-50 dark:bg-neutral-700/50 rounded-lg">
                    <span class="text-sm font-medium text-neutral-700 dark:text-neutral-300">{{ $petugas->name }}</span>
                    <span class="text-sm font-bold text-blue-600 dark:text-blue-400">{{ $petugas->total_transaksi }} transaksi</span>
                </div>
                @empty
                <p class="text-sm text-neutral-500 dark:text-neutral-400 text-center py-4">Belum ada data</p>
                @endforelse
            </div>
        </div>

        <!-- Statistik Per Area -->
        <div class="bg-white dark:bg-neutral-800 rounded-xl shadow-sm border border-neutral-200 dark:border-neutral-700 p-6">
            <h3 class="text-lg font-semibold text-neutral-900 dark:text-white mb-4">Statistik Per Area Parkir</h3>
            <div class="space-y-3">
                @forelse($statistikArea as $area)
                <div class="p-3 bg-neutral-50 dark:bg-neutral-700/50 rounded-lg">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-sm font-medium text-neutral-700 dark:text-neutral-300">{{ $area->nama_area }}</span>
                        <span class="text-xs text-neutral-500 dark:text-neutral-400">{{ $area->terisi }}/{{ $area->kapasitas }}</span>
                    </div>
                    <div class="flex justify-between text-xs">
                        <span class="text-neutral-600 dark:text-neutral-400">{{ $area->total_transaksi }} transaksi</span>
                        <span class="text-green-600 dark:text-green-400 font-semibold">Rp {{ number_format($area->pendapatan_area ?? 0, 0, ',', '.') }}</span>
                    </div>
                </div>
                @empty
                <p class="text-sm text-neutral-500 dark:text-neutral-400 text-center py-4">Belum ada area parkir</p>
                @endforelse
            </div>
        </div>
    </div>
    @else
    <!-- Statistik Per Area untuk non-admin -->
    <div class="bg-white dark:bg-neutral-800 rounded-xl shadow-sm border border-neutral-200 dark:border-neutral-700 p-6 mb-6">
        <h3 class="text-lg font-semibold text-neutral-900 dark:text-white mb-4">Statistik Per Area Parkir</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @forelse($statistikArea as $area)
            <div class="p-4 bg-neutral-50 dark:bg-neutral-700/50 rounded-lg">
                <div class="flex justify-between items-center mb-2">
                    <span class="text-sm font-medium text-neutral-700 dark:text-neutral-300">{{ $area->nama_area }}</span>
                    <span class="text-xs text-neutral-500 dark:text-neutral-400">{{ $area->terisi }}/{{ $area->kapasitas }}</span>
                </div>
                <div class="flex justify-between text-xs">
                    <span class="text-neutral-600 dark:text-neutral-400">{{ $area->total_transaksi }} transaksi</span>
                    <span class="text-green-600 dark:text-green-400 font-semibold">Rp {{ number_format($area->pendapatan_area ?? 0, 0, ',', '.') }}</span>
                </div>
            </div>
            @empty
            <p class="text-sm text-neutral-500 dark:text-neutral-400 text-center py-4 col-span-full">Belum ada area parkir</p>
            @endforelse
        </div>
    </div>
    @endif

    <!-- Transaksi Terbaru -->
    <div class="bg-white dark:bg-neutral-800 rounded-xl shadow-sm border border-neutral-200 dark:border-neutral-700">
        <div class="p-6 border-b border-neutral-200 dark:border-neutral-700">
            <h3 class="text-lg font-semibold text-neutral-900 dark:text-white">Transaksi Terbaru</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-neutral-50 dark:bg-neutral-900/50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase">Plat Nomor</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase">Area</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase">Waktu Masuk</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase">Status</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase">Biaya</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">
                    @forelse($transaksiTerbaru as $index => $transaksi)
                    <tr class="hover:bg-neutral-50 dark:hover:bg-neutral-800/50">
                        <td class="px-6 py-4 text-sm text-neutral-900 dark:text-neutral-100">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 text-sm font-medium text-neutral-900 dark:text-neutral-100">{{ $transaksi->kendaraan->plat_nomor }}</td>
                        <td class="px-6 py-4 text-sm text-neutral-600 dark:text-neutral-400">{{ $transaksi->area->nama_area }}</td>
                        <td class="px-6 py-4 text-sm text-neutral-600 dark:text-neutral-400">{{ $transaksi->waktu_masuk->format('d M Y, H:i') }}</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                {{ $transaksi->status == 'masuk' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400' : 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' }}">
                                {{ ucfirst($transaksi->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-right font-semibold text-green-600 dark:text-green-400">
                            {{ $transaksi->biaya_total ? 'Rp ' . number_format($transaksi->biaya_total, 0, ',', '.') : '-' }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-sm text-neutral-500 dark:text-neutral-400">
                            Belum ada transaksi pada periode ini
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.app>
