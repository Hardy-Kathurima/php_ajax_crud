<?php
require 'database/connection.php';
require 'functions/validate.php';

$id = htmlspecialchars($_GET['id']);
$select = " SELECT * FROM guests WHERE id = $id";
$result = mysqli_query($conn, $select);
$guest = mysqli_fetch_assoc($result);
mysqli_free_result($result);

if (isset($_POST['edit'])) {

    $edit_guest = validateInput($_POST['edit_id']);
    $guest_name = validateInput($_POST['guest_name']);
    $phone = validateInput($_POST['phone']);
    $amount = validateInput($_POST['amount']);

    if (!empty($guest_name) || !empty($phone) || !empty($amount)) {

        $edit_guest = mysqli_real_escape_string($conn, $_POST['edit_id']);
        $guest_name = mysqli_real_escape_string($conn, $_POST['guest_name']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $amount = mysqli_real_escape_string($conn, $_POST['amount']);

        $update = "UPDATE guests  SET guest_name='$guest_name', phone='$phone', amount = '$amount' WHERE id = $edit_guest ";
        if (mysqli_query($conn, $update)) {
            header("Location:index.php");
        }
    }
}


?>

<?php require 'templates/header.php'; ?>

<div class="container p-3">
    <h2 class=" mt-5">Edit Guest details</h2>
    <form method="post" class="mx-auto mt-5" id="edit-form">
        <input type="hidden" name="edit_id" value=" <?php echo $guest['id']; ?> ">
        <div class="form-group">
            <input type="text" name="guest_name" class="w-50 p-2" id="guest_name" pattern="[a-zA-Z\s]{1,15}"
                placeholder=" enter guest name" value="<?php echo $guest['guest_name']; ?> " required>
        </div>
        <div class="form-group">
            <input type="tel" name="phone" class="w-50 p-2" id="phone" pattern="[0-9\s]{10}"
                placeholder=" phone 0703642687" value="<?php echo '0' . $guest['phone']; ?> " readonly required>
        </div>
        <div class="form-group">
            <input type="number" name="amount" class="w-50 p-2" id="amount" min="50" max="10000" step="50"
                placeholder="amount" value="<?php echo $guest['amount']; ?>" required>
        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-info w-50" value="update" name="edit" id="edit">
        </div>
    </form>
    <a href="index.php">
        <--- Home </a>
</div> <?php require 'templates/footer.php'; ?>