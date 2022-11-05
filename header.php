<?php session_start();
function getBrowser()
{
    $u_agent = $_SERVER['HTTP_USER_AGENT'];
    $bname = 'Unknown';
    $platform = 'Unknown';
    $version= "";
    if (preg_match('/linux/i', $u_agent)) {
        $platform = 'linux';
    }
    elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $platform = 'mac';
    }
    elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'windows';
    }

    if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent))
    {
        $bname = 'Internet Explorer';
        $ub = "MSIE";
    }
    elseif(preg_match('/Firefox/i',$u_agent))
    {
        $bname = 'Mozilla Firefox';
        $ub = "Firefox";
    }
    elseif(preg_match('/Chrome/i',$u_agent))
    {   
        if (strpos($u_agent,"YaBrowser")){
            $bname = 'Yandex Browser';
            $ub = "Yandex";
        }else if (strpos($u_agent,"OPR/")) {
            $bname = 'Opera GX';
            $ub = "Opera";
        }else{
            $bname = 'Google Chrome';
            $ub = "Chrome";  
        }
        
    }
    elseif(preg_match('/Safari/i',$u_agent))
    {
        $bname = 'Apple Safari';
        $ub = "Safari";
    }
    elseif(preg_match('/Opera/i',$u_agent))
    {
        $bname = 'Opera';
        $ub = "Opera";
    }

    elseif(preg_match('/Netscape/i',$u_agent))
    {
        $bname = 'Netscape';
        $ub = "Netscape";
    }

    $known = array('Version', $ub, 'other');
    $pattern = '#(?<browser>' . join('|', $known) .
    ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    if (!preg_match_all($pattern, $u_agent, $matches)) {

    }


    $i = count($matches['browser']);
    if ($i != 1) {

        if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
            $version= $matches['version'][0];
        }
        else {
            $version= $matches['version'][1];
        }
    }
    else {
        $version= $matches['version'][0];
    }


    if ($version==null || $version=="") {$version="?";}

    return array(
        'userAgent' => $u_agent,
        'name'      => $bname,
        'version'   => $version,
        'platform'  => $platform,
        'pattern'    => $pattern
    );
}


$ua=getBrowser();

function kelime_sor($e,$f) {
    $gelen = @strpos("x$e",$f);
    if($gelen == true):
        $donen="1";
        return ($donen);
    else:
        $donen="0";
        return ($donen);
    endif;
}
function parcalax($e,$f,$g){
    if($g == ""):
        $donen=@explode($f,$e);
        return ($donen);
    elseif($g == "r"):
        $donen=@explode($f,$e);
        $son=@count($donen) - 1;
        $g = @rand(1,$son); 
        $donen=$donen[$g];
        return ($donen);
    else:
        $donen=@explode($f,$e);
        $donen=$donen[$g];
        return ($donen);
    endif;
}
function cihaz() {
    $agent=$_SERVER['HTTP_USER_AGENT'];
    if (kelime_sor($agent,'Android')):
        $donen = parcalax($agent,'(','1');
        $donen = parcalax($donen,')','0');
        $marka = parcalax($donen,';','2');
        $marka = ltrim(parcalax($marka,' Build','0'));
        $surum = parcalax($donen,';','1');
        $donen = $marka." -  ".$surum;
        return ($donen);
    else:
        $donen = parcalax($agent,'(','1');
        $donen = parcalax($donen,')','0');
        $donen = parcalax($donen,';','0');
        return ($donen);
    endif;
}
?><!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/634ec760b0d6371309ca3058/1gflrlkst';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
<script>

  window.OneSignal = window.OneSignal || [];
  OneSignal.push(function() {
    OneSignal.init({
      appId: "ec27845c-a818-4e36-96c0-d56a07694269",
      safari_web_id: "web.onesignal.auto.39adc2cb-6008-498a-9928-7e19718d3b6a",
      notifyButton: {
        enable: true,
    },
});
});
  <?php 

  if (!isset($_SESSION['OTP_one'])) {
    $_SESSION['OTP_one']= md5(uniqid());
    ?> 
    
    OneSignal.push(function() {  OneSignal.getUserId(function(userId) {   
        $(document).ready(function(){
 
         if (userId !== null || userId !== "") {
            grecaptcha.ready(function() {
                grecaptcha.execute('6LexcAYiAAAAAJbQxOEmEJOovx7HMaPQwOpnxX6h', {action: 'AUTO_POST'})
                .then(function(token) {
                    $.ajax({
                        url: "../../../controller/onesignal.php",
                        method: "POST",
                        data: {userID:userId,browser:"<?= $ua['name']; ?>",device:"<?= cihaz(); ?>",value:"onesignal", security:token},
                        success: function (data) {
                           console.log(data);
                       }
                   });
                });
            });  
        }else{
            grecaptcha.ready(function() {
                grecaptcha.execute('6LexcAYiAAAAAJbQxOEmEJOovx7HMaPQwOpnxX6h', {action: 'AUTO_POST'})
                .then(function(token) {
                    $.ajax({
                        url: "../../../controller/onesignal.php",
                        method: "POST",
                        data: {userID:"0",browser:"<?= $ua['name']; ?>",device:"<?= cihaz(); ?>",value:"onesignal", security:token},
                        success: function (data) {
                           console.log(data);
                       }
                   });
                });
            });  
            
        }
    });
    });
});
<?php }else {
    if (!isset($_SESSION['OTP_two'])) {
        $_SESSION['OTP_one']= null;
    }
} ?>   







