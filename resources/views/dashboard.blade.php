<x-app-layout>
  <div class="container px-5 py-4 mx-auto">
    <h1 class="text-2xl font-medium title-font text-gray-900 pt-12">■ダッシュボード</h1>
    <div class="font-bold text-3xl text-center pb-4">― {{Auth::user()->organization->name_organization}} お知らせ　―</div>
    <div class="p-6 overflow-y:scroll rounded">
  <section class="text-gray-600 body-font">
  <div class="container px-5 py-0 mx-auto">
    <div class="flex flex-col text-center w-full mb-4">
    <div class="w-full mx-auto overflow-wrap">
      <table style="table-layout:fixed; width:100%;" class="table-auto w-full text-center font-bold text-xlwhitespace-no-wrap border-solid border-collapse">
       <colgroup>
          <col style="width:15%;">
          <col style="width:15%;">
          <col style="width:70%;">
       </colgroup>

       <thead>
          <tr>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-black text-xl bg-gray-400 border border-slate-500">日付</th>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-black text-xl bg-gray-400 border border-slate-500">区分</th>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-black text-xl bg-gray-400 border border-slate-500">メッセージ</th>
          </tr>
        </thead>
        <tbody>
        @foreach($notifications as $notification)
          <tr>
            <td class="px-4 py-3 border border-slate-400 bg-white text-lg">{{$notification->date_post}}</td>
            <!-- <td class="px-4 py-3 border border-slate-400 bg-white text-lg">{{$notification->text_title}}</td> -->
            <td class="px-4 py-3 border border-slate-400 bg-white ">
              @if($notification->text_title === 'Info')
                <span class="bg-green-700 text-white px-3 py-2 rounded">お知らせ</span>
                @else
                <span class="bg-red-700 text-white p-2 rounded">障害情報</span>
              @endif
            </td>
            <!-- <td class="px-4 py-3 border border-slate-400 bg-white text-lg">{!!nl2br(e(\Illuminate\Support\Str::limit($notification->text_message,20,'　...　')))!!}</td> -->
            <td style="word-wrap:break-word;" class="px-4 py-3 border border-slate-400 bg-white text-left">{!!nl2br(e($notification->text_message))!!}</td>
          </tr>
        @endforeach
        </tbody>
      </table>
      <br>
      <div>
      {{$notifications->links()}}
    </div>
    </div>
    </div>
  </div>
          
        </div>

</section>     
                </div>
            </div>
           
</x-app-layout>
