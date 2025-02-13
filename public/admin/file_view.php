<?php 
require_once 'login_config.php';
global $dbc;
$id = $_GET['value'];

?>
<!DOCTYPE html>
<html lang="en" class="loading" ng-app="myapp">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
      <meta name="description" content="Student Project Sentimental Analysis">
    <meta name="keywords" content=" Student Project - Sentimental Analysis">
    <meta name="author" content="Code Snypers">
    <title>Student Project|Sentimental Analysis</title>
        
        <link rel="apple-touch-icon" sizes="60x60" href="app-assets/img/ico/apple-icon-60.html">
        <link rel="apple-touch-icon" sizes="76x76" href="app-assets/img/ico/apple-icon-76.html">
        <link rel="apple-touch-icon" sizes="120x120" href="app-assets/img/ico/apple-icon-120.html">
        <link rel="apple-touch-icon" sizes="152x152" href="app-assets/img/ico/apple-icon-152.html">
        <!--link rel="shortcut icon" type="image/x-icon" href="app-assets/img/ico/favicon.ico">
        <link rel="shortcut icon" type="image/png" href="app-assets/img/ico/favicon-32.png"-->
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-touch-fullscreen" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="default">
        <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700,900|Montserrat:300,400,500,600,700,800,900" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="app-assets/fonts/feather/style.min.css">
        <link rel="stylesheet" type="text/css" href="app-assets/fonts/simple-line-icons/style.css">
        <link rel="stylesheet" type="text/css" href="app-assets/fonts/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/perfect-scrollbar.min.css">
        <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/prism.min.css">
        <link rel="stylesheet" type="text/css" href="app-assets/css/app.css">
        <link rel="stylesheet" type="text/css" href="app-assets/css/custom.css">
        <link rel="stylesheet" type="text/css" href="app-assets/sweetalert2/css/sweetalert2.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>
        <style>
            form.form-horizontal .form-group .label-control{
                text-align: left; 
            }
        </style>
    </head>
   

    <body data-col="2-columns" class=" 2-columns ">
       <div class="wrapper nav-collapsed menu-collapsed">
      <div data-active-color="white" data-background-color="purple-bliss" data-image="app-assets/img/sidebar-bg/01.jpg" class="app-sidebar">
           <div class="sidebar-header">
                    <div class="logo clearfix"><a href="dashboard.html" class="logo-text float-left">
                            <span class="text align-middle">Analysis</span></a><a id="sidebarToggle" href="javascript:;" class="nav-toggle d-none d-sm-none d-md-none d-lg-block"><i data-toggle="collapsed" class="ft-toggle-left toggle-icon"></i></a><a id="sidebarClose" href="javascript:;" class="nav-close d-block d-md-block d-lg-none d-xl-none"><i class="ft-x"></i></a></div>
                </div>
                <div class="sidebar-content">
                    <div class="nav-container" ng-controller="logout">
            <ul id="main-menu-navigation" data-menu="menu-navigation" class="navigation navigation-main">
                            
                            <?php 
