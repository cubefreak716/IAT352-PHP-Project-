<?php
    header("Content-type: text/css; charset: UTF-8");
?>

html{
  font-family: "Arial", sans-serif;
  margin:0;
  padding:0;
}
body{
  margin:0;
}

a{
  text-decoration:none;
  color:black;
}
a.link{
  text-decoration: underline;
  color:blue;

}
a.link:hover{
  color:black;
}
nav {
  width:100%;
  margin:0;
  background-color: #24272B;
  height:3rem;
}
.nav-box{
  height:4.5rem;
  <!-- border:1px solid black; -->
}
.nav-title{
  flex:5;
  font-size:1.8rem;
  color:white;
  padding-left:3rem;
  padding-top:0.5rem;
  font-weight:bold;
}
.nav-button{
  flex:1;
  margin-right:0.2rem;
  font-size:1rem;
  background-color: #24272B;
  transition: background-color 0.5s ease-out;
  padding-top:0.8rem;
  text-align:center;
  height:3rem;;
}
.nav-button:hover{
  background-color: #4b525c;
}
nav>a{
    color:white;
    flex:1;
}
.signup-button{
  margin-right:0.2rem;
  font-size:1rem;
  background-color: #07070A;
  transition: background-color 0.5s ease-out;
  padding-top:0.8rem;
  text-align:center;
  height:3rem;
}
.signup-button:hover{
  background-color: #6f7680;
}
.member-status-bar{
  float:right;
  background-color: #3E78B2;
  color: rgba(245, 245, 245,1);
  font-size:1.1rem;
  padding:0.3rem;
  padding-left:0.5rem;
  padding-right:0.5rem;
}

li{
  list-style: none;
}

/* <!-- flexbox --> */
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
.container2{
  display:flex;
  width:70%;
  border: 1px solid rgba(89, 255, 170,1);
  margin-top:2rem;
  margin-left:auto;
  margin-right:auto;
}

.index-top{
  width:80rem;
  height:30rem;
  margin-top:0.5rem;
  margin-left:auto;
  margin-right:auto;
  background-color: rgba(240, 240, 240, 1);
  overflow:hidden;
}
.index-bottom{
  width:80rem;
  margin-left:auto;
  margin-right:auto;
  margin-top:1.5rem;
}
.overlay{
  position: absolute;
  background-color: rgba(180,180,180,0.3);
  z-index: 5;
  width:inherit;
  height:inherit;
}

h1{
  padding:0;
  margin:0;
  color:white;
  font-size:3rem;
}
h2{
  padding:0;
  margin:0;
  margin:0.5rem;
}
.index-heading{
  margin:0;
  padding:0;
  padding-top:8rem;
  padding-left:2rem;
  width:30rem;
  height:inherit;
  <!-- background-color: #4b525c; -->
  color:white;
  font-weight: normal;
  font-size: 1rem;
}
.heading-subtitle{
  color:;
}

.index-browsebutton{
  width:8rem;
  padding:0.3rem;
  text-align:center;
  color: white;
  background-color: #004BA8;
  transition:background-color 0.3s ease-out;
}
.index-browsebutton:hover{
  background-color: rgba(140, 140, 140, 1);
}

.index-info{
  width:100%;
  height:12rem;
  flex:1;
  margin-right:0.3rem;
  background-color:rgb(240,240,240);
  transition:background-color 0.3s ease-out;
  text-align:center;
}

.title{
  padding:1.5rem;
  font-size:1.2rem;
  width:inherit;
  color: rgba(114, 173, 130,1);
  background-color: rgba(197, 250, 211, 1);
}
p{
  text-align: left;
  margin-left: 0.4rem;
}

.signup-form{
  width:25rem;
  margin-left: auto;
  margin-right: auto;
  padding-top:0.8rem;
  padding-bottom:3rem;
  padding-left:2rem;
  background-color:rgba(245,245,245,1);
}
.signupform{
  margin-left:3rem;
}
input{
  margin-bottom:0.5rem;
}
span.errorMsg{
  color:red;
  font-weight: bold;
}
.browse-box{
  width:60%;
  height:100vh;
  margin-left:auto;
  margin-right:auto;
}
.filter-box{
  flex:1;
  font-size:0.8rem;
}
.queryForm{
  
}
.filter-type-name{
  font-weight: bold;
}

.items-box{
  flex:4;
  margin-left:0.5rem;
}
.item{
  background-color:rgb(242, 242, 242);
  margin-bottom:0.5rem;
  transition:background-color 0.3s ease-out;
  text-align: left;
  padding-top:1.5rem;
  padding-left:0.5rem;
  padding-bottom:1.5rem;
}
.item:hover{
  background-color: rgba(160, 160, 160, 1);
}
.item-num{
  font-size: 1.1rem;
  font-weight:bold;
  display:inline;
}
.item-stationtype{
  font-weight:bold;
  color:rgb(34, 70, 94);
  display:inline;
}
.item-hourrate{
  float:right;
  margin-right: 0.8rem;
  font-weight: bold;
  font-size: 0.9rem;
}

.icon-meter{
  width: 2rem;
}

.browse-box{
  flex:3;
  padding:0;
}

.disabled-pagination{
  pointer-events: none;
  cursor: default;
  flex:1
}

.pages-bar{
  margin-top:2rem;
  margin-bottom: 5rem;
  background-color: rgba(209, 237, 216,1);
}
.curr-page{
  flex:1;
  text-align: center;
}
.pagination-button{
  flex:1;
  text-align: center;
  background-color: rgba(182, 209, 189,1);
  transition:background-color 0.3s ease-out;
}
.pagination-button:hover{
  background-color: rgba(182, 209, 189,0);
}
