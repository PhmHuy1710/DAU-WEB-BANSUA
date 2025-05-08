document.addEventListener("DOMContentLoaded", function () {
  // Kích hoạt animation khi cuộn trang
  const fadeElements = document.querySelectorAll(".fade-in");
  const scaleElements = document.querySelectorAll(".scale-in");

  const observerOptions = {
    root: null,
    rootMargin: "0px",
    threshold: 0.1,
  };

  // Xử lý hiệu ứng fadeIn
  const fadeObserver = new IntersectionObserver(function (entries, observer) {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.style.animationPlayState = "running";
        observer.unobserve(entry.target);
      }
    });
  }, observerOptions);

  fadeElements.forEach(el => {
    el.style.animationPlayState = "paused";
    fadeObserver.observe(el);
  });

  // Xử lý hiệu ứng scaleIn
  const scaleObserver = new IntersectionObserver(function (entries, observer) {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.style.animationPlayState = "running";
        observer.unobserve(entry.target);
      }
    });
  }, observerOptions);

  scaleElements.forEach(el => {
    el.style.animationPlayState = "paused";
    scaleObserver.observe(el);
  });

  // Xử lý toast notification
  function showToast(message, type = "success") {
    const toast = document.createElement("div");
    toast.className = "toast-notification";

    if (type === "success") {
      toast.innerHTML = `<i class="fas fa-check-circle"></i> ${message}`;
      toast.style.backgroundColor = "#28a745";
    } else if (type === "error") {
      toast.innerHTML = `<i class="fas fa-exclamation-circle"></i> ${message}`;
      toast.style.backgroundColor = "#dc3545";
    } else if (type === "info") {
      toast.innerHTML = `<i class="fas fa-info-circle"></i> ${message}`;
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
  }

  // Xử lý biểu mẫu tìm kiếm
  const searchForm = document.querySelector(".hero-search");
  if (searchForm) {
    searchForm.addEventListener("submit", function (e) {
      const searchInput = this.querySelector(".search-input");
      if (searchInput.value.trim() === "") {
        e.preventDefault();
        showToast("Vui lòng nhập từ khóa tìm kiếm", "info");
      }
    });
  }

  // Xử lý nút thêm vào giỏ hàng (nếu có)
  const addToCartButtons = document.querySelectorAll(".add-to-cart");
  if (addToCartButtons.length > 0) {
    addToCartButtons.forEach(button => {
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
