<?php
session_start();
include 'header.php';
include 'functions.php';
?>
<h1 class="text-primary text-center mt-5">MULTISTEP FORM</h1>

<form method="POST" action="" enctype="multipart/form-data">
    <div class="container border p-3 rounded mt-5 step1_form bg-light <?php echo ($current_step == 'step1') ? '' : 'd-none'; ?>">
        <div class="mb-3">
            <label class="form-label ">First Name</label>
            <input type="text" class="form-control" name="first_name"
                value="<?php echo htmlspecialchars($firstname); ?>">
            <small class="text-danger"><?php echo $errors['first_name']; ?></small>
        </div>
        <div class="mb-3">
            <label class="form-label ">Last Name</label>
            <input type="text" class="form-control" name="last_name"
                value="<?php echo htmlspecialchars($lastname); ?>">
            <small class="text-danger"><?php echo $errors['last_name']; ?></small>
        </div>
        <div class="d-flex justify-content-end">
            <button type="submit" name="save" class="btn1 btn btn-danger btn-sm">Next</button>
        </div>
    </div>
    <div class="container border p-3 rounded mt-5 step2_form <?php echo ($current_step == 'step2') ? '' : 'd-none'; ?>">
        <div class="mb-3">
            <label class="form-label ">Phone</label>
            <input type="text" class="form-control" name="phone" value="<?php echo htmlspecialchars($phone); ?>">
            <small class="text-danger"><?php echo $errors['phone']; ?></small>
        </div>
        <div class="mb-3">
            <label class="form-label ">Email</label>
            <input type="text" class="form-control" name="email" value="<?php echo htmlspecialchars($email); ?>">
            <small class="text-danger"><?php echo $errors['email']; ?></small>
        </div>
        <div class="d-flex justify-content-between">
            <button type="button" class="btn2_back btn btn-success btn-sm">Back</button>
            <button type="submit" name="save_1" class="btn2 btn btn-danger btn-sm">Next</button>
        </div>
    </div>
    <div class="container border p-3 rounded mt-5 step3_form <?php echo ($current_step == 'step3') ? '' : 'd-none'; ?>">
        <div class="mb-3">
            <label class="form-label ">Image</label>
            <input type="file" name="image" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label ">Address</label>
            <input type="text" name="address" class="form-control" value="<?php echo htmlspecialchars($address); ?>">
            <small class="text-danger"><?php echo $errors['address']; ?></small>
        </div>
        <div class="d-flex justify-content-between">
            <button type="button" class="btn3_back btn btn-success btn-sm">Back</button>
            <button type="submit" name="save_3" class="btn btn-success btn-sm">Submit</button>
        </div>
    </div>
</form>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    const CURRENT_STEP = "<?php echo $current_step; ?>";
</script>
<script src="assets/multistep.js"></script>

