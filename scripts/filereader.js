const hostname = 'http://localhost';
const presetVolume = 0.04;
var albums;
var tracksInfo = {};
var repeatMode = 0;
var audio;
var source;

function parseFile(obj) {
  jsmediatags.read(obj.files[0], {
    onSuccess: function(tag) {
      console.log(tag);
    },
    onError: function(error) {
      console.log(error);
    }
  });
}

function renderAlbums() {
  let el = $('#albums-list');
  el.empty();
  Object.keys(albums).forEach(function (name) {
    el.append(`<div id='album-${name}' onclick='openAlbum("${name}")'> ${name} <span>(${albums[name].length})</span></div>`);
    for (k in albums[name]) {
      if (tracksInfo[albums[name][k]] === undefined) {
        loadTrack(albums[name][k]);
      }
    }
  });
}

function loadAlbums() {
  j = localStorage.getItem('albums');
  if (j == null) {
    localStorage.setItem('albums', '{}');
    return;
  }
  j = JSON.parse(j);
  albums = j;
  renderAlbums();
}

function loadTrack(filename, afterSuccess) {
  tracksInfo[filename] = null;
  jsmediatags.read(`${hostname}/music/${filename}`, {
    onSuccess: function(tag) {
      tracksInfo[filename] = tag;
      if (afterSuccess) afterSuccess();
    },
    onError: function(error) {
      console.log(error);
    }
  });
}

function openAlbum(name) {
  el = $('#album-tracks');
  el.empty();
  $('.album-selected').removeClass('album-selected');
  $('#album-' + name).addClass('album-selected');
  albums[name].forEach(function (filename) {
    let title = filename;
    let artist = '';
    if (tracksInfo[filename].tags.title) {
      title = tracksInfo[filename].tags.title;
    }
    if (tracksInfo[filename].tags.artist) {
      artist = tracksInfo[filename].tags.artist;
    }
    el.append(`<div track-filename='${filename}' onclick='setTrack("${filename}")'${`${hostname}/music/${filename}` === audio.currentSrc ? ' class="track-selected"' : ''}> ${title} <span>${artist}</span></div>`);
  });
}

function setTrack(filename) {
  source.src = `/music/${filename}`;
  $('.track-selected').removeClass('track-selected');
  $(`div[track-filename="${filename}"]`).addClass('track-selected');
  audio.load();
  audio.play();
  $('#play-button > img').attr('src', '/images/pause.svg');
  if (tracksInfo[filename].tags.title) {
    $('#track-info-title').empty().append(tracksInfo[filename].tags.title);
  } else {
    $('#track-info-title').empty().append(filename);
  }
  if (tracksInfo[filename].tags.artist) {
    $('#track-info-artist').empty().append(tracksInfo[filename].tags.artist);
  } else {
    $('#track-info-artist').empty();
  }
  if (tracksInfo[filename].tags.picture) {
    let base64String = "";
    for (var i = 0; i < tracksInfo[filename].tags.picture.data.length; i++) {
      base64String += String.fromCharCode(tracksInfo[filename].tags.picture.data[i]);
    }
    let imageUri = "data:" + tracksInfo[filename].tags.picture.format + ";base64," + window.btoa(base64String);
    $('#track-info-image > img').attr('src', imageUri);
  } else {
    $('#track-info-image > img').attr('src', '/images/nocover.svg');
  }
}

