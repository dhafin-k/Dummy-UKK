<x-layouts.app :title="__('Kendaraan')">
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center py-4 gap-4">
        <div>    
            <flux:heading size="xl">Kendaraan</flux:heading>
            <p class="mt-1 text-sm text-neutral-600 dark:text-neutral-400">
                Kelola data kendaraan.
            </p>
        </div>
        <div class="flex flex-col sm:flex-row gap-2">
            <a href="{{ route('admin.kendaraan.create') }}" wire:navigate.hover class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Kendaraan
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg">
            <p class="text-sm text-green-800 dark:text-green-200">{{ session('success') }}</p>
        </div>
    @endif

    <div class="mt-4 bg-white dark:bg-neutral-800 rounded-xl shadow-sm border border-neutral-200 dark:border-neutral-700">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-neutral-50 dark:bg-neutral-900/50 border-b border-neutral-200 dark:border-neutral-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider w-16">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">Plat Nomor</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">Jenis Kendaraan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">Warna</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">Pemilik</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider w-48">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">
                    @forelse($data as $index => $kendaraan)
                        <tr class="hover:bg-neutral-50 dark:hover:bg-neutral-800/50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral-900 dark:text-neutral-100">
                                {{ $data->firstItem() + $index }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $kendaraan->plat_nomor }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $kendaraan->jenis_kendaraan }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral-600 dark:text-neutral-400">
                                {{ $kendaraan->warna }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral-600 dark:text-neutral-400">
                                {{ $kendaraan->pemilik }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.kendaraan.edit', $kendaraan) }}" wire:navigate.hover
                                       class="inline-flex items-center gap-1 px-3 py-1.5 text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 hover:bg-blue-50 dark:hover:bg-blue-900/20 rounded-md transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.kendaraan.destroy', $kendaraan) }}" method="POST" 
                                          onsubmit="return confirm('Yakin ingin menghapus kendaraan ini?')" 
                                          class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="inline-flex items-center gap-1 px-3 py-1.5 text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-md transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        Belum ada data kendaraan.
                                    </p>
                                    <a href="{{ route('admin.kendaraan.create') }}" 
                                       class="mt-2 inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
                                        Tambah Kendaraan
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($data->hasPages())
            <div class="px-6 py-4 border-t border-neutral-200 dark:border-neutral-700">
                {{ $data->links() }}
            </div>
        @endif
    </div>
</x-layouts.app>