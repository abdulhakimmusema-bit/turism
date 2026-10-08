            </main>
        </div>
    </div>

    <script>
        const mobileTrigger = document.querySelector('.mobile-sidebar-trigger');
        const sidebarClose = document.querySelector('.sidebar-toggle');
        const sidebar = document.querySelector('.admin-sidebar');
        
        if (mobileTrigger && sidebar) {
            mobileTrigger.addEventListener('click', () => {
                sidebar.classList.add('active');
            });
        }
        
        if (sidebarClose && sidebar) {
            sidebarClose.addEventListener('click', () => {
                sidebar.classList.remove('active');
            });
        }
    </script>
</body>
</html>
