<div>
  <form action="/admin/portfolio_procc" method="post">
    <input type="hidden" name="procc" value="write">
    <div style="float:right;"><button type="submit" class="btn btn-primary mb-3">글쓰기</button></div>
  </form>
</div>

<div class="bg-4">
  <div class="container">
    <?php if(isset($stats)):?>
      <table class="table table-hover text-center">
      <tr><th scope="row" colspan="5"><?=$stats?></th></tr>
    </table>
    <?php endif;?>


	<div class="row">
    <?php
    if(!isset($stats)):
      foreach($list as $lt):
        $thumnail = $lt->thumbnail;
    ?>

    <div class="col-lg-4 col-md-6 mt-5">
      <div class="card card-bordered" style="width:300px; height:400px;">
        <img class="card-img-top img-fluid" src="<?=$thumnail?>" alt="image" style="max-width: 600px; height: auto;">
        <div class="card-body">

        <form action="/admin/portfolio_procc" method="post">
          <input type="hidden" name="page"/>
          <input type="hidden" name="procc" value="view"/>
          <input type="hidden" name="idx" value="<?=$lt->idx?>"/>
          <h5 class="title"><?=$lt->title?></h5>
          <p class="card-text">
          </p>
          <input type="submit"class="btn btn-primary" value="자세히">
        </form>


        </div>
      </div>
    </div>

    <?php
      endforeach;
    endif;
    ?>
	   </div><!--/row-->
  </div><!--/container-->


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

<center>
  <div class="col-md-6 col-sm-8 clearfix">
    <div class="search-box pull-left">
      <form action="/admin/portfolio" method="post" name="search_form">
        <input type="hidden" name="procc" value="search">
        <input type="text" name="search" placeholder="Search..." required>
        <i class="ti-search"></i>
      </form>
    </div>
  </div>
</center>
</div>
