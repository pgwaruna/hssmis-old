<br>
<form method="POST" action="index.php?view=admin&admin=21&sub=<?php echo $sub_21; ?>&task1=attendence">
	Date Select here :&nbsp; <select size="1" name="y">
	<option value="2009">2009</option>
	<option value="2010">2010</option>
	<option value="2011">2011</option>
	<option value="2012">2012</option>
	<option value="2013">2013</option>
	<option value="2014">2014</option>
	<option value="2015">2015</option>
	</select><select size="1" name="m">
	<option value="1">Jan</option>
	<option value="2">Feb</option>
	<option value="3">Mar</option>
	<option value="4">Apr</option>
	<option value="5">May</option>
	<option value="6">June</option>
	<option value="7">July</option>
	<option value="8">Aug</option>
	<option value="9">Sep</option>
	<option value="10">Oct</option>
	<option value="11">Nov</option>
	<option value="12">Dec</option>
	</select><select size="1" name="d">
	<option value="1">1</option>
	<option value="2">2</option>
	<option value="3">3</option>
	<option value="4">4</option>
	<option value="5">5</option>
	<option value="6">6</option>
	<option value="7">7</option>
	<option value="8">8</option>
	<option value="9">9</option>
	<option value="10">10</option>
	<option value="11">11</option>
	<option value="12">12</option>
	<option value="13">13</option>
	<option value="14">14</option>
	<option value="15">15</option>
	<option value="16">16</option>
	<option value="17">17</option>
	<option value="18">18</option>
	<option value="19">19</option>
	<option value="20">20</option>
	<option value="21">21</option>
	<option value="22">22</option>
	<option value="23">23</option>
	<option value="24">24</option>
	<option value="25">25</option>
	<option value="26">26</option>
	<option value="27">27</option>
	<option value="28">28</option>
	<option value="29">29</option>
	<option value="30">30</option>
	<option value="31">31</option>
	</select>&nbsp; Number of Hours : <select size="1" name="hours">
	<option value="1">1</option>
	<option value="2">2</option>
	<option value="3">3</option>
	<option value="4">4</option>
	</select><br><br>Lecture Starting Time : <select size="1" name="time_21">
	<option value="08:00">08:00</option>
	<option value="09:00">09:00</option>
	<option value="10:00">10:00</option>
	<option value="11:00">11:00</option>
	<option value="12:00">12:00</option>
	<option value="13:00">13:00</option>
	<option value="14:00">14:00</option>
	<option value="15:00">15:00</option>
	<option value="16:00">16:00</option>
	<option value="17:00">17:00</option>
	</select>&nbsp;<input type="submit" value="Create Lecture ID for <?php echo strtoupper($sub_21); ?>" name="submit">
</form>
		