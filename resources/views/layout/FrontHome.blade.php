<!doctype html>
<html prefix="og: http://ogp.me/ns#">
<html dir="ltr" lang="en-US">
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8">
    <title>Stream</title>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <base href="http://localhost:8000/"/>
    <meta name="description" content="">
    <meta name="generator" content="Stream"/>
    <meta property="og:site_name" content="Stream"/>
    <meta name="theme-color" content="#ffffff">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/bootstrap-select.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/nifty.min.css') }}"/>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.2/toastr.min.css"/>
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Material+Icons|Roboto:300,400,500" type="text/css"
          media="all"/>
    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
    <script type="text/javascript">
        window.Json =
            {!!
                json_encode([
                    'api_stream' => route('stream.start'),

                ])
            !!};
    </script>
</head>
<body>

    <div id="container">
        <div class="boxed">
            <div class="content-container">
                <div id="page-content">
                    <div class="row">
                        <div class="col-sm-6 col-md-6">
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Live Stream Facebook</h3>
                                </div>

                                <!--Block Styled Form -->
                                <!--===================================================-->
                                <form>
                                    <div class="panel-body">

                                        <div class="row">

                                            <div class="col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label"> Source Stream</label>
                                                    <select class="source_stream" id="source_stream">
                                                        <option value="facebook">Facebook</option>
                                                        <option value="youtube">Youtube</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label"> URL máy chủ</label>
                                                    <input type="text" class="form-control" name="url_server">
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">Khóa video</label>
                                                    <input type="text" class="form-control" name="stream_key">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">Source Video</label>
                                                    <input type="text" class="form-control" name="source_video">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="panel-footer text-right" style="padding-top: 15px">
                                        @include('alert::bootstrap')
                                        <button class="btn btn-success" type="button" id="button_stream">Stream</button>
                                    </div>
                                </form>
                                <!--===================================================-->
                                <!--End Block Styled Form -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-select.min.js') }}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.2/toastr.min.js"></script>
<script src="{{ asset('js/main.js') }}"></script>
</body>
</html>