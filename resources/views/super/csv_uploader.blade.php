
<x-app-layout>
  <div class="container px:auto mx-auto">
    <h1 class="text-2xl font-medium title-font text-gray-900 pt-12">■ユーザープロビジョニング</h1> 
    
    <p>CSVファイルをインポートします。<br>UTF-8のcsvファイルをアップロードしてください。</p>
    <div class="px-12 py-12">
        <form action="" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
            <label for="domain_organization" class="text-xl text-gray-600">対象自治体</label>
            <div class="col-11">
                        <select class="rounded text-xl text-gray-600 bg-indigo-50 py-4" id="domain_organization" name="domain_organization">
                            @foreach($organizations as $organization)
                                <option value="{{$organization->domain_organization}}">{{$organization->name_organization}}</option>
                            @endforeach
                        </select>
            </div>
            <label for="mode_admin" class="text-xl text-gray-600">管理者モード</label>
            <div class="col-11">
                    <select class="rounded text-xl text-gray-600 bg-indigo-50 py-4" id="mode_admin" name="mode_admin">
                            <option value=0>0</option>
                            <option value=1>1</option>
                    </select>
            </div>
                <label class="col-1 text-xl text-gray-600" for="form-file-1">File:</label>
                <div class="col-11">
                    <div class="custom-file py-4 text-xl text-gray-600">
                        <input type="file" name="csv" class="custom-file-input" id="customFile">
                        <label class="custom-file-label" for="customFile" data-browse="参照"></label>
                    </div>
                </div>
            </div>
            <button class="mt-16 text-white bg-indigo-500 border-0 py-2 px-10 focus:outline-none hover:bg-indigo-600 rounded text-2xl" type="submit" class="btn btn-success btn-block">送信</button>
        </form>
    </div>
    <script>
    // ファイルを選択すると、入力フォーム部分にファイル名を表示
        $('.custom-file-input').on('change',function(){
            $(this).next('.custom-file-label').html($(this)[0].files[0].name);
        })
    </script>
    </body>
    </html>

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
            @if (session('error'))
                $(function () {
                        toastr.warning('{{ session('error') }}');
                        $(".toast").attr("style","top:100px");
                });
            @endif
    </script>
              
  </div>
 
    
</x-app-layout>
