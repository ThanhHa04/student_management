<?php
$conn = new mysqli("localhost", "root", "", "your_database");

$id = $_POST['id'] ?? null;
$teacher_id = $_POST['teacher_id'];
$degree_name = $_POST['degree_name'];
$institution = $_POST['institution'];
$year = $_POST['year'];

if ($id) {
    $stmt = $conn->prepare("UPDATE certificates SET teacher_id=?, degree_name=?, institution=?, year=? WHERE id=?");
    $stmt->bind_param("issii", $teacher_id, $degree_name, $institution, $year, $id);
} else {
    $stmt = $conn->prepare("INSERT INTO certificates (teacher_id, degree_name, institution, year) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("issi", $teacher_id, $degree_name, $institution, $year);
}

if ($stmt->execute()) {
    echo "Lưu thành công. <a href='list_certificates.php'>Quay lại danh sách</a>";
} else {
    echo "Lỗi: " . $stmt->error;
}
