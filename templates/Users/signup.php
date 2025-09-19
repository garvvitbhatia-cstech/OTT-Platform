<?php

if(isset($pageData->seo_title)){

    #set page meta content

    $this->assign('title', $pageData->seo_title);

    $this->assign('meta_keywords', $pageData->seo_keyword);

    $this->assign('meta_description', $pageData->seo_description);

    $this->assign('meta_robot', $pageData->robot_tags);

}

?>
<ott-app _nghost-ovl-c55="" ng-version="11.2.14">

  <div _ngcontent-ovl-c55="" class="ott-theme page_auth/signin ott-theme-no-header-footer page-scroll mobile-no-sub-menu">

    <div _ngcontent-ovl-c55="" id="content_body" class="content_body"><!---->

      <div _ngcontent-ovl-c55="" class="ott-main-body no-header">

        <router-outlet _ngcontent-ovl-c55=""></router-outlet>

        <ott-signin _nghost-ovl-c59="" class="ng-star-inserted">

          <div _ngcontent-ovl-c59="" id="signin_cont" class="signin_cont_new">

          <a href="<?php echo $this->Url->build('/'); ?>"><img _ngcontent-ovl-c59="" class="logo" tabindex="0" src="<?php echo $this->Url->build('/img/logo.png'); ?>"></a>

            <div _ngcontent-ovl-c59="" class="signin_inner ng-star-inserted">

              <h2 _ngcontent-ovl-c59="">Create your Account </h2>
              
              <?php echo($this->Flash->render()); ?>

              
              <?= $this->Form->create(NULL,array('id' => 'regForm', 'action' => SITEURL.'user-register', 'csrfToken' => $this->request->getAttribute('csrfToken')));?>

                <div _ngcontent-ovl-c59="" class="form_rows">

                <label _ngcontent-ovl-c59="" class="name">
                  <span _ngcontent-ovl-c59="" class="title">Full Name</span>
                  <input _ngcontent-ovl-c59="" id="name" name="name" class="form-control ng-untouched ng-pristine ng-invalid" onkeyup="$('#nameError').html('');" type="text">
                  <span class="form_error_msg" id="nameError"></span>
                  </label>
                  
                  <label _ngcontent-ovl-c59="" class="email">
                  <span _ngcontent-ovl-c59="" class="title">Email ID</span>
                  <input _ngcontent-ovl-c59="" id="email_address" name="email_address" class="form-control ng-untouched ng-pristine ng-invalid" onkeyup="$('#email_addressError').html('');" type="text">
                  <span class="form_error_msg" id="email_addressError"></span>
                  </label>

                  <label _ngcontent-ovl-c59="" class="mobile_number">
                  <span _ngcontent-ovl-c59="" class="title">Mobile Number</span>
                  <country-flag _ngcontent-ovl-c59="" _nghost-ovl-c46="" class="ng-star-inserted">

                    <div _ngcontent-ovl-c46="" data-input-name="country" data-scrollable="true" data-scrollable-height="250px" data-selected-country="US" id="options" class="flagstrap open ott-dropdown-border ng-star-inserted">
                    <span _ngcontent-ovl-c46="" class="country-logo">
                    <img _ngcontent-ovl-c46="" src="<?php echo $this->Url->build('/img/india.png'); ?>">
                    <span _ngcontent-ovl-c46="" class="country_name"> + 91</span>
                    <span _ngcontent-ovl-c46="" class="caret">
                    <i _ngcontent-ovl-c46="" aria-hidden="true" class="fa fa-caret-down caret"></i>
                    </span>
                    </span>
                    </div>

                   </country-flag>
                  <input _ngcontent-ovl-c59="" maxlength="10" onkeyup="$('#phoneError').html('');" id="phone" name="phone" type="tel" class="form-control ng-untouched ng-pristine ng-invalid" style="width: 65%;">
                  <span class="form_error_msg" id="phoneError"></span>
                  </label>

                  <label _ngcontent-ovl-c59="" class="password">
                  <span _ngcontent-ovl-c59="" class="title">Password</span>
                  <input _ngcontent-ovl-c59="" id="password" name="password" oncopy="return false" onpaste="return false" onkeyup="$('#passwordError').html('');" class="form-control ng-untouched ng-pristine ng-invalid" type="password">
                  <span class="form_error_msg" id="passwordError"></span>
                  </label>

                  <label _ngcontent-ovl-c59="" class="password">
                  <span _ngcontent-ovl-c59="" class="title">Confirm Password</span>
                  <input _ngcontent-ovl-c59="" id="confirm_pass" name="confirm_pass" oncopy="return false" onpaste="return false" onkeyup="$('#confirm_passError').html('');" class="form-control ng-untouched ng-pristine ng-invalid" type="password">
                  <span class="form_error_msg" id="confirm_passError"></span>
                  </label>
                  
                  <div class="text-left"><input name="is_film_maker" value="1" type="checkbox" /> <label>Film Maker</label></div>

                </div>

                <button _ngcontent-ovl-c59="" id="signUpBtn" class="btn btn-grey">Sign Up</button>

             <?= $this->Form->end(); ?>

              <div _ngcontent-ovl-c59="" class="wrap-or">

                <div _ngcontent-ovl-c59="" class="links-or"><span _ngcontent-ovl-c59=""></span></div>

              </div>

              <!--<button _ngcontent-ovl-c59="" class="signinVariable">Sign In with Email ID</button>-->

              <ott-social-login _ngcontent-ovl-c59="" _nghost-ovl-c56="">

                <div _ngcontent-ovl-c56="" class="row remove-margin social-login ng-star-inserted">

                  <button _ngcontent-ovl-c56="" onclick="fbLogin();" class="facebook-login">
                  <img _ngcontent-ovl-c56="" src="<?php echo $this->Url->build('/img/facebook_logo.png'); ?>">
                  <span _ngcontent-ovl-c56="">Continue with Facebook</span></button>
				
               
                
                  <?php /*?><a href="https://accounts.google.com/o/oauth2/auth/oauthchooseaccount?response_type=code&redirect_uri=https%3A%2F%2Fwww.cinemasthan.com%2Fwebroot%2Fgoogle%2Findex.php&client_id=603058979552-gtua2r14jvqc99dcf3k0r993phqvuc7r.apps.googleusercontent.com&scope=email%20profile&access_type=online&approval_prompt=auto&flowName=GeneralOAuthFlow" _ngcontent-ovl-c56="" class="google-login">
                  <span _ngcontent-ovl-c56="" class="logo-container">
                  <img _ngcontent-ovl-c56="" src="<?php echo $this->Url->build('/img/google_icon.png'); ?>" class="google"></span>
                  <span _ngcontent-ovl-c56="" class="logo-content">Sign up with Google</span>
                  </a><?php */?>
                  
                  <div class="g-signin2" data-onsuccess="onSignIn"></div>

                </div>

               </ott-social-login>


              <p _ngcontent-ovl-c59="" class="msg">By Signing Up, you agree to Cinemasthan <a _ngcontent-ovl-c59="" target="_blank" href="<?php echo $this->Url->build('/terms-and-conditions/'); ?>"> Terms and Conditions</a></p>

              <span _ngcontent-ovl-c59="" class="have_an_account">Have an account? <a _ngcontent-ovl-c59="" class="signin" href="<?php echo $this->Url->build('/sign-in/'); ?>">Sign In</a></span></div>

            </div>
          </ott-signin>
        </div>
      </div>
  </div>
