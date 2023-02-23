<?php
if (isset($_SESSION['message'])) :
?>

    <div role="alert">
        <strong>Hey!</strong> <?= $_SESSION['message']; ?>
        <button type="button" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

<?php
    unset($_SESSION['message']);
endif;
?>