<footer>
                <p>
                    &copy all rights reserved to <span>The Cozy Corner</span>. 
                    developed by <span>Michael Magdy</span>.
                </p>
            </footer>
        </div>
    </div>
    <script>
        function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const container = document.querySelector('.container');

        if (sidebar.style.marginLeft === '-250px') {
            sidebar.style.marginLeft = '0';
            container.style.marginLeft = '0';
        } else {
            sidebar.style.marginLeft = '-250px'; 
            container.style.marginLeft = '-250px';
        }
}
    </script>
</body>
</html>