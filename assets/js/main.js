showModal = (element) => {
    const modal = new bootstrap.Modal(document.getElementById(element));
    modal.show();
}

$(document).on('input', '#regi_nacimiento', function () {
  let v = this.value.replace(/\D/g, '').slice(0, 8); // solo dígitos (máx 8)
  if (v.length >= 5)       v = v.replace(/(\d{2})(\d{2})(\d{1,4}).*/, '$1/$2/$3');
  else if (v.length >= 3)  v = v.replace(/(\d{2})(\d{1,2})/, '$1/$2');
  this.value = v;
});

function checkFecha(fecha) {  
      
  try{        
    var fecha = fecha.split("/");        
    var dia = fecha[0];        
    var mes = fecha[1];        
    var ano = fecha[2];        
    var estado = true;  
     
    if ((dia.length == 2) && (mes.length == 2) && (ano.length == 4)) {        
      switch (parseInt(mes)) {        
        case 1:dmax = 31;break;        
        case 2: if (ano % 4 == 0) dmax = 29; else dmax = 28;        
        break;        
        case 3:dmax = 31;break;        
        case 4:dmax = 30;break;        
        case 5:dmax = 31;break;        
        case 6:dmax = 30;break;        
        case 7:dmax = 31;break;        
        case 8:dmax = 31;break;        
        case 9:dmax = 30;break;        
        case 10:dmax = 31;break;       
        case 11:dmax = 30;break;      
        case 12:dmax = 31;break;       
      }  
          
      dmax!=""?dmax:dmax=-1;if ((dia >= 1) && (dia <= dmax) && (mes >= 1) && (mes <= 12)) {        
      for (var i = 0; i < fecha[0].length; i++) {         
        diaC = fecha[0].charAt(i).charCodeAt(0);        
        (!((diaC > 47) && (diaC < 58)))?estado = false:'';       
        mesC = fecha[1].charAt(i).charCodeAt(0);        
        (!((mesC > 47) && (mesC < 58)))?estado = false:'';       
      }  
     
    } for (var i = 0; i < fecha[2].length; i++) {  
     
    anoC = fecha[2].charAt(i).charCodeAt(0);  
     
    (!((anoC > 47) && (anoC < 58)))?estado = false:'';        
    }} else estado = false;        
    return estado;    
      
 }catch(err){  
  //alert("Error fechas");    
  }
}

function checkEmail(emailAddress) {
  var sQtext = '[^\\x0d\\x22\\x5c\\x80-\\xff]';
  var sDtext = '[^\\x0d\\x5b-\\x5d\\x80-\\xff]';
  var sAtom = '[^\\x00-\\x20\\x22\\x28\\x29\\x2c\\x2e\\x3a-\\x3c\\x3e\\x40\\x5b-\\x5d\\x7f-\\xff]+';
  var sQuotedPair = '\\x5c[\\x00-\\x7f]';
  var sDomainLiteral = '\\x5b(' + sDtext + '|' + sQuotedPair + ')*\\x5d';
  var sQuotedString = '\\x22(' + sQtext + '|' + sQuotedPair + ')*\\x22';
  var sDomain_ref = sAtom;
  var sSubDomain = '(' + sDomain_ref + '|' + sDomainLiteral + ')';
  var sWord = '(' + sAtom + '|' + sQuotedString + ')';
  var sDomain = sSubDomain + '(\\x2e' + sSubDomain + ')*';
  var sLocalPart = sWord + '(\\x2e' + sWord + ')*';
  var sAddrSpec = sLocalPart + '\\x40' + sDomain; 
  var sValidEmail = '^' + sAddrSpec + '$';

  var reValidEmail = new RegExp(sValidEmail);

  return reValidEmail.test(emailAddress);
}

