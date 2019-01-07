<div>
  <form action="/admin/qanda_procc" method="post">
    <input type="hidden" name="procc" value="write">
    <div style="float:right;"><button type="submit" class="btn btn-primary mb-3">글쓰기</button></div>
  </form>
</div>
  <div class="col-lg-12 mt-5">
    <div class="card">
      <div class="card-body">

        <div class="single-table">
          <div class="table-responsive">
            <table class="table table-hover text-center">
              <thead class="text-uppercase">
                <tr>
                  <th scope="col" width="10%">글번호</th>
                  <th scope="col" width="15%">작성자</th>
                  <th scope="col">제목</th>
                  <th scope="col" width="15%">날짜</th>
                </tr>
              </thead>
              <tbody>
              <?php if(isset($stats)):?>
              <tr><th scope="row" colspan="5"><?=$stats?></th></tr>
              <?php  endif;
              if(!isset($stats)):
                foreach($list as $lt):
              ?>

              <tr>
                <th scope="row"><?= $num--?></th>
                <td><?=$lt->name;?></td>
                <td>
                  <?php if($lt->del=="y"):?>
                  <del>
                    <?php endif;?>
                    <form name="paging" id="paging">
                      <input type="hidden" name="page" id="page"/>
                      <input type="hidden" name="procc" id="procc"/>
                      <input type="hidden" name="idx" id="idx"/>
                      <a class="dropdown-item" href="javascript:qanda_page_move('1','view','<?=$lt->idx?>');">
                      <?php if ($lt->depth>1)  echo "<img height=1 width=" . $lt->depth*7 . ">└";?>
                      <?=$lt->title?></a>
                    </form>
                    <?php if($lt->del=="y"):?>
                  </del>

                <?php endif;?>
                </td>
                <td><?=date("Y-m-d",$lt->date)?></td>
              </tr>
              <?php
                endforeach;
              endif;
              ?>

              </tbody>
            </table>
            <?php
            if(!isset($stats)):
            ?>
            <center>
              <div class="col-lg-4 col-md-6 mt-5" >
                <div class="card">
                  <div class="card-body">

                    <ul class="pagination pg-color-border center-block">
                      <?=$pagination;?>
                    </ul>

                  </div>
                </div>
              </div>
            </center>
            <?php endif;?>
          </div>
        </div>

      </div>
    </div>

    <center>
      <div class="col-md-6 col-sm-8 clearfix">
        <div class="search-box pull-left">
          <form action="/admin/qanda" method="post">
            <input type="hidden" name="procc" value="search">
            <input type="text" name="search" placeholder="Search..." required>
            <i class="ti-search"></i>
          </form>
        </div>
      </div>
    </center>


  </div>
</div>

<script>
function qanda_page_move(s_page,s_procc,s_idx){
  var f =  $("form#paging")[0];
  $("#page").val(s_page);
  $("#procc").val(s_procc);
  $("#idx").val(s_idx);

  f.action="/admin/qanda_procc";//이동할 페이지
  f.method="post";//POST방식
  f.submit();
}
</script>
