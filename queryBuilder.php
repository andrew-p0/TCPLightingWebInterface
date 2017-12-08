<?php
include "include.php";
pageHeader("IFTTT Query Builder");
?>
<style>
p{margin: 10px 0; }
</style>
<div class="container" style="padding: 20px; background-color: #fff; border: 1px solid #000;">
<p>Use this to assist with creation of the IFTTT web-hooks quickly</p>
<p>I suggest setting up a Google Assistant Hook which then calls a webhook with the API string. Follow the guides in the wiki and feel free to ask a question in the forum</p>
<?php 
if( ALLOW_EXTERNAL_API_ACCESS == 1 ){
?>

<script>
var allowExternalAPI = "<?php echo ALLOW_EXTERNAL_API_ACCESS; ?>";
var externalAddr = "<?php echo EXTERNAL_DDNS_URL; ?>";
var externalPort = "<?php echo EXTERNAL_PORT; ?>";
var externalPass = "<?php echo EXTERNAL_API_PASSWORD; ?>";
var requireExtPass = "<?php echo REQUIRE_EXTERNAL_API_PASSWORD; ?>";

$(function(){
	$('#sceneLights').hide();
	$('#roomLights').hide();
	$('#builder').change(function(){
		console.log( $(this).val() );
		var id = $(this).find('option:selected').attr('data-device-id');
		var type = $(this).find('option:selected').attr('data-device-type');
		var roomName = "";
		$('#appletImage').html('');
		
		if( type == "room" || type == "light"){
			$('#sceneLights').hide();
			$('#roomLights').show();
			
			roomName = $(this).find('option:selected').attr('data-room-name');
			console.log("Type: " + type + ", id: " + id + ", RN: " + roomName );
			$('#appletImage').html('<img src="images/IFTTTAppletPhrase.png"/>');
			
			if( type == "room" ){
				$('#command_on_1').html("TCP " +  roomName + " lights ON");
				$('#command_on_2').html("Turn " + roomName + " TCP Lights ON");
				$('#command_on_3').html(roomName + " on");
				$('#command_on_response').html("Turning " + roomName + " Lights ON");
				$('#command_on_url').html( externalAddr + ( externalPort != 80 ?  ':' + externalPort : '' ) + '/api.php?fx=toggle&type=room&uid=' + id + '&val=1' + ( requireExtPass == 1 ? '&password=' + externalPass : '')  );
				
				$('#command_off_1').html("TCP " +  roomName + " lights off");
				$('#command_off_2').html("Turn " + roomName + " TCP Lights off");
				$('#command_off_3').html(roomName + " off");
				$('#command_off_response').html("Turning " + roomName + " Lights off");
				$('#command_off_url').html( externalAddr + ( externalPort != 80 ?  ':' + externalPort : '' ) + '/api.php?fx=toggle&type=room&uid=' + id + '&val=0' + ( requireExtPass == 1 ? '&password=' + externalPass : '') );
				
				$('#command_dim_1').html("Dim " +  roomName + " lights to # %");
				$('#command_dim_2').html("Set " + roomName + " lights brightness to # %");
				$('#command_dim_3').html(roomName + " brightness # %");
				$('#command_dim_response').html("Dimming " + roomName + " lights");
				$('#command_dim_url').html( externalAddr + ( externalPort != 80 ?  ':' + externalPort : '' ) + '/api.php?fx=dimby&type=room&uid=' + id + '&val={{NumberField}}' + ( requireExtPass == 1 ? '&password=' + externalPass : '') );
			}
			
			if( type == "light" ){
				$('#command_on_1').html("TCP " +  roomName + " light ON");
				$('#command_on_2').html("Turn " + roomName + " TCP Light ON");
				$('#command_on_3').html(roomName + " on");
				$('#command_on_response').html("Turning " + roomName + " Light ON");
				$('#command_on_url').html( externalAddr + ( externalPort != 80 ?  ':' + externalPort : '' ) + '/api.php?fx=toggle&type=device&uid=' + id + '&val=1' + ( requireExtPass == 1 ? '&password=' + externalPass : '')  );
				
				$('#command_off_1').html("TCP " +  roomName + " light off");
				$('#command_off_2').html("Turn " + roomName + " TCP Light off");
				$('#command_off_3').html(roomName + " off");
				$('#command_off_response').html("Turning " + roomName + " Light off");
				$('#command_off_url').html( externalAddr + ( externalPort != 80 ?  ':' + externalPort : '' ) + '/api.php?fx=toggle&type=device&uid=' + id + '&val=0' + ( requireExtPass == 1 ? '&password=' + externalPass : '') );
				
				$('#command_dim_1').html("Dim " +  roomName + " light to # %");
				$('#command_dim_2').html("Set " + roomName + " light brightness to # %");
				$('#command_dim_3').html(roomName + " brightness # %");
				$('#command_dim_response').html("Dimming " + roomName + " lights");
				$('#command_dim_url').html( externalAddr + ( externalPort != 80 ?  ':' + externalPort : '' ) + '/api.php?fx=dimby&type=device&uid=' + id + '&val={{NumberField}}' + ( requireExtPass == 1 ? '&password=' + externalPass : '') );
			}
			
			
			
		}
		
		if( type == "scene" ){
			$('#sceneLights').show();
			$('#roomLights').hide();
			var sceneName = $(this).find('option:selected').attr('data-device-name');
			console.log("Type: " + type + ", id: " + id + ", scene: " + sceneName );
			$('#appletImage').html('<img src="images/IFTTTAppletPhrase.png"/>');
			
			$('#scene_command_on_1').html("Activate " + sceneName );
			$('#scene_command_on_2').html("Turn " + sceneName + " scene ON");
			$('#scene_command_on_3').html(sceneName + " scene on");
			$('#scene_command_on_response').html("Turning " + sceneName + " devices ON");
			
			$('#scene_command_on_url').html( externalAddr + ( externalPort != 80 ?  ':' + externalPort : '' ) + '/api.php?fx=scene&type=on&uid=' + id + '&val=1' + ( requireExtPass == 1 ? '&password=' + externalPass : '')  );
			
			$('#scene_command_off_1').html("Deactivate " +  sceneName);
			$('#scene_command_off_2').html("Turn " + sceneName + " scene off");
			$('#scene_command_off_3').html(sceneName + " off");
			$('#scene_command_off_response').html("Turning " + sceneName + " devices off");
			
			$('#scene_command_off_url').html( externalAddr + ( externalPort != 80 ?  ':' + externalPort : '' ) + '/api.php?fx=scene&type=off&uid=' + id + '&val=0' + ( requireExtPass == 1 ? '&password=' + externalPass : '') );
			
			$('#command_run_1').html("Run " +  sceneName + " scene");
			$('#command_run_2').html("Enable " + sceneName + " scene");
			$('#command_run_3').html(sceneName + "scene on");
			$('#command_run_response').html("Running " + sceneName + " scene");
			
			$('#command_run_url').html( externalAddr + ( externalPort != 80 ?  ':' + externalPort : '' ) + '/api.php?fx=scene&type=run&uid=' + id + '&val={{NumberField}}' + ( requireExtPass == 1 ? '&password=' + externalPass : '') );
			
		}

	});
});
</script>

<p>
<select id="builder">
	<option>Select a Device | Room | Scene</option>
<?php
//Get State of System Data
	$CMD = "cmd=GWRBatch&data=<gwrcmds><gwrcmd><gcmd>RoomGetCarousel</gcmd><gdata><gip><version>1</version><token>".TOKEN."</token><fields>name,image,imageurl,control,power,product,class,realtype,status</fields></gip></gdata></gwrcmd></gwrcmds>&fmt=xml";
	$result = getCurlReturn($CMD);
	$array = xmlToArray($result);
	if( isset( $array["gwrcmd"]["gdata"]["gip"]["room"] ) ){
		$DATA = $array["gwrcmd"]["gdata"]["gip"]["room"];
	}
	
	if( sizeof($DATA) > 0 ){
		if ( isset( $DATA["rid"] ) ){ $DATA = array( $DATA ); }
		echo '<optgroup label="Rooms">';
		foreach($DATA as $room){
			echo '<option data-device-type="room" data-device-id="'.$room["rid"].'" data-room-name="'.$room["name"].'">'    .  $room["name"] .    '</option>';
			if( ! is_array($room["device"]) ){
				
			}else{
				$device = (array)$room["device"];
				if( isset($device["did"]) ){
					$DEVICES[] = "<option data-device-type='light' data-device-id='".$room["device"]["did"]."' data-room-name='".$room["name"]."'>".  $room["device"]["name"] ."</option>";
				}else{	
					for( $x = 0; $x < sizeof($device); $x++ ){
						if( isset($device[$x]) && is_array($device[$x]) && ! empty($device[$x]) ){
							$DEVICES[] = '<option data-device-type="light" data-device-id="'.$device[$x]["did"].'" data-room-name="'.$room["name"].'">'. $device[$x]["name"] ."</option>";
						}
					}
				}
			}
		}
		echo '</optgroup>';
	}
	
	echo '<optgroup label="Devices">';
	foreach($DEVICES as $device){
		echo $device;
	}
	echo '</optgroup>';
	
	$CMD = "cmd=SceneGetListDetails&data=<gip><version>1</version><token>".TOKEN."</token><bigicon>1</bigicon></gip>";
	$result = getCurlReturn($CMD);
	$array = xmlToArray($result);
	$scenes = $array["scene"];
	if( is_array($scenes) ){
		echo '<optgroup label="Scenes">';
		for($x = 0; $x < sizeof($scenes); $x++){
			echo '<option  data-device-type="scene" data-device-id="'.$scenes[$x]["sid"] .'" data-device-name="'.$scenes[$x]["name"] .'">'.$scenes[$x]["name"] . " - " . $scenes[$x]["sid"] . "</option>";
		}
		echo '</optgroup>';
	}
	
?>


</select>
</p>
<br />
<style>
#instructions p{ margin: 10px 0; }
#select{ margin-bottom: 10px; }
.response{ font-weight: bold; font-style: italic; font-size: 16px; }

</style>
<div id="instructions">
	<div id="appletImage" style="float: left; margin-right: 20px; overflow: hidden;">
	
    </div>
    <div class="fields">
    	<div id="roomLights">
            <h1>On Commands</h1>
            <p>What do you want to say: <span class="response" id="command_on_1"></span></p>
            <p>Whats another way to say it? (Optional): <span class="response" id="command_on_2"></span></p>
            <p>And another way?(optional): <span class="response" id="command_on_3"></span></p>
            <p>What do you want the Assistant to say in Response: <span class="response" id="command_on_response"></span></p>
            <p>URL: <span class="response" id="command_on_url"></span></p>
            <p>Method: Get</p>
            
            <h1>Off Commands</h1>
            <p>What do you want to say: <span class="response" id="command_off_1"></span></p>
            <p>Whats another way to say it? (Optional): <span class="response" id="command_off_2"></span></p>
            <p>And another way?(optional): <span class="response" id="command_off_3"></span></p>
            <p>What do you want the Assistant to say in Response: <span class="response" id="command_off_response"></span></p>
            <p>URL: <span class="response" id="command_off_url"></span></p>
            <p>Method: Get</p>
            
            <h1>Dim Command (Say a phrase with a number)</h1>
            <p>What do you want to say: <span class="response" id="command_dim_1"></span></p>
            <p>Whats another way to say it? (Optional): <span class="response" id="command_dim_2"></span></p>
            <p>And another way?(optional): <span class="response" id="command_dim_3"></span></p>
            <p>What do you want the Assistant to say in Response: <span class="response" id="command_dim_response"></span></p>
            <p>URL: <span class="response" id="command_dim_url"></span></p>
            <p>Method: Get</p>
    	</div>
        
        <div id="sceneLights">
            <h1>Run Command</h1>
            <p>What do you want to say: <span class="response" id="command_run_1"></span></p>
            <p>Whats another way to say it? (Optional): <span class="response" id="command_run_2"></span></p>
            <p>And another way?(optional): <span class="response" id="command_run_3"></span></p>
            <p>What do you want the Assistant to say in Response: <span class="response" id="command_run_response"></span></p>
            <p>URL: <span class="response" id="command_run_url"></span></p>
            <p>Method: Get</p>
            
            <h1>Off Command</h1>
            <p>What do you want to say: <span class="response" id="scene_command_off_1"></span></p>
            <p>Whats another way to say it? (Optional): <span class="response" id="scene_command_off_2"></span></p>
            <p>And another way?(optional): <span class="response" id="scene_command_off_3"></span></p>
            <p>What do you want the Assistant to say in Response: <span class="response" id="scene_command_off_response"></span></p>
            <p>URL: <span class="response" id="scene_command_off_url"></span></p>
            <p>Method: Get</p>
            
            <h1>All On Command</h1>
            <p>What do you want to say: <span class="response" id="scene_command_on_1"></span></p>
            <p>Whats another way to say it? (Optional): <span class="response" id="scene_command_on_2"></span></p>
            <p>And another way?(optional): <span class="response" id="scene_command_on_3"></span></p>
            <p>What do you want the Assistant to say in Response: <span class="response" id="scene_command_on_response"></span></p>
            <p>URL: <span class="response" id="scene_command_on_url"></span></p>
            <p>Method: Get</p>
        </div>
    </div>
	<div class="clear"></div>
</div>



<?php
}else{
	echo '<p>To use IFTTT you must enable the external API access</p>';
}
?>


</div>



<?php
pageFooter();
?>