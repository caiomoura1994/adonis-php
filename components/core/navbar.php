<?php session_start();?>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Open Sans", sans-serif}
</style>

<div class="w3-top">
 <div class="w3-bar w3-theme-d2 w3-left-align w3-large">
  <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
  <a
    href="/pages/timeline.php"
    class="w3-bar-item w3-button w3-padding-large w3-theme-d4">
    <img
      style="height: 28px; border-radius: 5px;"
      src="https://banner2.kisspng.com/20180214/wse/kisspng-pet-sitting-happy-animals-dog-animals-in-spanish-white-beard-dog-vector-5a83f003cfaf14.5775743415185960998507.jpg"
    />  Adonis
  </a>
  <a href="/pages/find_friends.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="Account Settings"><i class="fa fa-group"></i></a>
  <a href="javascript:logout();" class="w3-bar-item w3-button w3-hide-small w3-right w3-padding-large w3-hover-white" title="My Account">
    Sair
  </a>
 </div>
</div>
<script>
  function logout(){
    location.href = "/?finish_session=true"
  }
</script>