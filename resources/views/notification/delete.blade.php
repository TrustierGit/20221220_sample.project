<x-app-layout>
<div class="container px-5 py-24">
  <section class="text-gray-600 body-font relative mx-auto">
      
        <div class="md:w-1/2 bg-white flex flex-col mx-auto ">
        <h2 class="text-gray-900 text-2xl pb-12 text-center font-semibold">■削除ページ</h2>
            <form class="form-horizontal mx-4" method="POST" action=/admin/notification_delete/{id}>
                  @csrf
              <input type="hidden" name="id" value="{{$notification->id}}">
              <div class="relative mb-4">
                  <label for="name" class="leading-7 text-lg text-gray-600">日付</label>
                            <div class="border border-slate-800 bg-white py-1 px-3 leading-8">{{$notification->date_post}}</div>
                        </div>
                        <div class="relative mb-4">
                          <label for="name" class="leading-7 text-lg text-gray-600">区分</label>
                          <div class="border border-slate-800 bg-white py-1 px-3 leading-8">{{$notification->text_title}}</div>
                        </div>
                        <div class="relative mb-4">
                          <label for="name" class="leading-7 text-lg text-gray-600">メッセージ</label>
                          <div class="border border-slate-800 bg-white py-1 px-3 leading-8 overflow-auto">{{$notification->text_message}}</div>
                        </div>
                        <button class="mb-8 text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg w-full" action=/admin/notification_new>削除</button>
              </form>
            <button class="text-white bg-yellow-500 border-0 py-2 px-8 focus:outline-none hover:bg-yellow-600 rounded text-lg mb-12 mx-4 " onclick="location.href='{{ route('notification.create') }}' ">戻る</button>
          </div>
        </div>
      </div>
  </section>
  </div>
</x-app-layout>