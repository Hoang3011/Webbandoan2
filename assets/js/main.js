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
  // Gán sự kiện mở/tắt bộ lọc
  let toggleFilterBtn = document.getElementById("toggle-filter-btn");
  let advancedSearch = document.querySelector("advanced-search");
  
  if (toggleFilterBtn && advancedSearch) {
      toggleFilterBtn.addEventListener("click", function () {
          advancedSearch.classList.toggle("active");
      });
  }

  // Gán sự kiện khi nhấn nút tìm kiếm
  let searchBtn = document.getElementById("advanced-search-price-btn");
  if (searchBtn) {
      searchBtn.addEventListener("click", function () {
          searchProducts();
      });
  }
});

function searchProducts(sortOrder = 0) {
  let name = document.getElementById("search-input")?.value.trim() || "";
  let category = document.getElementById("advanced-search-category-select")?.value || "";
  let minPrice = document.getElementById("min-price")?.value || "";
  let maxPrice = document.getElementById("max-price")?.value || "";

  let formData = new FormData();
  formData.append("name", name);
  formData.append("category", category);
  formData.append("min_price", minPrice);
  formData.append("max_price", maxPrice);
  formData.append("sort_order", sortOrder);

  fetch("../includes/search.php", {
      method: "POST",
      body: formData
  })
  .then(response => response.json())
  .then(data => {
      let resultContainer = document.getElementById("search-results");
      resultContainer.innerHTML = ""; // Xóa kết quả cũ

      if (!Array.isArray(data) || data.length === 0) {
          resultContainer.innerHTML = "<p>Không tìm thấy sản phẩm phù hợp.</p>";
          return;
      }

      data.forEach(product => {
          let productHTML = `
              <div class="product-item">
                  <img src="${product.image}" alt="${product.name}">
                  <h3>${product.name}</h3>
                  <p>${product.description}</p>
                  <p>Giá: ${product.price} VNĐ</p>
              </div>
          `;
          resultContainer.innerHTML += productHTML;
      });
  })
  .catch(error => console.error("Lỗi khi tìm kiếm sản phẩm:", error));
}
