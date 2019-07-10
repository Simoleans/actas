<!DOCTYPE html>
<html>
<head>
  <title>Firmar</title>
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <!-- Icon 16x16 -->
    <link rel="icon" type="image/png" sizes="240x240" href="{{asset('img/logo.png')}}">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/font-awesome.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/AdminLTE.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/glyphicons.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/datatables/dataTables.bootstrap.css')}}">
     <link rel="stylesheet" type="text/css" href="{{ asset('plugins/datatables/extensions/Responsive/css/dataTables.responsive.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/fileinput-rtl.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/fileinput.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('js/sign_src/css/jquery.signaturepad.css')}}">
<!--     <link rel="stylesheet" type="text/css" href="{{asset('css/fileinput.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-datepicker3.min.css')}}">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/css/inputmask.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="{{asset('css/_all-skins.min.css')}}"> -->
<style type="text/css">
*,
*::before,
*::after {
  box-sizing: border-box;
}

body {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-pack: center;
      -ms-flex-pack: center;
          justify-content: center;
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center;
  height: 100vh;
  width: 100%;
  -webkit-user-select: none;
     -moz-user-select: none;
      -ms-user-select: none;
          user-select: none;
  margin: 0;
  padding: 32px 16px;
  */font-family: Helvetica, Sans-Serif;
  background-color: #ecf0f5;
}
.signature-pad {
  position: relative;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
      -ms-flex-direction: column;
          flex-direction: column;
  font-size: 10px;
  width: 100%;
  min-height: 80%;
  max-width: 700px;
  max-height: 460px;
  border: 1px solid #e8e8e8;
  background-color: #fff;
  box-shadow: 0 1px 4px rgba(0, 0, 0, 0.27), 0 0 40px rgba(0, 0, 0, 0.08) inset;
  border-radius: 4px;
  padding: 16px;
}

.signature-pad::before,
.signature-pad::after {
  position: absolute;
  z-index: -1;
  content: "";
  width: 40%;
  height: 10px;
  bottom: 10px;
  background: transparent;
  box-shadow: 0 8px 12px rgba(0, 0, 0, 0.4);
}

.signature-pad::before {
  left: 20px;
  -webkit-transform: skew(-3deg) rotate(-3deg);
          transform: skew(-3deg) rotate(-3deg);
}

.signature-pad::after {
  right: 20px;
  -webkit-transform: skew(3deg) rotate(3deg);
          transform: skew(3deg) rotate(3deg);
}

.signature-pad--body {
  position: relative;
  -webkit-box-flex: 1;
      -ms-flex: 1;
          flex: 1;
  border: 1px solid #f4f4f4;
}

.signature-pad--body
canvas {
  position: absolute;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  border-radius: 4px;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.02) inset;
}

.signature-pad--footer {
  color: #C3C3C3;
  text-align: center;
  font-size: 1.2em;
  margin-top: 8px;
}

.signature-pad--actions {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-pack: justify;
      -ms-flex-pack: justify;
          justify-content: space-between;
  margin-top: 8px;
}
  </style>
