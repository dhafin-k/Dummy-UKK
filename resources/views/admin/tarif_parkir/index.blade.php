<x-layouts.app :title="__('Tarif Parkir')">
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center py-4 gap-4">
        <div>
            <flux:heading size="xl">Data Tarif Parkir</flux:heading>
            <flux:text class="mt-1 text-neutral-600 dark:text-neutral-400">
                Kelola data tarif parkir di sistem Anda.
            </flux:text>
        </div>
        <div class="flex flex-col sm:flex-row">
            <flux:button variant="primary" href="{{ route('admin.tarif-parkir.create') }}">
                Tambah Data
            </flux:button>
        </div>
    </div>

    <div class="bg-white dark:bg-neutral-800 rounded-2xl">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-neutral-200 dark:divide-neutral-700">
            <thead class="bg-gray-50/50 dark:bg-neutral-800/50">
                <tr>
                    <th class="px-4 py-2 text-left">Jenis Kendaraan</th>
                    <th class="px-4 py-2 text-left">Tarif per Jam</th>
                    <th class="px-4 py-2 text-left">Tarif per Hari</th>
                    <th class="px-4 py-2 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border-t px-4 py-2">Mobil</td>
                    <td class="border-t px-4 py-2">Rp 5.000</td>
                    <td class="border-t px-4 py-2">Rp 50.000</td>
                    <td class="border-t px-4 py-2">
                        <flux:button size="sm" variant="ghost" href="#">
                            Edit
                        </flux:button>
                        <flux:button size="sm" variant="danger" href="#">
                            Hapus
                        </flux:button>
                    </td>
                </tr>
                <tr>
                    <td class="border-t px-4 py-2">Mobil</td>
                    <td class="border-t px-4 py-2">Rp 5.000</td>
                    <td class="border-t px-4 py-2">Rp 50.000</td>
                    <td class="border-t px-4 py-2">
                        <flux:button size="sm" variant="ghost" href="#">
                            Edit
                        </flux:button>
                        <flux:button size="sm" variant="danger" href="#">
                            Hapus
                        </flux:button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
</x-layouts.app>
