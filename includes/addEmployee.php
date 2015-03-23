<section id = "addEmployee" style="display:none;">
	<div class = "sectionBackground"></div>
	<div class = "verticalCenter"></div>
	<div id = "addEmployeeBox" class = "box dialogBox">
		<div class = "sectionTitle">Add Employee</div>
		<table id = "addEmployeeTable" cellspacing="0" cellpadding="0">
			<tr>
				<td>Type:</td>
				<td>
					<div class = "selectContainer">
						<select class = "employeeType">
							<option value="fullTime">Full Time</option>
							<option value="partTime">Part Time</option>
							<option value="seasonal">Seasonal</option>
							<option class = "adminControl" value="contract">Contract</option>
						</select>
					</div>
				</td>
			</tr>
			<tr class = "field fullTimeField partTimeField seasonalField"><td>First Name:</td><td><input type="text"/></td></tr>
			<tr class = "field fullTimeField partTimeField seasonalField"><td>Last Name:</td><td><input type="text"/></td></tr>
			<tr class = "field fullTimeField partTimeField seasonalField"><td>Date of Birth:</td><td><input type="text"/></td></tr>
			<tr class = "field fullTimeField partTimeField seasonalField"><td>Social Insurance Number:</td><td><input type="text"/></td></tr>
			<tr class = "field adminControl fullTimeField partTimeField"><td>Date Hired:</td><td><input type="text"/></td></tr>
			<tr class = "field adminControl fullTimeField partTimeField"><td>Date Terminated:</td><td><input type="text"/></td></tr>
			<tr class = "field adminControl fullTimeField"><td>Salary:</td><td><input type="text"/></td></tr>
			<tr class = "field adminControl partTimeField unselectedField"><td>Hourly Wage:</td><td><input type="text"/></td></tr>
			<tr class = "field seasonalField unselectedField"><td>Season:</td><td><input type="text"/></td></tr>
			<tr class = "field seasonalField unselectedField"><td>Season Year:</td><td><input type="text"/></td></tr>
			<tr class = "field adminControl seasonalField unselectedField"><td>Piece Pay:</td><td><input type="text"/></td></tr>
			<tr class = "field adminControl contractField unselectedField"><td>Company Name:</td><td><input type="text"/></td></tr>
			<tr class = "field adminControl contractField unselectedField"><td>Date of Incorporation:</td><td><input type="text"/></td></tr>
			<tr class = "field adminControl contractField unselectedField"><td>Business Number:</td><td><input type="text"/></td></tr>
			<tr class = "field adminControl contractField unselectedField"><td>Contract Start Date:</td><td><input type="text"/></td></tr>
			<tr class = "field adminControl contractField unselectedField"><td>Contract Stop Date:</td><td><input type="text"/></td></tr>
			<tr class = "field adminControl contractField unselectedField"><td>Contract Amount:</td><td><input type="text"/></td></tr>
		</table>
		<div class = "buttonContainer">
			<input id = "addEmployeeDone" type="button" class = "confirmButton bottomButton" value = "Done"/>
		</div>
	</div>
</section>