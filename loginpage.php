<?php
session_start();

$login_error = $_SESSION['login_error'] ?? '';
$signup_error = $_SESSION['signup_error'] ?? '';
$signup_success = $_SESSION['signup_success'] ?? '';
$active_form = $_SESSION['active_form'] ?? 'login';

unset($_SESSION['login_error'], $_SESSION['signup_error'], $_SESSION['signup_success'], $_SESSION['active_form']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />

    <title>Welcome to LabTrack!</title>

</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Montserrat', sans-serif;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    body {
        background-color: #ffff;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        height: 100vh;
    }

    .brand-title {

        font-size: 8.7rem;
        font-weight: 900;
        margin-bottom: 1.5rem;
        display: flex;
        justify-content: center;
        align-items: center;
        background: linear-gradient(to right, #e53935, #00796b);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        -webkit-background-clip: text;
    }


    .container p {
        font-size: 14px;
        line-height: 20px;
        letter-spacing: 0.3px;
        margin: 20px 0;
    }

    .container span {
        font-size: 12px;
    }

    .container a {
        color: #333;
        font-size: 13px;
        text-decoration: none;
        margin: 15px 0 10px;
    }

    .container button {
        background-color: #2da0a8;
        color: #fff;
        font-size: 12px;
        padding: 10px 45px;
        border: 1px solid transparent;
        border-radius: 8px;
        font-weight: 600;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        margin-top: 10px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .container button:hover {
        background-color: #00796b;
    }

    .container button.hidden {
        background-color: transparent;
        border-color: #fff;
    }

    .container form {
        background-color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        padding: 0 40px;
        height: 100%;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);



    }

    .input-wrapper {
        position: relative;
        width: 100%;
        margin: 8px 0;
    }

    .input-wrapper input {
        background-color: #eee;
        border: none;
        padding: 10px 15px;
        font-size: 13px;
        border-radius: 8px;
        width: 100%;
        outline: none;
        padding-right: 40px;
        transition: border-color 0.3s ease;
    }

    .input-wrapper input:focus {
        border-color: #2da0a8;
        box-shadow: 0 0 0 2px rgba(45, 160, 168, 0.3);
    }

    .input-wrapper .toggle-password {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #aaa;
        font-size: 14px;
        z-index: 10;
    }

    .form-container {
        position: absolute;
        top: 0;
        height: 100%;
        transition: all 0.6s ease-in-out;
    }

    .sign-in {
        left: 0;
        width: 50%;
        z-index: 2;
    }

    .container.active .sign-in {
        transform: translateX(100%);
    }

    .sign-up {
        left: 0;
        width: 50%;
        opacity: 0;
        z-index: 1;
    }

    .container.active .sign-up {
        transform: translateX(100%);
        opacity: 1;
        z-index: 5;
        animation: move 0.6s;
    }

   

    .social-icons {
        margin: 20px 0;
    }

    .social-icons a {
        border: 1px solid #ccc;
        border-radius: 20%;
        display: inline-flex;
        justify-content: center;
        align-items: center;
        margin: 0 3px;
        width: 40px;
        height: 40px;
    }

    .toggle-container {
        position: absolute;
        top: 0;
        left: 50%;
        width: 50%;
        height: 100%;
        overflow: hidden;
        transition: all 0.6s ease-in-out;
        border-radius: 150px 0 0 100px;
        z-index: 1000;
    }

    .container.active .toggle-container {
        transform: translateX(-100%);
        border-radius: 0 150px 100px 0;
    }

    .toggle {
        background-color: #2da0a8;
        height: 100%;

        background: linear-gradient(to right, #e53935, #00796b);
        color: #fff;
        position: relative;
        left: -100%;
        height: 100%;
        width: 200%;
        transform: translateX(0);
        transition: all 0.6s ease-in-out;
    }

    .container.active .toggle {
        transform: translateX(50%);
    }

    .toggle-panel {
        position: absolute;
        width: 50%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        padding: 0 30px;
        text-align: center;
        top: 0;
        transform: translateX(0);
        transition: all 0.6s ease-in-out;
    }

    .toggle-left {
        transform: translateX(-200%);
    }

    .container.active .toggle-left {
        transform: translateX(0);
    }

    .toggle-right {
        right: 0;
        transform: translateX(0);
    }

    .container.active .toggle-right {
        transform: translateX(200%);
    }


    @media screen and (max-width: 768px) {
        .brand-title {
            font-size: 2.5rem;
            text-align: center;
        }
    }



    @media screen and (max-width: 1200px) {
        .brand-title {
            font-size: 3rem;
            text-align: center;
        }
    }
</style>

<body>

    <div class="container" id="container">
        <div class="form-container sign-up">



            <form action="login_register.php" id="signupForm" method="post" autocomplete="off">
                <input type="hidden" name="action" value="signup" autocomplete="off"> <!-- ADD THIS -->
                <h1>Create Account</h1>

                <?php if ($signup_error): ?>
                    <p style="color:red; font-size:13px; margin-bottom:8px;"><?= htmlspecialchars($signup_error) ?></p>
                <?php endif; ?>
                <?php if ($signup_success): ?>
                    <p style="color:green; font-size:13px; margin-bottom:8px;"><?= htmlspecialchars($signup_success) ?>
                    </p>
                <?php endif; ?>

                <div class="input-wrapper">
                    <input type="text" name="full_name" placeholder="Full Name (SURNAME, Firstname MI.)" required 
                        pattern="[A-Z\s,.]+ [A-Za-z\s,.]+ [A-Za-z\s,.]+"
                        oninvalid="this.setCustomValidity('Please follow the required format')"
                        oninput="this.setCustomValidity('')">
                </div>

                <div class="input-wrapper">
                    <input type="number" name="student_id" placeholder="Student Id" required  autocomplete="off" />
                </div>

                <div class="input-wrapper">
                    <input type="text" name="course_section" placeholder="Course and Section" required autocomplete="off" />
                </div>

                <div class="input-wrapper">
                    <input type="email" name="email"  placeholder="Email" required autocomplete="off" />
                    
                    </datalist>
                </div>

                <div class="input-wrapper">
                    <input type="text" name="password" id="password" placeholder="Password" required
                        pattern="(?=.*\d)(?=.*[a-z])(?=.*[\W_]).{5,}"
                        oninvalid="this.setCustomValidity('Create a strong password must contain at least one number,special characters and 5+ characters')"
                        oninput="this.setCustomValidity('')" />
                </div>

                <div class="input-wrapper">
                    <input type="password" name="confirm_password" id="confirmPassword" placeholder="Confirm Password"
                        required autocomplete="off" />
                </div>



                <button type="submit">Signup</button>
            </form>





        </div>
        <div class="form-container sign-in">



            <form action="login_register.php" method="post" autocomplete="off">
                <input type="hidden" name="action" value="login">

                <div class="brand-title">LabTrack</div>
                <?php if ($login_error): ?>
                    <p style="color:#e53935; font-size:13px; margin-bottom:8px;"><?= htmlspecialchars($login_error) ?></p>
                <?php endif; ?>
                <?php if ($signup_success): ?>
                    <p style="color:#00796b; font-size:13px; margin-bottom:8px;"><?= htmlspecialchars($signup_success) ?>
                    </p>
                <?php endif; ?>

                <div class="input-wrapper">
                    <input type="email" name="email" placeholder="Email" required autocomplete="off"/>

                </div>
                <div class="input-wrapper">
                    <input type="password" name="password" id="signInPassword" placeholder="Password" required />
                    <i class="fas fa-eye toggle-password" id="toggleSignInPasswordIcon"></i>
                </div>
                <a href="#">Forget Your Password?</a>
                <button>LOG IN</button>
            </form>



        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Have an account?</h1>
                    <button class="hidden" id="login">Log In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Hi there! Are you new to LabTrack?</h1>
                    <p>Don't have an account?</p>
                    <button class="hidden" id="register">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.onload = function () {
            const activeForm = "<?= $active_form ?>";
            if (activeForm === 'signup') {
                container.classList.add("active");
            }
        }
        const container = document.getElementById("container");
        const registerBtn = document.getElementById("register");
        const loginBtn = document.getElementById("login");

        const toggleSignUpPasswordIcon = document.getElementById("toggleSignUpPasswordIcon");

        const toggleSignInPasswordIcon = document.getElementById("toggleSignInPasswordIcon");
        const signInPasswordInput = document.getElementById("signInPassword");

        function setupPasswordToggle(passwordInput, toggleIcon) {
            if (toggleIcon && passwordInput) {
                toggleIcon.addEventListener('click', function () {
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);
                    this.classList.toggle('fa-eye');
                    this.classList.toggle('fa-eye-slash');
                });
            }
        }



        setupPasswordToggle(signInPasswordInput, toggleSignInPasswordIcon);

        registerBtn.addEventListener("click", () => {
            container.classList.add("active");
        });

        loginBtn.addEventListener("click", () => {
            container.classList.remove("active");
        });


        const signupForm = document.getElementById("signupForm");

        signupForm.addEventListener("submit", function (e) {
            e.preventDefault();

            const password = document.getElementById("password").value;
            const confirmPassword = document.getElementById("confirmPassword").value;


            if (password !== confirmPassword) {
                alert(" Passwords and confirm password do not match!");
                return;
            }


            const message = `By registering and providing your personal information, you acknowledge and agree that we collect, use, and process your data in accordance with this Data Privacy Act and Terms of Agreement.

    The information you provide, such as your name, email address, and other relevant details, is collected solely to deliver, maintain, and improve our services, personalize your experience, and communicate important updates.

    We are committed to handling your data ethically, ensuring transparency by clearly informing you about what data we collect and why. We adhere strictly to the principles of purpose limitation and data minimization.

    By proceeding with registration, you confirm that you have read, understood, and agree to this Data Privacy Act and Terms of Agreement.`;

            const userAgreed = confirm(message);

            if (userAgreed) {
                signupForm.submit();
            } else {
                alert(" You must agree to continue registration.");
            }

        });
    </script>
</body>


</html>