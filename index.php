<html>
    <head>

        <!-- Metas dados do Sites -->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">


    </head>
    <body>
      <div class="flat-form">
        <ul class="tabs">
          <li>
            <a href="#login" class="active">Login</a>
          </li>
          <li>
            <a href="#register">Register</a>
          </li>
          <li>
            <a href="#reset">Reset Password</a>
          </li>
        </ul>
        <div id="login" class="form-action show">
          <h1>Login</h1>
          <p>Lorem ipsum by <a href="https://codepen.io/davideast">David East</a> dolor sit amet, consectetur adipisicing elit. Veritatis, magni culpa facilis.</p>
          <form id="Login" name="Login" method="post" action="login.php">
            <ul>
              <li>
                <input type="text" placeholder="Nikename" id="nickname" name="nikenamePost" size="30" onblur="CheckBlank(this)" />
              </li>
              <li>
                <input type="password" placeholder="Password" id="password" name="passwordPost" type="password" />
              </li>
              <li>
                <input id="login" name="login" value="Login" type="submit" class="button" />
              </li>
            </ul>
          </form>
        </div>
        <!--/#login.form-action-->
        <div id="register" class="form-action hide">
          <h1>Register</h1>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod, culpa repudiandae.</p>
          <form id="Cadastro" name="Cadastro" method="post" action="register.php">
            <ul>
              <li>
                <input type="text" name="namePost" placeholder="Nome" />
              </li>
              <li>
                <input type="text" name="nicknamePost" placeholder="Nickname" />
              </li>
              <li>
                <input type="email" name="emailPost" placeholder="E-mail" />
              </li>
              <li>
                <input type="password" name="passwordPost" placeholder="Senha" />
              </li>
              <li>
                <input type="password" name="repasswordPost" placeholder="Confirmação Senha" />
              </li>
              <li>
                <input type="checkbox" name="sendMailExeptionPost" value="sendMailExeption">Deseja Receber email de atualizações, promoções e outros.
              </li>
              <li>
                <input type="submit" value="Sign Up" class="button" />
              </li>
            </ul>
          </form>
        </div>
        <!--/#register.form-action-->
        <div id="reset" class="form-action hide">
          <h1>Reset Password</h1>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem, provident in accusamus possimus.</p>
          <form>
            <ul>
              <li>
                <input type="text" placeholder="Email" />
              </li>
              <li>
                <input type="submit" value="Send" class="button" />
              </li>
            </ul>
          </form>
        </div>
        <!--/#register.form-action-->
      </div>
    </body>
</html>
