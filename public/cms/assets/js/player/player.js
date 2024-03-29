$(document).ready(function() {
    (function(window, undefined) {

        'use strict';

        var AudioPlayer = (function() {

            // Player vars!
            var
                docTitle = document.title,
                player = document.getElementById('ap'),
                playBtn,
                // playSvg,
                // playSvgPath,
                prevBtn,
                nextBtn,
                // plBtn,
                repeatBtn,
                // volumeBtn,
                progressBar,
                preloadBar,
                curTime,
                durTime,
                trackTitle,
                audio,
                index = 0,
                playList,
                volumeBar,
                wheelVolumeValue = 0,
                volumeLength,
                repeating = false,
                seeking = false,
                rightClick = false,
                apActive = false,
                // playlist vars
                plPlaylist = document.getElementById('navMenu'),
                pl,
                plUl,
                plLi,
                tplList =
                    '<li class="player_playlist_item pl-list" data-track="{count}">' +
                    '<div class="pl-list__track">' +
                    '<div class="pl-list__icon"></div>' +
                    '<div class="pl-list__eq">' +
                    '<div class="eq">' +
                    '<div class="eq__bar"></div>' +
                    '<div class="eq__bar"></div>' +
                    '<div class="eq__bar"></div>' +
                    '<div class="eq__bar"></div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="song_block pl-list__title">{title}</div>' +
                    '</li>',
                // settings
                settings = {
                    volume: 1,
                    changeDocTitle: true,
                    confirmClose: true,
                    autoPlay: false,
                    buffered: true,
                    notification: true,
                    playList: []
                };

            function init(options) {

                if (!('classList' in document.documentElement)) {
                    return false;
                }

                if (apActive || player === null) {
                    return 'Player already init';
                }

                settings = extend(settings, options);
                // get player elements
                playBtn = player.querySelector('.p-play');
                // playSvg = playBtn.querySelector('.glyphicon-play');
                // playSvgPath = playSvg.querySelector('path');
                prevBtn = player.querySelector('.p-prev');
                nextBtn = player.querySelector('.p-next');
                repeatBtn = player.querySelector('.p-repeat');
                curTime = player.querySelector('.time_played');
                durTime = player.querySelector('.full_time');
                trackTitle = player.querySelector('.song_playing');
                progressBar = player.querySelector('.line_played');
                preloadBar = player.querySelector('.line_preload');

                playList = settings.playList;

                playBtn.addEventListener('click', playToggle, false);
                repeatBtn.addEventListener('click', repeatToggle, false);

                // progressBar.closest('.p-seekbar').addEventListener('mousedown', handlerBar, false);
                // progressBar.closest('.p-seekbar').addEventListener('mousemove', seek, false);

                document.documentElement.addEventListener('mouseup', seekingFalse, false);

                // volumeBar.closest('.volume').addEventListener('mousedown', handlerVol, false);
                // volumeBar.closest('.volume').addEventListener('mousemove', setVolume);
                // volumeBar.closest('.volume').addEventListener(wheel(), setVolume, false);

                // document.documentElement.addEventListener('mouseup', seekingFalse, false);

                prevBtn.addEventListener('click', prev, false);
                nextBtn.addEventListener('click', next, false);

                apActive = true;

                // Create audio object
                audio = new Audio();
                audio.volume = settings.volume;
                audio.preload = 'auto';

                audio.addEventListener('error', errorHandler, false);
                audio.addEventListener('timeupdate', timeUpdate, false);
                audio.addEventListener('ended', doEnd, false);

                // volumeBar.style.height = audio.volume * 100 + '%';
                // volumeLength = volumeBar.css('height');

                if (settings.confirmClose) {
                    window.addEventListener("beforeunload", beforeUnload, false);
                }

                if (isEmptyList()) {
                    return false;
                }
                audio.src = playList[index].file;
                $('.p-cover').css('background-image', 'url("'+playList[index].icon+'")');
                $('.p-title').text(playList[index].title);
                $('.p-artist').text(playList[index].artist);

                if (settings.autoPlay) {
                    audio.play();
                    // playBtn.classList.add('is-playing');
                    $('.p-play').find('').removeClass('icon-play').addClass('icon-pause');
                    plLi[index].classList.add('pl-list--current');

                }
            }

            function changeDocumentTitle(title) {
                if (settings.changeDocTitle) {
                    if (title) {
                        document.title = title;
                    } else {
                        document.title = docTitle;
                    }
                }
            }

            function beforeUnload(evt) {
                if (!audio.paused) {
                    var message = 'Music still playing';
                    evt.returnValue = message;
                    return message;
                }
            }

            function errorHandler(evt) {
                if (isEmptyList()) {
                    return;
                }
                var mediaError = {
                    '1': 'MEDIA_ERR_ABORTED',
                    '2': 'MEDIA_ERR_NETWORK',
                    '3': 'MEDIA_ERR_DECODE',
                    '4': 'MEDIA_ERR_SRC_NOT_SUPPORTED'
                };
                audio.pause();
                curTime.innerHTML = '--';
                durTime.innerHTML = '--';
                progressBar.style.width = 0;
                preloadBar.style.width = 0;
                // playBtn.classList.remove('is-playing');
                $(this).find('i').addClass('icon-play').removeClass('icon-pause');

                plLi[index] && plLi[index].classList.remove('pl-list--current');
                changeDocumentTitle();
                throw new Error('Houston we have a problem: ' + mediaError[evt.target.error.code]);
            }


            function listHandler(ind) {
                play(ind);
            }


            /**
             * Player methods
             */
            function play(currentIndex) {

                if (isEmptyList()) {
                    return clearAll();
                }

                index = (currentIndex) % playList.length;
                audio.src = playList[index].file;
                $('.p-cover').css('background-image', 'url("'+playList[index].icon+'")');
                $('.p-title').text(playList[index].title);
                $('.p-artist').text(playList[index].artist);

                // Audio play
                playToggle();
            }

            //-----= Play On Click Playlist
            function playSRC(src) {

                audio.src = src.file;
                $('.p-cover').css('background-image', 'url("'+src.icon+'")');
                $('.p-title').text(src.title);
                $('.p-artist').text(src.artist);


                // Audio play
                audio.play();

            }

            function prev() {
                play(index - 1);
            }

            function next() {
                play(index + 1);
            }

            function isEmptyList() {
                return playList.length === 0;
            }

            function clearAll() {
                audio.pause();
                audio.src = '';
                trackTitle.innerHTML = 'queue is empty';
                curTime.innerHTML = '--';
                durTime.innerHTML = '--';
                progressBar.style.width = 0;
                preloadBar.style.width = 0;
                playBtn.classList.remove('is-playing');
                if (!plUl.querySelector('.pl-list--empty')) {
                    plUl.innerHTML = '<li class="pl-list--empty">PlayList is empty</li>';
                }
                changeDocumentTitle();
            }

            function playToggle() {
                if (isEmptyList()) {
                    return;
                }
                if (audio.paused) {
                    audio.play();

                } else {
                    audio.pause();
                }
            }

            function volumeToggle() {
                if (audio.muted) {
                    if (parseInt(volumeLength, 10) === 0) {
                        volumeBar.style.height = settings.volume * 100 + '%';
                        audio.volume = settings.volume;
                    } else {
                        volumeBar.style.height = volumeLength;
                    }
                    audio.muted = false;
                    volumeBtn.classList.remove('has-muted');
                } else {
                    audio.muted = true;
                    volumeBar.style.height = 0;
                    volumeBtn.classList.add('has-muted');
                }
            }

            function repeatToggle() {
                if (repeatBtn.classList.contains('is-active')) {
                    repeating = false;
                    repeatBtn.classList.remove('is-active');
                } else {
                    repeating = true;
                    repeatBtn.classList.add('is-active');
                }
            }

            function plToggle() {
                plBtn.classList.toggle('is-active');
                pl.classList.toggle('h-show');
            }

            function timeUpdate() {
                if (audio.readyState === 0) return;

                var barlength = Math.round(audio.currentTime * (100 / audio.duration));
                progressBar.style.width = barlength + '%';

                var
                    curMins = Math.floor(audio.currentTime / 60),
                    curSecs = Math.floor(audio.currentTime - curMins * 60),
                    mins = Math.floor(audio.duration / 60),
                    secs = Math.floor(audio.duration - mins * 60);
                (curSecs < 10) && (curSecs = '0' + curSecs);
                (secs < 10) && (secs = '0' + secs);

                curTime.innerHTML = curMins + ':' + curSecs;
                durTime.innerHTML = mins + ':' + secs;

                if (settings.buffered) {
                    var buffered = audio.buffered;
                    if (buffered.length) {
                        var loaded = Math.round(100 * buffered.end(0) / audio.duration);
                        preloadBar.style.width = loaded + '%';
                    }
                }
            }

            /**
             * TODO shuffle
             */
            function shuffle() {
                if (shuffle) {
                    index = Math.round(Math.random() * playList.length);
                }
            }

            function doEnd() {
                if (index === playList.length - 1) {
                    if (!repeating) {
                        audio.pause();
                        plActive();
                        playBtn.classList.remove('is-playing');
                        playSvgPath.setAttribute('d', playSvg.getAttribute('data-play'));
                        return;
                    } else {
                        play(0);
                    }
                } else {
                    play(index + 1);
                }
            }

            function moveBar(evt, el, dir) {
                var value;
                if (dir === 'horizontal') {
                    value = Math.round(((evt.clientX - el.offset().left) + window.pageXOffset) * 100 / el.parentNode.offsetWidth);
                    el.style.width = value + '%';
                    return value;
                } else {
                    if (evt.type === wheel()) {
                        value = parseInt(volumeLength, 10);
                        var delta = evt.deltaY || evt.detail || -evt.wheelDelta;
                        value = (delta > 0) ? value - 10 : value + 10;
                    } else {
                        var offset = (el.offset().top + el.offsetHeight) - window.pageYOffset;
                        value = Math.round((offset - evt.clientY));
                    }
                    if (value > 100) value = wheelVolumeValue = 100;
                    if (value < 0) value = wheelVolumeValue = 0;
                    volumeBar.style.height = value + '%';
                    return value;
                }
            }

            function handlerBar(evt, rg) {
                rightClick = rg;
                seeking = true;
                seek(evt);
            }

            function handlerVol(evt) {
                seeking = true;
                setVolume(evt);
            }

            function seek(op) {
                if (seeking && rightClick === false && audio.readyState !== 0) {
                    audio.currentTime = Math.floor(audio.duration * (op));
                }
            }

            function seekingFalse() {
                seeking = false;
            }

            function setVolume(evt) {
                evt.preventDefault();
                volumeLength = volumeBar.css('height');
                if (seeking && rightClick === false || evt.type === wheel()) {
                    var value = moveBar(evt, volumeBar.parentNode, 'vertical') / 100;
                    if (value <= 0) {
                        audio.volume = 0;
                        audio.muted = true;
                        volumeBtn.classList.add('has-muted');
                    } else {
                        if (audio.muted) audio.muted = false;
                        audio.volume = value;
                        volumeBtn.classList.remove('has-muted');
                    }
                }
            }

            function notify(title, attr) {
                if (!settings.notification) {
                    return;
                }
                if (window.Notification === undefined) {
                    return;
                }
                attr.tag = 'AP music player';
                window.Notification.requestPermission(function(access) {
                    if (access === 'granted') {
                        var notice = new Notification(title.substr(0, 110), attr);
                        setTimeout(notice.close.bind(notice), 5000);
                    }
                });
            }

            /* Destroy method. Clear All */
            function destroy() {
                if (!apActive) return;

                if (settings.confirmClose) {
                    window.removeEventListener('beforeunload', beforeUnload, false);
                }

                playBtn.removeEventListener('click', playToggle, false);
                volumeBtn.removeEventListener('click', volumeToggle, false);
                repeatBtn.removeEventListener('click', repeatToggle, false);
                plBtn.removeEventListener('click', plToggle, false);

                progressBar.closest('.progress-container').removeEventListener('mousedown', handlerBar, false);
                progressBar.closest('.progress-container').removeEventListener('mousemove', seek, false);
                document.documentElement.removeEventListener('mouseup', seekingFalse, false);

                volumeBar.closest('.volume').removeEventListener('mousedown', handlerVol, false);
                volumeBar.closest('.volume').removeEventListener('mousemove', setVolume);
                volumeBar.closest('.volume').removeEventListener(wheel(), setVolume);
                document.documentElement.removeEventListener('mouseup', seekingFalse, false);

                prevBtn.removeEventListener('click', prev, false);
                nextBtn.removeEventListener('click', next, false);

                audio.removeEventListener('error', errorHandler, false);
                audio.removeEventListener('timeupdate', timeUpdate, false);
                audio.removeEventListener('ended', doEnd, false);


                audio.pause();
                apActive = false;
                index = 0;

                playBtn.classList.remove('is-playing');
                // playSvgPath.setAttribute('d', playSvg.getAttribute('data-play'));
                // volumeBtn.classList.remove('has-muted');
                // plBtn.classList.remove('is-active');
                repeatBtn.classList.remove('is-active');

                // Remove player from the DOM if necessary
                // player.parentNode.removeChild(player);
            }

            /**
             *  Helpers
             */
            function wheel() {
                var wheel;
                if ('onwheel' in document) {
                    wheel = 'wheel';
                } else if ('onmousewheel' in document) {
                    wheel = 'mousewheel';
                } else {
                    wheel = 'MozMousePixelScroll';
                }
                return wheel;
            }

            function extend(defaults, options) {
                for (var name in options) {
                    if (defaults.hasOwnProperty(name)) {
                        defaults[name] = options[name];
                    }
                }
                return defaults;
            }

            function create(el, attr) {
                var element = document.createElement(el);
                if (attr) {
                    for (var name in attr) {
                        if (element[name] !== undefined) {
                            element[name] = attr[name];
                        }
                    }
                }
                return element;
            }

            function getTrack(index) {
                return playList[index];
            }

            Element.prototype.offset = function() {
                var el = this.getBoundingClientRect(),
                    scrollLeft = window.pageXOffset || document.documentElement.scrollLeft,
                    scrollTop = window.pageYOffset || document.documentElement.scrollTop;

                return {
                    top: el.top + scrollTop,
                    left: el.left + scrollLeft
                };
            };

            Element.prototype.css = function(attr) {
                if (typeof attr === 'string') {
                    return getComputedStyle(this, '')[attr];
                } else if (typeof attr === 'object') {
                    for (var name in attr) {
                        if (this.style[name] !== undefined) {
                            this.style[name] = attr[name];
                        }
                    }
                }
            };

            // matches polyfill
            window.Element && function(ElementPrototype) {
                ElementPrototype.matches = ElementPrototype.matches ||
                    ElementPrototype.matchesSelector ||
                    ElementPrototype.webkitMatchesSelector ||
                    ElementPrototype.msMatchesSelector ||
                    function(selector) {
                        var node = this,
                            nodes = (node.parentNode || node.document).querySelectorAll(selector),
                            i = -1;
                        while (nodes[++i] && nodes[i] != node);
                        return !!nodes[i];
                    };
            }(Element.prototype);

            // closest polyfill
            window.Element && function(ElementPrototype) {
                ElementPrototype.closest = ElementPrototype.closest ||
                    function(selector) {
                        var el = this;
                        while (el.matches && !el.matches(selector)) el = el.parentNode;
                        return el.matches ? el : null;
                    };
            }(Element.prototype);

            /**
             *  Public methods
             */
            return {
                init: init,
                listHandler: listHandler,
                handlerBar: handlerBar,
                seek: seek,
                destroy: destroy,
                getTrack: getTrack
            };

        })();

        window.AP = AudioPlayer;



    })(window);

    //-----= Playlist Fetch
    var playlist = [];
    $('.play.d-inline').each(function () {

        var cover = $(this).data('cover');
        var title = $(this).data('title');
        var file = $(this).data('src');
        var artist = $(this).data('artist');
        var ind = playlist.push({
            'icon': cover,
            'title': title,
            'artist': artist,
            'file': file
        }) - 1;
        $(this).attr('data-index',ind);
    }).after(function () {
        AP.init({
            playList: playlist
        });
    });



    $(document).ready(function() {
        $(".pl-list__download").on("click", function() {
            var trackPlaying = $(this).closest(".pl-list");
            console.log(AP.getTrack(trackPlaying.attr("data-track")));
        });
    });

    (function() {
        $('.back_btn').on('click', function() {
            $('.player_playlist').toggleClass('playlist_on');
            $('.glyphicon-menu-left').toggleClass('back_btn_on');
            $('.waves').toggleClass('waves_up');
            $('.album_wrap').toggleClass('album_up');
            $('.song_playing').toggleClass('song_playing_up');
            $('.timeline_wrap').toggleClass('timeline_wrap_up');
            $('.player_btns').toggleClass('player_btns_up');
            $('.line_played').toggleClass('line_played_up');
            $('.full_line').toggleClass('full_line_up');
            $('.time_of_song').toggleClass('time_of_song_up');
            $('.progress-bar-pointer').toggleClass('progress-bar-pointer_up');
            $('.line_preload').toggleClass('line_preload_up');
        })
    })();

    (function() {
        $('.hamburger-menu').on('click', function() {
            $('.bar').toggleClass('animate');
            $('.hamburger-menu').toggleClass('slide');
            $('.back_btn').toggleClass('slide');
            $('.nav_menu').toggleClass('open');
            $('.player_fade').toggleClass('player_fade_on');
        })
    })();

    //-----= SeekBar
    (function() {
        $('.p-seekbar').on('mousedown', function(e) {
            var parentOffset = $(this).offset();
            var clkX = e.pageX - parentOffset.left;
            var relX = $(this).width();
            var rightClick = (e.which === 3);
            AP.handlerBar(clkX/relX,rightClick);
        })
    })();

    //-----= Play/Pause Click Handling
    (function() {
        $('.p-play').on('click', function() {
            if($(this).find('i').hasClass('icon-pause'))
                $(this).find('i').addClass('icon-play').removeClass('icon-pause');
            else
                $(this).find('i').removeClass('icon-play').addClass('icon-pause');
        })
    })();

    //-----= PlayList Play Click Handling
    (function() {
        $('.play.d-inline').on('click', function() {
            if($(this).find('i').hasClass('icon-pause')){
                // $(this).find('i').addClass('icon-play').removeClass('icon-pause');
                $('.p-play').find('i').addClass('icon-play').removeClass('icon-pause');
            }else{
                // $(this).find('i').removeClass('icon-play').addClass('icon-pause');
                $('.p-play').find('i').removeClass('icon-play').addClass('icon-pause');
            }
            AP.listHandler($(this).attr('data-index'));
        })
    })();
    (function() {
        $('.random_btn').on('click', function() {
            $('.random_btn').toggleClass('random_btn_on');
        })
    })();

    (function() {
        $('.repeat_btn').on('click', function() {
            $('.repeat_btn').toggleClass('repeat_btn_on');

        })
    })();

    // отменить выделение текста
    function preventSelection(element) {
        var preventSelection = false;

        function addHandler(element, event, handler) {
            if (element.attachEvent)
                element.attachEvent('on' + event, handler);
            else
            if (element.addEventListener)
                element.addEventListener(event, handler, false);
        }

        function removeSelection() {
            if (window.getSelection) {
                window.getSelection().removeAllRanges();
            } else if (document.selection && document.selection.clear)
                document.selection.clear();
        }

        function killCtrlA(event) {
            var event = event || window.event;
            var sender = event.target || event.srcElement;
            if (sender.tagName.match(/INPUT|TEXTAREA/i))
                return;
            var key = event.keyCode || event.which;
            if (event.ctrlKey && key == 'A'.charCodeAt(0)) // 'A'.charCodeAt(0) можно заменить на 65
            {
                removeSelection();
                if (event.preventDefault)
                    event.preventDefault();
                else
                    event.returnValue = false;
            }
        }
        // не даем выделять текст мышкой
        addHandler(element, 'mousemove', function() {
            if (preventSelection)
                removeSelection();
        });
        addHandler(element, 'mousedown', function(event) {
            var event = event || window.event;
            var sender = event.target || event.srcElement;
            preventSelection = !sender.tagName.match(/INPUT|TEXTAREA/i);
        });
        // борем dblclick
        // если вешать функцию не на событие dblclick, можно избежать
        // временное выделение текста в некоторых браузерах
        addHandler(element, 'mouseup', function() {
            if (preventSelection)
                removeSelection();
            preventSelection = false;
        });
        // борем ctrl+A
        // скорей всего это и не надо, к тому же есть подозрение
        // что в случае все же такой необходимости функцию нужно
        // вешать один раз и на document, а не на элемент
        addHandler(element, 'keydown', killCtrlA);
        addHandler(element, 'keyup', killCtrlA);
    }
    preventSelection(document);
});