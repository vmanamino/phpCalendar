<?
# set up to grab from form, right now directly enter
$birth_day = 13;

#these can be got from form too, right now directly entered in script
$birthdate = mktime(0, 0, 0, 07, $birth_day, 1976);

#set array from timestamp so values can be accessed without direct input
$birthdate_info = getdate($birthdate);

#birth month regardless of year
$birth_mon = $birthdate_info['mon'];

#birth month spelled out
$birth_month = $birthdate_info['month'];

#year of birth without entering the data
$birth_year = $birthdate_info['year'];

#current time data to make year and days accessible via array
$current_date = getdate();

#get year without entering the data
$current_year = $current_date['year'];

#create stamp to create array of current year's birth month information
$current_birth_month_stamp = mktime(0, 0, 0, $birth_mon, 01, $current_year);

#create array for easy access of info
$current_birth_month_object = getdate($current_birth_month_stamp);

#calculate total days in month
$days = cal_days_in_month(CAL_GREGORIAN, $birth_mon, $current_year);

#access weekday from current year's birth month
$first_day = $current_birth_month_object['weekday'];

#access month from currenty year's birth month, no entering of data
$month = $current_birth_month_object['month'];

#access year
$current_year = $current_birth_month_object['year'];

# set start date to corresponding weekday column
$start;

if ($first_day == "Sunday") {
	$start = 0;
} else if ($first_day == "Monday") {
	$start = 1;
} else if ($first_day == "Tuesday") {
	$start = 2;
} else if ($first_day == "Wednesday") {
	$start = 3;
} else if ($first_day == "Thursday") {
	$start = 4;
} else if ($first_day == "Friday") {
	$start = 5;
} else if ($first_day == "Saturday") {
	$start = 6;
}

echo "Your birthday is ".$birth_month." ".$birth_day.", ".$birth_year."<br/>";


echo "<br/>In ".$month." ".$current_year." it falls on the following day:<br/>";
?>
<br/>

 <table>
  <tr>
    <td>Sunday</td>
    <td>Monday</td>
    <td>Tuesday</td>
    <td>Wednesday</td>
    <td>Thursday</td>
    <td>Friday</td>
    <td>Saturday</td>
  </tr>
  
<?
	
	$day = 1;
	$first_row = 1;
	# count days until they equal total days of current year's birth month
	# this will make sure that the appropriate number of weekday rows are created
	while ($day <= $days) {	
		# start table row for each week at each increment of outer while loop
		echo "<tr>";
		# loop through weekday columns (horizontally, using asterix to stay on current line)
		for ($column = 0; $column < 7; $column++) {
			# days less than or equal to total days of month and within current weekday loop, follow conditions to put out proper date data
			if ($day <= $days) {
				if ($first_row) { # special instructions to deal with first week of month
					if ($start <= $column) { # when start value set above matches column value, i.e. the weekday when month begins, and in turn becomes less than column--enter date
						if ($day == $birth_day) { # indicate birthday, when day number matches birthday.
							echo "<td><b>b-day</b></td>";
							$day += 1; # each marking of month date, increment day by one
						
						} else {
							echo "<td>".$day."</td>";
							$day += 1; # each marking of month date, increment day by one
						}
					} else { # when start value does not correspond to weekday column, i.e. month has not begun, put out asterix as indication that month has not begun
						echo "<td>*</td>";
					}
				} else { # outside of first week, follow these instructions
					if ($day == $birth_day) { # indicate birthday if day number matches birthday
						echo "<td><b>b-day</b></td>";
						$day += 1;
					} else { # outside of first week, enter date in each weekday
						echo "<td>".$day."</td>";
						$day += 1;
					}
				}								
			} else { # last day of month, but still within weekday loop, put out asterix as indication
				echo "<td>*</td>";
			}
		} #exit weekday column loop	
		# first time exiting, no more first row
		$first_row = null;
		#each exit, end table row to start the next row for the next week
		echo "</tr>";		
	}	
?>
  
</table> 