function showError(name, msg){
    $("#"+name+"_help").html(msg);
    $("#"+name+"_help").fadeIn('fast');
    $("#"+name).focus();
    $("#"+name).val('');
    setTimeout(function () {
      //$("#"+name+"_help").fadeOut(1000);
      $("#"+name+"_help").html('');
    }, 4000)
}




  var Fn = {
    // Valida el rut con su cadena completa "XXXXXXXX-X"
    validaRut : function (rutCompleto) {
      if (!/^[0-9]+[-|‐]{1}[0-9kK]{1}$/.test( rutCompleto ))
        return false;
      var tmp   = rutCompleto.split('-');
      var digv  = tmp[1]; 
      var rut   = tmp[0];
      if ( digv == 'K' ) digv = 'k' ;
      return (Fn.dv(rut) == digv );
    },
    dv : function(T){
      var M=0,S=1;
      for(;T;T=Math.floor(T/10))
        S=(S+T%10*(9-M++%6))%11;
      return S?S-1:'k';
    }
  }


  $(document).ready(function(){

    $('#regi_nombre').attr('maxlength', 30);
    $('#regi_apellido').attr('maxlength', 30);
    $('#regi_telefono').attr('maxlength', 9);
    $('#regi_email').attr('maxlength', 100);
    $('#regi_rut').attr('maxlength', 10);
    $('#regi_nacimiento').attr('maxlength', 10);

    
    
    
    if($('#regi_telefono').length){
      $('#regi_telefono').mask('000000000');
    }

    $('.isUpper').keyup(function(){
      $(this).val($(this).val().toUpperCase());
    });
  
    $('.isLower').keyup(function(){
      $(this).val($(this).val().toLowerCase());
    });
    
    if($('#modalUps').length > 0){
      const modalUps = document.getElementById('modalUps')
      modalUps.addEventListener('hidden.bs.modal', function (event) {
        window.location.href = "index.php";
      })
    }
    

    if($('#modalFelicidades').length > 0){
      const modalFelicidades = document.getElementById('modalFelicidades')
      modalFelicidades.addEventListener('hidden.bs.modal', function (event) {
        //location.reload();
        window.location.href = "index.php";
      })
    }
    
    
    
  });

  function validaForm(){
 
    let regi_nombre     =  $("#regi_nombre").val();
    let regi_apellido   =  $("#regi_apellido").val();
    let comuna_id       =  $("#comuna_id option:selected" ).val();
    let regi_telefono   =  $("#regi_telefono").val();
    let regi_email      =  $("#regi_email").val();
    let regi_rut        =  $("#regi_rut").val();
    let regi_nacimiento =  $("#regi_nacimiento").val();
    let regi_bases      =  $("#regi_bases").is(":checked") ? true : false;
    let regi_mayor      =  $("#regi_mayor").is(":checked") ? true : false;
    
    const isMail  = checkEmail(regi_email);
    const isRut   = Fn.validaRut(regi_rut) ? true : false;
    const isFecha  = checkFecha(regi_nacimiento);

    
    if(regi_nombre == ''){
        showError('regi_nombre', 'Ingresa un Nombre')
        return false;
    }
    if(regi_apellido == ''){
        showError('regi_apellido', 'Ingresa tu Apellido')
        return false;
    }
    
    if(comuna_id == ''){
        showError('comuna_id', 'Selecciona una Comuna')
        return false;
    }
    if(regi_telefono == ''){
        showError('regi_telefono', 'Ingresa un teléfono válido')
        return false;
    }
    if(regi_telefono.length != 9){
      showError('regi_telefono', 'Ingresa un teléfono con 9 dígitos')
      return false;
    }
    if(regi_email == ''){
        showError('regi_email', 'Ingresa un email válido')
        return false;
    }
    if(!isMail){
      showError('regi_email', 'Ingresa un Correo válido')
      return false;
    }
    if(regi_rut == ''){
      showError('regi_rut', 'Ingresar un Rut')
      return false;
    }
    if(!isRut){
      showError('regi_rut', 'Ingresa un Rut válido')
      return false;
    }
    
    if(regi_nacimiento == ''){
      showError('regi_nacimiento', 'Ingresa una fecha de nacimiento')
      return false;
    }
    if(!isFecha){
      showError('regi_nacimiento', 'Ingresa una Fecha válido')
      return false;
    }
    const fileInput = document.getElementById('regi_etiqueta');
    if (!fileInput || fileInput.files.length === 0) {
      showError('regi_etiqueta', 'Debes adjuntar la foto de la etiqueta.');
      return false;
    }
    const file = fileInput.files[0];
    const tipos = ['image/jpeg', 'image/png'];
    const maxMB = 5;

    if (!tipos.includes(file.type)) {
      showError('regi_etiqueta', 'Formato no permitido (solo JPG o PNG).');
      return false;
    }
    if (file.size > maxMB * 1024 * 1024) {
      showError('regi_etiqueta', `La imagen supera ${maxMB} MB.`);
      return false;
    }
    if (!regi_bases) {
        showError("regi_bases", "Seleccione las Bases");
        return false;
    }
    if (!regi_mayor) {
      showError("regi_mayor", "Seleccione si cumples con la edad");
      return false;
    }
    
    
    return true;
  }


  $(document).ready(function (e) {
    $("#formRegistro").on('submit',(function(e) {
      e.preventDefault();
      
      if(validaForm()){
        $('.btnEnviar[type="submit"]').prop('disabled', true);

        const formRegistro = document.getElementById("formRegistro");

        grecaptcha.ready(function() {
            grecaptcha.execute('6LcMkaQrAAAAAP4UHxL0qKmeeriS2xPM4f2jZ0lh', {action:'validate_captcha'})
                      .then(function(token) {
                document.getElementById('recaptchaResponse').value = token;
                

                $.ajax({
                  url: "remote.php",
                  type: "POST",
                  data:  new FormData(formRegistro),
                  
                  beforeSend: function(){$(".loading").show();},
                    contentType: false,
                    processData:false,
                  success: function(response){

                    if(response.status == 'success'){
                      showModal(response.modal);
                    }
                    if(response.status == 'fail'){
                      showError(response.data.field, response.data.message);
                    }
                    if(response.status == 'error'){
                      showModal(response.modal);
                    }
                    $("#targetLayer").html(response);
                    $("#targetLayer").css('opacity','1');
                    setInterval(function() {
                      $(".loading").hide(); 
                    },500);
                    $('.btnEnviar[type="submit"]').prop('disabled', false);
                  },
                  error: function(){
                    console.log('ERROR EN EL SERVIDOR');
                    showModal('modalUps');
                  } 	        
                });
                
            
            });
        });

      }
    }));
  });


