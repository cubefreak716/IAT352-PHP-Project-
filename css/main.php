<?php
    header("Content-type: text/css; charset: UTF-8");
?>

html{
  font-family: "Arial", sans-serif;

}

a{
  text-decoration:none;
  color:black;
}

nav {
  background-color: rgba(180, 180, 180, 1);
  width:100%;
  margin:0;
}
nav>a{
  margin-right;0.2rem;
  font-size:1.3rem;
  color:white;
  transition: color 1s ease-out;
}
nav>a:hover{
  color:black;
}

<!-- flexbox -->
*, *::after, *::before{
  box-sizing: border-box;
}

.box{
  display: -webkit-flex;
  display: -ms-flex;
  display:flex;

  flex-wrap:-webkit-flex;
  flex-wrap: -ms-flex;
  flex-wrap: wrap;

  justify-content: space-around;
}

.index-top{
  width:80%;
  height:30rem;
  margin-left:auto;
  margin-right:auto;
  margin-top:1.8rem;
  background-color: rgba(220, 220, 220, 1);
}
.index-bottom{
  width:80%;
  margin-left:auto;
  margin-right:auto;
  margin-top:1.5rem;
}

.index-heading{
  width:30rem;
  flex:3;
}

.index-signupbox{
  flex:1;
  margin:0.5rem;
  background-color: rgba(240, 240, 240, 1);
}

.index-heading-2{
  text-align:center;
  margin-left:auto;
  margin-right:auto;
}

.index-signupbutton{
  width:5rem;
  padding:0.3rem;
  text-align:center;
  color:white;
  background-color: rgba(200, 200, 200, 1);
  transition:background-color 0.3s ease-out;
}
.index-signupbutton:hover{
  background-color: rgba(160, 160, 160, 1);
}

.index-meterbox{
  width:25rem;
  height:8rem;
  flex:1;
  margin-left:1rem;
  margin-top:1rem;
  padding-top:6rem;
  background-color:rgb(240,240,240);
  transition:background-color 0.3s ease-out;
  text-align:center;
}
.index-meterbox:hover{
  background-color:rgb(200,200,200);
}

.signup-signupbox{
  width:20rem;
  margin-left:auto;
  margin-right:auto;
}
