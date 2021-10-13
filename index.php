<!DOCTYPE html>
<html lang="en">
<head>
  <title>Practicle Test</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <style type="text/css">
    div{
      padding-bottom: 10px;
      text-align: center;
    }
  </style>
</head>
<body>

<!-- //input container for text box numbers -->
<div class="container mt-3">
  <h3>Practicle Test</h3>  
    <div class="input-group mb-3">
      <input type="text" class="form-control" placeholder="Enter the value" id="textbox">
      <button class="btn btn-primary" id="draw">Draw</button>
    </div>
</div>

<!-- //textboxes container -->
<div class="container">
  <form method="POST" action="index.php">
    <div class="row" id="container">
    </div>

<!-- buttons container -->

  <div class="row" id="bottons_container"></div>

<!-- lables container -->

  <div class="row" id="lables_container"></div>

  <div class="row">
    <div class="col-md-12">
      <input type="submit" name="submit" class="btn btn-primary" value="Submit">
      <button type="button" class="btn btn-primary" onclick="shuffle()">Refresh</button>
    </div>
  </div>
  </form>
</div>

<!-- After subbmiting form inserting values in the form of json into the database. -->
<?php
include('connection.php');
if(isset($_POST['submit']))
{ 
  if(isset($_POST['text_value']) && !empty($_POST['text_value']))
  {
    $text_values = $_POST['text_value'];
    $text_value_json = json_encode($text_values);
    if($conn) {
      $stmt = "INSERT INTO textbox_values (value) VALUES ('$text_value_json')";
      $rslt = mysqli_query($conn,$stmt);
      if($rslt)
      { ?>
        <div class="alert alert-success" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <strong>Success!</strong> Your data have been saved successfully!
        </div>
        <?php }else{ ?>
        <div class="alert alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Oppsss!</strong> Somthing went wrong, Please check it out!
        </div>
        <?php }
    }else{ ?>
      <div class="alert alert-danger" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <strong>Oppsss!</strong> Please check your connection!
      </div>
    <?php }
  }else{ ?>
      <div class="alert alert-danger" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <strong>Oppsss!</strong> Please enter some value!
      </div>
    <?php }
}
?>

<!-- script  start -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"> </script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"> </script>  
<script type="text/javascript">

  //for drawing textboxes according to numbers given
  $("#draw").click(function () {
    var textbox_lenght = $("#textbox").val(); //number of texboxes we have to create

    var textbox_html = ""; 
    var button_html = "";
    var lables_html = "";

    //check if value is numeric or not
    if($.isNumeric(textbox_lenght)){

    // console.log(Math.floor(Math.random() * textbox_lenght) + 1);

      // appending texboxes in the div element
      for (var i = 0; i < textbox_lenght; i++) {
        textbox_html += '<div class="col-md-3"><input type="text" autocomplete="off" id="text_value_'+i+'" class="form-control open_text" placeholder="" name="text_value['+i+']"></div>';
        button_html += '<div class="col-md-3" id="textbox_div_'+i+'"></div>';
        lables_html += '<div class="col-md-3" id="lables_div_'+i+'"></div>';
      }
    }
    $("#container").html(textbox_html);
    $("#bottons_container").html(button_html);
    $("#lables_container").html(lables_html);
  })

  //dynamically appending buttons and lables on entering any value
  $(document).on('keyup','.open_text',function(){
    var textbox_value = $(this).val();
    var textbox_id = this.id;
    var textbox_id_arr = textbox_id.split('_');
    var button = '<button type="button" class="btn btn-primary textbox_button" id="textbox_button_'+textbox_id_arr[2]+'">'+textbox_value+'</button>';
    var lable = '<p id="lable_'+textbox_id_arr[2]+'">'+textbox_value+'</p>';
    $("#textbox_div_"+textbox_id_arr[2]).html(button);
    $("#lables_div_"+textbox_id_arr[2]).html(lable);
    $("#lables_container>div").each(function() {
      $(this).insertBefore($(this).prev())
    })
  });

  // onclick of button highlight the lable
  $(document).on('click','.textbox_button',function(){
    var button_id = this.id;
    var button_id_arr = button_id.split('_');

    $("#lable_"+button_id_arr[2]).css('background-color','#e9dba7');
    setTimeout(function(){
      $("#lable_"+button_id_arr[2]).css('background-color','');
    }, 1500);
  });

//for suffling the lables
 function shuffle() {
  $("#lables_container>div").each(function() {
    $(this).insertBefore($(this).prev())
  })
}
</script>
<!-- script end -->

</body>
</html>
