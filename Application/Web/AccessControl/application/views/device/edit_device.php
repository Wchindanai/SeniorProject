<?php
/**
 * Created by PhpStorm.
 * User: Dream
 * Date: 7/19/16
 * Time: 13:06
 *
 */
?>



<p>Room Name</p>
<input type="text" class="form-control" name="room_name" id="room_name" placeholder="Room Name" value="<?php echo $roomName ?>" required>

<p style="margin-top: 10px;">IP Address</p>
<input type="text" class="form-control check_ip" name="ip_address" id="ip_address" placeholder="0.0.0.0" value='<?php echo $ip ?>' required>
<div id="error_ip" class="alert-error" hidden>! Wrong IP Address</div>

<p style="margin-top: 10px;">Location</p>
<input type="text" class="form-control" name="location" id="location" value='<?php echo $location ?>' placeholder="Ex. Engineer Building">
<input type="text" name="deviceId" value="<?php echo $deviceId ?>" hidden>