</ott-app>
<script>
$(document).ready(function(e) {
    $('#signUpBtn').click(function(e) {
		var nitam = 1;
		var name = $('#name').val();
		var email = $('#email_address').val();
		var phone = $('#phone').val();
		var password = $('#password').val();
		if($.trim(name) == ''){
			$('#nameError').html('Please enter fullname');
			$('#name').focus(); return false;
		}
        if($.trim(email) == ''){
			$('#email_addressError').html('Please enter email address');
			$('#email_address').focus(); return false;
		}else{
			var filter = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			if(!filter.test(email)){
				$('#email_addressError').html('Please enter valid email address');
				$('#email_address').focus(); return false;     
			}  
		}
		if($.trim(phone) == ''){
			$('#phoneError').html('Please enter phone number');
			$('#phone').focus(); return false;
		}
		if($.trim(password) == ''){
			$('#passwordError').html('Please enter password');
			$('#password').focus(); return false;
		}
		if($.trim($('#confirm_pass').val()) == ''){
			$('#confirm_passError').html('Please enter confirm password');
			$('#confirm_pass').focus(); return false;
		}
		if($.trim($('#confirm_pass').val()) != $.trim(password)){
			$('#confirm_passError').html('Confirm password do not match');
			$('#confirm_pass').focus(); return false;
		}
		if(nitam == 1){
			$('#signUpBtn').html('Processing...');
			$('#regForm').submit();
		}
    });
});
</script>
<script>
// This is called with the results from from FB.getLoginStatus().
function statusChangeCallback(response) {
console.log('statusChangeCallback');
console.log(response);
// The response object is returned with a status field that lets the
// app know the current login status of the person.
// Full docs on the response object can be found in the documentation
// for FB.getLoginStatus().
if (response.status === 'connected') {
  // Logged into your app and Facebook.
  testAPI();
} else if (response.status === 'not_authorized') {
  // The person is logged into Facebook, but not your app.
  //document.getElementById('status').innerHTML = 'Please log ' +'into this app.';
} else {
  // The person is not logged into Facebook, so we're not sure if
  // they are logged into this app or not.
  //document.getElementById('status').innerHTML = 'Please log ' +'into Facebook.';
}
}
// This function is called when someone finishes with the Login
// Button.  See the onlogin handler attached to it in the sample
// code below.
function checkLoginState() {
FB.getLoginStatus(function(response) {
  statusChangeCallback(response);
});
}
 window.fbAsyncInit = function() {
  FB.init({
    appId      : '349874880094622',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.8' // use version 2.2
  });
// Now that we've initialized the JavaScript SDK, we call 
// FB.getLoginStatus().  This function gets the state of the
// person visiting this page and can return one of three states to
// the callback you provide.  They can be:
//
// 1. Logged into your app ('connected')
// 2. Logged into Facebook, but not your app ('not_authorized')
// 3. Not logged into Facebook and can't tell if they are logged into
//    your app or not.
//
// These three cases are handled in the callback function.
FB.getLoginStatus(function(response) {
statusChangeCallback(response);
});
};
// Load the SDK asynchronously
(function(d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) return;
js = d.createElement(s); js.id = id;
js.src = "//connect.facebook.net/en_US/sdk.js";
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
// Here we run a very simple test of the Graph API after login is
// successful.  See statusChangeCallback() for when this call is made.

function fbLogin(){
	
/*if($('#terms').prop("checked") == false){
	$('#loginErrors').html('Please check terms and conditions');
	$('#login_errors').modal('show');
	return false;
}*/


 FB.login(function(response) {
	 
   if (response.authResponse) {
	 
	 FB.api('/me?fields=name,email,id', function(response) {
		if(response.email != ""){
			checkEmailRegister(response.name, response.email, response.id);
		}else{
			$('#tempFBBtn').html('Login with Facebook');
			$('#tempFBBtn').hide();
			$('#orgFBBtn').show();
			
			$('#errorPopupHeading').html('Alert');	
			$('#loginErrors').html('Your facebook account is not varified with email address');
			$('#login_errors').modal('show');
			
		}
	 });
	 
   } else {
	   
	   $('#tempFBBtn').html('Login with Facebook');
		$('#tempFBBtn').hide();
		$('#orgFBBtn').show();
	   
	   $('#errorPopupHeading').html('Alert');	
	   $('#loginErrors').html('User cancelled login or did not fully authorize');
	   $('#login_errors').modal('show');
	   
   }
   
 }, { scope: 'email' });

}
function checkEmailRegister(name, email, id){
	$.ajax({
	type: 'POST',
	url: '<?php echo $this->Url->build('/login-with-facebook/'); ?>',
	data: {name:name, email:email, fb_id:id, type:'facebook'},
	success: function(msg){
		if(msg == 'Success'){ 
			window.location.href = '<?php echo $this->Url->build('/'); ?>';
		}
	}
	});
}
</script>
<script src="https://apis.google.com/js/platform.js" async defer></script>
<meta name="google-signin-client_id" content="603058979552-gtua2r14jvqc99dcf3k0r993phqvuc7r.apps.googleusercontent.com">

<script>
function onSignIn(googleUser) {
  var profile = googleUser.getBasicProfile();
  
  checkEmailRegister(profile.getName(), profile.getEmail(), profile.getId());
  
  /*console.log('ID: ' + profile.getId());
  console.log('Name: ' + profile.getName());
  console.log('Image URL: ' + profile.getImageUrl());
  console.log('Email: ' + profile.getEmail());*/
}
</script>

<!--<a href="#" onclick="signOut();">Sign out</a>
<script>
  function signOut() {
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
      console.log('User signed out.');
    });
  }
</script>-->