$stmt = $dbc->prepare("SELECT * from tweets");
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);  
foreach ($result as $results ) {
    //print_r($results); exit;

?>
 <li class="nav-item"><a href="file_view.php?value=<?php echo $results['id'];?>"><i class="ft-package"></i><span data-i18n="" class="menu-title"><?php echo  $results['body']; ?></span></a>
                            </li>
                           
                            
                           
                        <?php }?>
                         <li class="nav-item"><a href="" ng-click="logout();" target="_self"><i class="ft-lock"></i><span data-i18n="" class="menu-title">Logout</span></a>
                            </li>
                        </ul>
          </div>
                </div>
                <div class="sidebar-background"></div>
                </div>
            <div class="main-panel">
                <div class="main-content">
                    <div class="content-wrapper"><!--Extended Table starts-->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                   
                                <section id="multi-column">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Postive</h4>
                                        </div>
                                        <div class="card-body" ng-controller="listdata_customer_enquiry">
                                            <div class="card-block">
                                               <table class="table table-striped table-bordered" ID="example">
                                                    <thead>
                                                        <tr>
                                                         <th>Review</th>
                                                         <th>Location</th>
                                                          </tr>
                                                    </thead>
            <?php $stmt = $dbc->prepare("SELECT * from company_review where result='1' and company_id='$id'");
                  $stmt->execute();
                  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($result  as $value) {
             ?> 
                    
                              <td><?php echo $value['review']; ?></td>
                               <td><?php echo $value['location']; ?></td>
                              </tr>
             <?php }  ?>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section> 
                        <section id="multi-column">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Negative</h4>
                                        </div>
                                        <div class="card-body" ng-controller="listdata_customer_enquiry">
                                            <div class="card-block">
                                               <table class="table table-striped table-bordered" ID="example1">
                                                    <thead>
                                                        <tr>
                                                         <th>Review</th>
                                                         <th>Location</th>
                                                          </tr>
                                                    </thead>
            <?php $stmt = $dbc->prepare("SELECT * from company_review where result='2' and company_id='$id'");
                  $stmt->execute();
                  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($result  as $value) {
             ?> 
                    
                              <td><?php echo $value['review']; ?></td>
                               <td><?php echo $value['location']; ?></td>
                              </tr>
             <?php }  ?>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section id="multi-column">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Netural</h4>
                                        </div>
                                        <div class="card-body" ng-controller="listdata_customer_enquiry">
                                            <div class="card-block">
                                               <table class="table table-striped table-bordered" ID="example2">
                                                    <thead>
                                                        <tr>
                                                         <th>Review</th>
                                                         <th>Location</th>
                                                          </tr>
                                                    </thead>
            <?php $stmt = $dbc->prepare("SELECT * from company_review where result='3' and company_id='$id'");
                  $stmt->execute();
                  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($result  as $value) {
             ?> 
                    
                              <td><?php echo $value['review']; ?></td>
                               <td><?php echo $value['location']; ?></td>
                              </tr>
             <?php }  ?>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>   
                            </div>
                                
                        </div>

                    </div>
                        
                </div>
                    

                <footer class="footer footer-static footer-light">
                    <p class="clearfix text-muted text-sm-center px-2"><span>Copyright  &copy; 2018 <a href="http://codesnypers.com/" id="pixinventLink" target="_blank" class="text-bold-800 primary darken-2">Code Snypers</a>, All rights reserved. </span></p>
                </footer>

            </div>
        </div>
        
        <script src="app-assets/vendors/js/core/jquery-3.2.1.min.js" type="text/javascript"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
        <script src="app-assets/ajs/angular-filter.js" type="text/javascript"></script>
        <script src="app-assets/vendors/js/core/popper.min.js" type="text/javascript"></script>
        <script src="app-assets/vendors/js/core/bootstrap.min.js" type="text/javascript"></script>
        <script src="app-assets/vendors/js/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
        <script src="app-assets/vendors/js/prism.min.js" type="text/javascript"></script>
        <script src="app-assets/vendors/js/jquery.matchHeight-min.js" type="text/javascript"></script>
        <script src="app-assets/vendors/js/screenfull.min.js" type="text/javascript"></script>
        <script src="app-assets/vendors/js/pace/pace.min.js" type="text/javascript"></script>
        <script src="app-assets/vendors/js/pickadate/picker.js" type="text/javascript"></script>
        <script src="app-assets/vendors/js/pickadate/picker.date.js" type="text/javascript"></script>
        <script src="app-assets/vendors/js/pickadate/picker.time.js" type="text/javascript"></script>
        <script src="app-assets/vendors/js/pickadate/legacy.js" type="text/javascript"></script>
        <script src="app-assets/vendors/js/dragula.min.js" type="text/javascript"></script>
        <script src="app-assets/js/pick-a-datetime.js" type="text/javascript"></script>
        <script src="app-assets/js/app-sidebar.js" type="text/javascript"></script>
        <script src="app-assets/js/notification-sidebar.js" type="text/javascript"></script>
        <script src="app-assets/js/customizer.js" type="text/javascript"></script>
        <script src="app-assets/js/taskboard.js" type="text/javascript"></script>
        <script src="app-assets/sweetalert2/js/sweetalert2.all.min.js" type="text/javascript"></script>
        <script src="app-assets/sweetalert2/js/sweetalert2.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>
        <script>
          //   var session = localStorage.getItem('session_id');
      //  if (!session) {
      //     window.location.href = 'index.html';
      //  }else if(session){
      //      if(session !='1'){
      //          window.location.href = 'index.html';
      //      }

      //  }
        
            var fetch = angular.module('myapp', []);
          fetch.controller('logout', ['$scope', '$http', function ($scope, $http) {
           $scope.logout = function () {
              
                localStorage.clear();
                window.location.href = 'index.html';
            };
             }]);
            $(document).ready(function() {
 $('#example').DataTable();
 $('#example1').DataTable();
 $('#example2').DataTable();
});
   
            </script>
  </body>
</html>
