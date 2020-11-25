
<?php
  // $conn = new mysqli("localhost","root","","nexus");
  $sql = "select * from chats where receiver='$username'";
  $get_senders = mysqli_query($conn, $sql);
  $i=-1; ?>
  <img id="in-back" src="arrow-back-ios.png" alt="" onclick="in_back()" style="display:none; cursor:pointer">
  <div id="in-title" style="display:none;font-size:1.5em;">
  </div>
  <div id="in-content" style="display:none">

  </div>
  <style>
      table{
        border-bottom:1px solid black;
        padding:10px;
        width:100%;
      }
      td{
        padding:10px;
        text-align:left;
        width:45%;
      }
      .content-box:hover{
        box-shadow: 5px 2px 2px 2px #767c77;
      }
      .content-box:active{
        box-shadow:0px 0px grey;
      }
      </style>
  <div id="inbox-list">
    <?php while($sender = mysqli_fetch_array($get_senders)){  ?>
    <form  action="" method="get">
      <?php if ($sender['deleted_by_receiver'] == '0') {
        $i+=1;
       ?>
       <input type="text" class="inbox_msg_id"  name="msg_id" value="<?php echo $sender['msg_id']; ?>" style="display:none">
       <div onclick="in_submit(<?php echo $i;?>)"  class="content-box" style="cursor:pointer">
         <table>
           <tr>
             <td><h4><?php echo $sender['title']; ?></h4></td>
             <td><span>From:</span> <span><?php echo $sender['sender']; ?></span></td>
             <td><button onclick='inbox_deleted(<?php echo $i;?>)' style='float:right'><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
   <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
   <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
 </svg></button></td>
           </tr>
         </table>

       </div>

     <?php } ?>

    </form>
    <?php   } ?>
    <?php if ($i == -1) { ?>
      <table>
        <td><svg width="5em" height="5em" viewBox="0 0 16 16" class="bi bi-exclamation-octagon-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353L11.46.146zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
        </svg></td>
        <td><span>no messages to show</span></td>
      </table>

    <?php } ?>
  </div>


<script type="text/javascript">
  function in_submit(k) {
    var formdata = new FormData();
    var inbox_msg_id = document.getElementsByClassName('inbox_msg_id');
    formdata.append(inbox_msg_id[k].name, inbox_msg_id[k].value);
    var xmlHttp = new XMLHttpRequest();
    var xmlHttp1 = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function()
        {
            if(xmlHttp.readyState == 4 && xmlHttp.status == 200)
            {
                document.getElementById('inbox-list').style.display = 'none';
                document.getElementById('in-content').innerText = xmlHttp.responseText;

                document.getElementById('in-back').style.display = 'block';
                document.getElementById('in-content').style.display = 'block';
            }
        }
    xmlHttp1.onreadystatechange = function()
            {
                if(xmlHttp1.readyState == 4 && xmlHttp1.status == 200)
                {
                    document.getElementById('inbox-list').style.display = 'none';
                    document.getElementById('in-title').innerText = xmlHttp1.responseText;

                    document.getElementById('in-back').style.display = 'block';
                    document.getElementById('in-title').style.display = 'block';
                }
            }
    xmlHttp.open("post", "content.php");
    xmlHttp1.open("post", "title.php");
    xmlHttp.send(formdata);
    xmlHttp1.send(formdata);
  }
  function in_back() {
    document.getElementById('inbox-list').style.display = 'block';
    document.getElementById('in-back').style.display = 'none';
    document.getElementById('in-content').style.display = 'none';
    document.getElementById('in-title').style.display = 'none';
  }
  function inbox_deleted(k){
    var inbox_msg_id=document.getElementsByClassName('inbox_msg_id');
    var formdata = new FormData();
    formdata.append(inbox_msg_id[k].name, inbox_msg_id[k].value);
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function()
        {
            if(xmlHttp.readyState == 4 && xmlHttp.status == 200)
            {
              alert(xmlHttp.responseText);
            }
        }
    xmlHttp.open("post", "inbox-delete.php");
    xmlHttp.send(formdata);

  }
</script>
