<?php 
require'database/connection.php';
$target = 100000;

$sum = "SELECT SUM(amount) as total from guests ";
$total=mysqli_query($conn,$sum);
$total_amount= mysqli_fetch_array($total);
$sum = $total_amount['total'];


$select = "SELECT id ,guest_name,phone,arrive_at ,amount FROM guests ORDER BY id DESC ";
$result = mysqli_query($conn, $select);
$guests = mysqli_fetch_all($result, MYSQLI_ASSOC);

$due = $target - $sum;

if ($due <= 0){
    echo 'target Achieved';
}




 ?>
 <?php require 'templates/header.php'; ?>

   <div class="container p-3">
    <h2 class="text-center mb-0">Meru school computer lab contribution</h2>
 <div class="message text-center text-success mt-3 "></div>
    

    <form  class="mt-2 mx-auto mb-2" id="form">
        <input type="text" name="guest_name" id="guest_name" pattern="[a-zA-Z]{1,15}" placeholder=" enter guest name" required>
        <input type="tel" name="phone" id="phone" pattern="[0-9]{10}" placeholder=" phone 0703642687" required>
        <input type="number" name="amount" id="amount" min="50" max="10000" step="50" placeholder="amount" required> 
        <input type="submit" value="submit" name="submit" id="insert">
    </form>
   

    <section class="content">
       
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
       
        
        
       

       <table class=" table table-bordered mt-2 ">
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
    </section>
 </div>


  <?php require 'templates/footer.php'; ?>

