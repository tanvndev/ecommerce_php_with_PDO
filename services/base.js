const showToast = (type, message, timer = 1500) => {
  const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: timer,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer);
      toast.addEventListener('mouseleave', Swal.resumeTimer);
    },
  });

  Toast.fire({
    icon: type,
    title: message,
  });
};

const showAlert = (title, type, timer = 3000) => {
  Swal.fire({
    title: title,
    text: 'Vấn đề bạn đang gặp là gì vui lòng liên hệ chúng tôi.',
    icon: type,
    showCancelButton: false,
    confirmButtonColor: '#3085d6',
    confirmButtonText: 'Đi tới gmail',
    timer: timer,
    timerProgressBar: true,
  }).then((result) => {
    if (result.isConfirmed) {
      window.open('http://gmail.com/', '_blank');
      return;
    }
    window.location.href = 'login';
  });
};

const formatCurrency = (amount) => {
  var formattedAmount = new Intl.NumberFormat('vi-VN', {
    style: 'currency',
    currency: 'VND',
  }).format(amount);
  return formattedAmount;
};
function calculateOriginalPrice(price, discount) {
  if (discount < 0 || discount > 100) {
    return '0đ';
  }

  const originalPrice = price / (1 - discount / 100);
  return new Intl.NumberFormat('vi-VN', {
    style: 'currency',
    currency: 'VND',
  }).format(originalPrice);
}

const renderStars = (number) => {
  const filledStars = Math.round(number);
  const starArray = [];

  for (let index = 0; index < 5; index++) {
    if (index < filledStars) {
      starArray.push('<i class="fas fa-star"></i>');
    } else {
      starArray.push('<i class="far fa-star"></i>');
    }
  }
  return starArray.join(' ');
};
