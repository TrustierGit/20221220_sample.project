<x-app-layout>
 
    <section class="text-gray-600 body-font">
  <div class="container mx-auto flex px-5 py-24 items-center justify-center flex-col">
    <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium">システム時間外</h1>
    <img class="lg:w-2/6 md:w-3/6 w-5/6 mb-10 object-cover object-center rounded" src="{{ asset('img/mentenance.png')}}" alt="">
    <div class="text-center lg:w-2/3 w-full">
      <p class="text-xl">ただいま時間外の為、システムの一部を一時停止しております。<br>
      利用時間は{!! config('maintenance.open_from')!!}から{!! config('maintenance.open_to')!!}までです。<br>
      ご不便をおかけ致しますが、利用時間内にご利用くださいますようお願い申し上げます。</p>
    </div>
  </div>
</section>

</x-app-layout>
