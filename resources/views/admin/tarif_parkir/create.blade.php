<x-layouts.app :title="__('Tarif Parkir')">
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center py-4 gap-4">
        <div>
            <flux:heading size="xl">Tambah Data Tarif Parkir</flux:heading>
            <flux:text class="mt-1 text-neutral-600 dark:text-neutral-400">
                Tambah data tarif parkir di sistem Anda.
            </flux:text>
        </div>
        <div class="flex flex-col sm:flex-row">

        </div>
    </div>

    <form action="">
        @csrf
        <div class="grid gap-4 md:grid-cols-2">
            <flux:field>
                <flux:label>Jenis Kendaraaan</flux:label>
                <flux:select wire:model="" placeholder="Pilih Jenis Kendaraan">
                    <flux:select.option value="mobil">Mobil</flux:select.option>
                    <flux:select.option value="motor">Motor</flux:select.option>
                    <flux:select.option value="lainnya">Lainnya</flux:select.option>
                </flux:select>
                <flux:error name="jenis_kendaraan" />
            </flux:field>

            <flux:field>
                <flux:label>Tarif per Jam</flux:label>
                <flux:input name="tarif_per_jam" type="number" wire:model="" placeholder="Masukkan Tarif per Jam" />
                <flux:error name="tarif_per_jam" />
            </flux:field>
        </div>
    </form>
</x-layouts.app>
