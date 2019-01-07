  <div id="main">
  <ul class="album">
    <?php
    if(isset($stats)):
    ?>
    <?=$stats?>
    <?php
    endif;

    if(!isset($stats)):
      foreach($list as $lt):
    ?>
    <li>
        <div class="album-item">
        <div class="album-cover" style="background-image: url('<?=$lt->thumbnail?>');"></div>
        <div class="album-info">
          <p class="album-title">
          <form name="paging" id="paging">
            <input type="hidden" name="page" id="page"/>
            <input type="hidden" name="idx" id="idx"/>
            <a id = "qanda_page_move" href="javascript:qanda_page_move('1','<?=$lt->idx?>');"><?=$lt->title?></a>
          </form>
          </p>
          <p class="album-date"><?=date("Y.m.d",$lt->date)?></p>
        </div>
      </div>
    </li>
    <?php endforeach;  endif;?>
  </ul>

  <center>
    <?php
    if(!isset($stats)):
    ?>


    <div class="page">
      <ul class="pagination">
        <?=$pagination;?>
      </ul>
    </div>


    <?php endif;?>
    <br><br><br>

    <form action="/bbs/portfolio" method="post">
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
  function qanda_page_move(s_page,s_idx){

    var f =  $("form#paging")[0];

    $("#page").val(s_page);
    $("#idx").val(s_idx);


    f.action="/bbs/portfolio_procc";//이동할 페이지
    f.method="post";//POST방식
    f.submit();

  }
</script>
