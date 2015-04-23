
var videotime = 0;
var timeupdater = null;
var array_of_json;
var player;

    /**
     * for initialising player
     * @param {string} video_id Video Id from url of youtube video
     */
function initPlayer(video_id) {
    function readyYoutube() {
        if (YT && YT.Player) {
            player = new YT.Player('video_container', {
                height: '390',
                width: '640',
                videoId: video_id,
                events: {
                    'onStateChange': onPlayerStateChange
                }
            });
            //at first hides panel with icons
            $('#icon_holder').hide();
        } else {
            setTimeout(readyYoutube, 100);
        }
    }
    readyYoutube();
}
//gets array with emotions and initialises player
$(document).ready(function() {
    $.ajax({
        method: 'GET',
        url: emotion_get_url
    })
        .done(function(data) {

            array_of_json = data;
            initPlayer(video_id);
        });
});

    /**
     * For responding if status of player changes
     */
function onPlayerStateChange() {
    //When video ends player destroys and initialises again
    if (player.getPlayerState() == 0) {
        player.destroy();
        initPlayer(video_id);
    }


    // At first play after initialising player it render icons. Every pressing
    // play it starts to check current time every 1000ms
    if (player.getPlayerState() == 1) {
        $('#icon_holder').show();
        function updateTime() {
            var oldTime = videotime;
            if (player && player.getCurrentTime) {
                videotime = +player.getCurrentTime().toFixed();
            }
            if (videotime !== oldTime) {

                onProgress(videotime);
            }
        }
        timeupdater = setInterval(updateTime, 1000);
    }
    //When user press pause it stops checking current time
    if (player.getPlayerState() == 2) {
        clearInterval(timeupdater);
    }
}

/**
 * when the time changes, this will be called.
 * @param {number} currentTime The time should be in seconds (integer)
 */
function onProgress(currentTime) {
    var ci = array_of_json.length;
    //Compares with currentTime & shows appropriate elements
    for (i = 0; i < ci; i++) {
        if (currentTime === array_of_json[i].time && currentTime != 0) {
            $(document).ready(function() {

                $('#emoticons').prepend(
                '<div class="emotion ' +
                array_of_json[i].emotion + ' ' +
                array_of_json[i].time +
                '" style="display: none" ></div>');
                (function() {
                    var selector = 'div.' + array_of_json[i].time;
                    $(selector).show(1000);
                    $(selector).fadeOut(10000, function() {
                        $(selector).remove();
                    });
                })();
            });
        }
    }
}

    /**
     *Saves user's emotions and animate successful adding
     */
$('.emoticon_button').click(function() {
    var emotion = $(this).attr('class').slice(16),
        current_time = player.getCurrentTime().toFixed();
    //Sends parameters of emotion to the server
    $.ajax({
        method: 'POST',
        url: emotion_post_url,
        data: {
            video_id: video_id,
            time: current_time,
            emotion: emotion
        }
    }).done(function(result) {
        if (result) {
            $(document).ready(
                // Shows animation  when adding is successful
                function() {
                    $('#emo_animate').prepend("<div class='" + emotion + "'" +
                    " style='background-position:center;position:relative; " +
                    "display:inline-block; width:20px; height:20px '></div>");
                    $('div#emo_animate div').animate({left: '50%'}, 2000);
                    (function() {
                        var selector = 'div.' + emotion;
                        $(selector).show(1000);
                        $(selector).fadeOut(1000, function() {
                            $(selector).remove();
                        });
                    })();
                });
        }
    });
});




