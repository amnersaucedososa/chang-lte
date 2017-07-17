<?php  
    include "header.php";
    if (!isset($_SESSION['user_id']) && $_SESSION['user_id']==null) {
        header("location: login.php");
    }
?>
<br><br><br><br><br>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading"> Cambiar Contraseña</div>
                    <div class="panel-body">
                        <form role="form" method="post" action="action/changepassword.php">
                              <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
                              </div>
                          <div class="form-group">
                            <label for="exampleInputPassword1">Confirmar Password</label>
                            <input type="password" name="confirm" class="form-control" id="exampleInputPassword1" placeholder="Confirmar Password" required>
                          </div>
                            <button type="submit" class="btn btn-block btn-default">Cambiar contrase&ntilde;a</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>