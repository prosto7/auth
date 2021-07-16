

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Sign In</h5>
          <span aria-hidden="true">&times;</span>
      </div>
      <div class="modal-body">
      <div class='mb-3 table-content'>
<p class="d-none msg_error border_msg_error p-2">Lorem ipsum dolor sit.</p>
    <form id='login-form' >
        <label for='exampleInputEmail1' class='form-label'>Login</label><br>
        <input type='text' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' name='login' required><br>
        <label for='exampleInputPassword1' class='form-label'>Password</label>
        <input type='password' placeholder='Password' class='form-control' name='password' required><br>
        <p class="msg_reg">If you don't have an account yet. <a href="/registration"> Sign up now</a></p>
        <a class="msg_pass_recovery" href="/registration"> Forgot Username or Password?</a>
     
      </div>
   
      <div class="modal-footer">  
      
      <button type="submit" id ="login_btn" class="btn btn-primary " >Sign in</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal" >Close</button>
    </form>

      </div>
    </div>
  </div>
</div>
