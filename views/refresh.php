<?php 
require '../database/connection.php';
$target = 100000;

$sum = "SELECT SUM(amount) as total from guests ";
$total=mysqli_query($conn,$sum);
$total_amount= mysqli_fetch_array($total);
$sum = $total_amount['total'];

$select = "SELECT id ,guest_name,phone,arrive_at ,amount FROM guests ORDER BY id DESC ";
$result = mysqli_query($conn, $select);
$guests = mysqli_fetch_all($result, MYSQLI_ASSOC);

$due = $target - $sum;





 ?>



   <?php if (count($guests)>0): ?>
         <div class="stats d-flex justify-content-between mt-3">
            <div class="total_guests">
                 <?php echo 'Number of guests :'. count($guests) ;?>
            </div>
            <div class="total-contribution">
                <?php echo  'Total Contributions :'.$sum; ?>
            </div>
            <div class="target">
                <?php echo 'Target :'.$target?>
            </div>
            <div class="amount-due">
                 <?php echo 'Amount due sh :' .$due; ?>
            </div>
        </div>
       <table class=" table table-bordered mt-5 ">
          <tr>
             <th>Guest name</th>
             <th>Phone</th>
             <th>Arrival time</th>
             <th>Amount</th>
             
          </tr>
            <?php foreach($guests as $guest): ?>
            <tr>
               <td><?php echo $guest['guest_name'] ;?></td>
               <td><?php echo '0'.$guest['phone'] ;?></td>
               <td><?php echo $guest['arrive_at'] ;?></td>
               <td><?php echo 'sh '.$guest['amount'] ;?></td>
               
            </tr>


          <?php endforeach; ?>

       </table>
    <?php else: ?>
      <p class="lead text-center p-3 mt-5">no records found</p>
   <?php endif; ?>