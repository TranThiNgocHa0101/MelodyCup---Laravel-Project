// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Lấy dữ liệu từ API và vẽ Pie Chart
$(document).ready(function () {
    // Gọi API để lấy dữ liệu
    $.ajax({
        url: '/api/scores', // URL của API lấy dữ liệu (Laravel)
        method: 'GET',
        success: function (data) {
            // Xử lý dữ liệu JSON trả về từ API
            const labels = data.map(item => 'User ' + item.user_id); // Nhãn là user_id
            const percentages = data.map(item => item.percentage); // Dữ liệu phần trăm điểm
            const backgroundColors = ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b']; // Màu cho từng user

            // Render Pie Chart
            var ctx = document.getElementById("myPieChart");
            var myPieChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: labels, // Gắn nhãn từ API
                    datasets: [{
                        data: percentages, // Dữ liệu phần trăm từ API
                        backgroundColor: backgroundColors.slice(0, percentages.length), // Giới hạn màu theo số lượng users
                        hoverBackgroundColor: backgroundColors.map(color => shadeColor(color, -20)).slice(0, percentages.length), // Hover màu sáng hơn
                        hoverBorderColor: "rgba(234, 236, 244, 1)",
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        backgroundColor: "rgb(255,255,255)",
                        bodyFontColor: "#858796",
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        caretPadding: 10,
                    },
                    legend: {
                        display: true, // Hiển thị chú thích
                        position: 'bottom', // Đưa chú thích xuống dưới
                        labels: {
                            fontColor: "#858796", // Màu font của chú thích
                        },
                    },
                    cutoutPercentage: 80, // Độ rỗng trong biểu đồ
                },
            });
        },
        error: function (xhr, status, error) {
            console.error("Error fetching data: ", error);
        }
    });

    // Hàm chỉnh sửa độ sáng màu (cho hover)
    function shadeColor(color, percent) {
        let R = parseInt(color.substring(1, 3), 16);
        let G = parseInt(color.substring(3, 5), 16);
        let B = parseInt(color.substring(5, 7), 16);

        R = parseInt(R * (100 + percent) / 100);
        G = parseInt(G * (100 + percent) / 100);
        B = parseInt(B * (100 + percent) / 100);

        R = (R < 255) ? R : 255;
        G = (G < 255) ? G : 255;
        B = (B < 255) ? B : 255;

        let RR = ((R.toString(16).length == 1) ? "0" + R.toString(16) : R.toString(16));
        let GG = ((G.toString(16).length == 1) ? "0" + G.toString(16) : G.toString(16));
        let BB = ((B.toString(16).length == 1) ? "0" + B.toString(16) : B.toString(16));

        return "#" + RR + GG + BB;
    }
});
