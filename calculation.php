<?php include("header.php") ?>
<?php

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $prodCost = (float) $_POST["prodCost"];
    $price = (float) $_POST["price"];
    $demand = $_POST["demand"];
} else {
    echo "Invalid";
}
    ?>
    <div class="card pay-off">
        <h1 class="text-center">Table PayOff</h1>
        <div class="container">
        <table class="table table-bordered">
            <thead>
            <form method=post action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <tr>
                <?php
                for($i=0; $i<1; $i++) {
                    echo "<tr>";
                    echo "<td>Demand</td>";
                    for($j=0; $j<count($demand); $j++) {
                    ?>
                        <td><input type="text" class="form-control" name="demand[<?php $j?>]" value="<?php echo $demand[$j]?>"></td>
                    <?php
                    }
                    echo "</tr>";
                }                     
                ?>
            </tr>
            <tr>
                <?php 
                    echo "<th> Data </th>";
                    for($i=0; $i<count($demand); $i++) {
                    echo "<th>" . $demand[$i] . "</th>";
                    }
                ?>
            </tr>
            </thead>
            <tbody>
               
            <tr>
                <?php
                for($i=0; $i<count($demand); $i++) {
                    echo "<tr>";
                    echo "<td>" . $demand[$i] . "</td>";
                    for($j=0; $j<count($demand); $j++) {
                    ?>
                    <?php
                        if($i == $j) {
                            ?>
                            <td><input type="number" class="form-control" name="value[][]" value="<?php echo 
                            abs($demand[$i] * $price - $demand[$j] * $prodCost)?>"></td>
                        </td>
                            <?php
                        } else {
                            ?>
                            <td><input type="number" class="form-control" name="value[][]" value="value[<?php $i?>] [<?php $j?>]"></td>
                            <?php
                        }
                    ?>
                    <?php
                    }
                    echo "</tr>";
                }              
                ?>
            </tr>
            <tr>
                <?php
                for($i=0; $i<1; $i++) {
                    echo "<tr>";
                    echo "<td>Probability</td>";
                    for($j=0; $j<count($demand); $j++) {
                    ?>
                    <td><input type="text" class="form-control" name="prob[]"></td>
                    <?php
                    }
                    echo "</tr>";
                }                     
                ?>
            </tr>
     
            </tbody>
        </table>
        <!-- <input type="button" name="submit" data-toggle="modal" data-target="#result_modal class="btn btn-dark btn-lg btn-block" value="Submit"><br> -->
        <button type="button" data-toggle="modal" data-target="#result_modal" class="btn btn-dark btn-lg btn-block" id="submit" name="submit">Hitung</button>
        </form>
        </div>
    </div>

  





<div id="result_modal" class="modal fade">
 <div class="modal-dialog index">
  <div class="modal-content card result" id="res_card">
   <div class="modal-header">
    <h1 class="modal-title header">Decision Result</h4>
   </div>
   <div class="modal-body">
     <pre id="detail" class="form-control"></pre>  
    <h3>Total Produk yang harus dijual:</h3>
    <h2 id="hasilakhir"></h2>

     <div class="modal-footer">
    <button type="button"  class="btn btn-default" data-dismiss="modal">Close</button>
   </div>

   </div>
  </div>
 </div>
</div>


<script type="text/javascript">
  $("#submit").click(function () {
      var tempValue;
      var extract_value = [];
      var i,j, len;
      var max = 0;
      var hasil = 0;
      var halo = '';
      var linebreak= "\n";
      var arrEV = [];
    // var prob = [];
        var prob = document.getElementsByName('prob[]');
        var data = document.getElementsByName('value[][]');
        var dema = document.getElementsByName('demand[]');
        // console.log(data[1][1].value);
        // for ( i = 0; i < data.length; i ++) {
        // //  data.slice(i, i + chunkSize);
        //     extract_value.push(data[i]);
        // }
       extract_value= chunkArray(data,prob.length);
        // console.log(extract_value[1][1].value);
        for(i=0; i<prob.length; i++) {
           
            tempValue = 0;
            for(j=0; j<prob.length; j++) {
                tempValue += extract_value[i][j].value * (prob[j].value/100);
                // console.log("value data ", extract_value[i][j].value);
                // console.log("prob value ",prob[j].value);
                // console.log("temp value ", tempValue);
            }
            arrEV[i] = tempValue;
            
        }
        
        for(i=0;i<arrEV.length;i++){
            if(max == 0 || arrEV[i] > max){
                max = arrEV[i];
                hasil = i;
            }
            halo = halo +"ER"+ dema[i].value + " Value: "+arrEV[i]+"\n";

        }

        var hasilakhir = dema[hasil].value;
        $("#detail").html(halo);
        $("#hasilakhir").html(hasilakhir);

        });
  
    function chunkArray(array, size) {
    var result = []
    for (value of array){
        var lastArray = result[result.length -1 ]
        if(!lastArray || lastArray.length == size){
            result.push([value])
        } else{
            lastArray.push(value)
        }
    }
    return result
}

</script>
<!-- <script type="text/javascript">
  $(window).load(function(){
    $('#result_modal').modal('show');
  });
</script> -->

<!-- <script type="text/javascript">
    $("#submit").click(function () {
        
//     var halo=$('#calc_form').validate();
//     console.log("halo",halo);
// // Begin Aksi Insert
//  $('#calc_form').on("submit", function(event){  
//   event.preventDefault();  
//    var tempValue;
//    var data = [];
//    var demand;
//    var max = 0;
//    var result =0;
//    var arrEV = [];
// //    var key;
// //    var value;

//    data = $('#value').val();
//    var prob = $('#prob').val();
//    demand = $('#demand').val();
// //    data = document.getElementById('value').value;
//    console.log("HALO");
//    console.log("data",count(data));
//    console.log("prob",prob);
//    console.log("demand",demand);
//    var extract_value = array_chunk(data, count(prob));

//    for(var i=0; i<count(prob); i++) {
//        tempValue = 0;
//        for(var j=0; j<count(prob); j++) {
//            tempValue += extract_value[i][j] * (prob[j]/100);
//        }
//        arrEV[i] = tempValue;
//    }
//    Object.entries(arrEV).forEach(([key, value]) => {
//         if(max === null || value > max) {
//             result = key;
//             max = value;
//         }
//     });
   
//     var hasil = demand[result];
//     console.log("HALO");
//     console.log("hasil",hasil);
//     $('#hasil').html(hasil);  
// //   var str = $( "form" ).serialize();
// //    $.ajax({  
// //     // url:"calculation.php",  
// //     // method:"POST",  
// //     data: hasil,
// //     success:function(data){  
// //      $('#hasil').html(data);  
//     // alert(data);
//     }  
//    });  
    
 });
// });

 </script> -->


<?php include("footer.php") ?>