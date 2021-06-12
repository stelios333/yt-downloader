<?php
header("Access-Control-Allow-Origin: *")
?>
<!DOCTYPE html>
<html>

<head>
    <title> Youtube downloader </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        .logo {
            font: 300% Arial;
            margin-top: 4%;
            margin-bottom: 4%;
        }

        .card {
            margin-top: 5%;
        }

        #video_author {
            margin-left: 3%
        }

        .loading {
            position: absolute;
            height: 200px;
            width: 200px;
            z-index: 99;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            margin: auto;
        }

        .faded_backgound {
            position: absolute;
            height: 100%;
            width: 100%;
            z-index: 98;
            background: rgba(100, 100, 100, 0.5);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            -moz-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            -webkit-transform: translate(-50%, -50%);
        }

        #video_tags {
            margin-bottom: 3%;
        }
        #vid_tp{
          overflow:hidden;
          display:inline-block;
          text-overflow: ellipsis;
          white-space: nowrap;
        }
        #vid_preview {
          width:100%;
          height:100%
        }
        .fa-play-circle {
          position: absolute;
          top:50%;
          right:50%;
          transform: translate(0, -50%);
          z-index: 99;
          font-size: 100px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="logo">Youtube downloader <span class="fa-stack fa-3x" style="font-family: FontAwesome; font-size: 150%;"><span class="fa-stack-1x" style="color:red">&#xf16a;</span><span class="fa-stack-2x" style="font-size: 75%">&#xf019;</span></span></div>
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Enter video url" id="video_url">
            <div class="input-group-append">
                <button class="btn btn-success" type="submit" id="download_btn">Download <span style="font-family: FontAwesome;">&#xf019;</span></button>
            </div>
        </div>
        <div class="alert alert-danger alert-dismissible fade show" style="display: none;" id="error01">
            <button type="button" class="close" onclick="$('#error01').css({'opacity':'0'});setTimeout(function(){$('#error01').css({'display':'none'});$('#error01').css({'opacity':'1'});}, 150)">&times;</button>
            <strong>Error: </strong>Invaild Url.
        </div>
        <div class="alert alert-danger alert-dismissible fade show" style="display: none;" id="error02">
            <button type="button" class="close" onclick="$('#error02').css({'opacity':'0'});setTimeout(function(){$('#error02').css({'display':'none'});$('#error02').css({'opacity':'1'});}, 150)">&times;</button>
            <strong>Error: </strong>Can't connect to server or video does not exist.
        </div>
        <div class="card" id="video_details" style="display: none;">
            <div class="card-header" id="video_title"></div>
            <div class="card-body" id="vid_dt">
                
                <div class="row">
                    <div class="col-lg"><div onclick="$('#VideoPreview').modal('show')" style="cursor:pointer" class="img-container"><img src="" alt="" style="width: 300px" id="video_thumbnail"></div></div>
                    <div class="col-sm">
                        <div id="video_channel"></div>
                        <br>
                        <div id="video_description" style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap; width: 600px">
                        </div>
                        <div id="video_tags"></div>
                    </div>
                </div>
                <div style="text-align: center;">
                    <button class="btn btn-success" id="play">Play <span style="font-family: FontAwesome;">&#xf04b;</span></button> <button class="btn btn-success" id="download">Download <span style="font-family: FontAwesome;">&#xf019;</span></button>
                </div>
            </div>
        </div>
        <div class="card" style="margin-bottom: 3%">
            <div class="card-header text-white" style="background: #007bff">Instructions</div>
            <div class="card-body">
                <ol>
                    <li>Copy the url of the video.</li>
                    <li>Paste it here.</li>
                    <li>Click download.</li>
                    <li>Click download again.</li>
                    <li>Your download will start automatically.</li>
                </ol>
            </div>
        </div>

    </div>
      <div class="modal fade" id="VideoPreview">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h5 class="modal-title" id="vid_tp"></h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <video id="vid_preview" controls></video>
        </div>
        
      
        
      </div>
    </div>
  </div>
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Download</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    Your download link has created.
                    <br>
                    <br>
                    Click <a id="hyperlink" href="#">here </a> to download.
                    <br>
                    <div class="card bg-warning">
                        <div class="card-header">
                            Video is playing instead downloading?
                        </div>
                        <div class="card-body">
                            <ol>
                                <li>Make sure you are using Chrome or Edge</li>
                                <li>Right click the download link and choose "Save link as..."</li>
                                <li>On the playing page, press "Ctrl+S" keys.</li>
                                <li>On mobile phones or tablets long-press the link and choose "Save link as..."</li>
                            </ol>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <footer class="bg-dark text-center text-lg-start">
        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.95)">
            Powered by Stelios. Based on youtube-dl. Source code in
            <a class="text-dark" target="_blank" href="https://github.com/stelios333/yt-downloader">Github</a>

        </div>
    </footer>
    <script>
        function isOverflown(element) {
            return $(element)[0].scrollHeight > $(element)[0].clientHeight
        }
        $('#video_url').focus()
        $('#video_url').on('keyup', function(evnt) {
            if (evnt.key == "Enter") {
                $("#download_btn").focus()
                $("#download_btn").click()
            }
        })
        $("#download_btn").on('click', function() {
            var vid_id = /v=([^&]+)/.exec($("#video_url").val())
            console.log(vid_id)
            if (vid_id == undefined || null) {
                $('#error01').css({
                    "display": "block"
                })
            } else {
                var req = fetch('https://www.googleapis.com/youtube/v3/videos?part=snippet&id=' + vid_id + '&key=AIzaSyC3yvmDMF8ItLKrNJzFWWmjLNuBq63yH8Y')
                req.then(function(e) {
                    return e.text()
                }).then(function(text) {
                    var json = JSON.parse(text)
                    var vid_title = json.items[0].snippet.title
                    $("#video_details").css({
                        "display": "block"
                    })
                    
                    $("#video_title").html(vid_title)
                    var vid_thumb = json.items[0].snippet.thumbnails.medium.url
                    $('#vid_tp').text(vid_title)
                    $('#video_thumbnail').attr('src', vid_thumb)
                      $("#VideoPreview").on('hide.bs.modal', function () {
                          $('#vid_preview').get(0).pause()
                      });
                    var vid_chan = json.items[0].snippet.channelTitle
                    $('#video_channel').html("<b>Channel:</b> " + vid_chan)
                    var vid_des = json.items[0].snippet.description
                    $('#video_description').html("<b>Description:</b> " + vid_des)
                    var vid_tags = json.items[0].snippet.tags
                    $('#video_tags').html('')
                    $('#video_tags').append('<b>Tags:</b> ')
                    if (vid_tags) {
                        for (var i = 0; i < vid_tags.length; i++) $('#video_tags').append('<a target="_blank" href="https://www.youtube.com/results?search_query=' + encodeURIComponent(vid_tags[i]) + '"><span class="badge badge-info">' + vid_tags[i] + '</span></a> ')
                    }
                    $('#play').attr('disabled', true)
                    $('#download').attr('disabled', true)
                    var url = "./download.php?url=" + $("#video_url").val()
                    $("#vid_preview").attr('src', url)


                   
                    $('#play').attr('disabled', false)
                    $('#download').attr('disabled', false)
                    $('#play').on('click', function() {
                        $('#VideoPreview').modal('show')
                    })
                    $('#download').on('click', function() {
                        $('#myModal').modal('show')
                        $('#hyperlink').on("click", function() {
                            window.open(url)
                        })
                    })
                }).catch(function(e) {
                    $('#error02').css({
                        "display": "block"
                    })
                })

            }
        })
    </script>
</body>

</html>
