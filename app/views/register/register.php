<?php $this->start('head'); ?>
<?php $this->end(); ?>

<?php $this->start('body'); ?>


<div class="col-md-6 offset-md-3">
  <h3 class="text-center">Register form!</h3>
  <hr>
  <form class="form" action="" method="post">
    <div class="bg-danger">
      <?=$this->displayErrors?>
    </div>
    <div class="form-group">
      <label for="firstName">First Name</label>
      <input type="text" name="firstname" class="form-control" id="firstname" value="<?=$this->post['firstname']?>">
    </div>
    <div class="form-group">
      <label for="lastName">Last Name</label>
      <input type="text" name="lastname" class="form-control" id="lastname" value="<?=$this->post['lastname']?>">
    </div>
    <div class="form-group">
      <label for="email">Email</label>
      <input type="text" name="email" class="form-control" id="email" value="<?=$this->post['email']?>">
    </div>
    <div class="form-group">
      <label for="username">Username</label>
      <input type="text" name="username" class="form-control" id="username" value="<?=$this->post['username']?>">
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" name="password" class="form-control" id="password" value="<?=$this->post['password']?>">
    </div>
    <div class="form-group">
      <label for="confirm">Confirm Password</label>
      <input type="password" name="confirm" class="form-control" id="confirm" value="<?=$this->post['confirm']?>">
    </div>
    <div class="pull-right">
      <input type="submit" class="btn btn-primary btn-large" value="Register">
    </div>
  </form>
</div>

<?php $this->end(); ?>
