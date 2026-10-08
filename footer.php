    <footer>
        <p>&copy; <?php echo date("Y"); ?> ስልጤ-TOUR Management System | All Rights Reserved.</p>
    </footer>

    <script>
        const menuToggle = document.querySelector('.menu-toggle');
        const navMenu = document.querySelector('.nav-menu');
        if (menuToggle && navMenu) {
            menuToggle.addEventListener('click', () => {
                navMenu.classList.toggle('active');
                const icon = menuToggle.querySelector('i');
                if (navMenu.classList.contains('active')) {
                    icon.classList.replace('fa-bars', 'fa-times');
                } else {
                    icon.classList.replace('fa-times', 'fa-bars');
                }
            });
        }
    </script>
</body>
</html>
