<?php
$title = "register";
include __DIR__ . '/../templates/header.php';

?>

<div class="container mt-5 d-flex justify-content-center">
    <div class="row w-100 justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <h2 class="mb-0">Register</h2>
                </div>
                <div class="card-body">
                    <!-- Error Alerts -->
                    <?php if (!empty($errors)): ?>
                        <div class="alert alert-danger">
                            <ul>
                                <?php foreach ($errors as $fieldErrors): ?>
                                    <?php foreach ($fieldErrors as $error): ?>
                                        <li><?= htmlspecialchars($error) ?></li>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <!-- Registration Form -->
                    <form id="registrationForm" method="POST" action="/register" novalidate>
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input
                                type="text"
                                class="form-control <?= isset($errors['name']) ? 'is-invalid' : (isset($oldValues['name']) ? 'is-valid' : '') ?>"
                                id="name"
                                name="name"
                                value="<?= htmlspecialchars($oldValues['name'] ?? '') ?>"
                                placeholder="Enter your name">
                            <?php if (isset($errors['name'])): ?>
                                <div class="invalid-feedback">
                                    <?= htmlspecialchars($errors['name'][0]) ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input
                                type="email"
                                class="form-control <?= isset($errors['email']) ? 'is-invalid' : (isset($oldValues['email']) ? 'is-valid' : '') ?>"
                                id="email"
                                name="email"
                                value="<?= htmlspecialchars($oldValues['email'] ?? '') ?>"
                                placeholder="Enter your email">
                            <?php if (isset($errors['email'])): ?>
                                <div class="invalid-feedback">
                                    <?= htmlspecialchars($errors['email'][0]) ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input
                                type="password"
                                class="form-control <?= isset($errors['password']) ? 'is-invalid' : (isset($oldValues['password']) ? 'is-valid' : '') ?>"
                                id="password"
                                name="password"
                                placeholder="Enter your password">
                            <?php if (isset($errors['password'])): ?>
                                <div class="invalid-feedback">
                                    <?= htmlspecialchars($errors['password'][0]) ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Interactive Validation -->
<script>
    $(document).ready(function() {
        $('#registrationForm').validate({
            rules: {
                name: {
                    required: true,
                    minlength: 3
                },
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 8, // Ensure at least 8 characters
                    pattern: /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/
                }
            },
            messages: {
                name: {
                    required: "Please enter your name",
                    minlength: "name must be at least 3 characters long"
                },
                email: {
                    required: "Please enter your email",
                    email: "Please enter a valid email address"
                },
                password: {
                    required: "Please provide a password",
                    minlength: "Password must be at least 8 characters long",
                    pattern: "Password must include at least one uppercase letter, one number, and one special character"
                }
            },
            errorClass: "is-invalid",
            validClass: "is-valid",
            errorElement: "div",
            errorPlacement: function(error, element) {
                error.addClass("invalid-feedback");
                error.insertAfter(element);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass(errorClass).removeClass(validClass);
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass(errorClass).addClass(validClass);
            }
        });
        // Add custom rule for regex pattern validation
        $.validator.addMethod("pattern", function(value, element, param) {
            return this.optional(element) || param.test(value);
        }, "Invalid format.");
    });
</script>
