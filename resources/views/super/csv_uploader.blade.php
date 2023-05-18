
<x-app-layout>
  <div class="container px:auto mx-auto">
    <h1 class="text-2xl font-medium title-font text-gray-900 pt-12">■ユーザープロビジョニング</h1> 
    
    <p>CSVファイルをインポートします。</p>
    <form action="" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="row">
            <label class="col-1 text-right" for="form-file-1">File:</label>
            <div class="col-11">
                <div class="custom-file">
                    <input type="file" name="csv" class="custom-file-input" id="customFile">
                    <label class="custom-file-label" for="customFile" data-browse="参照"></label>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-success btn-block">送信</button>
    </form>
    <script>
    // ファイルを選択すると、入力フォーム部分にファイル名を表示
        $('.custom-file-input').on('change',function(){
            $(this).next('.custom-file-label').html($(this)[0].files[0].name);
        })
    </script>
    </body>
    </html>

    @if(Session::has('flashmessage'))
    <script>
        $(window).on('load',function(){
            $('#myModal').modal('show');
        });
    </script>

    <!-- モーダルウィンドウの中身 -->
    <div class="modal fade" id="myModal" tabindex="-1"
         role="dialog" aria-labelledby="label1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                     {{ session('flashmessage') }}
                </div>
                <div class="modal-footer text-center">
                </div>
            </div>
        </div>
    </div>
    @endif
              
  </div>
 
    
</x-app-layout>
