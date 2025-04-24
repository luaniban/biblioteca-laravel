<div class="flex flex-col items-center min-h-screen pt-6 bg-gradient-to-r from-[#084E80] to-[#93d2ff] sm:justify-center sm:pt-0 ">
    <div>
        {{ $logo }}
    </div>

    <div class="w-full px-6 py-4 mt-6 overflow-hidden bg-gradient-to-r from-[#084E80] to-[#0D76C0] shadow-md sm:max-w-md sm:rounded-lg">
        {{ $slot }}
    </div>
</div>
