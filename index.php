<?php
require 'database/connection.php';
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

?>
<?php require 'templates/header.php'; ?>

<div class="container p-3">
    <div class="jumbotron ">
        <h2 class="text-center mb-0">Meru school contribution</h2>
        <form class="mt-2 mx-auto mb-2 mt-3 form-inline" id="form">

            <input type="text" name="guest_name" id="guest_name" class="form-control mr-2" pattern="[a-zA-Z\s]{1,15}"
                placeholder=" enter guest name..." required>


            <input type="tel" name="phone" id="phone" pattern="[0-9]{10}" placeholder=" mobile..."
                class="form-control mr-2" required>


            <input type="number" name="amount" id="amount" min="50" max="10000" step="50" placeholder="amount..."
                class="form-control mr-2" required>


            <input type="submit" value="submit" name="submit" id="insert" class="btn btn-info">

        </form>

    </div>

    <section class="content">

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


        <table class=" table table-bordered mt-2 text-center " id="myTable">
            <thead>
                <tr>
                    <th>Guest name</th>
                    <th>Mobile</th>
                    <th>Arrival time</th>
                    <th>Amount</th>
                    <th>Action</th>

                </tr>
            </thead>
            <?php foreach ($guests as $guest) : ?>
            <tbody>
                <tr>
                    <td><?php echo $guest['guest_name']; ?></td>
                    <td><?php echo '0' . $guest['phone']; ?></td>
                    <td><?php echo $guest['arrive_at']; ?></td>
                    <td><?php echo 'sh ' . $guest['amount']; ?></td>
                    <td>

                        <a class="mr-3" title="edit guest" href="edit.php?id=<?php echo $guest['id']; ?> "><img
                                src="images/edit.png" alt="edit icon"></a>
                        <a onclick="return confirm('Are you sure you want to delete?')" title="delete guest"
                            href="views/delete.php?id=<?php echo $guest['id']; ?>"><img src="images/delete.png"
                                alt="delete icon"></a>
                    </td>

                </tr>
            </tbody>


            <?php endforeach; ?>

        </table>
        <?php else : ?>
        <p class="lead text-center p-3 mt-5">no records found</p>
        <?php endif; ?>
    </section>
</div>



<?php require 'templates/footer.php'; ?>