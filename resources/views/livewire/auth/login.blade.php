<div class="flex min-h-screen">
    <div class="flex-1 flex justify-center  ">
        <div class="w-80 max-w-80 space-y-6 my-15">
            <div class="flex justify-center opacity-50">
                <a href="#" class="group flex items-center gap-3">
                    <div>
                        <svg class="h-4 text-zinc-800 dark:text-white" viewBox="0 0 18 13" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g>
                                <line x1="1" y1="5" x2="1" y2="10" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round"></line>
                                <line x1="5" y1="1" x2="5" y2="8" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round"></line>
                                <line x1="9" y1="5" x2="9" y2="10" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round"></line>
                                <line x1="13" y1="1" x2="13" y2="12" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round"></line>
                                <line x1="17" y1="5" x2="17" y2="10" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round"></line>
                            </g>
                        </svg>
                    </div>

                    <span class="text-xl font-semibold text-zinc-800 dark:text-white">flux</span>
                </a>
            </div>

            <flux:heading class="text-center" size="xl">Welcome back</flux:heading>

            <form wire:submit.prevent="login" action="">
                @csrf
                @if (session()->has('error'))
                    <div class="text-red-500 text-sm">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="flex flex-col gap-6">
                    <flux:input wire:model="email" label="Email" type="email" placeholder="email@example.com" />

                    <flux:field>
                        <div class="mb-3 flex justify-between">
                            <flux:label>Password</flux:label>

                            <flux:link href="#" variant="subtle" class="text-sm">Forgot password?</flux:link>
                        </div>

                        <flux:input wire:model="password" type="password" placeholder="Your password" />
                    </flux:field>

                    <flux:checkbox wire:model="remember" label="Remember me For 30 Days" />

                    <flux:button type="submit" variant="primary" class="w-full">
                        Log in
                    </flux:button>
                </div>
            </form>

        </div>
    </div>

    <div class="flex-1 p-4 max-lg:hidden">
        <div class="text-white relative rounded-lg h-full w-full bg-zinc-900 flex flex-col items-start justify-end p-16"
            style="background-image: url('/img/demo/auth_aurora_2x.png'); background-size: cover">
            <div class="flex gap-2 mb-4">
                <flux:icon.star variant="solid" />
                <flux:icon.star variant="solid" />
                <flux:icon.star variant="solid" />
                <flux:icon.star variant="solid" />
                <flux:icon.star variant="solid" />
            </div>

            <div class="mb-6 italic font-base text-3xl xl:text-4xl">
                Ini adalah Aplikasi Aplikasi Menegemant Promo Mixue Cisauk
            </div>

            <div class="flex gap-4">
                <flux:avatar src="" size="xl" />

                <div class="flex flex-col justify-center font-medium">
                    <div class="text-lg">GFR</div>
                    <div class="text-zinc-300">Creator of Menegemant Promo</div>
                </div>
            </div>
        </div>
    </div>
</div>