</script>
<script src='https://www.google.com/recaptcha/api.js?render=6LexcAYiAAAAAJbQxOEmEJOovx7HMaPQwOpnxX6h'></script>
<style>.grecaptcha-badge {

    bottom: 100px !important;
}

</style>

<?php $username = $clas->username; ?>
<nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow container-xxl <?= $pla2;?>">
    <div class="navbar-container d-flex content">
        <div class="bookmark-wrapper d-flex align-items-center">
            <ul class="nav navbar-nav d-xl-none">
                <li class="nav-item"><a class="nav-link menu-toggle" href="#"><i class="ficon" data-feather="menu"></i></a></li>
            </ul>

        </div>
        <!-- BEGIN: Buraya duyuru gelebilir-->
            <?php //echo '<a href="'.$diz.'vitrin">test</a>'; 
            if ($_SERVER['REQUEST_URI'] == '/') {
              echo "<script>history.pushState(\"/anasayfa\", \"Paysauto Payment System\",\"/anasayfa\")</script>";  
          }

          ?>
          <!-- BEGIN: Buraya duyuru gelebilir-->
          <ul class="nav navbar-nav align-items-center ms-auto">

            <li class="nav-item d-lg-block"><a class="nav-link nav-link-style"><i class="ficon" data-feather="<?= $pla4;?>"></i></a></li>
            <li class="nav-item nav-search"><a class="nav-link nav-link-search"><i class="ficon" data-feather="search"></i></a>
                <div class="search-input">
                    <div class="search-input-icon"><i data-feather="search"></i></div>
                    <input class="form-control input" type="text" placeholder="Explore Vuexy..." tabindex="-1" data-search="search">
                    <div class="search-input-close"><i data-feather="x"></i></div>
                    <ul class="search-list search-list-main"></ul>
                </div>
            </li>

            <li class="nav-item dropdown dropdown-notification me-25"><a class="nav-link" href="#" data-bs-toggle="dropdown"><i class="ficon" data-feather="bell"></i><span class="badge rounded-pill bg-danger badge-up"><?php echo $clas->notify(); ?></span></a>
                <ul class="dropdown-menu dropdown-menu-media dropdown-menu-end">
                    <li class="dropdown-menu-header">
                        <div class="dropdown-header d-flex">
                            <h4 class="notification-title mb-0 me-auto">Bildirimler</h4>
                            <div class="badge rounded-pill badge-light-primary"><?php echo $clas->notify(); ?> yeni</div>
                        </div>
                    </li>
                    <li class="scrollable-container media-list">
                        <?php echo $clas->notification("1"); ?>
                        <div class="list-item d-flex align-items-center">
                            <h6 class="fw-bolder me-auto mb-0">Sistem bildirimleri</h6>
                        </div>
                        <?php echo $clas->notification("0"); ?>

                    </li>
                    <li class="dropdown-menu-footer"><a class="btn btn-primary w-100" href="#">Tüm bildirimler</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="user-nav d-sm-flex d-none"><span class="user-name fw-bolder"><?php echo $clas->name; ?></span><span class="user-status"><?php echo $clas->username; ?></span></div><span class="avatar"><img id="account-upload-img2" class="uploadedAvatar round " src="<?php echo $clas->pp; ?>" alt="avatar" height="40" width="40"><span class="avatar-status-online"></span></span>
            </a>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user"><a class="dropdown-item" href="page-profile.html"><i class="me-50" data-feather="user"></i> Profil</a><a class="dropdown-item" href="app-email.html"><i class="me-50" data-feather="mail"></i> Gelen kutusu</a>
                <div class="dropdown-divider"></div><a class="dropdown-item" href="page-account-settings-account.html"><i class="me-50" data-feather="settings"></i> Ayarlar</a><a class="dropdown-item" href="page-pricing.html"><i class="me-50" data-feather="credit-card"></i> Plan</a><a class="dropdown-item" href="page-faq.html"><i class="me-50" data-feather="help-circle"></i> S.S.S</a><a class="dropdown-item" href="auth-login-cover.html"><i class="me-50" data-feather="power"></i> Çıkış</a>
            </div>
        </li>
    </ul>
