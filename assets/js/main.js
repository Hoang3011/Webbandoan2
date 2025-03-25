// Open Search Advanced
document.querySelector(".filter-btn").addEventListener("click", (e) => {
  e.preventDefault();
  document.querySelector(".advanced-search").classList.toggle("open");
  document.getElementById("home-service").scrollIntoView();
});

document.querySelector(".form-search-input").addEventListener("click", (e) => {
  e.preventDefault();
  document.getElementById("home-service").scrollIntoView();
});

function closeSearchAdvanced() {
  document.querySelector(".advanced-search").classList.toggle("open");
}

document.querySelectorAll(".inner-img a").forEach(function (item) {
  item.addEventListener("click", function (event) {
    event.preventDefault();
  });
});

function dangKi() {
  alert("Đăng kí thành công");
}

function thanhToan() {
  alert("Món ăn đã được thêm vào giỏ hàng !");
}

let lastScrollY = window.scrollY;
const headerBottom = document.querySelector(".header-bottom");

window.addEventListener("scroll", () => {
  if (window.scrollY > lastScrollY) {
    headerBottom.classList.add("hide");
    headerBottom.classList.remove("show");
  } else {
    headerBottom.classList.add("show");
    headerBottom.classList.remove("hide");
  }
  lastScrollY = window.scrollY;
});

function capNhat() {
  alert("Cập nhật thông tin thành công !");
}

function thayDoi() {
  alert("Đổi mật khẩu thành công !");
}

function tinhTien() {
  alert("Thanh toán thành công !");
}

function notLogin() {
  alert("Chưa đăng nhập tài khoản !");
}

document.addEventListener("DOMContentLoaded", function () {
  // Lấy tất cả các nút accordion
  const accordionButtons = document.querySelectorAll(".PhuongThuc .btn");

  accordionButtons.forEach((button) => {
    button.addEventListener("click", function () {
      // Xóa lớp grayscale khỏi tất cả các nút
      accordionButtons.forEach((btn) => btn.classList.remove("grayscale"));

      // Áp dụng lớp grayscale cho tất cả các nút trừ nút đang được nhấn
      accordionButtons.forEach((btn) => {
        if (btn !== this) {
          btn.classList.add("grayscale");
        }
      });
    });
  });
});

let result = document.querySelector("#tanggiam").value;
let tang = document.querySelector("#tang");
let giam = document.querySelector("#giam");

tang.addEventListener("click", () => {
  result++;
  document.querySelector("#tanggiam").value = result;
});

giam.addEventListener("click", () => {
  if (result > 1) {
    result--;
    document.querySelector("#tanggiam").value = result;
  }
});
document.getElementById("search-form").addEventListener("submit", function (event) {
  event.preventDefault(); // Ngăn load lại trang

  let name = document.getElementById("search-input").value.trim();
  let category = document.getElementById("advanced-search-category-select")?.value || "";
  let minPrice = document.getElementById("min-price")?.value || "";
  let maxPrice = document.getElementById("max-price")?.value || "";

  let formData = new FormData();
  formData.append("name", name);
  formData.append("category", category);
  formData.append("min_price", minPrice);
  formData.append("max_price", maxPrice);

  fetch("search.php", {
      method: "POST",
      body: formData
  })
  .then(response => response.json())
  .then(data => {
      let resultContainer = document.getElementById("search-results");
      resultContainer.innerHTML = ""; // Xóa kết quả cũ

      if (data.length === 0) {
          resultContainer.innerHTML = "<p>Không tìm thấy sản phẩm phù hợp.</p>";
          return;
      }

      data.forEach(product => {
          let productHTML = `
              <div class="product-item">
                  <img src="${product.Image}" alt="${product.Name}">
                  <h3>${product.Name}</h3>
                  <p>${product.Describtion}</p>
                  <p>Giá: ${product.Price} VNĐ</p>
              </div>
          `;
          resultContainer.innerHTML += productHTML;
      });
  })
  .catch(error => console.error("Lỗi khi tìm kiếm sản phẩm:", error));
});
