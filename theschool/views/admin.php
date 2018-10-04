<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script>
            $(function () {
                adminsNumber = 0;

                showAdmins();

                setTimeout(function () {
                    $(".userMainDisplay").html("<div class='alert alert-info'><h5>Number of Users is "+adminsNumber+"</h5></div>" );

                }, 100);

                function uploadImg() {
                    var adminImg = document.getElementById("user_img").files[0];
                    var myFormData = new FormData();
                    myFormData.append('image', adminImg, '.jpg');
                    myFormData.append('name', $("#user_name").val());
                    $.ajax({
                        url: '../controllers/imageUploadController.php',
                        data: myFormData,
                        type: 'POST',
                        success: function (data) {
                            var user_name = $("#user_name").val();
                            var user_email = $("#user_email").val();
                            var user_phone = $("#user_phone").val();
                            var user_role = $("#user_role").val();
                            var user_password = $("#user_password").val();
                            addUserToDB(user_name, user_email, user_phone, user_role, user_password, data);
                            $("#user_name").val("");
                            $("#user_email").val("");
                            $("#user_phone").val("");
                            $("#user_role").val("");
                            $("#user_password").val("");
                            $(".addUserForm").hide();
                            $(".userAdded").show();
                        },
                        cache: false,
                        contentType: false,
                        processData: false
                    });
                }


                function  addUserToDB(user_name, user_email, user_phone, user_role, user_password, user_image) {
                    var adminObj = {name: user_name, phone: user_phone, email: user_email, password: user_password, role: user_role, image: user_image};
                    $.post('../controllers/addUserController.php', adminObj,
                            function (data) {
                                showAdmins();
                            });
                }

                $('#loginBtn').click(uploadImg);
                function showAdmins() {
                    $(".userListContainer").html('');
                    $.post('../controllers/getAdminsController.php', {state: 1}, function (data) {
                        var parsedArray = JSON.parse(data);
                        adminsNumber = parsedArray.length;
                        $(parsedArray).each(function () {
                            var adminElement = $(` 
                       <div class="card singleAdmin" data-id=${this.id}> 
                        <h5 class="card-header">${this.user_name}</h5>
                        <div class="card-body">
                            <div class="userTopImg">
                                <img src='${this.user_image}'/>
                            </div>
                            <div class="userTopInfo">
                                <p class="card-text">Role: ${this.user_role}</p>
                                <p class="card-text">Phone: ${this.user_phone}</p>
                                <p class="card-text">Email: ${this.user_email}</p>
                            </div>
                        </div>
                    </div>`);
                            $(".userListContainer").append(adminElement);
                        });
                    });
                }

                $(".userListContainer").on("click", ".singleAdmin", function () {
                    var id = $(this).data("id");
                    $.post('../controllers/getAdminsController.php', {id: id, state: 2}, function (data) {
                        var parsedAdmin = JSON.parse(data);
                        $(".userMainDisplay").html("");
                        var adminDetailElement = $(`
                    <div class="card adminDetails" id="adminDetail_${parsedAdmin.id}">
                        <div class="card-header">
<h3 class="userNameTop">${parsedAdmin.user_name}</h3>
            <a href='../controllers/deleteUser.php?id=${parsedAdmin.id}' class="deleteUserBtn btn btn-danger"><i class="fas fa-trash-alt"></i> Delete User</a>
<button type="button" id="editAdminBtn" data-id=${parsedAdmin.id} class="btn btn-primary" data-toggle="modal" data-target="#editUserModal">
                       <i class="fas fa-edit"></i> Edit User 
                    </button>
</div>
                        <div class="card-body">
                            <img class="adminLgImg" src='${parsedAdmin.user_image}' alt="Card image cap">
                            <div>
                           <p class="card-text"><i class="fas fa-address-card"></i> ${parsedAdmin.user_role}</p>
                            <p class="card-text"><i class="fas fa-phone"></i> ${parsedAdmin.user_phone}</p>
                            <a href="mailto:${parsedAdmin.user_email}"><i class="fas fa-at"></i> ${parsedAdmin.user_email}</a>
</div>
            
                        </div>
                    </div>
                            `);
                        $(".userMainDisplay").append(adminDetailElement);
                        $(".userMainDisplay").on("click", "#editAdminBtn", function () {
                            var userId = $(this).data("id");
                            $.post('../controllers/getAdminsController.php', {id: userId, state: 2}, function (data) {
                                var parsedAdminDetailes = JSON.parse(data);
                                $("input#edit_user_name").val(parsedAdminDetailes.user_name);
                                $("input#edit_user_email").val(parsedAdminDetailes.user_email);
                                $("input#edit_user_phone").val(parsedAdminDetailes.user_phone);

                                if (parsedAdminDetailes.user_role == "manager") {
                                    $("select#edit_user_role").val(1);
                                } else {
                                    $("select#edit_user_role").val(2);
                                }
                                $("#editUserBtn").data("id", parsedAdminDetailes.id);
                                $("#editUserBtn").data("imgUrl", parsedAdminDetailes.user_image);
                                $("input#edit_user_password").val(parsedAdminDetailes.user_password);
                            });
                        });
                    });
                });

                $("#editUserModal").on("click", "#editUserBtn", function () {
                    var user_id = $(this).data("id");
                    var user_name = $("#edit_user_name").val();
                    var user_email = $("input#edit_user_email").val();
                    var user_phone = $("input#edit_user_phone").val();
                    var user_role = $("select#edit_user_role").val();
                    if (user_role == 1) {
                        user_role = "manager";
                    } else if (user_role == 2) {
                        user_role = "sales";
                    }
                    var user_password = $("input#edit_user_password").val();
                    var user_image_url = $(this).data("imgUrl");
                    var userImgFile = document.getElementById("edit_user_img").files[0];



                    var myFormData = new FormData();
                    myFormData.append("id", user_id);
                    myFormData.append("name", user_name);
                    myFormData.append("email", user_email);
                    myFormData.append("phone", user_phone);
                    myFormData.append("role", user_role);
                    myFormData.append("password", user_password);
                    myFormData.append("image_url", user_image_url);
                    myFormData.append("image", userImgFile);


                    $.ajax({
                        url: '../controllers/editUserController.php',
                        data: myFormData,
                        type: 'POST',
                        success: function (data) {

                            showAdmins();
                            setTimeout(function () {
                                $(".userMainDisplay").html("Number of admins in school " + adminsNumber);

                            }, 100);

                        },
                        cache: false,
                        contentType: false,
                        processData: false
                    });
                    debugger;




                });







            });
        </script>
    </head>
    <body>

        <!-- Add User Modal -->
        <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> Add a User <i class="fas fa-user-plus"></i></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-success userAdded" role="alert">
                            User Added Successfully
                        </div>
                        <div class="addUserForm">
                            <form>
                                <div class="form-group">
                                    <label for="user_name">Name:</label>
                                    <input required type="text" class="form-control" name="user_name" id="user_name">
                                    <p class="errMsg noName">
                                        Please Enter a Name
                                    </p>
                                </div>
                                <div class="form-group">
                                    <label for="user_email">Email:</label>
                                    <input required type="text" class="form-control" name="user_email" id="user_email">
                                    <p class="errMsg noEmail">
                                        Please Enter an Email
                                    </p>
                                </div>
                                <div class="form-group">
                                    <label for="user_phone">Phone:</label>
                                    <input required type="text" class="form-control" name="user_phone" id="user_phone">
                                    <p class="errMsg noPhone">
                                        Please Enter a Phone Number
                                    </p>
                                </div>
                                <div class="form-group">
                                    <label for="user_role">Role:</label>
                                    <select required id="user_role" name="user_role">
                                        <option>manager</option>
                                        <option>sales</option>
                                    </select>
                                    <p class="errMsg noRole">
                                        Please Enter a Role
                                    </p>
                                </div>
                                <div class="form-group">
                                    <label for="user_password">Password:</label>
                                    <input required type="text" class="form-control" name="user_password" id="user_password">
                                    <p class="errMsg noPass">
                                        Please Enter a Password
                                    </p>
                                </div>
                                <div class="form-group">
                                    <label for="user_img">Image:</label>
                                    <input required type="file" id="user_img">
                                    <p class="errMsg noImg">
                                        Please Enter an Image
                                    </p>
                                </div>
                                <button type="button" id="loginBtn">Submit</button>
                            </form>
                        </div>
                    </div>
                    <!--<div class="modal-footer"></div>-->
                </div>
            </div> 
        </div>

        <!-- Edit User Modal -->
        <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> Edit User <i class="fas fa-user-plus"></i></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="user_name">Name:</label>
                                <input type="text" class="form-control" name="user_name" id="edit_user_name">
                            </div>
                            <div class="form-group">
                                <label for="user_email">Email:</label>
                                <input type="text" class="form-control" name="user_email" id="edit_user_email">
                            </div>
                            <div class="form-group">
                                <label for="user_phone">Phone:</label>
                                <input type="text" class="form-control" name="user_phone" id="edit_user_phone">
                            </div>
                            <div class="form-group">
                                <label for="user_role">Role:</label>
                                <select id="edit_user_role" name="user_role">
                                    <option value="1">manager</option>
                                    <option value="2">sales</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="user_password">Password:</label>
                                <input type="text" class="form-control" name="user_password" id="edit_user_password">
                            </div>
                            <div class="form-group">
                                <label for="user_img">Image:</label>
                                <input type="file" id="edit_user_img">
                            </div>
                            <button type="button" id="editUserBtn">Submit</button>
                            <div class="alert alert-danger" role="alert" id="loginerrClass">
                                <p id="loginerr"></p>
                            </div>
                        </form>
                    </div>
                    <!--<div class="modal-footer"></div>-->
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 userListMainContainer">
                    <h2>Users</h2>
                    <button type="button" class="btn btn-primary addUserBtn" data-toggle="modal" data-target="#addUserModal">
                        Add a User <i class="fas fa-user-plus"></i>
                    </button>
                    <div class="userListContainer"></div>
                </div>
                <div class="col-md-8 userMainDisplay"></div>
            </div>
        </div>


        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
    </body>
</html>