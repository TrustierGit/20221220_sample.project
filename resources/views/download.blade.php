<x-app-layout>
<div class="container px-5 py-4 mx-auto">
  <h1 class="text-2xl font-medium title-font text-gray-900 py-12 ">■予約履歴ダウンロード</h1>
        <div class="h-full w-3/4 m-auto p-8 rounded bg-white border-2 border-gray-400">
            <div class="flex-grow flex flex-col pl-4">
              <div class="title-font font-medium text-gray-900">
              <section class="text-gray-600 body-font">
                
          <div class="container px-5 py-5 mx-auto">
          <div class="text-3xl text-center">
                 ― {{Auth::user()->organization->name_organization}} 予約履歴ダウンロード　―
          </div>
            <div class="px-12 py-24 text-2xl flex flex-auto">
                <div class="block ml-6 mr-6">
                                <form  method="get" action=/admin/export>
                                  @csrf 
                                  <div class="py-4">
                                      <label for="domain_organization" class="text-xl text-gray-600">対象自治体</label>
                                      <select class="rounded text-xl text-gray-600 bg-indigo-50 py-4" id="domain_organization" name="domain_organization">
                                            @foreach($organizations as $organization)
                                              <option value="{{$organization->domain_organization}}">{{$organization->name_organization}}</option>
                                            @endforeach
                                      </select>
                                  </div>
                                  <div class="py-4">
                                      <label for="date" class="text-xl text-gray-600">対象年月　</label>
                                      <select class="rounded text-xl text-gray-600 bg-indigo-50 py-4" id="date" name="ymd" >
                                            @for($i=0;$i < 24;$i++)
                                            <option value='{{\Carbon\Carbon::now()->submonth($i)->format("Y-m-t")}}'>{{\Carbon\Carbon::now()->submonth($i)->format("Y年m月")}}</option>
                                            @endfor
                                      </select>
                                  </div>
                                      <button class="flex mx-auto mt-16 text-white bg-indigo-500 border-0 py-2 px-10 focus:outline-none hover:bg-indigo-600 rounded text-2xl" action=/admin/export>ダウンロード</button>
                                </form>          
                </div>
                <div class="block ml-24 mr-6 border-2 rouded border-gray-400 p-8 base_admin_authority">
                        <ul class="list-disc text-xl">
                          <li>過去２年分のデータがダウンロード可能です。</li>
                          <li>該当データの無い月はダウンロードされません。</li>
                          <li>UTF-８（BOM付き）で出力されます。</li>
                        </ul>
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