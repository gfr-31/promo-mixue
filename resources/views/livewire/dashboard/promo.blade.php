<div>
    {{-- @dd(session('user')) --}}


    <flux:heading size="xl">Dashboard Promo</flux:heading>

    <flux:separator variant="subtle" class="my-4" />

    {{-- Your Promo Content Here --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse($promos as $promo)
            <div class="p-4 border rounded-lg bg-white dark:bg-zinc-800">
                <h3 class="font-bold">{{ $promo['title'] }}</h3>
                <p>{{ $promo['description'] }}</p>
            </div>
        @empty
            <p>No promos available.</p>
        @endforelse
    </div>

</div>
