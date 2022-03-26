<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Home</title>
    <link rel="stylesheet" href="../static/css/claimopensource.css">
    <!-- <link rel="stylesheet" href="style.css"> -->
    <style>
@import url("../static/css/color.css");

.container-1{
  position: relative;
}

.blog_right_sidebar{
    float: right;
    width: 15%;
    margin: 30px 30px 0 0;

}

.col-lg-4{
    background-color: var(--light-four) !important;
}
.admin-info{
    margin: 0;
}
    </style>
</head>
<body>
    <div class="container-1">

    <div class="blog_right_sidebar">
    <aside style="background-color: var(--light-three);" class="single_sidebar_widget post_category_widget">
                            <ul style="font-weight:600;" class="list cat-list">
                            </li>
                                <li>
                                    <a href="home.php" class="d-flex">
                                        <p style="color: var(--main-color)">Home</p>
                                        
                                    </a>
                                </li>
                                <li>
                                    <a href="addpolicy.php" class="d-flex">
                                        <p>Add policy</p>
                                        
                                    </a>
                                </li>
                                <li>
                                    <a href="deletepolicy.php" class="d-flex">
                                        <p >Delete Policy</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="approveclaim.php" class="d-flex">
                                        <p>Pending Policy</p>
                                        
                                    </a>
                                </li>
                                <li>
                                    <a href="approvedapp.php" class="d-flex">
                                        <p>Approved Policies</p>
                                        
                                    </a>
                                </li>
                                <li>
                                    <a href="disapprovedfiles.php" class="d-flex">
                                        <p>Disapproved Policies</p>
                                        
                                    </a>
                                </li>
                                <li>
                                    <a href="querries.php" class="d-flex">
                                        <p>Querries</p>
                               
                                    </a>
                                </li>
                                <li>
                                    <a href="logout.php" class="d-flex">
                                        <p>Logout</p>
                                     
                                    </a>
                                </li>
                            </ul>
                        </aside>
                        <div class="admin">
                            <h5>Admin Details</h5>
                            <p class="admin-info">Name: Shuja Ur Rahman</p>
                            <p class="admin-info">UserName: AdminShuja</p>
                            <p class="admin-info">Profile Picture</p>
                            <img src="../static/img/admin.jpg" alt="">

                            <p class="admin-info">Website Designed and Coded By Shuja ur Rahman</p>
                            <p class="admin-info">Faculty Number : 2019CAB009</p>
                            <p class="admin-info">Supervisor: Dr Ziyyyauddin </p>
                            <p class="admin-info">Copyright @2022 All rights reserved.</p>
                        </div>

                        
                        </div>
        

    </div>
</body>
</html>