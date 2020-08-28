<button class="btn btn-outline-warning mr-sm-2" data-toggle="modal" data-target="#auth"><? echo $lang['enter'];?></button>
<div class="modal fade" id="auth">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><? echo $lang['authorization'];?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body" style="text-align: center"> 
               <form method="post" action="<? echo $way['auth'];?>" onsubmit="return test_auth();">
                <input id="a_login" class="form-control" type="text" placeholder="<? echo $lang['email'];?>" name="login">
                <input id="a_password" class="form-control" type="password" placeholder="<? echo $lang['password'];?>" name="password">
                <button id="auth_button" type="submit" name="submit" class="btn btn-primary" style="margin-top: 10px;"><? echo $lang['enter'];?></button>
               </form>
            </div>
        </div>
    </div>
</div>

<button class="btn btn-outline-danger my-2 my-sm-0" data-toggle="modal" data-target="#reg"><? echo $lang['registration'];?></button>
<div class="modal fade" id="reg">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><? echo $lang['registration'];?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<? echo $way['registr'];?>" accept-charset="UTF-8" onsubmit="return test_reg();">
                    <div id="reg_name" class="form-group">
                        <label for="name" class="col-sm-2 control-label"><? echo $lang['name'];?></label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user fa my-3" aria-hidden="true"></i></span>
                                <input type="text" class="form-control" name="name" id="name" placeholder="<? echo $lang['placeholder_name'];?>"/>
                            </div>
                        </div>
                    </div>

                    <div id="reg_email" class="form-group">
                        <label for="email" class="col-sm-2 control-label"><? echo $lang['email'];?></label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope fa my-3" aria-hidden="true"></i></span>
                                <input type="text" class="form-control" name="email" id="email" placeholder="<? echo $lang['placeholder_email'];?>"/>
                            </div>
                        </div>
                    </div>

                    <div id="reg_pass" class="form-group">
                        <label for="password" class="col-sm-2 control-label"><? echo $lang['password'];?></label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock fa-lg my-3" aria-hidden="true"></i></span>
                                <input type="password" class="form-control" name="password" id="password" placeholder="<? echo $lang['placeholder_password'];?>"/>
                            </div>
                        </div>
                    </div>

                    <div id="reg_confirm" class="form-group">
                        <label for="confirm" class="col-sm-2 control-label"><? echo $lang['confirm'];?></label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock fa-lg my-3" aria-hidden="true"></i></span>
                                <input type="password" class="form-control" name="confirm" id="confirm" placeholder="<? echo $lang['placeholder_confirm'];?>"/>
                            </div>
                        </div>
                    </div>

                    <div class="form-group ">
                        <button name="submit" type="submmit" class="btn btn-primary btn-lg btn-block login-button"><? echo $lang['register'];?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>