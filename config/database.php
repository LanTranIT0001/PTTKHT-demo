<?php
class Database {
    // 1. Khai báo các thông số cấu hình kết nối
    private $host = "localhost";
    private $db_name = "quanly_quancafe"; // Tên database bạn tạo ở phpMyAdmin
    private $username = "root";
    private $password = ""; // Nếu dùng MAMP trên macOS, đổi thành "root"
    private $conn = null;

    // 2. Hàm thiết lập kết nối dữ liệu sử dụng PDO
    public function getConnection() {
        if ($this->conn !== null) {
            return $this->conn;
        }

        try {
            // Cấu hình chuỗi DSN (Data Source Name) hỗ trợ UTF-8 hiển thị tiếng Việt
            $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=utf8mb4";
            
            // Thiết lập các thuộc tính phòng vệ và bắt lỗi hệ thống
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Đẩy lỗi ra dạng Exception để dễ bắt và debug
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Trả dữ liệu về dạng mảng kết hợp (Associative Array)
                PDO::ATTR_EMULATE_PREPARES   => false,                  // Tắt chế độ giả lập Prepare nhằm thắt chặt bảo mật
            ];

            // Khởi tạo đối tượng PDO
            $this->conn = new PDO($dsn, $this->username, $this->password, $options);
            
        } catch (PDOException $exception) {
            // Xử lý ngoại lệ lỗi kết nối: Không hiển thị trực tiếp mật khẩu ra màn hình khi sập hệ thống
            die("Lỗi kết nối cơ sở dữ liệu: " . $exception->getMessage());
        }

        return $this->conn;
    }
}
?>
