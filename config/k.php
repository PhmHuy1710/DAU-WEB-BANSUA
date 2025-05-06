<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Khung Sản Phẩm</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box; 
    }
    body {
      width: 100%;
      height: 100vh; 
    }
    .sanpham {
      width: 100%;
      height: 100vh;
      display: flex;
    }
    .sanpham1 {
      width: 200px;
      height: 250px;
      border: 1px solid black;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }
    img {
      width: 180px;
      height: 60%;
      border-radius: 10px;
      object-fit: cover;
    }
    button {
      width: 80%;
      height: 30px;
      border-radius: 5px;
      border: none;
      background-color: #ff9900;
      color: #fff;
      margin-top: 5px;
    }
    button:hover {
      background-color: #ff6600;
      color: #fff;
    }
  </style>
</head>
<body>
  <div class="sanpham">
    <div class="sanpham1">
      <img src="https://yamicomputer.com/image/data/tintuc-ngoc/hinh-nen-may-tinh-dep-full-hd-8.jpg" alt="Sản phẩm">
      <div class="ten">Tên sản phẩm</div>
      <DIV>Giá: 100$</DIV>
      <button type="submit">Thêm vào giỏ hàng</button>
      <button type="submit">Mua hàng</button>
    </div>
  </div>
</body>
</html>