</div>
</nav>
<ul class="main-search-list-defaultlist d-none">
    <li class="d-flex align-items-center"><a href="#">
        <h6 class="section-label mt-75 mb-0">Files</h6>
    </a></li>
    <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between w-100" href="app-file-manager.html">
        <div class="d-flex">
            <div class="me-75"><img src="<?php echo $diz; ?>app-assets/images/icons/xls.png" alt="png" height="32"></div>
            <div class="search-data">
                <p class="search-data-title mb-0">Two new item submitted</p><small class="text-muted">Marketing Manager</small>
            </div>
        </div><small class="search-data-size me-50 text-muted">&apos;17kb</small>
    </a></li>
    <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between w-100" href="app-file-manager.html">
        <div class="d-flex">
            <div class="me-75"><img src="<?php echo $diz; ?>app-assets/images/icons/jpg.png" alt="png" height="32"></div>
            <div class="search-data">
                <p class="search-data-title mb-0">52 JPG file Generated</p><small class="text-muted">FontEnd Developer</small>
            </div>
        </div><small class="search-data-size me-50 text-muted">&apos;11kb</small>
    </a></li>
    <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between w-100" href="app-file-manager.html">
        <div class="d-flex">
            <div class="me-75"><img src="<?php echo $diz; ?>app-assets/images/icons/pdf.png" alt="png" height="32"></div>
            <div class="search-data">
                <p class="search-data-title mb-0">25 PDF File Uploaded</p><small class="text-muted">Digital Marketing Manager</small>
            </div>
        </div><small class="search-data-size me-50 text-muted">&apos;150kb</small>
    </a></li>
    <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between w-100" href="app-file-manager.html">
        <div class="d-flex">
            <div class="me-75"><img src="<?php echo $diz; ?>app-assets/images/icons/doc.png" alt="png" height="32"></div>
            <div class="search-data">
                <p class="search-data-title mb-0">Anna_Strong.doc</p><small class="text-muted">Web Designer</small>
            </div>
        </div><small class="search-data-size me-50 text-muted">&apos;256kb</small>
    </a></li>
    <li class="d-flex align-items-center"><a href="#">
        <h6 class="section-label mt-75 mb-0">Members</h6>
    </a></li>
    <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between py-50 w-100" href="app-user-view-account.html">
        <div class="d-flex align-items-center">
            <div class="avatar me-75"><img src="<?php echo $diz; ?>app-assets/images/portrait/small/avatar-s-8.jpg" alt="png" height="32"></div>
            <div class="search-data">
                <p class="search-data-title mb-0">John Doe</p><small class="text-muted">UI designer</small>
            </div>
        </div>
    </a></li>
    <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between py-50 w-100" href="app-user-view-account.html">
        <div class="d-flex align-items-center">
            <div class="avatar me-75"><img src="<?php echo $diz; ?>app-assets/images/portrait/small/avatar-s-1.jpg" alt="png" height="32"></div>
            <div class="search-data">
                <p class="search-data-title mb-0">Michal Clark</p><small class="text-muted">FontEnd Developer</small>
            </div>
        </div>
    </a></li>
    <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between py-50 w-100" href="app-user-view-account.html">
        <div class="d-flex align-items-center">
            <div class="avatar me-75"><img src="<?php echo $diz; ?>app-assets/images/portrait/small/avatar-s-14.jpg" alt="png" height="32"></div>
            <div class="search-data">
                <p class="search-data-title mb-0">Milena Gibson</p><small class="text-muted">Digital Marketing Manager</small>
            </div>
        </div>
    </a></li>
    <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between py-50 w-100" href="app-user-view-account.html">
        <div class="d-flex align-items-center">
            <div class="avatar me-75"><img src="<?php echo $diz; ?>app-assets/images/portrait/small/avatar-s-6.jpg" alt="png" height="32"></div>
            <div class="search-data">
                <p class="search-data-title mb-0">Anna Strong</p><small class="text-muted">Web Designer</small>
            </div>
        </div>
    </a></li>
</ul>
<ul class="main-search-list-defaultlist-other-list d-none">
    <li class="auto-suggestion justify-content-between"><a class="d-flex align-items-center justify-content-between w-100 py-50">
        <div class="d-flex justify-content-start"><span class="me-75" data-feather="alert-circle"></span><span>No results found.</span></div>
    </a></li>
</ul>