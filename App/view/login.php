<?php

use App\Php\URL;
use App\core\router\Router;

Router::$title = 'Login';
?>

<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-5">
                <div class="login-wrap p-4 p-md-5">
                    <h3 class="text-center mb-4">Sign In</h3>
                    <form action="/login" method="post" class="login-form">
                        <div class="form-group">
                            <input type="text" class="form-control rounded-left" name="username" placeholder="Username"
                                   required>
                        </div>
                        <div class="form-group d-flex">
                            <input type="password" class="form-control rounded-left" name="password"
                                   placeholder="Password" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="form-control btn btn-primary rounded submit px-3">Login
                            </button>
                        </div>

                        <div class="w-50 text-md">
                            Don't hava account? <a href="<?php echo URL::getURL("register"); ?>">Register</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>