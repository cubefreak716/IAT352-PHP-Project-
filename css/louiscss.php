<?php
    header("Content-type: text/css; charset: UTF-8");
?>

#googleMap{
  margin-top:1.3rem;
  border:2px solid gray;
}

.itempage-heading{
  margin-left:5rem;
}
em{
  font-weight:bold;
  font-style:normal;
  font-size:1.2rem;
}

.square {
  display: flex;
  justify-content: center;
  align-items: center;
  overflow: hidden;
  width:10rem;
  height:10rem;
  background-color: #555;
  border: 1px solid black;
  margin:0.4rem;
}
.profile-image{
  flex-shrink: 0;
  width:inherit;
}
.profile-box{
  margin-left: auto;
  margin-right: auto;
  margin-bottom:1rem;
  display:flex;
  border:1px solid gray;
  width:40rem;
  height:25rem;
  padding-left: auto;
  padding-right: auto;
}
.favourite-box{
  margin-left: auto;
  margin-right: auto;
  margin-bottom:1rem;
  border:1px solid gray;
  width:40rem;
  height:25rem;
  padding-left: auto;
  padding-right: auto;
}

.userinfosquare {
  margin-top:0.5vh;
  margin-left:1vw;
  min-height:1vh;
  width: 15vw;
  background-color: rgba(204, 204, 204,1);
}

.userinfo{
  margin-left:5rem;
  font-size:1vw;
}

.iteminfo{
  margin-left:2vw;
  font-size:1vw;
}
.iteminfo>p{
  font-size:1rem;
  border:4px rgba(62, 102, 82,1);
  border-style: none none none solid
}
.edit-features{
  float:right;
}

.container{
  display:flex;
  width:70%;
  border: 1px solid rgba(89, 255, 170,1);
  margin-top:2rem;
  margin-left:auto;
  margin-right:auto;
}
