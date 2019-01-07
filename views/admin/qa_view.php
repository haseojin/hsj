  <div class="col-lg-12 mt-5">
    <div class="card">
      <div class="card-body">
        <div class="single-table">
          <div class="table-responsive">
            <?php foreach($list as $lt): ?>
            <table class="table">
              <thead class="text-uppercase">
              <tr>
                <th scope="col" rowspan="2" style="width: 70%; text-align:center;" ><?=$lt->title?></th>
                <th scope="col"><?=date("Y-m-d h:i:s",$lt->date)?></th>
                <?php  if($subtitle!="portfolio"):?>
                <th scope="col"><?=$lt->name?></th>
                <?php endif;?>
              </tr>
              </thead>
              <tbody>
                <tr><td scope="row" colspan="5"><?=$lt->contents?></td></tr>
              </tbody>
            </table>

          </div>
        </div>
        <form name="paging">
          <input type="hidden" name="page"/>
          <input type="hidden" name="procc"/>
          <input type="hidden" name="idx"/>
          <?php
          if($subtitle!="portfolio"):
          if($lt->depth<2){
          ?>
          <td nowrap="" class="m-tcol-c filter-30">|</td><a href="javascript:qanda_page_move('<?=$subtitle?>','answer','<?=$lt->idx?>');">답변</a>
          <?php
          }
          endif;
          ?>
          <td nowrap="" class="m-tcol-c filter-30">|</td><a href="javascript:qanda_page_move('<?=$subtitle?>','modify','<?=$lt->idx?>');">수정</a>
          <td nowrap="" class="m-tcol-c filter-30">|</td><a href="javascript:qanda_page_move('<?=$subtitle?>','delete','<?=$lt->idx?>');">삭제</a>
        </form>
        <?php endforeach;?>
      </div>
    </div>

  </div>
</div>

<script>
function qanda_page_move(s_page,s_procc,s_idx){
    var f=document.paging; //폼 name
    f.page.value = 1; //POST방식으로 넘기고 싶은 값
    f.procc.value = s_procc; //POST방식으로 넘기고 싶은 값
    f.idx.value = s_idx;//POST방식으로 넘기고 싶은 값
    f.action="/admin/"+s_page+"_procc";//이동할 페이지
    f.method="post";//POST방식
    f.submit();
}
</script>
