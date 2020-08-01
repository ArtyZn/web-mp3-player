<!-- 
<?php
  $uagent=$_SERVER['HTTP_USER_AGENT'];
  if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$uagent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($uagent,0,4)))
    header('location: http://192.168.1.50/mobile/');
?> 
-->

<html>
  <head>
    <meta charset="utf-8">
    <link rel='stylesheet' type="text/css" href='/styles/themes/dark.css'>
    <link rel='stylesheet' type="text/css" href='/styles/main.css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="/scripts/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="/scripts/jsmediatags.js"></script>
    <script src="/scripts/filereader.js"></script>
  </head>

  <body>
    <audio id="audio">
      <source id="audioSource" src="">
    </audio>
    <div id='content-wrapper'>
      <div id='navbar'>
        <div id='navbar-right'>
          <div id='search' class='invisible'></div>
          <div id='search-wrapper'>
            <input class='form-control' id='search-input' type='text' placeholder="Поиск"></input>
          </div>
          <button class='btn btn-outline-light' id='upload-modal-button' onclick='$("#file-upload-modal").modal("toggle");'>Загрузить</button>
        </div>
      </div>
      <div id='track'>
        <div id='track-info'>
          <div id='track-info-image'>
            <img src='/images/nocover.svg'>
          </div>
          <div id='track-info-title'></div>
          <div id='track-info-artist'></div>
        </div>
        <div id='track-time-info'>
          <div id='track-time-info-currentTime'>0:00</div>
          <div id='track-time-info-duration'>0:00</div>
        </div>
        <div id='track-time-slider'>
          <div class='track-time-slider-base'>
            <div class='track-time-slider-colored'></div>
          </div>
        </div>
        <div id='track-controls'>
          <div id='volume-slider'>
            <div class='volume-slider-base'>
              <div class='volume-slider-colored'></div>
            </div>
          </div>
          <div id="prev-button"><img src='/images/prev.svg'></div>
          <div id="play-button"><img src='/images/play.svg'></div>
          <div id="next-button"><img src='/images/next.svg'></div>
          <div id="repeat-button"><img src='/images/repeat0.svg'></div>
        </div>
      </div>
      <div id='album'>
        <div id='album-tracks'></div>
        <div id='album-controls'>
          <div id="track-add-button"><img src='/images/add.svg'></div>
        </div>
      </div>
      <div id='albums'>
        <div id='albums-list'></div>
        <div id='albums-controls'>
          <div id="album-create-button"><img src='/images/add.svg'></div>
        </div>
      </div>
    </div>

    <div class="modal" tabindex="-1" role="dialog" id='file-upload-modal'>
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Загрузить файл</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Закрыть">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="file-upload" multiple>
              <label class="custom-file-label" for="file-upload">Выберите файл для загрузки</label>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary">Загрузить</button>
          </div>
        </div>
      </div>
    </div>
    <div class="modal" tabindex="-1" role="dialog" id='track-add-modal'>
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Добавить трек</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Закрыть">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <input type="text" class="form-control" id="track-add-filename" placeholder="Название файла">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="track-add-confirm-button">Добавить</button>
          </div>
        </div>
      </div>
    </div>
    <div class="modal" tabindex="-1" role="dialog" id='album-create-modal'>
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Создать альбом</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Закрыть">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <input type="text" class="form-control" id="album-create-name" placeholder="Название альбома">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="album-create-confirm-button">Создать</button>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
