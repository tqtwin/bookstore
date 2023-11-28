<form action="customer-signup.php" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="tentaikhoan">Tên tài khoản:</label>
    <input type="text" class="form-control" placeholder="Nhập tên tài khoản" id="tentaikhoan" name="tentaikhoan" maxlength="50">
    <span id="tentaikhoan-error" class="error-message"></span>
  </div>
  <div class="form-group">
    <label for="password">Mật khẩu:</label>
    <input type="password" class="form-control" placeholder="Nhập mật khẩu" id="password" name="password">
    <span id="password-error" class="error-message"></span>
  </div>
  <div class="form-group">
    <label for="repassword">Xác nhận mật khẩu:</label>
    <input type="password" class="form-control" placeholder="Nhập lại mật khẩu" id="repassword" name="repassword">
    <span id="repassword-error" class="error-message"></span>
  </div>
  <div class="form-group">
    <label for="name">Họ tên:</label>
    <input type="text" class="form-control" id="name" name="name" placeholder="Họ tên của bạn" maxlength="50">
    <span id="name-error" class="error-message"></span>
  </div>
  <div class="form-group">
    <label for="phone">Số điện thoại:</label>
    <input type="tel" class="form-control" id="phone" name="phone" placeholder="0123456789" pattern="[0-9]{10}" maxlength="10">
    <span id="phone-error" class="error-message"></span>
  </div>
  <div class="form-group">
    <label for="email">Email:</label>
    <input type="email" class="form-control" placeholder="Nhập email đăng ký" id="email" name="email" maxlength="50">
    <span id="email-error" class="error-message"></span>
  </div>
  <div class="form-group">
    <label for="roleid">Role ID:</label>
    <input type="text" class="form-control" placeholder="Nhập role ID" id="roleid" name="roleid" maxlength="50">
    <span id="roleid-error" class="error-message"></span>
  </div>
  <div class="form-group">
    <label for="status">Status:</label>
    <input type="text" class="form-control" placeholder="Nhập status" id="status" name="status" maxlength="50">
    <span id="status-error" class="error-message"></span>
  </div>
 
  <button type="submit" class="btn btn-primary">Đăng ký</button>
  <button type="reset" class="btn btn-primary">Bỏ qua</button>
</form>
<script>
  document.addEventListener("DOMContentLoaded", function () {
  var form = document.querySelector("form");
  form.addEventListener("submit", function (event) {
    var tentaikhoanInput = document.getElementById("tentaikhoan");
    var emailInput = document.getElementById("email");
    var passwordInput = document.getElementById("password");
    var repasswordInput = document.getElementById("repassword");
    var nameInput = document.getElementById("name");
    var phoneInput = document.getElementById("phone");
    var roleidInput = document.getElementById("roleid");
    var statusInput = document.getElementById("status");
    var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    var passwordPattern = /^.{6,}$/;
    var isValid = true;

    if (!emailPattern.test(emailInput.value)) {
      document.getElementById("email-error").textContent = "Email không hợp lệ";
      emailInput.style.borderColor = "red";
      isValid = false;
    } else {
      document.getElementById("email-error").textContent = "";
      emailInput.style.borderColor = "";
    }

    if (!passwordPattern.test(passwordInput.value)) {
      document.getElementById("password-error").textContent = "Mật khẩu phải có ít nhất 6 ký tự";
      passwordInput.style.borderColor = "red";
      isValid = false;
    } else {
      document.getElementById("password-error").textContent = "";
      passwordInput.style.borderColor = "";
    }

    if (passwordInput.value !== repasswordInput.value) {
      document.getElementById("repassword-error").textContent = "Mật khẩu không khớp";
      repasswordInput.style.borderColor = "red";
      isValid = false;
    } else {
      document.getElementById("repassword-error").textContent = "";
      repasswordInput.style.borderColor = "";
    }

    if (nameInput.value.trim() === "") {
      document.getElementById("name-error").textContent = "Họ tên không được để trống";
      nameInput.style.borderColor = "red";
      isValid = false;
    } else {
      document.getElementById("name-error").textContent = "";
      nameInput.style.borderColor = "";
    }

    if (!phoneInput.checkValidity()) {
      document.getElementById("phone-error").textContent = "Số điện thoại không hợp lệ";
      phoneInput.style.borderColor = "red";
      isValid = false;
    } else {
      document.getElementById("phone-error").textContent = "";
      phoneInput.style.borderColor = "";
    }

    if (roleidInput.value.trim() === "") {
      document.getElementById("roleid-error").textContent = "Role ID không được để trống";
      roleidInput.style.borderColor = "red";
      isValid = false;
    } else {
      document.getElementById("roleid-error").textContent = "";
      roleidInput.style.borderColor = "";
    }

    if (statusInput.value.trim() === "") {
      document.getElementById("status-error").textContent = "Status không được để trống";
      statusInput.style.borderColor = "red";
      isValid = false;
    } else {
      document.getElementById("status-error").textContent = "";
      statusInput.style.borderColor = "";
    }

    if (!isValid) {
      event.preventDefault();
    }
  });
});

</script>
