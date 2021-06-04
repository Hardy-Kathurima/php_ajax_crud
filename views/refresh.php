<?php
require '../database/connection.php';
$target = 100000;

$sum = "SELECT SUM(amount) as total from guests ";
$total = mysqli_query($conn, $sum);
$total_amount = mysqli_fetch_array($total);
$sum = $total_amount['total'];

$select = "SELECT id ,guest_name,phone,arrive_at ,amount FROM guests ORDER BY id DESC LIMIT 20 ";
$result = mysqli_query($conn, $select);
$guests = mysqli_fetch_all($result, MYSQLI_ASSOC);

$due = $target - $sum;

if ($due <= 0) {
    echo 'target Achieved';
}

$search_value = '';
// search the database
if (isset($_POST['search']) && isset($_POST['search_value'])) {

    $search_value = htmlspecialchars($_POST['search_value']);
    $search_value = '%' . $search_value . '%';
    $search = "SELECT *  FROM guests WHERE phone LIKE $search_value ";
    mysqli_query($conn, $search);
}


?>

<?php if (count($guests) > 0) : ?>
<div class="stats d-flex justify-content-around mt-3 ">
    <div class="total_guests">
        <img src="images/group.png" alt="guest icon">
        <?php echo 'Number of guests: ' . count($guests); ?>
    </div>
    <div class="total-contribution">
        <img src="images/money.png" alt="money icon">
        <?php echo  'Total Contributions : sh ' . $sum; ?>
    </div>
    <div class="target">
        <img src="images/target.png" alt="target icon">
        <?php echo 'Target: sh ' . $target ?>
    </div>
    <div class="amount-due">
        <img src="images/wait.png" alt="load icon">
        <?php echo 'Amount due: sh ' . $due; ?>
    </div>
</div>

<div class="message text-center text-danger mt-3 "></div>
<table class=" table table-bordered mt-2 text-center ">
    <tr>
        <th>Guest name</th>
        <th>Mobile</th>
        <th>Arrival time</th>
        <th>Amount</th>
        <th>Action</th>

    </tr>
    <?php foreach ($guests as $guest) : ?>
    <tr>
        <td><?php echo $guest['guest_name']; ?></td>
        <td><?php echo '0' . $guest['phone']; ?></td>
        <td><?php echo $guest['arrive_at']; ?></td>
        <td><?php echo 'sh ' . $guest['amount']; ?></td>
        <td>

            <a class="mr-3" title="edit guest" href="views/edit.php?id=<?php echo $guest['id']; ?> "><img
                    src="images/edit.png" alt="edit icon"></a>
            <a onclick="return confirm('Are you sure you want to delete?')" title="delete guest"
                href="views/delete.php?id=<?php echo $guest['id']; ?>"><img src="images/delete.png"
                    alt="delete icon"></a>
        </td>

    </tr>


    <?php endforeach; ?>

</table>
<?php else : ?>
<p class="lead text-center p-3 mt-5">no records found</p>
<?php endif; ?>