<script type="text/javascript">
  function add_item(obj){
    // pre_set 에 있는 내용을 읽어와서 처리..
    var obj=obj;
    var div = document.createElement('div');
    div.innerHTML = document.getElementById(obj).innerHTML;
    //$('.cp').find(".id").attr("value", i);
    document.getElementById(obj+'_input').appendChild(div);
  }

  function remove_item(obj,input){
    // obj.parentNode 를 이용하여 삭제
    document.getElementById(input+'_input').removeChild(obj.parentNode);
  }

  function remove_item1(obj){
    var i = obj;
    // obj.parentNode 를 이용하여 삭제
    $( 'div#'+i ).remove();
  }

</script>


  <div class="main-content-inner">
    <div class="row">
      <div class="col-lg-6 col-ml-12">
        <div class="row">
        <!-- Textual inputs start -->
          <div class="col-12 mt-5">
            <div class="card">
              <div class="card-body">

                <form action="/admin/skill_procc" method="post" >
                  <h4 class="header-title">skill</h4>
                  <p class="text-muted font-14 mb-4">보유기술 및 능력
                  <span style="float: right;">
                  <button type="submit" class="btn btn-primary mb-3">저장</button>
                  </span>
                  </p>


                  <div class="form-group">
                    <label for="example-text-input" class="col-form-label">Coding & Programming</label>
                    <span style="padding:10px;" class="fw-icons"><a href="#" onclick="add_item(`cp`)"><i class="fa fa-plus"></i></a></span>

                    <div id="cp" style="display:none">
                      <input style="display: inline-block;" class="form-control form-control-sm col-sm-2" name="cp[]" type="text" value="" id="example-text-input">
                      <input type="button" value="삭제" onclick="remove_item(this,'cp')">
                    </div>
                    <?php if($cp_count>0):
                            for($i=0; $i<$cp_count; $i++):?>
                    <div id="cp_<?=$i?>">
                      <input style="display: inline-block;" class="form-control form-control-sm col-sm-2" name="cp[<?=$cp[$i]["gid"]?>]" type="text" value="<?=$cp[$i]["contents"]?>" id="example-text-input">
                      <span class="fw-icons col-lg-3 col-sm-6"><a href="#" onclick="remove_item1('cp_<?=$i?>')"><i class="fa fa-minus"></i></a></span>
                    </div>
                    <?php endfor;endif;?>
                    <div id="cp_input"></div>
                  </div>

                  <div class="form-group">
                    <label for="example-text-input" class="col-form-label">DB</label>
                    <span style="padding:10px;" class="fw-icons"><a href="#" onclick="add_item(`db`)"><i class="fa fa-plus"></i></a></span>
                    <div id="db" style="display:none">
                      <input style="display: inline-block;" class="form-control form-control-sm col-sm-2" name="db[]" type="text" value="" id="example-text-input">
                      <input type="button" value="삭제" onclick="remove_item(this,'db')">
                    </div>
                    <?php if($db_count>0):
                            for($i=0; $i<$db_count; $i++): ?>
                    <div id="db_<?=$i?>">
                      <input style="display: inline-block;" class="form-control form-control-sm col-sm-2" name="db[<?=$db[$i]["gid"]?>]" type="text" value="<?=$db[$i]["contents"]?>" id="example-text-input">
                      <span class="fw-icons col-lg-3 col-sm-6"><a href="#" onclick="remove_item1('db_<?=$i?>')"><i class="fa fa-minus"></i></a></span>
                    </div>
                    <?php endfor;endif;?>
                    <div id="db_input"></div>
                  </div>


                  <div class="form-group">
                    <label for="example-text-input" class="col-form-label">System Engineer</label>
                    <span style="padding:10px;" class="fw-icons"><a href="#" onclick="add_item(`se`)"><i class="fa fa-plus"></i></a></span>
                    <div id="se" style="display:none">
                      <input style="display: inline-block;" class="form-control form-control-sm col-sm-2" name="se[]" type="text" value="" id="example-text-input">
                      <input type="button" value="삭제" onclick="remove_item(this,'se')">
                    </div>
                    <?php if($se_count>0):
                            for($i=0; $i<$se_count; $i++):  ?>
                    <div id="se_<?=$i?>">
                      <input style="display: inline-block;" class="form-control form-control-sm col-sm-2" name="se[<?=$se[$i]["gid"]?>]" type="text" value="<?=$se[$i]["contents"]?>" id="example-text-input">
                      <span class="fw-icons col-lg-3 col-sm-6"><a href="#" onclick="remove_item1('se_<?=$i?>')"><i class="fa fa-minus"></i></a></span>
                    </div>
                    <?php endfor;endif;?>
                    <div id="se_input"></div>
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
