<!DOCTYPE html PUBLIC "-//IETF//DTD HTML 2.0//EN">
<HTML>
<BODY>
<p> Click on the button to log in </p>

<script src="https://cdn.auth0.com/js/lock-6.2.js"></script>
<script type="text/javascript">
  var lock = new Auth0Lock('KfrSoLVhhmtRnHprgnKePia5v3oLpSXC', '<span style="color:red;">ERROR: acount is not defined</span>');

  function signin() {
    lock.show({
        callbackURL: 'http://jwt.io'
      , responseType: 'token'
      , authParams: {
        scope: 'openid profile'
      }
    });
  }
</script>
<button onclick="signin()">Login</button>
    </BODY>
</HTML>