</head>
<body>
  
  @if($firma)
    <form method="POST" enctype="multipart/form-data" id="form_pad">
       <meta name="csrf-token" content="{{ csrf_token() }}" />
        <input type="hidden" name="id_participante" value="{{$participante->id}}">
        <input type="hidden" name="firma" id="firma" required>
        <input type="hidden" name="id_acta" value="{{$acta->id}}">
      </form>
        <div id="signature-pad" class="signature-pad" >
          <div class="signature-pad--body" id="signatura-pad-image">
            <canvas></canvas>
          </div>
          <div class="signature-pad--footer">
            <div class="description">VeanX Technology<br>{{$participante->clientes->nombre.' '.$participante->clientes->apellido}}</div>

            <div class="signature-pad--actions">
              <div>
                <button type="button" class="button clear btn btn-lg btn-default btn-flat" data-action="clear">Limpiar</button>
                <button type="button" class="button btn btn-lg btn-warning btn-flat"  data-action="change-color">Cambiar Color</button>
                <button type="button" class="button btn btn-lg btn-warning btn-flat"  data-action="undo">Corregir</button>

              </div>
              <div>
                <button type="button" class="button save btn btn-lg btn-success btn-flat"  data-action="save-png">Guardar</button>
                <button type="button" class="button save btn btn-sm btn-danger btn-flat" style="display: none;" data-action="save-jpg">Guardar en JPG</button>
                <button type="button" class="button save btn btn-sm btn-danger btn-flat" style="display: none;" data-action="save-svg">Guardar en SVG</button>
              </div>
            </div>
          </div>
        </div>
    @else
    <h2>¡Ya usted Ha Firmado!</h2>
    @endif

          <!-- jQuery 2.1.4 -->
    <script type="text/javascript" src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
    <!-- Bootstrap 3.3.5 -->
    <script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script type="text/javascript" src="{{asset('js/app.min.js')}}"></script>
    <!-- Data table -->
    <script type="text/javascript" src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('plugins/datatables/dataTables.bootstrap.js')}}"></script>
    <script type="text/javascript" src="{{ asset('plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js') }}"></script>
    <script type="text/javascript" src="{{asset('js/fileinput.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/inputmask/inputmask.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/themes/fa/theme.js" type="text/javascript"></script>
    <script type="text/javascript" src="{{asset('js/sign_src/js/bezier.js')}}"></script>
     {{-- <script type="text/javascript" src="{{asset('js/sign_src/js/jquery.signaturepad.js')}}"></script> --}}
     <script type="text/javascript" src="{{asset('js/sign_src/js/json2.min.js')}}"></script>
     <script type="text/javascript" src="{{asset('js/sign_src/js/numeric-1.2.6.min.js')}}"></script>
     <script type='text/javascript' src="https://github.com/niklasvh/html2canvas/releases/download/0.4.1/html2canvas.js"></script>
     <script type="text/javascript" src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript" src="{{asset('js/fileinput.js')}}"></script>
    {{--  <script type="text/javascript" src="{{asset('js/signature_pad.js')}}"></script> --}}
     <script type="text/javascript" src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
     <script type="text/javascript" src="{{asset('js/signature_pad.umd.js')}}"></script>
     <script type="text/javascript" src="{{asset('js/bootstrap-datepicker.min.js')}}"></script>
     <script type="text/javascript" src="{{asset('js/bootstrap-datepicker.es.min.js')}}"></script>

     <script type="text/javascript">



 var wrapper = document.getElementById("signature-pad");
var clearButton = wrapper.querySelector("[data-action=clear]");
var changeColorButton = wrapper.querySelector("[data-action=change-color]");
var undoButton = wrapper.querySelector("[data-action=undo]");
var savePNGButton = wrapper.querySelector("[data-action=save-png]");
var saveJPGButton = wrapper.querySelector("[data-action=save-jpg]");
var saveSVGButton = wrapper.querySelector("[data-action=save-svg]");
var canvas = wrapper.querySelector("canvas");
var signaturePad = new SignaturePad(canvas, {
  // It's Necessary to use an opaque color when saving image as JPEG;
  // this option can be omitted if only saving as PNG or SVG
  backgroundColor: 'rgb(255, 255, 255)'
});


// Adjust canvas coordinate space taking into account pixel ratio,
// to make it look crisp on mobile devices.
// This also causes canvas to be cleared.
function resizeCanvas() {
  // When zoomed out to less than 100%, for some very strange reason,
  // some browsers report devicePixelRatio as less than 1
  // and only part of the canvas is cleared then.
  var ratio =  Math.max(window.devicePixelRatio || 1, 1);


  // This part causes the canvas to be cleared
  canvas.width = canvas.offsetWidth * ratio;
  canvas.height = canvas.offsetHeight * ratio;
  //console.log(canvas.width,canvas.height);
  canvas.getContext("2d").scale(ratio, ratio);


  // This library does not listen for canvas changes, so after the canvas is automatically
  // cleared by the browser, SignaturePad#isEmpty might still return false, even though the
  // canvas looks empty, because the internal data of this library wasn't cleared. To make sure
  // that the state of this library is consistent with visual state of the canvas, you
  // have to clear it manually.
  signaturePad.clear();
}

