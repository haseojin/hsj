  <div id="main">
  <input class="myButton" type="button" value="글쓰기" onClick="self.location='/bbs/qna_proc?procc=write';" style="float:right;"><br><br>
    <table class="type08 type08_list">
      <thead>
        <tr><th scope="cols" style="width:5%;">no</th><th scope="cols">제목</th><th scope="cols" style="width:15%;">작성자</th><th scope="cols" style="width:15%;">작성일</th></tr>
      </thead>
    <tbody>
    <?php if(isset($stats)):?>
    <tr><th colspan="4"><?=$stats?></th></tr>
    <?php endif;

    if(!isset($stats)):
      foreach($list as $lt):
    ?>
    <tr>
      <td><?=$num?></td>

      <td>
        <form name="paging" id="paging">
          <input type="hidden" name="page" id="page"/>
          <input type="hidden" name="procc" id="procc"/>
          <input type="hidden" name="idx" id="idx"/>
          <?php if ($lt->depth>1) echo "<img height=1 width=" . $lt->depth*7 . ">└"; ?>
          <a id = "qanda_page_move" href="javascript:qanda_page_move('1','view','<?=$lt->idx?>','<?=$lt->pwd?>');">
            <?=$lt->title?>
          </a>
        </form>
      </td>
      <td><?=$lt->name?></td>
      <td><?=date("Y.m.d",$lt->date)?></td>
    </tr>
    <?php
    $num--;
      endforeach;
    endif;
    ?>
    </tbody>
    </table>
  <center>

  <?php  if(!isset($stats)):?>
  <div class="page">
    <ul class="pagination">
      <?=$pagination;?>
    </ul>
  </div>
  <?php endif;?>

  <br><br><br>

  <form action="/bbs/qna" method="post">
    <input type="hidden" name="procc" value="search">
    <span class='green_window'>
      <input type='text' class='input_text' name="search"/>
    </span>
    <button type='submit' class='sch_smit'>검색</button>
  </form>

  </center>

  </div>
</div>


<script>

function qanda_page_move(s_page,s_procc,s_idx,s_pwd){

  var f =  $("form#paging")[0];

  $("#page").val(s_page);
  $("#procc").val(s_procc);
  $("#idx").val(s_idx);

  f.action="/bbs/qna_proc";//이동할 페이지
  f.method="post";//POST방식
  f.submit();
}

</script>
