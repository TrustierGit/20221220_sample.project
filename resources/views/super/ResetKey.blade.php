
<x-app-layout>
  <div class="container px-5 py-4 mx-auto">
    <h1 class="text-2xl font-medium title-font text-gray-900 pt-12">■APIキーリセット</h1> 
    
      <section class="text-gray-600 body-font">
          <div class="hidden sm:flex sm:items-center sm:ml-6 py-8 flex flex-col">
              <form method="POST" action=/superuser/ResetKey>
                @csrf
                <button class="mt-8 mb-8 text-white bg-yellow-500 border-0 py-2 px-8 focus:outline-none hover:bg-yellow-600 rounded text-lg rounded text-lg font-bold" action=/superuser/reset_api>APIキーリセット</button>
              </form>
          </div>
      </section>     
              
  </div>
  {{-- フラッシュメッセージの表示 --}}
    <script src="{{ asset('js/jquery.min2.js')}}"></script>
    <script src="{{ asset('js/toastr.min.js')}}"></script>
    <script src="{{ asset('js/toastr.js')}}"></script>
        <script>
            @if (session('status'))
                $(function () {
                        toastr.success('{{ session('status') }}');
                        $(".toast").attr("style","top:100px");
                });
            @endif
        </script>
    
</x-app-layout>
