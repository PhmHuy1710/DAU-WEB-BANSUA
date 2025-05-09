document.addEventListener("DOMContentLoaded", function () {
  // Kích hoạt animation khi cuộn trang
  const phanTuMo = document.querySelectorAll(".fade-in");
  const phanTuPhong = document.querySelectorAll(".scale-in");

  const tuyChinh = {
    root: null,
    rootMargin: "0px",
    threshold: 0.1,
  };

  // Xử lý hiệu ứng fadeIn
  const xuLyMo = new IntersectionObserver(function (entries, observer) {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.style.animationPlayState = "running";
        observer.unobserve(entry.target);
      }
    });
  }, tuyChinh);

  phanTuMo.forEach(el => {
    el.style.animationPlayState = "paused";
    xuLyMo.observe(el);
  });

  // Xử lý hiệu ứng scaleIn
  const xuLyPhong = new IntersectionObserver(function (entries, observer) {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.style.animationPlayState = "running";
        observer.unobserve(entry.target);
      }
    });
  }, tuyChinh);

  phanTuPhong.forEach(el => {
    el.style.animationPlayState = "paused";
    xuLyPhong.observe(el);
  });

  // Kiểm tra nếu hàm showToast đã tồn tại (trong footer.php), tạo một alias
  if (typeof window.showToast !== "function") {
    // Hàm hiển thị thông báo toast (chỉ định nghĩa nếu chưa tồn tại)
    window.showToast = function (thongBao, loai = "success") {
      const toast = document.createElement("div");
      toast.className = "toast-notification";

      if (loai === "success") {
        toast.innerHTML = `<i class="fas fa-check-circle"></i> ${thongBao}`;
        toast.style.backgroundColor = "#28a745";
      } else if (loai === "error") {
        toast.innerHTML = `<i class="fas fa-exclamation-circle"></i> ${thongBao}`;
        toast.style.backgroundColor = "#dc3545";
      } else if (loai === "info") {
        toast.innerHTML = `<i class="fas fa-info-circle"></i> ${thongBao}`;
        toast.style.backgroundColor = "#17a2b8";
      }

      document.body.appendChild(toast);

      // Hiển thị toast
      setTimeout(() => {
        toast.classList.add("show");
      }, 100);

      // Ẩn toast sau 3 giây
      setTimeout(() => {
        toast.classList.remove("show");

        // Xóa toast khỏi DOM sau khi animation kết thúc
        setTimeout(() => {
          document.body.removeChild(toast);
        }, 300);
      }, 3000);
    };
  }

  // Xử lý biểu mẫu tìm kiếm
  const formTimKiem = document.querySelector(".hero-search");
  if (formTimKiem) {
    formTimKiem.addEventListener("submit", function (e) {
      const oTimKiem = this.querySelector(".search-input");
      if (oTimKiem.value.trim() === "") {
        e.preventDefault();
        showToast("Vui lòng nhập từ khóa tìm kiếm", "info");
      }
    });
  }

  // Xử lý nút thêm vào giỏ hàng (nếu có)
  const nutThemGio = document.querySelectorAll(".add-to-cart");
  if (nutThemGio.length > 0) {
    nutThemGio.forEach(button => {
      button.addEventListener("click", function (e) {
        e.preventDefault();

        // Thêm vào giỏ hàng logic ở đây (AJAX request)
        // ...

        // Hiển thị thông báo
        showToast("Sản phẩm đã được thêm vào giỏ hàng", "success");
      });
    });
  }
});
