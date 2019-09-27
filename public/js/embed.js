/*! embed.js v1.0.0 | Custom youtube and vimeo embed plugin */

var Video = function (container) {

    var video_url = $(container).data("url");


    function get_video_thumb(url, callback) {
        var id = get_video_id(url);
        if (id['type'] == 'y') {
            return processYouTube(id);
        } else if (id['type'] == 'v') {

            $.ajax({
                url: 'http://vimeo.com/api/v2/video/' + id['id'] + '.json',
                dataType: 'jsonp',
                success: function (data) {
                    callback({type: 'v', id: id['id'], url: data[0].thumbnail_large});
                }
            });
        }

        function processYouTube(id) {
            if (!id) {
                throw new Error('Unsupported YouTube URL');
            }

            callback({
                type: 'y',
                id: id['id'],
                url: 'http://i2.ytimg.com/vi/' + id['id'] + '/hqdefault.jpg'
            });
        }
    }

    function get_video_id(url) {
        var id;
        var a;
        if (url.indexOf('youtube.com') > -1) {
            if (url.indexOf('v=') > -1) {
                id = url.split('v=')[1].split('&')[0];
            }
            else if (url.indexOf('embed') > -1) {
                id = url.split('embed/')[1].split('?')[0];
            }
            ;
            return processYouTube(id);
        }
        else if (url.indexOf('youtu.be') > -1) {
            id = url.split('/')[1];
            return processYouTube(id);
        }
        else if (url.indexOf('vimeo.com') > -1) {
            if (url.match(/https?:\/\/(www\.)?vimeo.com\/(\d+)($|\/)/)) {
                id = url.split('/')[3];
            }
            else if (url.match(/^vimeo.com\/channels\/[\d\w]+#[0-9]+/)) {
                id = url.split('#')[1];
            }
            else if (url.match(/vimeo.com\/groups\/[\d\w]+\/videos\/[0-9]+/)) {
                id = url.split('/')[4];
            }
            else if (url.match(/player.vimeo.com\/video\/[0-9]+/)) {
                id = url.split('/')[2];
            }
            else {
                throw new Error('Unsupported Vimeo URL');
            }

        }
        else {
            throw new Error('Unrecognised URL');
        }
        a = {type: 'v', id: id};
        return a;
        function processYouTube(id) {
            if (!id) {
                throw new Error('Unsupported YouTube URL');
            }
            a = {type: 'y', id: id};
            return (a); // default.jpg OR hqdefault.jpg
        }
    }

    function callback(video) {

        $(container + ' .video-overlay').css({"background-image": "url('" + video.url + "')"});

        var frame;

        if (video.type == 'v') {
            frame = '<iframe src="https://player.vimeo.com/video/' + video.id + '?autoplay=1&color=3aafd6&portrait=0" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div>';
        } else {
            frame = '<iframe src="https://www.youtube.com/embed/' + video.id + '?autoplay=1&color=white&rel=0" frameborder="0" allowfullscreen width="560" height="315" showinfo="0"></iframe>';
        }

        $(container).click(function () {
            $(container).fadeOut('fast', 'linear', function () {
                $(this).html(frame);
                $(this).fadeIn('fast');
            });
        })

    }

    get_video_thumb(video_url, callback);
}