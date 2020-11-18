<script type="text/javascript" src="Ajax/addUser.js"></script>

<div align="center">
<table border="0" width="69%" cellspacing="1">
	<tr>
		<td width="461"><form method="POST" name="useradd" action="index.php?view=admin&admin=31&task=adduser">

<table border="0" width="510" cellspacing="8" bgcolor="#F2FDFF">
	<tr>
		<td width="121">
<font color="#800000">User id :</font></td>
		<td width="363" colspan="2">
&nbsp;<span id="sprytextfield1"><input type="text" name="user_20" size="32">
	<span class="textfieldRequiredMsg"><font size="-1"> Enter a User id</font></span></span>
		</td>
	</tr>
	<tr>
		<td>
	<font color="#800000">Password :</font></td>
		<td width="363" colspan="2"> 
	<span id="sprypassword">
	<input type="password" name="pass_20" size="19">
	<span class="passwordRequiredMsg"><font size="-1"> Enter a Password </font></span></span>
		</td>
	</tr>
	<tr>
		<td>
	<font color="#800000">Confirm Password :</font></td>
		<td width="363" colspan="2"> 
	<span id="sprypassword1">
	<input type="password" name="pass_20_2" size="19">
	<span class="passwordRequiredMsg"><font size="-1"> Confirm the Password</font></span></span></td>
	</tr>
	<tr>
		<td>
	<font color="#800000">Last Name :</font></td>
		<td width="363" colspan="2"> 
	<span id="sprytextfield2">
	<input type="text" name="last_20" size="33">
	<span class="textfieldRequiredMsg"><font size="-1"> Enter the Last Name </font></span></span>
		</td>
	</tr>
	<tr>
		<td>
	<font color="#800000">Initials :</font></td>
		<td width="363" colspan="2">
	<span id="sprytextfield3"> 
	<input type="text" name="init_20" size="33">
	<span class="textfieldRequiredMsg"><font size="-1"> Enter the Initials</font></span></span></td>
	</tr>
	<tr>
		<td height="28">
	<font color="#800000">Occupation :</font></td>
		<td height="28" width="363" colspan="2"> 
	<span id="sprytextfield4">
	<input type="text" name="occu_20" size="33">
	<span class="textfieldRequiredMsg"><font size="-1"> Enter the Occupation </font></span></span>
		</td>
	</tr>
	<tr>
		<td>
	<font color="#800000">Role :</font></td>
		<td width="363" colspan="2"> 
	
	
	
	
<select size="1" name="role_20">


echo '<option value="office"> Technical Officer</option>';

</select></td>
	</tr>
	<tr>
		<td>
	<font color="#800000">Email :</font></td>
		<td width="363" colspan="2"> 
	<span id="email">
	<input type="text" name="email_20" size="34">
	<span class="textfieldRequiredMsg"><font size="-1"> Enter the Email </font></span>
	<span class="textfieldInvalidFormatMsg"><font size="-1">Invalid format</font></span>
	</span>
		</td>
	</tr>
	<tr>
		<td>
	<font color="#800000">Section :</font></td>
		<td width="363" colspan="2"> <select size="1" name="sec_20">
<option value="<?php echo $section; ?>"><?php echo ucfirst($section); ?></option>
</select></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td width="308">
	
	<input type="submit" value="Create Tech. Off. Account" name="submit">
	<input type="reset" value="Clear All" name="clear" ></td>
		<td width="48">
	
</td>
	</tr>
</table>

<p>&nbsp;</td>
	</tr>
	</table>
</form>

</div>
