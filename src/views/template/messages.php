<?php
    $errors = [];

    if($exception) {
        $message = [
            'type' => 'error',
            'message' => $exception->getMessage()
        ];

        if(get_class($exception) === 'ValidationException') {
            $errors = $exception->getErrors();
        }
    }

    $alertType = 'success';

    if($message['type'] === 'error') {
        $alertType = 'danger';
    }
?>

<?php if($message): ?>
<div class="my-3 alert alert-<?= $alertType ?>" role="alert">
    <?= $message['message'] ?>
</div>
<?php endif ?>