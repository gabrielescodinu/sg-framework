<?php
if (isset($_SESSION['message'])) :
?>

    <div role="alert">
        <strong>Hey!</strong> <?= $_SESSION['message']; ?>
    </div>

<?php
    unset($_SESSION['message']);
endif;
?>