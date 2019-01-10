<?php
if($lang == 'pl'){$fb_lang='pl_PL';}
if($fb_lang == ''){$fb_lang='en_EN';}
?>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '139692516826149',
      xfbml      : true,
      version    : 'v2.11'
    });
    FB.AppEvents.logPageView();
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/<?php echo $fb_lang; ?>/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>

<div class="fb-customerchat" page_id="1871142729568326" ref="https://www.lvadshirt.com/" minimized="true"></div>

<script type="text/javascript">
var script = document.createElement("script");
script.async = true; script.type = "text/javascript";
var target = 'https://www.clickcease.com/monitor/stat.js';
script.src = target;
var elem = document.head;
elem.appendChild(script);
</script>
<noscript><img src="https://monitor.clickcease.com/stats/stats.aspx"/></noscript>
