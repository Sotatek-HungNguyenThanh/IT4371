@extends('admin.app.layout')


@section('title')
    Test
@endsection

@section('script')
    <script type="text/javascript" src="/js/plugins/summernote/summernote.js"></script>
    <script>
        $('#summernote').summernote({
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']]
            ]
        });
    </script>
@endsection
@section('css')
    <style>
        .content-header {
            width: 27px;
            height: 27px;
            border-radius: 50%;
            position: absolute;
            overflow: hidden;
            top: -63px;
            left: 97.5%;
            background: #fff;
        }
        button.close {
            float: none;
            opacity: 1;
            padding: 0;
            cursor: pointer;
            background: transparent;
            border: 0;
            -webkit-appearance: none;
        }
        .content-header .close {
            margin-top: 0px;
            margin-right: 0px;
            position: absolute;
            left: 1px;
            top: -1px;
        }
        .modal-body{
            width: calc(100% - 40px);
            margin: auto;
        }
        .modal-content{
            border-width: 0px;
        }
    </style>
@endsection

@section('page_content')
    <div class="row">
        <div class="col-md-12">
            <div class="block">
                <button type="button" class="btn btn-warning"
                        data-toggle="modal" data-target="#message-box-update"
                        data-backdrop="static">Update</button>

            </div>
        </div>
    </div>
    <div id="message-box-update" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-header">
                <h4 class="modal-title">Update</h4>
            </div>
            <!-- Modal content-->
            <div class="modal-content">
                <div class="content-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <img src="https://nholicham.com/image/close-button.png" alt="">
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/test" method="post">
                        {{ csrf_field() }}
                    <dl>
                        <dt>
                            Text
                        </dt>
                        <dd>
                            <textarea class="summernote" name="xxx">
                            </textarea>
                            <div style="margin-top: 2px">
                                <button class="btn btn-primary pull-right" >Submit</button>
                                <button class="btn btn-primary pull-right" data-dismiss="modal" style="margin-right: 5px">Close</button>
                            </div>
                        </dd>
                    </dl>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection