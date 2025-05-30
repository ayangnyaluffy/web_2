<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">List Unit Kerja</h1>

    @if (session('message'))
        <div class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <div class="flex justify-between mb-4">
        <flux:button :href="route('unitkerja.create')" variant="primary">New Unit Kerja</flux:button>
    </div>

    <table class="min-w-full border-collapse border border-gray-400 mt-4">
        <thead>
            <tr class="text-left bg-gray-100">
                <th class="py-2 px-4 border border-gray-300">No</th>
                <th class="py-2 px-4 border border-gray-300">Kode</th>
                <th class="py-2 px-4 border border-gray-300">Nama Pekerjaan</th>
                <th class="py-2 px-4 border border-gray-300">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($unit_kerjas as $index => $unit_kerja)
                <tr>
                    <td class="py-2 px-4 border border-gray-300">{{ $index + 1 }}</td>
                    <td class="py-2 px-4 border border-gray-300">{{ $unit_kerja->kode }}</td>
                    <td class="py-2 px-4 border border-gray-300">{{ $unit_kerja->nama }}</td>
                    <td class="py-2 px-4 border border-gray-300">
                        <flux:button :href="route('unitkerja.edit', $unit_kerja->id)">Edit</flux:button>
                        <flux:button variant="danger" wire:click="delete({{ $unit_kerja->id }})" wire:confirm="Are you sure?">Delete</flux:button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
