<div>
    {{-- @dd($user) --}}
    @if ($user && $user['role'] === 'head')
        <flux:navlist.item icon="user" href="#">User</flux:navlist.item>
    @endif
</div>
