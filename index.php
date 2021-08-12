<h1>Finger</h1>
<?php
  
if(isset($_GET["ip"])){?>
 <input id="tgl" type="date" name="tgl">
 <input id="jam" type="text" name="jam">
 <button onclick="ok()" type="submit">ok</button>
 <?php }else{ ?>
  <input type="text" id="ip" name="ip" placeholder="ip neh" >
  <button onclick="ok2()" type="submit">ok</button>
 <?php }?>
 
<script type="text/javascript">
  var tgl = document.getElementById("tgl");
  var jam = document.getElementById("jam");
  var ip = document.getElementById("ip");
  
  var nilai;

  function ok2() {
    nilai = ip.value;
      setTimeout(()=>{
          window.location.href = "index.php?ip="+ip.value;
      },200)

  }

  function ok(){
    nilai = window.location.search.substr(1).split("=")[1];
    setTimeout(()=>{
     window.location.href = "index.php?ip="+nilai+"&waktu="+tgl.value+" "+jam.value;
      },1000)
  }

</script>
<?php

require 'zklibrary.php';
if(isset($_GET["ip"])){
  $zk = new ZKLibrary($_GET["ip"], 4370);
  $zk->connect();
  
  $zk->disableDevice();

  $users = $zk->getUser();

  if(isset($_GET["waktu"])){
    $zk->setTime($_GET["waktu"]);
  }
  // echo $zk->getTime();
  echo "<br/>".date('Y-m-d', strtotime($zk->getTime()))."<br/>";
  echo date('H:i:s', strtotime($zk->getTime()));
}


$zk->enableDevice();
$zk->disconnect();

?>
