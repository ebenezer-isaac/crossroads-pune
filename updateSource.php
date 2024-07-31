<?php
// Validate and sanitize the input source
function getValidSource($validSources)
{
    if (isset($_POST['source']) && in_array($_POST['source'], $validSources, true)) {
        return htmlspecialchars($_POST['source'], ENT_QUOTES, 'UTF-8');
    }
    return false;
}

$validSources = ['flyer', 'poster', 'spoon', 'instagram'];
$source = getValidSource($validSources);

if ($source !== false) {
    $jsonFile = './qr.json';
    if (file_exists($jsonFile)) {
        $data = file_get_contents($jsonFile);
        $sources = json_decode($data, true);
        if (json_last_error() === JSON_ERROR_NONE) {
            if (array_key_exists($source, $sources)) {
                $sources[$source] += 1;
            } else {
                $sources[$source] = 1;
            }
            $updatedData = json_encode($sources, JSON_PRETTY_PRINT);
            if (file_put_contents($jsonFile, $updatedData)) {
                echo json_encode(['status' => 'success', 'message' => 'Source count updated']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to write to file']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid JSON data']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'File not found']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid source']);
}
