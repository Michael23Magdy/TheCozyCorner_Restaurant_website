<?php include('components/sidebar_header.php') ?>
    <main>
        <h2><i class="fa-duotone fa-solid fa-user"></i></i> Manage Admins</h2>
        <br>
        <div class="database">
            <a href="add-admin.php?name=admins" class="btn-add general-btns"> <i class="fa-solid fa-plus"></i> Add Admin</a>
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

                        function print_admin_row($SN, $username, $email,$id){
                            $url_del = SITE_URL."admin/delete-admin.php?id={$id}&name=admins";
                            $url_upd = SITE_URL."admin/update-admin.php?id={$id}&name=admins";
                            echo "
                                <tr>
                                    <td class=\"center_tbl_col\">{$SN}</td>
                                    <td>{$username}</td>
                                    <td>{$email}</td>
                                    <td class=\"center_tbl_col\">
                                        <a href=\"{$url_upd}\"><i class=\"fa-solid fa-pen\"></i></a>
                                        <a href=\"{$url_del}\"><i class=\"fa-solid fa-delete-left \"></i></a>
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
                                    print_admin_row($SN++,$username,$email,$id);
                                }
                            } else {
                                echo "
                                    <tr> <td colspan=\"6\"> no data added </td> <tr> 
                                ";
                            }
                        }
                    ?>
                    
                </tbody>
            </table>
        </div>
    </main>

<?php include('components/footer.php') ?>