<?php
$conn = new mysqli("localhost", "root", "", "your_database");

$edit_id = $_GET['id'] ?? null;
$data = ['degree_name' => '', 'institution' => '', 'year' => '', 'teacher_id' => ''];

if ($edit_id) {
    $stmt = $conn->prepare("SELECT * FROM certificates WHERE id = ?");
    $stmt->bind_param("i", $edit_id);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    $data = $result ?: $data;
}
?>

<form method="POST" action="save_certificate.php">
    <input type="hidden" name="id" value="<?= htmlspecialchars($edit_id) ?>">
    <label>Giáo viên ID:</label>
    <input type="number" name="teacher_id" value="<?= htmlspecialchars($data['teacher_id']) ?>" required><br>

    <label>Tên bằng cấp:</label>
    <input type="text" name="degree_name" value="<?= htmlspecialchars($data['degree_name']) ?>" required><br>

    <label>Trường cấp:</label>
    <input type="text" name="institution" value="<?= htmlspecialchars($data['institution']) ?>"><br>

    <label>Năm cấp:</label>
    <input type="number" name="year" value="<?= htmlspecialchars($data['year']) ?>"><br>

    <button type="submit"><?= $edit_id ? 'Cập nhật' : 'Thêm mới' ?></button>
</form>
<form method="POST" action="{{ route('teachers.certificates.save', $teacher->id) }}">
    @csrf
    <label>Bằng cấp:</label>
    <input type="text" name="degree_name" required><br>

    <label>Trường:</label>
    <input type="text" name="institution"><br>

    <label>Năm:</label>
    <input type="number" name="year"><br>

    <button type="submit">Lưu</button>
</form>