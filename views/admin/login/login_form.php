<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- login area start -->
    <div class="login-area">
        <div class="container">
            <div class="login-box ptb--100">

              <form method="post" action="/admin/login_post">
                    <div class="login-form-head">
                        <h4>로그인</h4>
                        <p>안녕하세요, 로그인하여 관리 템플릿 관리를 시작하십시오.</p>
                    </div>
                    <div class="login-form-body">
                        <div class="form-gp">
                            <label for="exampleInputEmail1">ID</label>
                            <input type="text" id="text" name="id">
                            <i class="ti-email"></i>
                        </div>
                        <div class="form-gp">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" id="pwd" name="pwd">
                            <i class="ti-lock"></i>
                        </div>

                        <div class="submit-btn-area">
                            <button id="form_submit" type="submit">로그인 <i class="ti-arrow-right"></i></button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
