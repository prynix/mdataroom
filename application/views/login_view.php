<?php $this->load->view('segments/head')?>
<style>
    html, body {
        height:100%;
    } 
    body {
        //margin-left: 10%;
        //margin-right: 10%;
    }
    body {
        background: url("<?php echo base_url()."assets/backgroundRescaled.png";?>");
        background-size: 100% auto;
        background-repeat: no-repeat;
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #eee;
    }

.wrapper {
        //margin-left: 10%;
        //margin-right: 10%;
}

.container{
    padding-top: 150px;
    padding-left: 50%;
}

.form-signin {
  max-width: 330px;
  padding: 15px;
  margin: 0 auto;
}
.form-signin .form-signin-heading,
.form-signin .checkbox {
  margin-bottom: 10px;
}
.form-signin .checkbox {
  font-weight: normal;
}
.form-signin .form-control {
  position: relative;
  height: auto;
  -webkit-box-sizing: border-box;
     -moz-box-sizing: border-box;
          box-sizing: border-box;
  padding: 10px;
  font-size: 16px;
}
.form-signin .form-control:focus {
  z-index: 2;
}
.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}
@font-face {
    font-family: "HATTEN";
    src: url(<?php echo base_url()."assets/HATTEN.TTF";?>) format("truetype");
}
.form-signin-heading {
    color: white;
    font-family: "HATTEN" Helvatia;
}
</style>
<body>
    <div class="wrapper">
    <div class="container">
        <?php // Change the css classes to suit your needs    

							$attributes = array('class' => 'form-signin', 'id' => '');
							echo form_open('login/submit', $attributes); ?>
							
							<p>
        <h2 class="form-signin-heading">UserName</h2>
							        <?php echo form_error('name')."<br/>"; ?>
							        <input id="name" type="text" class="form-control" name="name" maxlength="50" value="<?php echo set_value('name'); ?>"  />
							</p>
							<p>
        <h2 class="form-signin-heading">Password</h2>
							        <input id="pass" type="password" class="form-control" name="pass" maxlength="50" value="<?php echo set_value('name'); ?>"  /><h4 class="form-signin-heading"><?php echo form_error('pass')."<br/>"; ?></h4>
							</p>
														
							<p>
        <h4 class="form-signin-heading"><?php if(isset($msg))echo $msg;?></h4>
							        <?//php echo form_submit( 'submit', 'Submit'); ?><button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
							</p>
      <!--<form class="form-signin">
        <h2 class="form-signin-heading">UserName</h2>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
        <h2 class="form-signin-heading">Password</h2>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>-->
    </div>
    </div>
</body>