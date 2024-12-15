<?php
// Start the session
session_start();

// Load Composer's autoloader
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// Check if form is submitted
if (isset($_POST["submit"])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';            // Correct SMTP server for Gmail
        $mail->SMTPAuth   = true;                        // Enable SMTP authentication
        $mail->Username   = 'brian01kimathi@gmail.com';  // Your Gmail address
        $mail->Password   = 'viim gbip ekfr rppa';       // App-specific password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  // Enable TLS encryption
        $mail->Port       = 587;                         // TCP port to connect to

        //Recipients
        $mail->setFrom('brian01kimathi@gmail.com', 'Portfolio/s - contacts');
        $mail->addAddress('brian01kimathi@gmail.com');   // Send to your email

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;  // Set email subject from the form
        $mail->Body    = "<h3>Contact Form Submission</h3>
                          <p><strong>Name:</strong> $name</p>
                          <p><strong>Email:</strong> $email</p>
                          <p><strong>Subject:</strong> $subject</p>
                          <p><strong>Message:</strong> $message</p>";
        $mail->AltBody = "Name: $name\nEmail: $email\nSubject: $subject\nMessage: $message";

        // Send the email
        $mail->send();
        $_SESSION['success'] = 'Message sent successfully!';
    } catch (Exception $e) {
        $_SESSION['error'] = "Mailer Error: " . $mail->ErrorInfo;
    }

    // Redirect to avoid form resubmission
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content />
    <meta name="author" content />
    <title>Brian Muriungi - contact</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/logo.jpg" />
    <!-- Custom Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.min.css">
</head>

<body class="d-flex flex-column">
    <main class="flex-shrink-0">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-white py-3">
            <div class="container px-5">
                <a class="navbar-brand" href="index.php"><span class="fw-bolder text-primary">Brian Muriungi</span></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation"><span
                        class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 small fw-bolder">
                        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="resume.php">Resume</a></li>
                        <li class="nav-item"><a class="nav-link" href="projects.php">Projects</a></li>
                        <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Page content-->
        <section class="py-5">
            <div class="container px-5">
                <!-- Contact form-->
                <div class="bg-light rounded-4 py-5 px-4 px-md-5">
                    <div class="text-center mb-5">
                        <div class="feature bg-primary bg-gradient-primary-to-secondary text-white rounded-3 mb-3"><i
                                class="bi bi-envelope"></i></div>
                        <h1 class="fw-bolder">Get in touch</h1>
                        <p class="lead fw-normal text-muted mb-0">Let's work together!</p>
                    </div>
                    <div class="row gx-5 justify-content-center">
                        <div class="col-lg-8 col-xl-6">
                            <form action="#" method="POST" id="contactForm">

                                <!-- Name input-->
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="name" name="name" type="text"
                                        placeholder="Enter your name..." data-sb-validations="required" />
                                    <label for="name">Full name</label>
                                    <div class="invalid-feedback" data-sb-feedback="name:required">A name is required.</div>
                                </div>

                                <!-- Email address input-->
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="email" name="email" type="email"
                                        placeholder="name@example.com" data-sb-validations="required,email" />
                                    <label for="email">Email address</label>
                                    <div class="invalid-feedback" data-sb-feedback="email:required">An email is required.</div>
                                    <div class="invalid-feedback" data-sb-feedback="email:email">Email is not valid.</div>
                                </div>

                                <!-- Subject input-->
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="subject" name="subject" type="text"
                                        placeholder="Enter the subject..." data-sb-validations="required" />
                                    <label for="subject">Subject</label>
                                    <div class="invalid-feedback" data-sb-feedback="subject:required">A subject is required.</div>
                                </div>

                                <!-- Message input-->
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" id="message" name="message" type="text"
                                        placeholder="Enter your message here..." style="height: 10rem"
                                        data-sb-validations="required"></textarea>
                                    <label for="message">Message</label>
                                    <div class="invalid-feedback" data-sb-feedback="message:required">A message is required.</div>
                                </div>

                                <div class="d-none" id="submitErrorMessage">
                                    <div class="text-center text-danger mb-3">Error sending message!</div>
                                </div>

                                <!-- Submit Button-->
                                <div class="d-grid">
                                    <button class="btn btn-primary btn-lg" id="submitButton" name="submit" type="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row gx-4 gx-lg-5 justify-content-center">
                        <div class="col-lg-4 text-center mb-5 mb-lg-0">
                            <i class="bi-phone fs-2 mb-3 text-muted"></i>
                            <a href="tel:+254743208307" target="_blank" style="text-decoration: none;">
                                <div>+254 743 208 307</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- Footer-->
    <footer class="bg-white py-4 mt-auto">
        <div class="container px-5">
            <div class="row align-items-center justify-content-between flex-column flex-sm-row">
                <div class="col-auto">
                    <div class="col-auto">
                        <div class="small m-0">Copyright &copy; Brian Muriungi 2024 <p>In support by
                                <a href="https://kingsbreakfast.kenswedtechclub.org" style="text-decoration: none;">king's Breakfast</a>
                            </p>
                        </div>
                    </div>
                    <div class="col-auto">
                        <a id="privacy-link" class="small" href="#!">Privacy</a>
                        <span class="mx-1">&middot;</span>
                        <a id="terms-link" class="small" href="#!">Terms</a>
                        <span class="mx-1">&middot;</span>
                        <a class="small" href="contact.php">Hire me</a>
                    </div>
                </div>
            </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <!-- * *                               SB Forms JS                               * *-->
    <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>

    <script src="js/agree.js"></script>
    <!-- Sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.all.min.js"></script>
</body>

</html>
