<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<style>
@import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700');
 ul,li{list-style: none;padding:0;margin:0} 


/*Login form CSS*/
.loginpg{font-family:'Poppins',Arial,sans-serif;background: #497f7f; /* Old browsers */background: -moz-linear-gradient(top, #497f7f 16%, #4b8181 49%, #639393 65%, #679895 84%, #719f9d 100%); /* FF3.6-15 */background: -webkit-linear-gradient(top, #497f7f 16%,#4b8181 49%,#639393 65%,#679895 84%,#719f9d 100%); /* Chrome10-25,Safari5.1-6 */background: linear-gradient(to bottom, #497f7f 16%,#4b8181 49%,#639393 65%,#679895 84%,#719f9d 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#497f7f', endColorstr='#719f9d',GradientType=0 ); /* IE6-9 */background-repeat: no-repeat;background-size: cover;background-attachment: fixed}.loginwrap{background:#ffb933 url('images/login-bg.jpg') no-repeat left center;border-radius: 10px;margin:50px auto;padding: 0;background-size: auto 100%}
.loginformWrap{padding: 20px;margin: 120px auto;background: #fff;box-shadow: 1px 1px 20px #777}
.formbtn{appearance:none;-webkit-appearance:none;border:0;outline:none;color: #fff;font-family: 'Poppins',Arial,sans-serif;background: #1a535c;font-size: 15px;border-radius: 0;width:49%;padding: 10px;margin:15px 0}
.logtoptxt{color: #ffb933;font-size: 15px;padding-bottom: 20px;font-weight: 500}
.loginform-control{padding:10px;height: auto;border-radius: 0;text-align: left;color: #555}
.reqdmsg{padding:2px;color:#000;font-size: 12px;border-top: 2px solid #990000;text-align: center}
.msgnone{display:none}
.errormsgWrap{position: relative;margin-bottom: 15px}
.loginerrormsg{border:1px solid #990000;padding:7px;text-align:center;display: none}
.para{display: none;margin:0}
/*Login form CSS ends*/

/*Sign up form CSS*/
.signupWrap{width: 500px;margin:20px auto;text-align: center}
.signuppg{background: #cce2df}
.signupformWrap{padding: 20px;margin: 0 auto;background: #fff}
/*Sign up form CSS ends*/

/*Task Table CSS*/
.dashpg{background: #f5f5f5;font-family:'Poppins',Arial,sans-serif; position: relative;overflow-x: hidden;height: 100%}
.dashpg .headWrap{padding: 20px 70px;background: #fff;box-shadow: 1px 2px 15px #ddd;text-align: center}
.dashpg .headTxt{color: #4db6ac;font-weight: 700;font-size: 24px;text-align: left;display: inline;padding: 0 15px;vertical-align:middle}
.dashpg .midTxt{color: #acb3b5;font-weight: 400;font-size: 16px;border-left: 1px solid #acb3b5;line-height: 20px;display: inline;padding: 0 15px;vertical-align:middle}
.dashpg .taskdetailWrap{padding:25px 0;width:97%;border-bottom:1px solid #fff;margin:0 auto}
.dashpg .dashbtnwrap{clear: both;text-align: center;margin:0 auto;padding:10px 0 30px}
.dashpg .dashbtn{appearance:none;-webkit-appearance:none;border:0;outline:none;color: #fff;font-family: 'Poppins',Arial,sans-serif;background: #4db6ac;font-size: 16px;width:115px;height:40px;padding: 10px;margin:0 10px 0}
.dashpg .dashtitle{font-size: 16px;padding-bottom:10px;font-weight: 600;text-align: center}
.dashpg .dashform-control{height: 40px;border-radius: 0;box-shadow: 1px 4px 7px #e2e2e2}
.dashpg .taskcontainer{padding:35px 0;width:95%;margin:0 auto}
.dashpg .tasktrackwrap{position: relative;width: 900px;margin:0 auto}
.dashpg .monthmenu{position: absolute;top:10px;right:5%;cursor: pointer;text-align: right}
.dashpg #tasktrack, .dashpg #pietrack, .dashpg #usermonthlytrack, .dashpg #usercattrack{min-width: 310px; height: 400px; margin: 30px auto;width:900px}
.filterwrap {padding-top: 35px;width: 97%;margin: 0 auto}
.highcharts-credits{display: none}
.dashpg #page_links{margin:10px;font-weight: 500}
.dashpg #page_a_link{margin:10px;font-weight: 500}
.taskmonthwrap{width: 150px;background:rgba(25,25,25,0.9);padding:10px;text-align:left;display: none}
.taskmonthwrap li{padding:7px 0}
.taskmonthwrap a{color: #fff;font-size:14px}
.nodatafoundwrap{margin: 30px auto;text-align: center}
/*.pagitxt{background: #4db6ac;color: #fff;margin:0 5px;}*/

/*Task Table CSS*/

/*Side Bar CSS Starts*/
.nav .open > a, 
.nav .open > a:hover, 
.nav .open > a:focus {background-color: transparent}
#wrapper {padding-left: 0;-webkit-transition: all 0.5s ease;-moz-transition: all 0.5s ease;-o-transition: all 0.5s ease;transition: all 0.5s ease}
#wrapper.toggled {padding-left: 220px}
#sidebar-wrapper {z-index: 1000;left: 220px;width: 0;height: 100%;margin-left: -220px;overflow-y: auto;overflow-x: hidden;background: #1a1a1a;-webkit-transition: all 0.5s ease;-moz-transition: all 0.5s ease;-o-transition: all 0.5s ease;transition: all 0.5s ease}
#sidebar-wrapper::-webkit-scrollbar {display: none}
#wrapper.toggled #sidebar-wrapper {width: 220px}
#wrapper.toggled #page-content-wrapper {margin-right: -220px}
.sidebar-nav {position: absolute;width: 220px;margin: 0;padding: 0;list-style: none}
.sidebar-nav li {position: relative; line-height: 20px;display: inline-block;width: 100%;color: #fff}
.sidebar-nav li:before {content: '';position: absolute;top: 0;left: 0;z-index: -1;height: 100%;width: 3px;background-color: #1c1c1c;-webkit-transition: width .2s ease-in;-moz-transition:  width .2s ease-in;-ms-transition:  width .2s ease-in;transition: width .2s ease-in}
.sidebar-nav li:first-child:before{background-color: #7d5d81}
.sidebar-nav li:nth-child(2):before {background-color: #ec1b5a}
.sidebar-nav li:nth-child(3):before {background-color: #35acdf}
.sidebar-nav li:nth-child(4):before {background-color: #e0876a}
.sidebar-nav li:nth-child(5):before {background-color: #5b9aa0}
.sidebar-nav li:nth-child(6):before {background-color: #ff6f69}
.sidebar-nav li:hover:before, .sidebar-nav li.open:hover:before {width: 100%;-webkit-transition: width .2s ease-in;-moz-transition:  width .2s ease-in;-ms-transition:  width .2s ease-in;transition: width .2s ease-in}
.sidebar-nav li a{display: block;color: #ddd;text-decoration: none;padding: 12px 15px 12px 30px}
.sidebar-nav li a:hover,.sidebar-nav li a:active,.sidebar-nav li a:focus,.sidebar-nav li.open a:hover,.sidebar-nav li.open a:active,.sidebar-nav li.open a:focus{color: #fff;text-decoration: none;background-color: transparent}
.sidebar-name {color: #fff;font-size: 15px;line-height: 20px;text-align: center;padding: 0 0 20px;text-transform: capitalize}
.sidebar-nav .dropdown-menu {position: relative;width: 100%;padding: 0;margin: 0;border-radius: 0;border: none;background-color: #222;box-shadow: none}

.hamburger {position: fixed;top: 21px;  z-index: 999;display: block;width: 32px;height: 32px;margin-left: 15px;background: transparent;border: none}
.hamburger:hover,.hamburger:focus,.hamburger:active {outline: none}
.hamburger.is-closed:before {content: '';display: block;width: 100px;font-size: 14px;color: #fff;line-height: 32px;text-align: center;opacity: 0;-webkit-transform: translate3d(0,0,0);-webkit-transition: all .35s ease-in-out}
.hamburger.is-closed:hover:before {opacity: 1;display: block;-webkit-transform: translate3d(-100px,0,0);-webkit-transition: all .35s ease-in-out}
.hamburger.is-closed .hamb-top,.hamburger.is-closed .hamb-middle,.hamburger.is-closed .hamb-bottom,.hamburger.is-open .hamb-top,.hamburger.is-open .hamb-middle,.hamburger.is-open .hamb-bottom {position: absolute;left: 0;height: 4px;width: 100%}
.hamburger.is-closed .hamb-top,.hamburger.is-closed .hamb-middle,.hamburger.is-closed .hamb-bottom {background-color: #2E6D67}
.hamburger.is-closed .hamb-top { top: 5px; -webkit-transition: all .35s ease-in-out}
.hamburger.is-closed .hamb-middle {top: 50%;margin-top: -2px}
.hamburger.is-closed .hamb-bottom {bottom: 5px;  -webkit-transition: all .35s ease-in-out}
.hamburger.is-open .hamb-top,.hamburger.is-open .hamb-middle,.hamburger.is-open .hamb-bottom {background-color: #fff}
.hamburger.is-open .hamb-top,.hamburger.is-open .hamb-bottom {top: 50%;margin-top: -2px}
.hamburger.is-open .hamb-top {-webkit-transform: rotate(45deg);-webkit-transition: -webkit-transform .2s cubic-bezier(.73,1,.28,.08)}
.hamburger.is-open .hamb-middle {display: none}
.hamburger.is-open .hamb-bottom {-webkit-transform: rotate(-45deg);-webkit-transition: -webkit-transform .2s cubic-bezier(.73,1,.28,.08)}
.hamburger.is-open:before {content: '';display: block;width: 100px;font-size: 14px;color: #fff;line-height: 32px;text-align: center;opacity: 0;-webkit-transform: translate3d(0,0,0);-webkit-transition: all .35s ease-in-out}
.hamburger.is-open:hover:before {opacity: 1;display: block;-webkit-transform: translate3d(-100px,0,0);-webkit-transition: all .35s ease-in-out}
.overlay {position: fixed;display: none;width: 100%;height: 100%;top: 0;left: 0;right: 0;bottom: 0;background-color: rgba(0,0,0,.7);z-index: 1} 
.userpro{text-align: center;padding:20px 10px}
.userpro img{width: 150px;height:auto} 
/*Side Bar CSS Ends*/

/*User Perormance Bar CSS*/
.performancecanvas{width: 900px;margin:30px auto 20px;background: #333}
#userperformancewrap{margin:0 auto;text-align: center}
#userperformancewrap li{display: inline-block;margin:30px auto;padding: 0 20px}
.perftitle{text-align: center;font-size:18px;padding: 30px 5px 0;font-weight: 500;color: #A7FFEB}
.perfusertxt{text-align: center;font-size:16px;font-weight: 400;color: #fff}
/*User Perormance Bar CSS Ends*/

/*User Task Tabs CSS*/
.allusernav{padding: 18px !important;border-bottom:3px solid transparent;font-size:18px;font-weight: 600}
.currnavtab{border-bottom:3px solid #4db6ac !important}
/*User Task Tab CSS ends*/

/*Media Queries*/
@media only screen and (max-width:950px){
.dashpg .tasktrackwrap, .dashpg #pietrack, .dashpg #usermonthlytrack, .dashpg #usercattrack{width: 95%}
.dashpg #tasktrack, .performancecanvas{width: auto}
}
</style>