// Marcar selección y setear hidden premio_id
$(document).on('click', '.ticket', function () {
  const id = $(this).data('id');
  $('#premio_id').val(id);

  // feedback visual (opcional)
  $('.ticket').removeClass('selected');
  $(this).addClass('selected');
});

// Enviar por AJAX
$(document).on('click', '.btnEnviarSeleccion', function () {
  const $btn = $(this);
  const $form = $('#formSeleccion');
  const url = 'remote.php'; // actual

  // Validaciones mínimas
  const premioId = $('#premio_id').val();
  const token = $('#token').val();
  if (!premioId) {
    showError("seleccion", "Debes seleccionar un premio antes de enviar.");
    //return false;
    //alert('Debes seleccionar un premio antes de enviar.');
    return;
  }
  if (!token) {
    alert('Falta el token. Vuelve a cargar la página o contacta soporte.');
    return;
  }

  // Evitar doble click
  $btn.addClass('disabled').css('pointer-events', 'none');

  $.ajax({
    url: url,
    type: 'POST',
    data: $form.serialize(), // opcional: new FormData para archivos
    //dataType: 'json',        // asumiendo que el backend responde JSON
    success: function (response) {
      if(response.status == 'success'){
        $(".isGame").fadeOut(1000);
        $(".isGame").html('');

        showModal(response.modal);
      }
      if(response.status == 'error'){
        showModal(response.modal);
      }
    },
    error: function (xhr) {
      const msg = xhr.responseJSON?.message || 'Error de conexión al enviar la selección.';
      alert(msg);
    },
    complete: function () {
      $btn.removeClass('disabled').css('pointer-events', '');
    }
  });
});

  
$(document).on('click', '.btnUpload', function() {
  $('#regi_etiqueta').click();
});

function displaySelectedImage(event, elementId) {
    const selectedImage = document.getElementById(elementId);
    const fileInput = event.target;

    if (fileInput.files && fileInput.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            selectedImage.src = e.target.result;
        };

        reader.readAsDataURL(fileInput.files[0]);
    }
}

function showPreview(objFileInput) {
  const file = objFileInput.files[0];
  const fileType = file['type'];
  const validImageTypes = ['image/jpeg', 'image/png'];

  if (objFileInput.files[0]) {
    var fileReader = new FileReader();
    fileReader.onload = function (e) {
      $("#targetLayer").html('<img src="'+e.target.result+'" class="upload-preview img-fluid" />');
      $("#targetLayer").css('opacity','0.7');
      $(".icon-choose-image").css('opacity','0.5');
    }
    fileReader.readAsDataURL(objFileInput.files[0]);
  }
}



    window.addEventListener('load', function () {
      const modalEl = document.getElementById('videoModal');
      const iframe = document.getElementById('ytPlayer');
      const baseSrc = iframe.getAttribute('data-src');

      // Instanciar modal
      const modal = new bootstrap.Modal(modalEl, {
        backdrop: 'static',  // evita cerrar haciendo clic fuera (opcional)
        keyboard: true       // permite cerrar con tecla ESC
      });

      // Abrir modal al cargar
      modal.show();

      modalEl.addEventListener('shown.bs.modal', function () {
        // agregar autoplay=1 al abrir
        const url = baseSrc + (baseSrc.includes('?') ? '&' : '?') + 'autoplay=1';
        iframe.setAttribute('src', url);
      });

      modalEl.addEventListener('hide.bs.modal', function () {
        // limpiar src para detener el video
        iframe.setAttribute('src', '');
      });

      modalEl.addEventListener('hidden.bs.modal', function () {
        // restablecer src base sin autoplay
        iframe.setAttribute('src', baseSrc);
      });
    });
