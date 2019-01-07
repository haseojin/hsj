<div class="main-content-inner">
    <div class="row">
        <div class="col-lg-6 col-ml-12">
            <div class="row">
                <!-- Textual inputs start -->
                <div class="col-12 mt-5">
                    <div class="card">
                        <div class="card-body">
                          <form action="/admin/personalinfo_procc" method="post" >
                            <h4 class="header-title">Personal Info</h4>
                            <p class="text-muted font-14 mb-4">기본정보 입니다.

                            <span style="float:right;"><button type="submit" class="btn btn-primary mb-3">저장</button></span>

                            </p>

                            <div class="form-group">
                                <label for="example-text-input" class="col-form-label">이름</label>
                                <input class="form-control" name="name" type="text" value="<?=$name?>" id="example-text-input">
                            </div>

                            <div class="form-group">
                                <label for="example-text-input" class="col-form-label">생년월일</label>
                                <input class="form-control" name="birthday" type="text" value="<?=$birthday?>" id="example-text-input">
                            </div>

                            <div class="form-group">
                                <label for="example-text-input" class="col-form-label">주소</label>
                                <input class="form-control" name="adress" type="text" value="<?=$adress?>" id="example-text-input">
                            </div>

                            <div class="form-group">
                                <label for="example-email-input" class="col-form-label">Email</label>
                                <input class="form-control" name="email" type="email" value="<?=$email?>" id="example-email-input">
                            </div>

                            <div class="form-group">
                                <label for="example-tel-input" class="col-form-label">휴대폰번호</label>
                                <input class="form-control" name="phonenumber" type="tel" value="<?=$phonenumber?>" id="example-tel-input">
                            </div>

                          </form>

                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
