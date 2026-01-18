<?php
use Illuminate\Support\Facades\Auth;

$user = Auth::user();
$role = $user ? $user->role : null;
?>


<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-white dark:bg-zinc-800">
    <flux:sidebar sticky collapsible="mobile"
        class="border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
        <flux:sidebar.header>
            <x-app-logo :sidebar="true" href="{{ route('dashboard') }}" wire:navigate />
            <flux:sidebar.collapse class="lg:hidden" />
        </flux:sidebar.header>

        <flux:sidebar.nav>
            @if ($role === 'admin')
                <flux:sidebar.group :heading="__('Platform')" class="grid gap-2">
                    <flux:sidebar.item icon="home" :href="route('dashboard')"
                        :current="request()->routeIs('dashboard')" wire:navigate>
                        {{ __('Dashboard') }}
                    </flux:sidebar.item>
                    <flux:sidebar.item icon="users" :href="route('admin.users.index')"
                        :current="request()->routeIs('admin.users.*')" wire:navigate>
                        Users
                    </flux:sidebar.item>
                </flux:sidebar.group>

                <flux:sidebar.group expandable
                    expanded="{{ request()->routeIs('admin.tarif-parkir.*') ? 'true' : 'false' }}" heading="Data Parkir"
                    icon="truck" class="grid">
                    <flux:sidebar.item icon="map-pin" :href="route('admin.area-parkir.index')"
                        :current="request()->routeIs('admin.area-parkir.*')" wire:navigate>
                        {{ __('Area Parkir') }}
                    </flux:sidebar.item>
                    <flux:sidebar.item icon="currency-dollar" :href="route('admin.tarif-parkir.index')"
                        :current="request()->routeIs('admin.tarif-parkir.*')" wire:navigate>
                        {{ __('Tarif Parkir') }}
                    </flux:sidebar.item>
                </flux:sidebar.group>
                <flux:sidebar.item :href="route('admin.kendaraan.index')"
                    :current="request()->routeIs('admin.kendaraan.*')" icon="truck" wire:navigate>
                    {{ __('Kendaraan') }}
                </flux:sidebar.item>
                <flux:sidebar.item icon="circle-stack" wire:navigate :href="route('admin.log-aktivitas.index')"
                    :current="request()->routeIs('admin.log-aktivitas.*')">
                    {{ __('Log Aktivitas') }}
                </flux:sidebar.item>
            @endif

            @if ($role === 'petugas')
                <flux:sidebar.group :heading="__('Platform')" class="grid gap-2">
                    <flux:sidebar.item icon="home" :href="route('dashboard')"
                        :current="request()->routeIs('dashboard')" wire:navigate>
                        {{ __('Dashboard') }}
                    </flux:sidebar.item>
                    <flux:sidebar.item icon="users" :href="route('petugas.transaksi.index')"
                        :current="request()->routeIs('petugas.transaksi.*')" wire:navigate>
                        Transaksi
                    </flux:sidebar.item>
                </flux:sidebar.group>
            @endif

            @if($role === 'owner')
                <flux:sidebar.group :heading="__('Platform')" class="grid gap-2">
                    <flux:sidebar.item icon="home" :href="route('dashboard')"
                        :current="request()->routeIs('dashboard')" wire:navigate>
                        {{ __('Dashboard') }}
                    </flux:sidebar.item>
                    <flux:sidebar.item icon="users" :href="route('admin.users.index')"
                        :current="request()->routeIs('admin.users.*')" wire:navigate>
                        Rekap Transaksi
                    </flux:sidebar.item>
                </flux:sidebar.group>
            @endif
        </flux:sidebar.nav>

        <flux:spacer />

        <flux:sidebar.nav>
            <flux:sidebar.item icon="folder-git-2" href="https://github.com/laravel/livewire-starter-kit"
                target="_blank">
                {{ __('Repository') }}
            </flux:sidebar.item>

            <flux:sidebar.item icon="book-open-text" href="https://laravel.com/docs/starter-kits#livewire"
                target="_blank">
                {{ __('Documentation') }}
            </flux:sidebar.item>
        </flux:sidebar.nav>

        <x-desktop-user-menu class="hidden lg:block" :name="auth()->user()->name" />
    </flux:sidebar>

    <!-- Mobile User Menu -->
    <flux:header class="lg:hidden">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

        <flux:spacer />

        <flux:dropdown position="top" align="end">
            <flux:profile :initials="auth()->user()->initials()" icon-trailing="chevron-down" />

            <flux:menu>
                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                            <flux:avatar :name="auth()->user()->name" :initials="auth()->user()->initials()" />

                            <div class="grid flex-1 text-start text-sm leading-tight">
                                <flux:heading class="truncate">{{ auth()->user()->name }}</flux:heading>
                                <flux:text class="truncate">{{ auth()->user()->email }}</flux:text>
                            </div>
                        </div>
                    </div>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <flux:menu.radio.group>
                    <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>
                        {{ __('Settings') }}
                    </flux:menu.item>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle"
                        class="w-full cursor-pointer" data-test="logout-button">
                        {{ __('Log Out') }}
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:header>

    {{ $slot }}

    @fluxScripts
</body>

</html>
