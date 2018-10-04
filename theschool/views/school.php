<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
        <script>
            $(function () {
                showCourses();
                showStudents();
                courseNumber = 0;
                studentNumber = 0;
                setTimeout(function () {
                    $(".mainContainer").html("<div class='alert alert-info'><h5>Number of courses in school: " + courseNumber + "</h5></div><div class='alert alert-info'><h5>Number of students in school: " + studentNumber + "</h5></div>");

                }, 1000);
                function uploadCourseImg() {
                    var courseImg = document.getElementById("course_image").files[0];
                    var myFormData = new FormData();
                    myFormData.append('image', courseImg, '.jpg');
                    myFormData.append('name', $("#course_name").val());
                    $.ajax({
                        url: '../controllers/imageUploadController.php',
                        data: myFormData,
                        type: 'POST',
                        success: function (data) {

                            var course_name = $("#course_name").val();
                            var course_description = $("#course_description").val();
                            addCourseToDB(course_name, course_description, data);
                            $("#course_name").val("");
                            $("#course_description").val("");
                            $(".courseFormContainer").hide();
                            $(".courseAdded").show();
                        },
                        cache: false,
                        contentType: false,
                        processData: false
                    });
                }

                function addCourseToDB(course_name, course_description, course_image) {
                    var courseObj = {
                        name: course_name,
                        description: course_description,
                        image: course_image
                    };
                    $.post('../controllers/addCourseController.php', courseObj,
                            function (data) {
                                showCourses();
                            });
                }


                $('#addCourseBtn').click(uploadCourseImg);


                function showCourses() {
                    $(".courseListContainer").html('');
                    $.post('../controllers/getCoursesController.php', {state: 1}, function (data) {
                        var parsedArray = JSON.parse(data);
                        courseNumber = parsedArray.length;
                        $(parsedArray).each(function () {
                            var courseElement = $(` 
            <div class="card singleCourse" data-id=${this.course_id}>
                <h5 class="card-header">${this.course_name}</h5>
                <div class="card-body">
                        <img class="courseImg" src='${ this.course_image }'/>
                </div>
            </div>
`);
                            $(".courseListContainer").append(courseElement);
                        });
                    });
                }




                function uploadStudentImg() {
                    var studentImg = document.getElementById("student_image").files[0];
                    var myFormData = new FormData();
                    myFormData.append('image', studentImg, '.jpg');
                    myFormData.append('name', $("#student_name").val());
                    $.ajax({
                        url: '../controllers/imageUploadController.php',
                        data: myFormData,
                        type: 'POST',
                        success: function (data1) {
                            var student_name = $("#student_name").val();
                            var student_phone = $("#student_phone").val();
                            var student_email = $("#student_email").val();
                            addStudentToDb(student_name, student_phone, student_email, data1);
                            $("#student_name").val("");
                            $("#student_phone").val("");
                            $("#student_email").val("");
                            $(".addStudentForm").hide();
                            $(".studentAdded").show();
                        },
                        cache: false,
                        contentType: false,
                        processData: false
                    });
                }

                function addStudentToDb(student_name, student_phone, student_email, student_image) {
                    var studentObj = {
                        name: student_name,
                        phone: student_phone,
                        email: student_email,
                        image: student_image
                    };
                    $.post('../controllers/addStudentController.php', studentObj,
                            function (data) {
                                showStudents();
                            });
                }

                $('#addStudentBtn').click(uploadStudentImg);


                function showStudents() {
                    $(".studentListContainer").html('');
                    $.post('../controllers/getStudentController.php', {state: 1}, function (data) {
                        var parsedArray = JSON.parse(data);
                        studentNumber = parsedArray.length;
                        $(parsedArray).each(function () {
                            var studentElement = $(` 
            <div class="card singleStudent" data-id=${this.student_id}>
                <h5 class="card-header">${this.student_name}</h5>
                <div class="card-body">
                        <img class="studentImg" src='${ this.student_image }'/>
                        <p class="card-text">${this.student_phone}</p>
                            <p class="card-text">${this.student_email}</p>
                </div>
            </div>
`);
                            $(".studentListContainer").append(studentElement);
                        });
                    });
                }


                $(".courseListContainer").on("click", ".singleCourse", function () {
                    var id = $(this).data("id");
                    $.post('../controllers/getCoursesController.php', {id: id, state: 2}, function (data) {

                        var parsedCourse = JSON.parse(data);
                        $(".mainContainer").html("");
                        var CourseDetailElement = $(`
                    <div class="card courseDetails" id="courseDetail_${parsedCourse.course_id}">
                       <div class="card-header">
                            <h3 class="courseTitle">${parsedCourse.course_name}</h3>
                            
                             
                           <a href='../controllers/deleteCourse.php?id=${parsedCourse.course_id}' class="btn btn-danger deleteCourseBtn"><i class="fas fa-trash-alt"></i> Delete Course</a>
                        
<button type="button" id="editCourseBtn" data-id=${parsedCourse.course_id} class="btn btn-primary" data-toggle="modal" data-target="#editCourseModal">
                       <i class="fas fa-edit"></i> Edit Course 
                    </button>
</div>
                        <div class="card-body">
                            <img class="img-fluid courseLgImg" src='${parsedCourse.course_image}' alt="Card image cap">
                            <p class="card-text">${parsedCourse.course_description}</p>
                        </div>
                    </div>
                            `);

                        $(".mainContainer").append(CourseDetailElement);
                        $(".mainContainer").on("click", "#editCourseBtn", function () {

                            var CourseId = $(this).data("id");
                            $.post('../controllers/getCoursesController.php', {id: CourseId, state: 2}, function (data) {
                                var parsedCourseDetailes = JSON.parse(data);
                                $("#edit_course_name").val(parsedCourseDetailes.course_name);
                                $("#edit_course_description").val(parsedCourseDetailes.course_description);
                                $("#editCourseBtn").data("id", parsedCourseDetailes.course_id);
                                $("#updateCourseBtn").data("id", parsedCourseDetailes.course_id);
                                $("#updateCourseBtn").data("imgUrl", parsedCourseDetailes.course_image);
                                $("#editCourseBtn").data("imgUrl", parsedCourseDetailes.course_image);

                            });
                        });
                    });
                });




                $(".studentListContainer").on("click", ".singleStudent", function () {
                    var StudentId = $(this).data("id");
                    $.post('../controllers/getStudentController.php', {id: StudentId, state: 2}, function (data) {

                        var parsedStudent = JSON.parse(data);
                        $(".mainContainer").html("");
                        var studentDetailElement = $(`
                    <div class="card studentDetails" id="studentDetail_${parsedStudent.student_id}">
  <div class="card-header">
    <h3 class="studentTitle">${parsedStudent.student_name}</h3>
    <a href='../controllers/deleteStudent.php?id=${parsedStudent.student_id}' class="btn btn-danger deleteStudentBtn"><i class="fas fa-trash-alt"></i> Delete Student</a>
    <button type="button" id="editStudenteBtn" data-id=${parsedStudent.student_id} class="btn btn-primary" data-toggle="modal" data-target="#editStudentModal"> <i class="fas fa-edit"></i> Edit Student </button>
  </div>
  <div class="card-body"> <img class="img-fluid studentLgImg" src='${parsedStudent.student_image}' alt="Card image cap">
    <h5><i class="fas fa-phone"></i> ${parsedStudent.student_phone}</h5>
    <a href="mailto:${parsedStudent.student_email}"><i class="fas fa-at"></i> ${parsedStudent.student_email}</p>
  </div>
</div>
                            `);

                        $(".mainContainer").append(studentDetailElement);


                        $(".mainContainer").on("click", "#editStudenteBtn", function () {
                            var StudentId = $(this).data("id");

                            $.post('../controllers/getStudentController.php', {id: StudentId, state: 2}, function (data) {

                                var parsedStudentDetailes = JSON.parse(data);
                                $("#edit_student_name").val(parsedStudentDetailes.student_name);
                                $("#edit_student_phone").val(parsedStudentDetailes.student_phone);
                                $("#edit_student_email").val(parsedStudentDetailes.student_email);
                                $("#editStudentBtn").data("id", parsedStudentDetailes.student_id);
                                $("#updateStudentBtn").data("id", parsedStudentDetailes.student_id);
                                $("#updateStudentBtn").data("imgUrl", parsedStudentDetailes.student_image);
                                $("#editStudentBtn").data("imgUrl", parsedStudentDetailes.student_image);

                            });
                        });
                    });
                });


                $("#editCourseModal").on("click", "#updateCourseBtn", function () {
                    var course_id = $(this).data("id");
                    var course_name = $("#edit_course_name").val();
                    var course_description = $("#edit_course_description").val();
                    var course_image_url = $(this).data("imgUrl");
                    var courseImgFile = document.getElementsByName("course_image")[1].files[0];


                    var myFormData = new FormData();
                    myFormData.append("id", course_id);
                    myFormData.append("name", course_name);
                    myFormData.append("description", course_description);
                    myFormData.append("image_url", course_image_url);
                    myFormData.append("image", courseImgFile);


                    $.ajax({
                        url: '../controllers/editCourseController.php',
                        data: myFormData,
                        type: 'POST',
                        success: function (data) {
                            console.log(data);
                            showCourses();
                            setTimeout(function () {
                                $(".mainContainer").html("Number of courses in school " + courseNumber);

                            }, 100);

                        },
                        cache: false,
                        contentType: false,
                        processData: false
                    });




                });



                $("#editStudentModal").on("click", "#updateStudentBtn", function () {
                    var student_id = $(this).data("id");
                    var student_name = $("#edit_student_name").val();
                    var student_phone = $("#edit_student_phone").val();
                    var student_email = $("#edit_student_email").val();
                    var student_image_url = $(this).data("imgUrl");
                    var studentImgFile = document.getElementsByName("student_image")[2].files[0];


                    var myFormData = new FormData();
                    myFormData.append("id", student_id);
                    myFormData.append("name", student_name);
                    myFormData.append("phone", student_phone);
                    myFormData.append("email", student_email);
                    myFormData.append("image_url", student_image_url);
                    myFormData.append("image", studentImgFile);


                    $.ajax({
                        url: '../controllers/editStudentController.php',
                        data: myFormData,
                        type: 'POST',
                        success: function (data) {
                            showStudents();
                            setTimeout(function () {
                                $(".mainContainer").html("Number of students in school " + studentNumber);

                            }, 100);

                        },
                        cache: false,
                        contentType: false,
                        processData: false
                    });
                });
                $(".addCourseBtn").click(function () {

                });
                $(".addAStudentBtn").click(function () {
                    $(".courseAdded").hide();
                    $(".courseFormContainer").show();
                });
            });
        </script>
    </head>
    <body>

        <!--Add Student Modal Start-->
        <div class="modal fade" id="addStudentModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add a Student</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-success studentAdded" role="alert">
                            Student Added Successfully
                        </div>
                        <div class="addStudentForm">
                            <form>
                                <div class="form-group">
                                    <label for="student_name">Student Name:</label>
                                    <input type="text" class="form-control" name="student_name" id="student_name">
                                </div>
                                <div class="form-group">
                                    <label for="student_phone">Student Phone:</label>
                                    <input type="text" class="form-control" name="student_phone" id="student_phone">
                                </div>
                                <div class="form-group">
                                    <label for="student_email">Student Email:</label>
                                    <input type="text" class="form-control" name="student_email" id="student_email">
                                </div>

                                <div class="form-group">
                                    <label for="student_image">Student Image:</label>
                                    <input type="file" id="student_image" name="student_image">
                                </div>

                                <button type="button" id="addStudentBtn" class="btn btn-primary">Add Student</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Add Student Modal End-->


        <!--Add Course Modal Start-->
        <div class="modal fade" id="addCourseModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add a Course</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-success courseAdded" role="alert">
                            Course Added Successfully
                        </div>
                        <div class="courseFormContainer">
                            <form>
                                <div class="form-group">
                                    <label for="course_name">Course Name:</label>
                                    <input type="text" class="form-control" name="course_name" id="course_name">
                                </div>
                                <div class="form-group">
                                    <label for="course_description">Course Description:</label>
                                    <textarea rows="4"  class="form-control" name="course_description" id="course_description"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="course_image">Course Image:</label>
                                    <input type="file" id="course_image" name="course_image">
                                </div>

                                <button type="button" id="addCourseBtn" class="btn btn-primary">Add Course</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Add Course Modal End-->


        <!--Edit Course Modal Start-->
        <div class="modal fade" id="editCourseModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Course</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="course_name">Course Name:</label>
                                <input type="text" class="form-control" name="course_name" id="edit_course_name">
                            </div>
                            <div class="form-group">
                                <label for="course_description">Course Description:</label>
                                <textarea rows="4"  class="form-control" name="course_description" id="edit_course_description"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="course_image">Course Image:</label>
                                <input type="file" id="edit_course_image" name="course_image">
                                <img src="">
                            </div>

                            <button type="button" id="updateCourseBtn" class="btn btn-primary">Update Course</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--Edit Course Modal End-->


        <!--Edit Student Modal Start-->
        <div class="modal fade" id="editStudentModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Student</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="student_name">Student Name:</label>
                                <input type="text" class="form-control" name="student_name" id="edit_student_name">
                            </div>
                            <div class="form-group">
                                <label for="student_phone">Student Phone:</label>
                                <input type="text" class="form-control" name="student_phone" id="edit_student_phone">
                            </div>
                            <div class="form-group">
                                <label for="student_phone">Student Email:</label>
                                <input type="text" class="form-control" name="student_phone" id="edit_student_email">
                            </div>
                            <div class="form-group">
                                <label for="student_image">Student Image:</label>
                                <input type="file" id="edit_student_image" name="student_image">
                                <img src="">
                            </div>

                            <button type="button" id="updateStudentBtn" class="btn btn-primary">Update Student</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--Edit Student Modal End-->

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 studentListMainContainer">
                    <h2>Students</h2>
                    <button type="button" class="btn btn-primary addAStudentBtn" data-toggle="modal" data-target="#addStudentModal">
                        <i class="fas fa-plus-square"></i> Add a Student 
                    </button>
                    <div class="studentListContainer">

                    </div>
                </div>
                <div class="col-md-3 courseListMainContainer">
                    <h2>Courses</h2>
                    <button type="button" class="btn btn-primary addCourseBtn" data-toggle="modal" data-target="#addCourseModal">
                        <i class="fas fa-plus-square"></i> Add a Course 
                    </button>
                    <div class="courseListContainer">

                    </div>
                </div>
                <div class="col-md-6 mainContainer">

                </div>
            </div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    </body>
</html>