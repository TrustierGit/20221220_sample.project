<x-app-layout>
<div class="container px-5 py-4 mx-auto">
  <h1 class="text-2xl font-medium title-font text-gray-900 py-12 ">■予約履歴ダウンロード</h1>
        <div class="h-full w-3/4 m-auto p-8 rounded bg-white border-2 border-gray-400">
            <span class="flex-grow flex flex-col pl-4">
              <span class="title-font font-medium text-gray-900">
              <section class="text-gray-600 body-font">
                
  <div class="container px-5 py-5 mx-auto">
    <div class="flex flex-col text-center w-full mb-20">
    </div>
    <div class="flex flex-wrap -m-4 text-center">
      <div class="p-4 md:w-1/4 sm:w-1/2 w-full">
        <div class="border-2 border-gray-400 px-4 py-6 rounded-lg bg-white">
          <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="text-indigo-500 w-12 h-12 mb-3 inline-block bg-white" viewBox="0 0 24 24">
            <path d="M8 17l4 4 4-4m-4-5v9"></path>
            <path d="M20.88 18.09A5 5 0 0018 9h-1.26A8 8 0 103 16.29"></path>
          </svg>
          <p class="leading-relaxed text-2xl">Downloads</p>
        </div>
      </div>
      <div class="px-8 py-5 flex-grow">

    <form  method="get" action=/admin/export>
      @csrf 
        <label for="date" class="text-xl text-gray-600">対象年月</label>

        <select class="rounded text-xl text-gray-600 bg-indigo-50 py-4" id="date" name="ymd" >
              @for($i=0;$i<24;$i++)
                <option>{{\Carbon\Carbon::now()->submonth($i)->format("Y-m")}}</option>
              @endfor
            </select>
            <button class="flex mx-auto mt-16 text-white bg-indigo-500 border-0 py-2 px-10 focus:outline-none hover:bg-indigo-600 rounded text-2xl" action=/admin/export>ダウンロード</button>
      </form>          
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

        </div>
      </div>
    </div>
  </div>
    </div>

    {{-- フラッシュメッセージの表示 --}}
    <script src="{{ asset('js/jquery.min2.js')}}"></script>
    <script src="{{ asset('js/toastr.min.js')}}"></script>
    <script src="{{ asset('js/toastr.js')}}"></script>
        <script>
            @if (session('status'))
                $(function () {
                        toastr.warning('{{ session('status') }}');
                        $(".toast").attr("style","top:100px");
                });
            @endif
        </script>
  </x-app-layout>

