<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<meta name="description" content="EngineRay Engineer's dashboard page" />
		<meta name="keywords"    content="my profile, my exams, my interviews, my jobs, contact us, settings" />
		<meta name="author"      content="Serena Wu" /> 
		<meta name="viewpoint"   content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/dash_style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-2+FdTlStPhuWnJYPLtMSPJJ9DkMTP+ilr7FJsiGTYLez44xK22IaHwLb5K5ruPys9XhJZ8R/Oti0B6+g16/3hA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <title>EngineRay | Engineer Dashboard</title>
    </head>
    <body>
        <header>
            <div class="logo">
                <a href="dash_eng.php"><img src="images/logo.png" alt="EngineRay Logo"></a>
            </div>
            <div class="user-info">
                <a href="notification_eng.php" class="notification"><i class="fas fa-bell"></i></a>
                <a href="settings.php" class="settings"><i class="fas fa-cog"></i></a>
                <form action="logout.php" method="POST">
                    <button type="submit" class="logout" name="logout">Logout</button>
                </form>

            </div>
        </header>

        <nav class="topnav">
            <ul>
                <li><a href="my_profile_eng.php">My Profile</a></li>
                <li><a href="dkm_eng.php">Domain Knowledge Metrics</a></li>
                <li><a href="my_interviews_eng.php">My Interviews</a></li>
                <li><a href="my_offers_eng.php">My Offers</a></li>
                <li><a href="contactus.php">Contact Us</a></li>
            </ul>
        </nav>
        <main>
            <div class="dash">
                <h1>Welcome to EngineRay! </h1>
                <p>Let's complete the following tasks first!</p>
                
            </div>
            <div class="cards">
                <div class="card">
                    <a class="card" href="initialize_my_profile_eng.php">
                        <h2>Update My Profile</h2>
                    </a>
                    <p>It is important to let potential employers to know you better!</p>
                    <img src="images/completeMyProfile.jpg" alt="Complete My Profile">
                </div>
                <div class="card">
                    <a class="card" href="my_personality_test_eng.php">
                        <h2>Take My Personality Test</h2>
                    </a>
                    <p>Find your personality type for the company's role.</p>
                    <img src="images/personality.png" alt="Personality Test">
                </div>
                <div class="card">
                    <a class="card" href="my_work_avbly_eng.php">
                        <h2>Set My Work Availability</h2>
                    </a>
                    <p>Please set your available start-date for a future remote job.</p>
                    <img src="images/workAvbly.jpg" alt="Work Availability">
                </div>
                <div class="card">
                    <a class="card" href="take_a_psv_eng.php">
                        <h2>Record A Problem-Solving Video</h2>
                    </a>
                    <p>Show your problem-solving ability to potential employers.</p>
                    <img src="images/psv.jpg" alt="Record A Problem-Solving Video">
                </div>
                <div class="card">
                    <a class="card" href="dkm_eng.php">
                        <h2>Attempt An Exam</h2>
                    </a>
                    <p>Improve your competitiveness by taking various exanms and getting higher scores.</p>
                    <img src="images/takeAnExam.jpg" alt="Attempt An Exam">
                </div>
                <div class="card">
                    <a class="card" href="my_interview_avbly_eng.php">
                        <h2>Set My Interview Availability</h2>
                    </a>
                    <p>Please set your interviewable time for future interviews.</p>
                    <img src="images/interview.jpg" alt="Interview Availability">
                </div>
            </div>
        </main>
    </body>
</html>
