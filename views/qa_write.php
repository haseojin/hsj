<script type="text/javascript" src="/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="/ckeditor/config.js"></script>
<script type="text/javascript">

function LoadPage() {
    CKEDITOR.replace('contents');
}


CKEDITOR.editorConfig = function( config ) {
    config.filebrowserUploadUrl = '/upload/upload.php'
};


</script>

<style>
input[type="text"],input[type="password"] {
height: auto; /* 높이 초기화 */
line-height: normal; /* line-height 초기화 */
padding: .8em .5em; /* 여백 설정 */ }
label{color: white;}

.input-group {
    margin-top:10px;
    width:60%;
    display:flex;
    justify-content:space-between;
    flex-wrap:wrap;
}
label, input {
    flex-basis:100px;
}

</style>
</head>


  <body onload="LoadPage();"><br><br>

    <form id="EditorForm" name="EditorForm" action="/bbs/qna_proc" method="post" style="width:70%; float:right;" onsubmit="return FormSubmit();">

      <input type="hidden" name="procc" value="<?=$procc?>_procc">
      <div>
        <?php
        $title="";
        $contents="";
        $idx="";
        $pid="";
        $name="";
        $pwd="";
        $disabled="";

        if($procc=="modify"):
          $disabled="disabled";
          foreach($list as $lt):
            $title=$lt->title;
            $contents=$lt->contents;
            $idx=$lt->idx;
            $name=$lt->name;
            $pwd=$lt->pwd;
          endforeach;
        endif;
        ?>
        <div class="input-group">
          <label for="title">제목</label> <input type="text" id="title" name="title" size="40" value="<?=$title?>" placeholder="제목을 입력해주세요" />
        </div>
        <div class="input-group">
          <label for="name">닉네임</label><input type="text" id="name" name="name" size="40" value="<?=$name?>" placeholder="닉네임을 입력해주세요"/>
        </div>
        <div class="input-group">
          <label for="pwd">비밀번호</label><input type="password" id="pwd" name="pwd" <?=$disabled?> size="40" value="<?=$pwd?>" placeholder="비밀번호를 입력해주세요"/>
        </div>
        <input type="hidden" name="idx" value="<?=$idx?>">
        <input type="hidden" name="pid" value="<?=$pid?>">


      </div><br><br>

      <div>
        <textarea id="contents" name="contents" placeholder="내용을 입력해주세요">
        <?=$contents;?>
        </textarea>
      </div>
      <div style="float:right;"><button type="submit" class="myButton">저장</button></div>
    </form>
  </div>

<script>
function FormSubmit() {
  var f =  $("form#EditorForm")[0];

    if(f.title.value == "") {
      alert("제목을 입력해 주세요.");
      return false;
    }

    if(f.name.value == "") {
      alert("닉네임을 입력해 주세요.");
      return false;
    }

    if(f.pwd.value == "") {
      alert("비밀번호를 입력해 주세요.");
      return false;
    }

  if(f.contents.value == "") {
    alert("내용을 입력해 주세요.");
    return false;
  }
}
</script>
