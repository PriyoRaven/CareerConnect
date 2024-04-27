<?php 
    session_start();
    if(!isset($_SESSION['mail'])){
        header("Location: ../../LoginandRegister/studentLogin.php");
    }
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Resume Page</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- custom css -->
    <link rel="stylesheet" href="resume.css">
    <!-- font awesome -->
    <script src="https://kit.fontawesome.com/0d6185a30c.js" crossorigin="anonymous"></script>
</head>

<?php 
    require '../../../dbconnect.php';

    if (isset($_SESSION['mail'])){
        $email = $_SESSION['mail'];
    } else {
        echo "<script>alert('Error: Session is not working.')</script>";
    }
    $sql = "SELECT * FROM `stu_personal_details` WHERE `email` = '$email'";
    $student_details = $conn->query($sql);
?>

<body>

    <a href="../../landingPage/landingStudent.php" class="goBack"><i class="back-button fa-regular fa-circle-left"></i></a>

    <?php
        while($row = mysqli_fetch_assoc($student_details)){
    ?>

    <section class="heading-main">
        <div class="main-topic">
            <h1>Build your resume/CV here.</h1>
        </div>
    </section>

    <section id="about-sc" class="">
        <div class="container">
            <div class="about-cnt">
                <form action="" class="cv-form" id="cv-form">
                    <div class="cv-form-blk">
                        <div class="cv-form-row-title">
                            <h3>about you section</h3>
                        </div>
                        <div class="cv-form-row cv-form-row-about">
                            <div class="cols-3">
                                <div class="form-elem">
                                    <label for="" class="form-label">First Name</label>
                                    <input name="firstname" type="text" value="<?php echo $row["F_name"];?>" class="form-control firstname" id=""
                                        onkeyup="generateCV()" placeholder="e.g. John">
                                    <span class="form-text"></span>
                                </div>
                                <div class="form-elem">
                                    <label for="" class="form-label">Middle Name <span
                                            class="opt-text">(optional)</span></label>
                                    <input name="middlename" type="text" class="form-control middlename" id=""
                                        onkeyup="generateCV()" placeholder="e.g. Herbert">
                                    <span class="form-text"></span>
                                </div>
                                <div class="form-elem">
                                    <label for="" class="form-label">Last Name</label>
                                    <input name="lastname" type="text" value="<?php echo $row["L_name"];?>" class="form-control lastname" id=""
                                        onkeyup="generateCV()" placeholder="e.g. Doe">
                                    <span class="form-text"></span>
                                </div>
                            </div>

                            <div class="cols-3">
                                <div class="form-elem">
                                    <label for="" class="form-label">Your Image</label>
                                    <input name="image" type="file" class="form-control image" id="" accept="image/*"
                                        onchange="previewImage()">
                                </div>
                                <div class="form-elem">
                                    <label for="" class="form-label">Designation (optional)</label>
                                    <input name="designation" type="text" class="form-control designation" id=""
                                        onkeyup="generateCV()" placeholder="e.g. Sr. Product Manager">
                                    <span class="form-text"></span>
                                </div>
                                <div class="form-elem">
                                    <label for="" class="form-label">Address</label>
                                    <input name="address" type="text" class="form-control address" id=""
                                        onkeyup="generateCV()" placeholder="e.g. Lake Street-23">
                                    <span class="form-text"></span>
                                </div>
                            </div>

                            <div class="cols-3">
                                <div class="form-elem">
                                    <label for="" class="form-label">Email</label>
                                    <input name="email" type="text" value="<?php echo $row["email"];?>" class="form-control email" id=""
                                        onkeyup="generateCV()" placeholder="e.g. johndoe@gmail.com">
                                    <span class="form-text"></span>
                                </div>
                                <div class="form-elem">
                                    <label for="" class="form-label">Phone No:</label>
                                    <input name="phoneno" type="text" value="<?php echo $row["phone_no"];?>" class="form-control phoneno" id=""
                                        onkeyup="generateCV()" placeholder="e.g. 8899112233, 567-654-002">
                                    <span class="form-text"></span>
                                </div>
                                <div class="form-elem">
                                    <label for="" class="form-label">About</label>
                                    <input name="summary" type="text" class="form-control summary" id=""
                                        onkeyup="generateCV()" placeholder="e.g. I am hard working">
                                    <span class="form-text"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="cv-form-blk">
                        <div class="cv-form-row-title">
                            <h3>education</h3>
                        </div>

                        <div class="row-separator repeater">
                            <div class="repeater" data-repeater-list="group-c">
                                <div data-repeater-item>
                                    <div class="cv-form-row cv-form-row-experience">
                                        <div class="cols-3">
                                            <div class="form-elem">
                                                <label for="" class="form-label">School</label>
                                                <input name="edu_school" type="text"
                                                    placeholder="e.g. school, intitution, collge or university name"
                                                    class="form-control edu_school" id="" onkeyup="generateCV()">
                                                <span class="form-text"></span>
                                            </div>
                                            <div class="form-elem">
                                                <label for="" class="form-label">Degree</label>
                                                <input name="edu_degree" type="text"
                                                    placeholder="e.g. secondary, senior secondary, graduate, etc."
                                                    class="form-control edu_degree" id="" onkeyup="generateCV()">
                                                <span class="form-text"></span>
                                            </div>
                                            <div class="form-elem">
                                                <label for="" class="form-label">City</label>
                                                <input name="edu_city" type="text" class="form-control edu_city" id=""
                                                    onkeyup="generateCV()">
                                                <span class="form-text"></span>
                                            </div>
                                        </div>

                                        <div class="cols-3">
                                            <div class="form-elem">
                                                <label for="" class="form-label">Start Date</label>
                                                <input name="edu_start_date" type="date"
                                                    class="form-control edu_start_date" id="" onkeyup="generateCV()">
                                                <span class="form-text"></span>
                                            </div>
                                            <div class="form-elem">
                                                <label for="" class="form-label">End Date</label>
                                                <input name="edu_graduation_date" type="date"
                                                    class="form-control edu_graduation_date" id=""
                                                    onkeyup="generateCV()">
                                                <span class="form-text"></span>
                                            </div>
                                            <div class="form-elem">
                                                <label for="" class="form-label">Description</label>
                                                <input name="edu_description" type="text"
                                                    class="form-control edu_description" id="" onkeyup="generateCV()">
                                                <span class="form-text"></span>
                                            </div>
                                        </div>

                                        <button data-repeater-delete type="button"
                                            class="repeater-remove-btn">-</button>
                                    </div>
                                </div>
                            </div>
                            <button type="button" data-repeater-create value="Add" class="repeater-add-btn">Add
                                another</button>
                        </div>
                    </div>

                    <div class="cv-form-blk">
                        <div class="cv-form-row-title">
                            <h3>experience</h3>
                        </div>

                        <div class="row-separator repeater">
                            <div class="repeater" data-repeater-list="group-b">
                                <div data-repeater-item>
                                    <div class="cv-form-row cv-form-row-experience">
                                        <div class="cols-3">
                                            <div class="form-elem">
                                                <label for="" class="form-label">Title</label>
                                                <input name="exp_title" placeholder="e.g. Junior web developer"
                                                    type="text" class="form-control exp_title" id=""
                                                    onkeyup="generateCV()">
                                                <span class="form-text"></span>
                                            </div>
                                            <div class="form-elem">
                                                <label for="" class="form-label">Company / Organization</label>
                                                <input name="exp_organization" type="text"
                                                    class="form-control exp_organization"
                                                    placeholder="e.g. tata, infosys" id="" onkeyup="generateCV()">
                                                <span class="form-text"></span>
                                            </div>
                                            <div class="form-elem">
                                                <label for="" class="form-label">Location</label>
                                                <input name="exp_location" type="text" class="form-control exp_location"
                                                    id="" onkeyup="generateCV()">
                                                <span class="form-text"></span>
                                            </div>
                                        </div>

                                        <div class="cols-3">
                                            <div class="form-elem">
                                                <label for="" class="form-label">Start Date</label>
                                                <input name="exp_start_date" type="date"
                                                    class="form-control exp_start_date" id="" onkeyup="generateCV()">
                                                <span class="form-text"></span>
                                            </div>
                                            <div class="form-elem">
                                                <label for="" class="form-label">End Date</label>
                                                <input name="exp_end_date" type="date" class="form-control exp_end_date"
                                                    id="" onkeyup="generateCV()">
                                                <span class="form-text"></span>
                                            </div>
                                            <div class="form-elem">
                                                <label for="" class="form-label">Description</label>
                                                <input name="exp_description" type="text"
                                                    class="form-control exp_description" id="" onkeyup="generateCV()">
                                                <span class="form-text"></span>
                                            </div>
                                        </div>

                                        <button data-repeater-delete type="button"
                                            class="repeater-remove-btn">-</button>
                                    </div>
                                </div>
                            </div>
                            <button type="button" data-repeater-create value="Add" class="repeater-add-btn">Add
                                another</button>
                        </div>
                    </div>

                    <div class="cv-form-blk">
                        <div class="cv-form-row-title">
                            <h3>projects</h3>
                        </div>

                        <div class="row-separator repeater">
                            <div class="repeater" data-repeater-list="group-d">
                                <div data-repeater-item>
                                    <div class="cv-form-row cv-form-row-experience">
                                        <div class="cols-3">
                                            <div class="form-elem">
                                                <label for="" class="form-label">Project Name</label>
                                                <input name="proj_title" type="text" class="form-control proj_title"
                                                    id="" onkeyup="generateCV()">
                                                <span class="form-text"></span>
                                            </div>
                                            <div class="form-elem">
                                                <label for="" class="form-label">Project link</label>
                                                <input name="proj_link" type="text" class="form-control proj_link" id=""
                                                    onkeyup="generateCV()">
                                                <span class="form-text"></span>
                                            </div>
                                            <div class="form-elem">
                                                <label for="" class="form-label">Description</label>
                                                <input name="proj_description" type="text"
                                                    class="form-control proj_description" id="" onkeyup="generateCV()">
                                                <span class="form-text"></span>
                                            </div>
                                        </div>
                                        <button data-repeater-delete type="button"
                                            class="repeater-remove-btn">-</button>
                                    </div>
                                </div>
                            </div>
                            <button type="button" data-repeater-create value="Add" class="repeater-add-btn">Add
                                another</button>
                        </div>
                    </div>

                    <div class="cv-form-blk">
                        <div class="cv-form-row-title">
                            <h3>achievements</h3>
                        </div>

                        <div class="row-separator repeater">
                            <div class="repeater" data-repeater-list="group-a">
                                <div data-repeater-item>
                                    <div class="cv-form-row cv-form-row-achievement">
                                        <div class="cols-2">
                                            <div class="form-elem">
                                                <label for="" class="form-label">Title</label>
                                                <input name="achieve_title" type="text"
                                                    class="form-control achieve_title" id="" onkeyup="generateCV()"
                                                    placeholder="e.g. johndoe@gmail.com">
                                                <span class="form-text"></span>
                                            </div>
                                            <div class="form-elem">
                                                <label for="" class="form-label">Description</label>
                                                <input name="achieve_description" type="text"
                                                    class="form-control achieve_description" id=""
                                                    onkeyup="generateCV()" placeholder="e.g. johndoe@gmail.com">
                                                <span class="form-text"></span>
                                            </div>
                                        </div>
                                        <button data-repeater-delete type="button"
                                            class="repeater-remove-btn">-</button>
                                    </div>
                                </div>
                            </div>
                            <button type="button" data-repeater-create value="Add" class="repeater-add-btn">Add
                                another</button>
                        </div>
                    </div>

                    <div class="cv-form-blk">
                        <div class="cv-form-row-title">
                            <h3>skills</h3>
                        </div>

                        <div class="row-separator repeater">
                            <div class="repeater" data-repeater-list="group-e">
                                <div data-repeater-item>
                                    <div class="cv-form-row cv-form-row-skills">
                                        <div class="form-elem">
                                            <label for="" class="form-label">Skill</label>
                                            <input name="skill" type="text" class="form-control skill" id=""
                                                onkeyup="generateCV()">
                                            <span class="form-text"></span>
                                        </div>

                                        <button data-repeater-delete type="button"
                                            class="repeater-remove-btn">-</button>
                                    </div>
                                </div>
                            </div>
                            <button type="button" data-repeater-create value="Add" class="repeater-add-btn">Add
                                another</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <hr>

    <section class="cv-form-preview">
        <div class="cv-form-preview-inner">
            <h3>Preview Area</h3>
        </div>
    </section>

    <section id="preview-sc" class="print_area">
        <div class="container">
            <div class="preview-cnt">
                <div class="preview-cnt-l bg-green text-white">
                    <div class="preview-blk">
                        <div class="preview-image">
                            <img src="" alt="" id="image_dsp">
                        </div>
                        <div class="preview-item preview-item-name">
                            <span class="preview-item-val fw-6" id="fullname_dsp"></span>
                        </div>
                        <div class="preview-item">
                            <span class="preview-item-val text-uppercase fw-6 ls-1" id="designation_dsp"></span>
                        </div>
                    </div>

                    <div class="preview-blk">
                        <div class="preview-blk-title">
                            <h3>about</h3>
                        </div>
                        <div class="preview-blk-list">
                            <div class="preview-item">
                                <span class="preview-item-val" id="phoneno_dsp"></span>
                            </div>
                            <div class="preview-item">
                                <span class="preview-item-val" id="email_dsp"></span>
                            </div>
                            <div class="preview-item">
                                <span class="preview-item-val" id="address_dsp"></span>
                            </div>
                            <div class="preview-item">
                                <span class="preview-item-val" id="summary_dsp"></span>
                            </div>
                        </div>
                    </div>

                    <div class="preview-blk">
                        <div class="preview-blk-title">
                            <h3>skills</h3>
                        </div>
                        <div class="skills-items preview-blk-list" id="skills_dsp">
                            <!-- skills list here -->
                        </div>
                    </div>
                </div>

                <div class="preview-cnt-r bg-white">
                    <div class="preview-blk">
                        <div class="preview-blk-title">
                            <h3>educations</h3>
                        </div>
                        <div class="educations-items preview-blk-list" id="educations_dsp"></div>
                    </div>

                    <div class="preview-blk">
                        <div class="preview-blk-title">
                            <h3>experiences</h3>
                        </div>
                        <div class="experiences-items preview-blk-list" id="experiences_dsp"></div>
                    </div>

                    <div class="preview-blk">
                        <div class="preview-blk-title">
                            <h3>projects</h3>
                        </div>
                        <div class="projects-items preview-blk-list" id="projects_dsp"></div>
                    </div>
                    <div class="preview-blk">
                        <div class="preview-blk-title">
                            <h3>Achievements</h3>
                        </div>
                        <div class="achievements-items preview-blk-list" id="achievements_dsp"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="print-btn-sc">
        <div class="container">
            <div class="for-the-right">
                <button type="button" class="print-btn btn btn-primary" onclick="printCV()">Print CV</button>
                <p class="notice">*Note: During print as PDF, only print the pages you have filled. Empty pages
                    can also get printed.</p>
            </div>
        </div>
    </section>

    <?php

        }
    ?>

    <!-- jquery cdn -->
    <script src="https://code.jquery.com/jquery-3.6.4.js"
        integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <!-- jquery repeater cdn -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.js"
        integrity="sha512-bZAXvpVfp1+9AUHQzekEZaXclsgSlAeEnMJ6LfFAvjqYUVZfcuVXeQoN5LhD7Uw0Jy4NCY9q3kbdEXbwhZUmUQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- custom js -->
    <script src="../../../javaScripts/resume/app.js"></script>
    <!-- app js -->
    <script src="../../../javaScripts/resume/script.js"></script>
</body>

</html>