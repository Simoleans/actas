@extends('layouts.app')
@section('title','Acta - '.config('app.name'))
@section('header','Acta')
@section('breadcrumb')
  <ol class="breadcrumb">
    <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
    <li> Acta {{$acta->codigo}} </li>
    <li class="active">Ver </li>
  </ol>
@endsection
@section('content')

<style type="text/css">
  .modal-dialog {
  width: 100%;
  height: 100%;
  padding: 0;
}

.modal-content {
  min-height: 80vh;
  border-radius: 0;
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
  /*max-width: 700px;*/
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
/*  position: absolute;*/
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


}

</style>

  <section class="perfil">
    <div class="row">
      <div class="col-md-12">
        <h2 class="page-header" style="margin-top:0!important">
          <i class="fa fa-user" aria-hidden="true"></i>
          {{ 'Acta '.$acta->codigo }}
          <small class="pull-right">Registrado: {{ $acta->created_at }}</small>
          <span class="clearfix"></span>
        </h2>
      </div>
      <div class="col-md-5">
        <h4>Detalles de la empresa</h4>
        <p><b>Usuario: </b> {{$acta->user->nombre}} </p>
        <p><b>Empresa: </b> {{strtoupper($acta->empresa->r_social)}}</p>
        <p><b>Ciudad: </b> {{strtoupper($acta->empresa->ciudad)}}</p>
        <p><b>RUT: </b> {{strtoupper($acta->empresa->rut)}}</p>
        <p><b>Contacto: </b> {{strtoupper($acta->empresa->contacto)}}</p>
        <p><b>Telefono: </b> {{strtoupper($acta->empresa->telefono)}}</p>
        <p><b>Direccion: </b> {{strtoupper($acta->empresa->direccion)}}</p>

      </div>

      <div class="col-md-4">
        <h4>Fotos</h4>
        <div class="row">
          @foreach($acta->fotos($acta->codigo) as $f)
            <div class="col-md-5"><img src="{{asset('img/actas/fotos/'.$f->foto)}}" class="img-responsive"></div>
          @endforeach
        </div>
      </div>

      <div class="col-md-2">
        <p>&nbsp;</p>
        <p><b>Logo</b></p>
        <img src="{{asset('img/empresas/'.$acta->empresa->logo)}}" class="img-responsive">
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <h2 class="page-header" style="margin-top:0!important">
          <i class="fa fa-users" aria-hidden="true"></i>
          Firma Aquí
          <span class="clearfix"></span>
        </h2>
      </div>
      <div class="col-md-12">
          @if(!$firma)
            <div class="col-md-6 col-md-offset-3">
              <img src="{{asset('img/actas').'/'.$participante->firma}}" class="img-responsive">
              <h3 class="tag-ingo text-center">{{strtoupper($participante->clientes->nombre.' '.$participante->clientes->apellido)}}</h3>
            </div>
           @else
         <div class="row">
           <div class="col-md-5 col-md-offset-5">
             <a class="btn btn-primary btn-lg" href="{{route('actas.sign',['id' => $participante->id,'acta_id'=>$acta->id])}}">
              ¡Firma Aquí!
            </a>
           </div>
         </div>
        
         @endif

      <br>
      <img src="">
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <h2 class="page-header" style="margin-top:0!important">
          <i class="fa fa-list" aria-hidden="true"></i>
          Acciones
          <span class="clearfix"></span>
        </h2>
      </div>
      <div class="col-md-12">
       <table class="table table-condensed table-hover table-bordered">
         <thead>
           <tr>
            <th class="text-center">#</th>
            <th class="text-center">Accion</th>
          </tr>
         </thead>
         <tbody>
          @foreach($acta->acciones($acta->codigo) as $a)
           <tr>
             <td>{{$loop->index+1}}</td>
             <td class="text-center">{{$a->accion}}</td>
           </tr>
          @endforeach
         </tbody>
       </table>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <h2 class="page-header" style="margin-top:0!important">
          <i class="fa fa-eye" aria-hidden="true"></i>
          Observaciones
          <span class="clearfix"></span>
        </h2>
      </div>
      <div class="col-md-12">
       <table class="table table-condensed table-hover table-bordered">
         <thead>
           <tr>
            <th class="text-center">#</th>
            <th class="text-center">Accion</th>
          </tr>
         </thead>
         <tbody>
          @foreach($acta->observaciones($acta->codigo) as $a)
           <tr>
             <td>{{$loop->index+1}}</td>
             <td class="text-center">{{$a->observacion}}</td>
           </tr>
          @endforeach
         </tbody>
       </table>
      </div>
    </div>
  </section>




@endsection

@section('script')

<script type="text/javascript">

  $(document).ready(function(){

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
window.onresize = resizeCanvas;
resizeCanvas();

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



savePNGButton.addEventListener("click", function (event) {
  if (signaturePad.isEmpty()) {
    swal("Debe poner una firma.");
  } else {
    // var dataURL = signaturePad.toDataURL();
    // download(dataURL, "signature.png");

    html2canvas([document.getElementById('signatura-pad-image')], {
          onrendered: function (canvas) {
            var canvas_img_data = canvas.toDataURL('image/png');
            var img_data = canvas_img_data.replace(/^data:image\/(png|jpg);base64,/, "");

            $("#firma").val(img_data);

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
                    $('#myModal').modal('hide');
                     window.location.reload();
                  }
                });



          }
        });// fin html2canvas
  }
});






});
</script>

@endsection
