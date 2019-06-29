<?php

/**
* Changes logo url on login
*/

if(LOGIN_LOGO_URL) {
  // Use your own external URL logo link
  function mad_login_logo_url(){
    return LOGIN_LOGO_URL; // your URL here
  }
  add_filter('login_headerurl', 'mad_login_logo_url');
}

?>