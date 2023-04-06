<x-app-layout>
  
  <div class="container px-5 py-4 mx-auto">
  <h1 class="text-2xl font-medium title-font text-gray-900 pt-12 pb-4">■お知らせ投稿</h1>
  
                <a href="{{ route('notification.new')}}" class="text-white bg-green-500 border-0 py-2 px-6 focus:outline-none hover:bg-green-600 rounded text-lg font-bold">追加</a>
                <section class="text-gray-600 body-font"> 
                  
  <div class="container px-5 mx-auto">
    <div class="flex flex-col text-center w-full mb-4">
    <div class="py-6">
    <div class="w-full mx-auto overflow-auto">
    <table style="table-layout:fixed; width:100%;" class="table-auto w-full text-center font-bold text-xlwhitespace-no-wrap border-solid border-collapse">
       <colgroup>
          <!-- <col style="width:5%;"> -->
          <col style="width:15%;">
          <col style="width:15%;">
          <col style="width:60%;">
          <col style="width:15%;">
       </colgroup>
        <thead>
          <tr>
            <!-- <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-lg border border-slate-500 bg-gray-400">@sortablelink('id','ID')</th> -->
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-lg border border-slate-500 bg-gray-400">@sortablelink('date_post','日付')</th>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-lg border border-slate-500 bg-gray-400">@sortablelink('text_title','区分')</th>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-lg border border-slate-500 bg-gray-400">@sortablelink('text_message','メッセージ')</th>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-lg border border-slate-500 bg-gray-400"></th>
          </tr>
        </thead>
        <tbody>
        @foreach($notifications as $notification)
          <tr>
            <!-- <td class="px-4 py-3 border border-slate-400 bg-white">{{$notification->id}}</td> -->
            <td class="px-4 py-3 border border-slate-400 bg-white">{{$notification->date_post}}</td>
            <!-- <td class="px-4 py-3 border border-slate-400 bg-white">{{$notification->text_title}}</td> -->
            <td class="px-4 py-3 border border-slate-400 bg-white">
            @if($notification->text_title === 'Info')
                <span class="bg-green-700 text-white px-3 py-2 rounded">お知らせ</span>
                @else
                <span class="bg-red-700 text-white p-2 rounded">障害情報</span>
              @endif
            </td>
            <td class="px-4 py-3 border border-slate-400 bg-white text-left">{!!nl2br(e(\Illuminate\Support\Str::limit($notification->text_message,90,'　　...　　')))!!}</td>
            <!-- <td style="word-wrap:break-word;" class="px-4 py-3 border border-slate-400 text-left">{!!nl2br(e($notification->text_message))!!}</td> -->
            
            <td class="border border-slate-400 bg-white">

              <a href="{{ route('notification.edit', ['id'=>$notification->id]) }}" class="text-white bg-yellow-500 border-0 py-2 px-6 focus:outline-none hover:bg-yellow-600 rounded">更新</a>
              <a href="{{ route('notification.delete', ['id'=>$notification->id]) }}"class="text-white bg-red-500 border-0 py-2 px-6 focus:outline-none hover:bg-red-600 rounded" >削除</a>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
      <div>
      {{$notifications->links()}}
    </div>
    </div>

</section>  

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
