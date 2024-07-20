<?php 
    class Accountant {

        public function upload($conn) {
            $uploadDir = '../../uploads/';
            $fileName = basename($_FILES['file']['name']);
            $targetFilePath = $uploadDir . $fileName;
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        
            if ($_FILES['file']['size'] > 12 * 1024 * 1024) { 
                echo "File size exceeds 12MB limit.";
            } else {
                $allowedTypes = ['jpg', 'png', 'jpeg', 'gif', 'pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx'];
                if (in_array($fileType, $allowedTypes)) {
                    if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)) {
                        $theme = implode(', ', $_POST['theme']);
                        $stmt = $conn->prepare("INSERT INTO uploads (file_name, file_description, file_path, theme) VALUES (?, ?, ?, ?)");
                        $stmt->execute([$_POST['file_name'], $_POST['file_description'], $targetFilePath, $theme]);
                        echo "Файл успешно загружен.";
                    } else {
                        echo "Извините, произошла ошибка при загрузке вашего файла.";
                    }
                } else {
                    echo "К сожалению, разрешены только файлы в форматах JPG, JPEG, PNG, GIF, PDF, DOC, DOCX, XLS, XLSX, PPT и PPTX.";
                }
            }
        }

        public function delete($conn) {
            $fileId = $_POST['file_id'];
    
            $stmt = $conn->prepare("SELECT file_path FROM uploads WHERE id = ?");
            $stmt->execute([$fileId]);
            $file = $stmt->fetch(PDO::FETCH_ASSOC);
        
            if ($file) {
                if (unlink($file['file_path'])) {
                    $stmt = $conn->prepare("DELETE FROM uploads WHERE id = ?");
                    $stmt->execute([$fileId]);
                    header('Location: #');
                    exit();
                } else {
                    echo "Ошибка при удалении файла.";
                }
            } else {
                echo "Файл не найден.";
            }
        
        }

        public function download() {
            $filePath = isset($_POST['file_path']) ? $_POST['file_path'] : '';

            if (file_exists($filePath) && is_readable($filePath)) {
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($filePath));
                ob_clean();
                flush();
                readfile($filePath);
                exit;
            } else {
                echo "Файл не найден или недоступен.";
            }
        }

    }
?>