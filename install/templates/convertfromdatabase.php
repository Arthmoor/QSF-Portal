    <tr>
        <td colspan='2' class='subheader'>Old Board Database Information</td>
    </tr>
    <tr>
        <td><b>Host Server</b></td>
        <td><input class='input' type='text' name='old_db_host' value='<?php echo $oldset['old_db_host']; ?>' /></td>
    </tr>
    <tr>
        <td><b>Database Name</b></td>
        <td><input class='input' type='text' name='old_db_name' value='<?php echo $oldset['old_db_name']; ?>' /></td>
    </tr>
    <tr>
        <td><b>Database Username</b></td>
        <td><input class='input' type='text' name='old_db_user' value='<?php echo $oldset['old_db_user']; ?>' /></td>
    </tr>
    <tr>
        <td><b>Database Password</b></td>
        <td><input class='input' type='password' name='old_db_pass' value='' /></td>
    </tr>
    <tr>
        <td><b>Database Port</b><br /><span class='tiny'>Blank for none</span></td>
        <td><input class='input' type='text' name='old_db_port' value='<?php echo $oldset['old_db_port']; ?>' /></td>
    </tr>
    <tr>
        <td><b>Database Socket</b><br /><span class='tiny'>Blank for none</span></td>
        <td><input class='input' type='text' name='old_db_socket' value='<?php echo $oldset['old_db_socket']; ?>' /></td>
    </tr>
    <tr>
        <td><b>Table Prefix</b></td>
        <td><input class='input' type='text' name='old_prefix' value='<?php echo $oldset['old_prefix']; ?>' /></td>
    </tr>
    <tr>
        <td><b>Number of posts to convert at a time</b></td>
        <td><input class='input' type='text' name='post_inc' value='<?php echo $oldset['post_inc']; ?>' /></td>
    </tr>
