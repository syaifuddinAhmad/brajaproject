<?php
$this->load->view('administrator/template/header');
$this->load->view('administrator/template/navbar');
?>
    <!-- Page container -->
    <div class="page-container">

        <!-- Page content -->
        <div class="page-content">
            
        <?php
            $this->load->view('administrator/template/sidebar');
        ?>

            <!-- Main content -->
        <div class="content-wrapper">

        <div class="content">
        <div class="panel panel-info">
        <div class="panel-heading">
        <h6 class="panel-title">Edit Data User</h6>   </div>
        <div class="panel panel-flat">
        <div class="panel-body">
        <?php echo form_open(uri_string());?>
         <div class="form-group">
            <label for="varchar">First name <?php echo form_error('first_name') ?></label>
            <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name" <?php echo form_input($first_name);?> 
        </div>
         <div class="form-group">
            <label for="varchar">Last Name <?php echo form_error('last_name') ?></label>
            <input type="text" class="form-control" name="last_name" id="last_name" placeholder="last name" <?php echo form_input($last_name);?> 
        </div>
         <div class="form-group">
            <label for="varchar">Company <?php echo form_error('company') ?></label>
            <input type="text" class="form-control" name="company" id="company" placeholder="company" <?php echo form_input($company);?> 
        </div>
        <div class="form-group">
            <label for="varchar">Alamat <?php echo form_error('alamat') ?></label>
            <input type="text" class="form-control" name="alamat" id="alamat" placeholder="alamat" <?php echo form_input($alamat);?> 
        </div>
        <div class="form-group">
            <label for="varchar">Phone <?php echo form_error('phone') ?></label>
            <input type="text" class="form-control" name="phone" id="phone" placeholder="phone"  <?php echo form_input($phone);?> 
        </div>
        <div class="form-group">
            <label for="varchar">Phone <?php echo form_error('jatuh_tempo') ?></label>
            <input type="text" class="form-control daterange-single" name="jatuh_tempo" id="jatuh_tempo" placeholder="phone"  <?php echo form_input($jatuh_tempo);?> 
        </div>
	    <div class="form-group">
            <label for="varchar">Password <?php echo form_error('password') ?></label>
            <input type="text" class="form-control" name="password" id="password" placeholder="Password"  <?php echo form_input($password);?> 
        </div>
         <div class="form-group">
            <label for="varchar">Password Confirm <?php echo form_error('password_confirm') ?></label>
            <input type="text" class="form-control" name="password_confirm" id="password_confirm" placeholder="password_confirm" <?php echo form_input($password_confirm);?> 
        </div>

        <?php if ($this->ion_auth->is_admin()): ?>

          <h3><?php echo lang('edit_user_groups_heading');?></h3>
          <?php foreach ($groups as $group):?>
              <label class="checkbox">
              <?php
                  $gID=$group['id'];
                  $checked = null;
                  $item = null;
                  foreach($currentGroups as $grp) {
                      if ($gID == $grp->id) {
                          $checked= ' checked="checked"';
                      break;
                      }
                  }
              ?>
              <input type="checkbox" name="groups[]" value="<?php echo $group['id'];?>"  <?php echo $checked;?>>
                 <?php echo htmlspecialchars ($group['name'],ENT_QUOTES,'UTF-8');?>
              </label>
          <?php endforeach?>

        <?php endif ?>
         <div class="text-right">
          <?php echo form_hidden('id', $user->id);?>
        <?php echo form_hidden($csrf); ?>
                <!-- Id gambar kita hidden pada input field dimana berfungsi sebagai identitas yang dibawa untuk update -->
	       <a href="<?php echo site_url('users') ?>" class="btn btn-danger"><i class=" icon- icon-cancel-circle2"></i> Batal</a>
        <button type="submit" value="upload" class="btn btn-success"><i class="icon-floppy-disk"></i> Simpan</button> 
        </div>
        </div>
        </div>
	<?php echo form_close(); ?>
<?php
$this->load->view('administrator/template/footer');
