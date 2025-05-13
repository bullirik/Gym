    <?php
    header('Content-Type: application/json'); // Попробуем сразу установить JSON-ответ

    $response = [
        'message' => 'Simple PHP POST test script reached!',
        'request_method' => $_SERVER['REQUEST_METHOD'],
        'get_data' => $_GET,
        'post_data_form' => $_POST, // Это будет заполнено, если Content-Type: application/x-www-form-urlencoded
        'raw_input' => file_get_contents('php://input'),
        'all_headers' => getallheaders()
    ];

    // Попытка декодировать raw_input как JSON, если Content-Type был application/json
    $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
    if (stripos($contentType, 'application/json') !== false) {
        $decodedJson = json_decode($response['raw_input'], true);
        if (json_last_error() === JSON_ERROR_NONE) {
            $response['decoded_json_body'] = $decodedJson;
        } else {
            $response['json_decode_error'] = json_last_error_msg();
        }
    }

    echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    ?>
    