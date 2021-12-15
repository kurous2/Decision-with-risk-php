<?php include("header.php") ?>
<!-- <div class="index">
    <div class="card index-card">
    <h1 class="header">RISK MANAGEMENT</h1>
        <form method="post" action="index.php">
            <div class="form-group">
                <label for="prodCost">Input Demand</label>
                <input type="text" class="form-control" name="demand" placeholder="Input Total Demand">
            </div>
            <button type="submit" class="btn btn-primary btn-lg btn-block">Submit</button>
        </form>
        <a href="user-guide.pdf" class="link-primary text-center" style="margin-top: 8px;">Need Help?</a>
    </div>
</div> -->

<div id="add_data_Modal" class="modal fade">
 <div class="modal-dialog index">
  <div class="modal-content card index-card">
   <div class="modal-header">
    <h1 class="modal-title header">Decision with Risk</h4>
   </div>
   <div class="modal-body form-group">
    <form  id="insert_form">
     <label>Total Demand</label>
     <br />
     <input type="text" name="demanda" id="demanda" class="form-control" placeholder="Masukkan Jumlah Demand" />
     <br />
     <button type="submit" class="btn  btn-dark btn-lg btn-block">Submit</button>
    </form>
   </div>
  </div>
 </div>
</div>

<div class="card form" >
<div align="right">
     <button type="button" name="age" id="age" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-warning">Masukkan Demand</button>
    </div>
        <form method="post" action="calculation.php">
            <div class="form-group">
                <label for="prodCost">Harga Beli</label>
                <input type="text" class="form-control" name="prodCost" placeholder="Masukkan Harga Beli">
            </div>
            <div class="form-group">
                <label for="price">Harga Jual</label>
                <input type="text" class="form-control" name="price" placeholder="Masukkan Harga Jual">
            </div>

            <div class="form-group" id="employee_table">
            <?php
                for($i=0; $i<$_GET['demanda']; $i++) {
                    ?>
                    <label for="demand">Demand</label>
                    <input type="text" class="form-control" name="demand[]" placeholder="Masukkan Demand">
                    <br>
            <?php
                }
            ?>
             </div>
            <button type="submit" class="btn btn-dark btn-lg btn-block">Submit</button>
        </form>
        <a href="UserGuide.pdf" class="link-primary text-center" style="margin-top: 8px;">User Guide</a>
    </div>

<script>  
$(function () {
  $('#insert_form').validate();
// Begin Aksi Insert
 $('#insert_form').on("submit", function(event){  
  event.preventDefault();  

      var dem = $('#demanda').val();

   $.ajax({  
    // url:"index.php",  
    // method:"POST",  
    data: {'dem':dem},
    success:function(data){  
     $('#add_data_Modal').modal('hide');  
     $('#employee_table').html(data);  
    }  
   });  
    
 });
});
 </script>

<?php include("footer.php") ?>