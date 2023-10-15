<section class="w-full h-full max-h-screen pb-12">
    <div class="px-4 py-4 mb-24">
        <div class="border-2 border-gray-500 border-dashed rounded-lg dark:border-gray-700">
            @if(isset($voucher))
                @include('admision-matriculas.inbox.type.voucher', ['selectedNotification' => $selectedNotification, 'voucher' => $voucher, 'metodos' => $metodos])
            @endif
        </div>
     </div>
</section>
