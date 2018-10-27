<?php $this->start('head'); ?>
<?php $this->end(); ?>

<?php $this->start('body'); ?>

  <div style="margin-top: 50px" class="col-md-6 offset-md-3 well">
    <form class="form" action="<?=PROOT?>register/login" method="post">
      <div class="bg-danger">
        <?=$this->displayErrors?>
      </div>
      <div class="form-group">
          <label for="username">Username</label>
          <input type="text" name="username" class="form-control" id="username" value="">
      </div>
      <div class="form-group">
          <label for="username">Password</label>
          <input type="password" name="password" class="form-control" id="password" value="">
      </div>
      <div class="form-group">
          <label for="username"><input type="checkbox" name="remember_me" id="remember_me" value="on"> Remember me</label>
      </div>
      <div class="form-group">
          <input type="submit" class="btn btn-large btn-primary" value="Login">
      </div>
      <div class="text-right">
          <a href="<?=PROOT?>register/login" class="text-primary">Register</a>
      </div>
    </form>
  </div>

<?php $this->end(); ?>
