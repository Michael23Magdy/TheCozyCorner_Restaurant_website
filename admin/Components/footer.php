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

        // Function to update the span with the image name if an image is selected
        function updateFileName() {
            // Get the file input and span elements
            const fileInput = document.getElementById('image_name');
            const fileNameDisplay = document.getElementById('fileName');
            
            // Check if a file is selected and if it is an image
            if (fileInput.files.length > 0 && fileInput.files[0].type.startsWith('image/')) {
                // Update the span with the image file's name
                fileNameDisplay.textContent = fileInput.files[0].name;
            } else {
                // Reset to default text if no image is selected or if it's not an image file
                fileNameDisplay.textContent = 'No image chosen';
            }
        }
        function resetFileName() {
            document.getElementById('fileName').textContent = 'No file chosen';
        }
        // Add event listener for when a file is selected
        document.getElementById('image_name').addEventListener('change', updateFileName);
        document.getElementById('form').addEventListener('reset', resetFileName);
        
        // Event listeners for the labels to toggle checkbox state and update classes
        document.getElementById('featured-btn').addEventListener('click', function() {
            const featuredLabel = document.getElementById('featured-btn');
            const featuredCheckbox = document.getElementById('featured-box');
            featuredLabel.className = featuredCheckbox.checked ? 'btn unset' : 'btn set';

        });

        document.getElementById('active-btn').addEventListener('click', function() {
            const activeLabel = document.getElementById('active-btn');
            const activeCheckbox = document.getElementById('active-box');
            activeLabel.className = activeCheckbox.checked ? 'btn unset' : 'btn set';
        });

    </script>
</body>
</html>