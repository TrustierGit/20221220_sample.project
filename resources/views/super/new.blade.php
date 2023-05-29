<x-app-layout>
<div class="container px-5 py-24">
  <section class="text-gray-600 body-font relative mx-auto">
      
        <div class="md:w-1/2 bg-white flex flex-col mx-auto ">
            <h2 class="text-gray-900 text-2xl pb-12 text-center font-semibold">■スーパー新規投稿ページ</h2>
              <div class="relative mb-4 mx-4">
                        <form class="form-horizontal" method="POST" action=/superuser/super_new>
                            @csrf 
                          <div class="relative mb-4">
                            <label for="date_post" class="leading-7 text-lg text-gray-600">日付</label>
                            <input id="date" type="date" class="form-control border border-slate-800 bg-white py-1 px-3 leading-8 overflow-auto w-full"  name="date_post" required>
                          </div>
                          <div class="relative mb-4">
                            <label for="text_title" class="leading-7 text-lg text-gray-600">区分</label>
                            </div>
                              <select id="text_title" name="text_title" class="form-control border border-slate-800 bg-white py-1 px-3 leading-8 overflow-auto w-full" required>
                                <option>Info</option>
                                <option>Err</option>
                              </select>  
                          <div class="relative mb-4">
                          <p><label for="text_message" class="leading-7 text-lg text-gray-600">投稿メッセージ</label></p>
                            <textarea id="text_message" type="text" class="form-control border border-slate-800 bg-white py-1 px-3 leading-8 overflow-auto w-full"  name="text_message" required></textarea>
                          </div>
                          <button class="mt-8 mb-8 text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg w-full" action=/admin/notification_new>登録</button>
                        <button class="text-white bg-yellow-500 border-0 py-2 px-8 focus:outline-none hover:bg-yellow-600 rounded text-lg mb-12 w-full" onclick="location.href='{{ route('super.create') }}' ">戻る</button>
                        </form>
                </div>
              </div>
      </div>
</section>
</x-app-layout>
 