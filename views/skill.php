<div id="main">

<?php if($cp_count>0){?>

<div style="width:30%; display:inline-block">
<h3>Coding & Programming </h3>
<ul class="skill">
<?php for($i=0; $i<$cp_count; $i++){  ?>
   <li style="line-height:30px;"><?=$cp[$i]["contents"]?></li>
<?php }}?>
</ul>
</div>

<?php if($db_count>0){?>
<div style="width:30%; display:inline-block; position: relative; top:-75px;">
<h3>DB </h3>
<ul class="skill">
<?php for($i=0; $i<$db_count; $i++){  ?>
   <li style="line-height:30px;"><?=$db[$i]["contents"]?></li>
<?php }}?>
</ul>
</div>


<?php if($se_count>0){?>
<div style="width:30%; display:inline-block;  position: relative; top:-155px;">
<h3>System Engineer</h3>
<ul class="skill">
<?php for($i=0; $i<$se_count; $i++){  ?>
   <li style="line-height:30px;"><?=$se[$i]["contents"]?></li>
<?php }}?>
</ul>
</div>


</div>
</div>