// On mobile devices it might make more sense to listen to orientation change,
// rather than window resize events.
//window.onresize = resizeCanvas;
resizeCanvas()

function download(dataURL, filename) {
  if (navigator.userAgent.indexOf("Safari") > -1 && navigator.userAgent.indexOf("Chrome") === -1) {
    window.open(dataURL);
  } else {
    var blob = dataURLToBlob(dataURL);
    var url = window.URL.createObjectURL(blob);

    var a = document.createElement("a");
    a.style = "display: none";
    a.href = url;
    a.download = filename;

    document.body.appendChild(a);
    a.click();

    window.URL.revokeObjectURL(url);
  }
}

// One could simply use Canvas#toBlob method instead, but it's just to show
// that it can be done using result of SignaturePad#toDataURL.
function dataURLToBlob(dataURL) {
  // Code taken from https://github.com/ebidel/filer.js
  var parts = dataURL.split(';base64,');
  var contentType = parts[0].split(":")[1];
  var raw = window.atob(parts[1]);
  var rawLength = raw.length;
  var uInt8Array = new Uint8Array(rawLength);

  for (var i = 0; i < rawLength; ++i) {
    uInt8Array[i] = raw.charCodeAt(i);
  }

  return new Blob([uInt8Array], { type: contentType });
}

clearButton.addEventListener("click", function (event) {
  signaturePad.clear();
});

undoButton.addEventListener("click", function (event) {
  var data = signaturePad.toData();

  if (data) {
    data.pop(); // remove the last dot or line
    signaturePad.fromData(data);
  }
});

var toogle=true;

changeColorButton.addEventListener("click", function (event) {

  toogle = !toogle;

  if(toogle){var color = "rgb(0,0,0)";}
  if(!toogle){var color = "rgb(0,0,255)";}

  //var r = Math.round(Math.random() * 255);
  //var g = Math.round(Math.random() * 255);
  //var b = Math.round(Math.random() * 255);
  //var color = "rgb(" + r + "," + g + "," + b +")";

  signaturePad.penColor = color;
});



savePNGButton.addEventListener("click", function (event) {
  if (signaturePad.isEmpty()) {
    swal("Debe poner una firma.");
  } else {
    var dataURL = signaturePad.toDataURL();
    // download(dataURL, "signature.png");

    html2canvas([document.getElementById('signatura-pad-image')], {
          onrendered: function (canvas) {
            var canvas_img_data = canvas.toDataURL('image/png');
            var img_data = canvas_img_data.replace(/^data:image\/(png|jpg);base64,/, "");

            $("#firma").val(img_data);
              console.log("llegue")
                $.ajax({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  url: '{{route('actas.send')}}',
                  data: $("#form_pad").serialize(),
                  type: 'post',
                  dataType: 'json',
                  success: function (response) {
                    swal(response.msg);
                    window.location.replace(response.url);
                  }
                });



          }
        });// fin html2canvas
  }
});

saveJPGButton.addEventListener("click", function (event) {
  if (signaturePad.isEmpty()) {
    alert("Please provide a signature first.");
  } else {
    var dataURL = signaturePad.toDataURL("image/jpeg");
    download(dataURL, "signature.jpg");
  }
});

saveSVGButton.addEventListener("click", function (event) {
  if (signaturePad.isEmpty()) {
    alert("Please provide a signature first.");
  } else {
    var dataURL = signaturePad.toDataURL('image/svg+xml');
    download(dataURL, "signature.svg");
  }
});


</script>
</body>


</html>
