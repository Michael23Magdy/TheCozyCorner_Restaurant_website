<?php include('components/sidebar_header.php') ?>
    <?php 
        if(isset($_SESSION['stat'])){
            echo "<p class=\"success msg\"> *{$_SESSION['stat']} </p>";
            unset($_SESSION['stat']);
        }
    ?>
    <main>
        <h2><i class="fa-duotone fa-solid fa-user"></i></i> Manage Admins</h2>
        <br>
        <div class="database">
            <a href="add-admin.php?name=admins" class="btn-add"> <i class="fa-solid fa-plus"></i> Add Admin</a>
            <table>
                <thead>
                    <tr>
                        <th>S.N.</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT user_id,username,email FROM users WHERE role='admin'";
                        $res = mysqli_query($conn, $sql);

                        function print_admin_row($SN, $username, $email){
                            echo "
                                <tr>
                                    <td>{$SN}</td>
                                    <td>{$username}</td>
                                    <td>{$email}</td>
                                    <td>
                                        <i class=\"fa-solid fa-pen\"></i>
                                        <i class=\"fa-solid fa-delete-left \"></i>
                                    </td>
                                </tr>
                            ";
                        }

                        if($res == true){
                            $no_rows = mysqli_num_rows($res);
                            if($no_rows > 0){
                                $SN = 1;
                                while($row=mysqli_fetch_assoc($res)){
                                    $id = $row['user_id'];
                                    $username = $row['username'];
                                    $email = $row['email'];
                                    print_admin_row($SN++,$username,$email);
                                }
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </main>

<?php include('components/footer.php') ?>