$(document).ready(function () {
  audio = document.getElementById('audio');
  source = document.getElementById('audioSource');
  loadAlbums();
  audio.volume = presetVolume;
  $('.volume-slider-base').children().css({transform: 'translateY(' + parseInt((1 - presetVolume) * 100) + '%)'});
  $('.volume-slider-base').on('click', function (e) {
    let y = e.originalEvent.clientY;
    let offset = e.currentTarget.offsetTop;
    let height = e.currentTarget.clientHeight;
    y -= offset;
    volume = 1 - y / height;
    audio.volume = volume;
    let percent = parseInt(y / height * 100);
    $(e.currentTarget).children().css({transform: 'translateY(' + percent + '%)'});
  });
  $('#play-button > img').on('click', function (e) {
    if (audio.paused) {
      audio.play();
      e.currentTarget.src = '/images/pause.svg';
    } else {
      audio.pause();
      e.currentTarget.src = '/images/play.svg';
    }
  });
  $('#repeat-button > img').on('click', function (e) {
    repeatMode = (repeatMode + 1) % 3;
    $('#repeat-button > img').attr('src', '/images/repeat' + repeatMode + '.svg');
  });
  $('#prev-button > img').on('click', function (e) {
    let track = $('.track-selected');
    let trackIndex = parseInt(Object.keys($('#album-tracks').children()).find(key => $('#album-tracks').children()[key] === track[0]));
    $('#album-tracks').children().get(trackIndex - 1).click();
  });
  $('#next-button > img').on('click', function (e) {
    let track = $('.track-selected');
    let trackIndex = parseInt(Object.keys($('#album-tracks').children()).find(key => $('#album-tracks').children()[key] === track[0]));
    if (trackIndex != $('#album-tracks').children().length - 1) {
      $('#album-tracks').children().get(trackIndex + 1).click();
    } else {
      $('#album-tracks').children().get(0).click();
    }
  });
  $('.track-time-slider-base').on('click', function (e) {
    let x = e.originalEvent.clientX - e.currentTarget.clientLeft;
    let width = e.currentTarget.clientWidth;
    audio.currentTime = parseInt(x / width * audio.duration);
  });

  $('#track-add-button').on('click', function (e) {
    $('#track-add-modal').modal('show');
  });
  $('#track-add-confirm-button').on('click', function (e) {
    let albumSelected = $('.album-selected')[0].id.slice(6);
    let filename = $('#track-add-filename')[0].value;
    if (tracksInfo[filename]) {
      if (albums[albumSelected].indexOf(filename) == -1) {
        albums[albumSelected].push(filename);
        openAlbum(albumSelected);
        localStorage['albums'] = JSON.stringify(albums);
      }
    } else {
      loadTrack(filename, function () {
        albums[albumSelected].push(filename);
        openAlbum(albumSelected);
        localStorage['albums'] = JSON.stringify(albums);
      });
    }
    renderAlbums();
  });

  $('#album-create-button').on('click', function (e) {
    $('#album-create-modal').modal('show');
  });
  $('#album-create-confirm-button').on('click', function (e) {
    albums[$('#album-create-name')[0].value] = [];
    openAlbum($('#album-create-name')[0].value);
    renderAlbums();
    localStorage['albums'] = JSON.stringify(albums);
  });

  $(audio).on('loadedmetadata', function (e) {
    $('#track-time-info-duration')[0].innerHTML = parseInt(audio.duration / 60) + ':' + (parseInt(audio.duration % 60) < 10 ? '0' : '') + parseInt(audio.duration % 60);
  });
  $(audio).on('ended', function (e) {
    let track = $('.track-selected');
    let trackIndex = parseInt(Object.keys($('#album-tracks').children()).find(key => $('#album-tracks').children()[key] === track[0]));
    switch (repeatMode) {
      case 0:
        if (trackIndex != $('#album-tracks').children().length - 1) {
          $('#album-tracks').children().get(trackIndex + 1).click();
        } else {
          $('#album-tracks').children().get(0).click();
          audio.pause();
          $('#play-button > img').attr('src', '/images/play.svg');
        }
        break;
      case 1:
        if (trackIndex != $('#album-tracks').children().length - 1) {
          $('#album-tracks').children().get(trackIndex + 1).click();
        } else {
          $('#album-tracks').children().get(0).click();
        }
        break;
      case 2:
        audio.play();
        break;
    }
  });
  $(audio).on('timeupdate', function (e) {
    let percent = audio.currentTime / audio.duration * 100;
    $('.track-time-slider-colored').css({transform: 'translateX(' + (percent - 100) + '%)'});
    $('#track-time-info-currentTime')[0].innerHTML = parseInt(audio.currentTime / 60) + ':' + (parseInt(audio.currentTime % 60) < 10 ? '0' : '') + parseInt(audio.currentTime % 60)
  });
});
