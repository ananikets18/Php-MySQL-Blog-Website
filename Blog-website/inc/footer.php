<?php
define('JSPATH', './inc/js/'); 
$jsItem = 'script.js'; 
?>

<footer class="footer mt-auto py-3 border-top">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <span class="text-muted">&copy; 2021 - <a href="index.php" class="heading text-primary fw-bold">BLog</a>
                Project </span>
            <span class="text-muted">218714</span>
        </div>
    </div>
</footer>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js">
</script>
<script type="text/javascript" src="<?php echo (JSPATH . "$jsItem") ?>" defer></script>
</body>

</html>