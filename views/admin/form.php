<script type="text/javascript" src="/ckeditor/ckeditor.js"></script>
<script type="text/javascript">

function LoadPage() {
  
    CKEDITOR.replace('contents');
}

function FormSubmit(f) {
    CKEDITOR.instances.contents.updateElement();
    if(f.title.value == "") {
  		alert("제목을 입력해 주세요.");
  		return false;
  	}

	if(f.contents.value == "") {
		alert("내용을 입력해 주세요.");
		return false;
	}



  if(f.thumbnail.value == "") {
		alert("썸네일을 선택해 주세요.");
		return false;
	}

}


$(document).ready(function(){
  var fileTarget = $('.filebox .upload-hidden');

  fileTarget.on('change', function(){
    if(window.FileReader){
    // 파일명 추출
      var filename = $(this)[0].files[0].name;
    }else {
    // Old IE 파일명 추출
      var filename = $(this).val().split('/').pop().split('\\').pop();
    };

    $(this).siblings('.upload-name').val(filename);
  });

  //preview image
  var imgTarget = $('.preview-image .upload-hidden');

  imgTarget.on('change', function(){
    var parent = $(this).parent();
    parent.children('.upload-display').remove();

    if(window.FileReader){
      //image 파일만
      if (!$(this)[0].files[0].type.match(/image\//)) return;

      var reader = new FileReader();
      reader.onload = function(e){
        var src = e.target.result;
        parent.prepend('<div class="upload-display"><div class="upload-thumb-wrap"><img src="'+src+'" class="upload-thumb"></div></div>');
      }
      reader.readAsDataURL($(this)[0].files[0]);
    }else {
      $(this)[0].select();
      $(this)[0].blur();
      var imgSrc = document.selection.createRange().text;
      parent.prepend('<div class="upload-display"><div class="upload-thumb-wrap"><img class="upload-thumb"></div></div>');

      var img = $(this).siblings('.upload-display').find('img');
      img[0].style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(enable='true',sizingMethod='scale',src=\""+imgSrc+"\")";
    }
  });

});

</script>

<style>
body {margin: 10px;}
.where {
  display: block;
  margin: 25px 15px;
  font-size: 11px;
  color: #000;
  text-decoration: none;
  font-family: verdana;
  font-style: italic;
}

.filebox input[type="file"] {
	position: absolute;
	width: 1px;
	height: 1px;
	padding: 0;
	margin: -1px;
	overflow: hidden;
	clip:rect(0,0,0,0);
	border: 0;
}

.filebox label {
	display: inline-block;
	padding: .5em .75em;
	color: #999;
	font-size: inherit;
	line-height: normal;
	vertical-align: middle;
	background-color: #fdfdfd;
	cursor: pointer;
	border: 1px solid #ebebeb;
	border-bottom-color: #e2e2e2;
	border-radius: .25em;
}

/* named upload */
.filebox .upload-name {
	display: inline-block;
	padding: .5em .75em;
	font-size: inherit;
	font-family: inherit;
	line-height: normal;
	vertical-align: middle;
	background-color: #f5f5f5;
  border: 1px solid #ebebeb;
  border-bottom-color: #e2e2e2;
  border-radius: .25em;
  -webkit-appearance: none; /* 네이티브 외형 감추기 */
  -moz-appearance: none;
  appearance: none;
}

/* imaged preview */
.filebox .upload-display {
	margin-bottom: 5px;
}

@media(min-width: 768px) {
	.filebox .upload-display {
		display: inline-block;
		margin-right: 5px;
		margin-bottom: 0;
	}
}

.filebox .upload-thumb-wrap {
	display: inline-block;
	width: 54px;
	padding: 2px;
	vertical-align: middle;
	border: 1px solid #ddd;
	border-radius: 5px;
	background-color: #fff;
}

.filebox .upload-display img {
	display: block;
	max-width: 100%;
	width: 100% \9;
	height: auto;
}

.filebox.bs3-primary label {
  color: #fff;
  background-color: #337ab7;
	border-color: #2e6da4;
}
</style>


</head>
<body onload="LoadPage();">

<form id="EditorForm" name="EditorForm" action="/admin/<?=$subtitle?>_procc" method="post"  enctype="multipart/form-data" onsubmit="return FormSubmit(this);" >

  <?php if($subtitle!="about"):?>
  <input type="hidden" name="procc" value="<?=$procc?>_procc">
  <div>

      <div class="input-group mb-3">
          <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">제목</span>
          </div>
          <input type="text" id="title" name="title" class="form-control" placeholder="제목을 입력해주세요" aria-label="title" aria-describedby="basic-addon1"  value="<?=$row["title"]?>">
      </div>

      <input type="hidden" name="idx" value="<?=$row["idx"]?>">
      <?php if($subtitle=="qanda"):?>
      <input type="hidden" name="pid" value="<?=$row["pid"]?>">
      <?php endif;?>
  </div>
  <div>
  <?php endif;?>

	<textarea id="contents" name="contents">
    <?=$row["contents"];?>
  </textarea>
</div>

<?php if($subtitle=="portfolio"):?>
<div class="filebox bs3-primary preview-image">
  <?php
    $state = "파일선택";
    if($procc=="modify"):
      $state =$row["file_name"].$row["file_ext"];
  ?>
  <div class="upload-display"><div class="upload-thumb-wrap"><img src="<?=$row["thumbnail"]?>" class="upload-thumb"></div></div>
  <?php endif;?>
  <input class="upload-name" value="<?=$state?>" disabled="disabled" style="width: 200px;">

  <label for="input_file">업로드</label>
  <input type="file" id="input_file" class="upload-hidden" name="thumbnail" >
</div>
<?php endif;?>

  <span style="float:right;"><button type="submit" class="btn btn-primary mb-3">저장</button></span>
</form>
</div>
