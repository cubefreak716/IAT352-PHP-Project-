<?php
    header("Content-type: text/css; charset: UTF-8");
?>
p{
  display:inline;
}

li{
  list-style: square;
}

#googleMap{
  margin-top:1.3rem;
  border:2px solid gray;
  flex:1;
}

.itempage-heading{
  margin-left:5rem;
}
em{
  font-weight:bold;
  font-style:normal;
  font-size:1.2rem;
}
p.meterlist{
  display:block;
}

.square {
  display: flex;
  justify-content: center;
  align-items: center;
  overflow: hidden;
  width:10rem;
  height:10rem;
  margin-left:0.4rem;
  <!-- background-color: #555; -->

  margin:0.4rem;
}
.profile-image{
  flex-shrink: 0;
  width:inherit;
  border: 1px solid black;
}
.profile-box{
  margin-left: 3rem;
  margin-right: 0.5rem;
  margin-bottom:1rem;
  flex:1;
  padding-left: auto;
  padding-right: auto;
  padding-top:0.5rem;
  border: 1px solid rgba(89, 255, 170,1);
}
.favourite-box{
  flex:3;
  margin-left: auto;
  margin-right: auto;
  margin-bottom:1rem;
  padding-left: auto;
  padding-right: auto;
  border: 1px solid rgba(89, 255, 170,1);
}

.userinfosquare {
  margin-top:0.5vh;
  margin-left:1vw;
  min-height:1vh;
  width: 15vw;
  <!-- background-color: rgba(204, 204, 204,1); -->
  margin-bottom:0.5vh;
}
.userinfosquare>p{
  padding-left:0.2rem;
  border-style: none none none solid;
}

.userinfo{
  <!-- margin-left:5rem; -->
  font-size:1vw;
}

.iteminfo{
  flex:1;
  margin-left:2vw;
  font-size:1vw;
}
.iteminfo>p{
  font-size:1rem;
  border:4px rgba(62, 102, 82,1);
  border-style: none none none solid;
}
.edit-features{
  text-align:center;
}

.container{
  display:flex;
  width:70%;
  border: 1px solid rgba(89, 255, 170,1);
  margin-top:2rem;
  margin-left:auto;
  margin-right:auto;
}
