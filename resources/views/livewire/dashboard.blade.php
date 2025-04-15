<div>
    <div x-data="{ showModal: false }" class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class=" flex justify-between">
            <p class="font-bold text-2xl">Data Promo</p>
            <button type="button" @click="showModal = true"
                class="group text-gray-900 hover:text-white border hover:bg-black border-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-2 py-2 text-center inline-flex items-center gap-1 transition-colors duration-200 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <span class="hidden sm:inline">Tambah Promo</span>
                <svg class="w-[20px] h-[20px] text-gray-800 dark:text-white transition-transform duration-200 group-hover:rotate-90 group-hover:text-white"
                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 12h14m-7 7V5" />
                </svg>
            </button>
        </div>

        <!-- Modal -->
        <div x-show="showModal" @keydown.escape.window="showModal = false" @click.outside="showModal = false"
            class="fixed top-0 left-0 z-50 flex items-center justify-center w-full h-full overflow-y-auto bg-black/50"
            style="display: none;">
            <div @click.stop class="relative p-4 w-full max-w-xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                    <!-- Modal header -->
                    <div
                        class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            Tambah Data Promo
                        </h3>
                        <button type="button" @click="showModal = false"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    @if (session()->has('success'))
                        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif
                    <!-- Modal body -->
                    <form wire:submit.prevent="submit" class="p-4 md:p-5">
                        <div class="grid gap-4 mb-4 grid-cols-2">
                            <!-- Promo -->
                            <div class="col-span-2">
                                <label for="description"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Promo
                                </label>
                                <textarea id="promo" wire:model="promo" rows="4"
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Write promo description here" required></textarea>
                                @error('promo')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- Periode -->
                            <div class="col-span-2">
                                <label for="periode"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Periode</label>
                                <input wire:model="periode" type="text" name="periode" id="periode"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Periode of promo" required>
                                @error('periode')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit"
                                class="group text-gray-900 hover:text-white border hover:bg-black border-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-2 py-2 text-center inline-flex items-center gap-1 transition-colors duration-200 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                <span wire:loading.remove wire:target="submit">Tambah Promo</span>
                                <svg wire:loading.remove wire:target="submit"
                                    class="w-[20px] h-[20px] text-gray-800 dark:text-white transition-transform duration-200 group-hover:rotate-90 group-hover:text-white"
                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M5 12h14m-7 7V5" />
                                </svg>

                                <!-- Loading spinner -->
                                <svg wire:loading wire:target="submit"
                                    class="w-5 h-5 animate-spin text-gray-800 dark:text-white"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto bg-white dark:bg-zinc-900 shadow-md rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-300">
                    <tr>
                        <th scope="col" class="w-1/12 px-3 py-3 text-center">
                            No
                        </th>
                        <th scope="col" class="w-5/12 md:w-8/12 px-3 py-3 text-left">
                            Promo
                        </th>
                        <th scope="col" class="w-3/12 px-3 py-3 text-center">
                            Periode
                        </th>
                        <th scope="col" class="w-3/12 px-3 py-3 text-center">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody id="promo-tbody">
                    @forelse ($promos as $index => $promo)
                        <tr class="border-b dark:border-gray-700">
                            <td class="px-3 text-center py-4">{{ $loop->iteration }}</td>
                            <td class="px-3 py-4">
                                @php
                                    $fullText = $promo['promo'] ?? '-';
                                    $words = explode(' ', $fullText);
                                    $shortText =
                                        implode(' ', array_slice($words, 0, 7)) . (count($words) > 7 ? '...' : '');
                                @endphp
                                <div>
                                    <div wire:loading.remove wire:target="togglePromo">
                                        @if ($showFull[$index] ?? false)
                                            {{ $fullText }}
                                            <button wire:click="togglePromo('{{ $index }}')"
                                                class="text-blue-600 text-xs hover:underline">
                                                Sembunyikan
                                            </button>
                                        @else
                                            {{ $shortText }}
                                            @if (count($words) > 10)
                                                <button wire:click="togglePromo('{{ $index }}')"
                                                    class="text-blue-600 text-xs hover:underline">
                                                    Lihat Selengkapnya
                                                </button>
                                            @endif
                                        @endif
                                    </div>

                                    {{-- Loading --}}
                                    <div wire:loading wire:target="togglePromo" class="text-gray-500 text-xs italic">
                                        Memuat...
                                    </div>
                                </div>
                            </td>

                            <td class="px-3 py-4 text-center">{{ $promo['periode'] ?? '-' }}</td>
                            <td class="px-3 py-4">
                                <div class=" flex justify-center align-items-center gap-3">
                                    {{-- Tombol Edit --}}
                                    <a href="#" class="text-[#001c40] dark:text-[#b8b8b9] hover:text-blue-800"
                                        aria-label="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="w-5 h-5"
                                            fill="currentColor">
                                            <path
                                                d="M532 386.2c27.5-27.1 44-61.1 44-98.2 0-80-76.5-146.1-176.2-157.9C368.3 72.5 294.3 32 208 32 93.1 32 0 103.6 0 192c0 37 16.5 71 44 98.2-15.3 30.7-37.3 54.5-37.7 54.9-6.3 6.7-8.1 16.5-4.4 25 3.6 8.5 12 14 21.2 14 53.5 0 96.7-20.2 125.2-38.8 9.2 2.1 18.7 3.7 28.4 4.9C208.1 407.6 281.8 448 368 448c20.8 0 40.8-2.4 59.8-6.8C456.3 459.7 499.4 480 553 480c9.2 0 17.5-5.5 21.2-14 3.6-8.5 1.9-18.3-4.4-25-.4-.3-22.5-24.1-37.8-54.8zm-392.8-92.3L122.1 305c-14.1 9.1-28.5 16.3-43.1 21.4 2.7-4.7 5.4-9.7 8-14.8l15.5-31.1L77.7 256C64.2 242.6 48 220.7 48 192c0-60.7 73.3-112 160-112s160 51.3 160 112-73.3 112-160 112c-16.5 0-33-1.9-49-5.6l-19.8-4.5zM498.3 352l-24.7 24.4 15.5 31.1c2.6 5.1 5.3 10.1 8 14.8-14.6-5.1-29-12.3-43.1-21.4l-17.1-11.1-19.9 4.6c-16 3.7-32.5 5.6-49 5.6-54 0-102.2-20.1-131.3-49.7C338 339.5 416 272.9 416 192c0-3.4-.4-6.7-.7-10C479.7 196.5 528 238.8 528 288c0 28.7-16.2 50.6-29.7 64z" />
                                        </svg>
                                    </a>

                                    {{-- Tombol Hapus --}}
                                    <a href="#" class="text-[#001c40] dark:text-[#b8b8b9] hover:text-red-700"
                                        aria-label="Hapus">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="w-5 h-5"
                                            fill="currentColor">
                                            <path
                                                d="M32 464a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V128H32zm272-256a16 16 0 0 1 32 0v224a16 16 0 0 1 -32 0zm-96 0a16 16 0 0 1 32 0v224a16 16 0 0 1 -32 0zm-96 0a16 16 0 0 1 32 0v224a16 16 0 0 1 -32 0zM432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.7 23.7 0 0 0 -21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0 -16-16z" />
                                        </svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4">Belum Ada Promo</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
