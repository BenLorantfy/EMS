USE EMS;

DELIMITER $$

/*
 * User Triggers
 */

DROP TRIGGER IF EXISTS newUser$$
CREATE TRIGGER newUser
BEFORE INSERT ON User
FOR EACH ROW
    BEGIN
		DECLARE mydata INT;
		DECLARE numOfUsers INT;
		SET mydata := new.id;

		IF ( (SELECT MAX(id) FROM User) IS NULL) THEN
			SET new.id := 1;
		ELSE
			SET new.id := (SELECT MAX(id) FROM User) + 1;
		END IF;

		IF ( (SELECT COUNT(id) FROM USER WHERE (user.id = mydata)) = 0) THEN
			SET mydata := null;
		END IF;

		INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
		(mydata, (SELECT NOW()), 'User', new.id, 'username', null, new.username, 'Insert');

		INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
		(mydata, (SELECT NOW()), 'User', new.id, 'password', null, new.password, 'Insert');

		INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
		(mydata, (SELECT NOW()), 'User', new.id, 'securityLevel', null, new.securityLevel, 'Insert');
    END$$

DROP TRIGGER IF EXISTS updateUser$$
CREATE TRIGGER updateUser
BEFORE UPDATE ON User
FOR EACH ROW
	BEGIN
		DECLARE mydata INT;
		SET mydata := new.id;

		SET new.id := old.id;

		IF (mydata > (SELECT COUNT(id) FROM User)) THEN
			SET mydata := null;
		END IF;
		
		/* Start conditional Audit insert */

		IF (new.username != OLD.username) THEN
			INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
			(mydata, (SELECT NOW()), 'User', new.id, 'username', OLD.username, new.username, 'Update');
		END IF;

		IF (new.password != OLD.password) THEN
			INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
			(mydata, (SELECT NOW()), 'User', new.id, 'password', OLD.password, new.password, 'Update');
		END IF;

		IF (new.securityLevel != OLD.securityLevel) THEN
			INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
			(mydata, (SELECT NOW()), 'User', new.id, 'securityLevel', OLD.securityLevel, new.securityLevel, 'Update');
		END IF;
	END$$

/*
 *	Company Triggers
 */

DROP TRIGGER IF EXISTS newCompany$$
CREATE TRIGGER newCompany
BEFORE INSERT ON Company
FOR EACH ROW
    BEGIN
		DECLARE mydata INT;
		DECLARE numOfUsers INT;
		SET mydata := new.id;

		IF ( (SELECT MAX(id) FROM Company) IS NULL) THEN
			SET new.id := 1;
		ELSE
			SET new.id := (SELECT MAX(id) FROM Company) + 1;
		END IF;

		IF ( (SELECT COUNT(id) FROM USER WHERE (user.id = mydata)) = 0) THEN
			SET mydata := null;
		END IF;

		INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
		(mydata, (SELECT NOW()), 'Company', new.id, 'corporationName', null, new.corporationName, 'Insert');

		INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
		(mydata, (SELECT NOW()), 'Company', new.id, 'dateOfIncorporation', null, new.dateOfIncorporation, 'Insert');
    END$$

DROP TRIGGER IF EXISTS updateCompany$$
CREATE TRIGGER updateCompany
BEFORE UPDATE ON Company
FOR EACH ROW
	BEGIN
		DECLARE mydata INT;
		SET mydata := new.id;

		SET new.id := old.id;

		IF (mydata > (SELECT COUNT(id) FROM User)) THEN
			SET mydata := null;
		END IF;
		
		/* Start conditional Audit insert */

		IF (new.corporationName != OLD.corporationName) THEN
			INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
			(mydata, (SELECT NOW()), 'Company', new.id, 'corporationName', OLD.corporationName, new.corporationName, 'Update');
		END IF;

		IF (new.dateOfIncorporation != OLD.dateOfIncorporation) THEN
			INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
			(mydata, (SELECT NOW()), 'Company', new.id, 'dateOfIncorporation', OLD.dateOfIncorporation, new.dateOfIncorporation, 'Update');
		END IF;
	END$$
    
/*
 * Contractor Triggers
 */

DROP TRIGGER IF EXISTS newContractor$$
CREATE TRIGGER newContractor
BEFORE INSERT ON Contractor
FOR EACH ROW
    BEGIN
		DECLARE mydata INT;
		DECLARE numOfUsers INT;
		SET mydata := new.id;

		IF ( (SELECT MAX(id) FROM Contractor) IS NULL) THEN
			SET new.id := 1;
		ELSE
			SET new.id := (SELECT MAX(id) FROM Contractor) + 1;
		END IF;

		IF ( (SELECT COUNT(id) FROM USER WHERE (user.id = mydata)) = 0) THEN
			SET mydata := null;
		END IF;

		INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
		(mydata, (SELECT NOW()), 'Contractor', new.id, 'company_id', null, new.company_id, 'Insert');

		INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
		(mydata, (SELECT NOW()), 'Contractor', new.id, 'buisnessNumber', null, new.buisnessNumber, 'Insert');

		INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
		(mydata, (SELECT NOW()), 'Contractor', new.id, 'contractStartDate', null, new.contractStartDate, 'Insert');

		INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
		(mydata, (SELECT NOW()), 'Contractor', new.id, 'contractStopDate', null, new.contractStopDate, 'Insert');
        
		INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
		(mydata, (SELECT NOW()), 'Contractor', new.id, 'fixedContractAmount', null, new.fixedContractAmount, 'Insert');
    END$$

DROP TRIGGER IF EXISTS updateContractor$$
CREATE TRIGGER updateContractor
BEFORE UPDATE ON Contractor
FOR EACH ROW
	BEGIN
		DECLARE mydata INT;
		SET mydata := new.id;

		SET new.id := old.id;

		IF (mydata > (SELECT COUNT(id) FROM User)) THEN
			SET mydata := null;
		END IF;
		
		/* Start conditional Audit insert */

		IF (new.company_id != OLD.company_id) THEN
			INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
			(mydata, (SELECT NOW()), 'Contractor', new.id, 'company_id', OLD.company_id, new.company_id, 'Update');
		END IF;

		IF (new.buisnessNumber != OLD.buisnessNumber) THEN
			INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
			(mydata, (SELECT NOW()), 'Contractor', new.id, 'buisnessNumber', OLD.buisnessNumber, new.buisnessNumber, 'Update');
		END IF;

		IF (new.contractStartDate != OLD.contractStartDate) THEN
			INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
			(mydata, (SELECT NOW()), 'Contractor', new.id, 'contractStartDate', OLD.contractStartDate, new.contractStartDate, 'Update');
		END IF;

		IF (new.contractStopDate != OLD.contractStopDate) THEN
			INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
			(mydata, (SELECT NOW()), 'Contractor', new.id, 'contractStopDate', OLD.contractStopDate, new.contractStopDate, 'Update');
		END IF;
        
		IF (new.fixedContractAmount != OLD.fixedContractAmount) THEN
			INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
			(mydata, (SELECT NOW()), 'Contractor', new.id, 'fixedContractAmount', OLD.fixedContractAmount, new.fixedContractAmount, 'Update');
		END IF;
	END$$

/*
 * Person Triggers
 */

DROP TRIGGER IF EXISTS newPerson$$
CREATE TRIGGER newPerson
BEFORE INSERT ON Person
FOR EACH ROW
    BEGIN
		DECLARE mydata INT;
		DECLARE numOfUsers INT;
		SET mydata := new.id;

		IF ( (SELECT MAX(id) FROM Person) IS NULL) THEN
			SET new.id := 1;
		ELSE
			SET new.id := (SELECT MAX(id) FROM Person) + 1;
		END IF;

		IF ( (SELECT COUNT(id) FROM USER WHERE (user.id = mydata)) = 0) THEN
			SET mydata := null;
		END IF;

		INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
		(mydata, (SELECT NOW()), 'Person', new.id, 'firstName', null, new.firstName, 'Insert');

		INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
		(mydata, (SELECT NOW()), 'Person', new.id, 'lastName', null, new.lastName, 'Insert');

		INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
		(mydata, (SELECT NOW()), 'Person', new.id, 'SIN', null, new.SIN, 'Insert');

		INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
		(mydata, (SELECT NOW()), 'Person', new.id, 'dateOfBirth', null, new.dateOfBirth, 'Insert');
    END$$

DROP TRIGGER IF EXISTS updatePerson$$
CREATE TRIGGER updatePerson
BEFORE UPDATE ON Person
FOR EACH ROW
	BEGIN
		DECLARE mydata INT;
		SET mydata := new.id;

		SET new.id := old.id;

		IF (mydata > (SELECT COUNT(id) FROM User)) THEN
			SET mydata := null;
		END IF;
		
		/* Start conditional Audit insert */

		IF (new.firstName != OLD.firstName) THEN
			INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
			(mydata, (SELECT NOW()), 'Person', new.id, 'firstName', OLD.firstName, new.firstName, 'Update');
		END IF;

		IF (new.lastName != OLD.lastName) THEN
			INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
			(mydata, (SELECT NOW()), 'Person', new.id, 'lastName', OLD.lastName, new.lastName, 'Update');
		END IF;

		IF (new.SIN != OLD.SIN) THEN
			INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
			(mydata, (SELECT NOW()), 'Person', new.id, 'SIN', OLD.SIN, new.SIN, 'Update');
		END IF;

		IF (new.dateOfBirth != OLD.dateOfBirth) THEN
			INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
			(mydata, (SELECT NOW()), 'Person', new.id, 'dateOfBirth', OLD.dateOfBirth, new.dateOfBirth, 'Update');
		END IF;
	END$$
    
/*
 * Employee Triggers
 */

DROP TRIGGER IF EXISTS newEmployee$$
CREATE TRIGGER newEmployee
BEFORE INSERT ON Employee
FOR EACH ROW
    BEGIN
		DECLARE mydata INT;
		DECLARE numOfUsers INT;
		SET mydata := new.id;

		IF ( (SELECT MAX(id) FROM Employee) IS NULL) THEN
			SET new.id := 1;
		ELSE
			SET new.id := (SELECT MAX(id) FROM Employee) + 1;
		END IF;

		IF ( (SELECT COUNT(id) FROM USER WHERE (user.id = mydata)) = 0) THEN
			SET mydata := null;
		END IF;

		INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
		(mydata, (SELECT NOW()), 'Employee', new.id, 'company_id', null, new.company_id, 'Insert');

		INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
		(mydata, (SELECT NOW()), 'Employee', new.id, 'person_id', null, new.person_id, 'Insert');

		INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
		(mydata, (SELECT NOW()), 'Employee', new.id, 'workStatus', null, new.workStatus, 'Insert');

		INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
		(mydata, (SELECT NOW()), 'Employee', new.id, 'reasonForLeaving', null, new.reasonForLeaving, 'Insert');
    END$$

DROP TRIGGER IF EXISTS updateEmployee$$
CREATE TRIGGER updateEmployee
BEFORE UPDATE ON Employee
FOR EACH ROW
	BEGIN
		DECLARE mydata INT;
		SET mydata := new.id;

		SET new.id := old.id;

		IF (mydata > (SELECT COUNT(id) FROM User)) THEN
			SET mydata := null;
		END IF;
		
		/* Start conditional Audit insert */

		IF (new.company_id != OLD.company_id) THEN
			INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
			(mydata, (SELECT NOW()), 'Employee', new.id, 'company_id', OLD.company_id, new.company_id, 'Update');
		END IF;

		IF (new.person_id != OLD.person_id) THEN
			INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
			(mydata, (SELECT NOW()), 'Employee', new.id, 'person_id', OLD.person_id, new.person_id, 'Update');
		END IF;

		IF (new.workStatus != OLD.workStatus) THEN
			INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
			(mydata, (SELECT NOW()), 'Employee', new.id, 'workStatus', OLD.workStatus, new.workStatus, 'Update');
		END IF;

		IF (new.reasonForLeaving != OLD.reasonForLeaving) THEN
			INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
			(mydata, (SELECT NOW()), 'Employee', new.id, 'reasonForLeaving', OLD.reasonForLeaving, new.reasonForLeaving, 'Update');
		END IF;
	END$$
    
/*
 * Full Time Employee Triggers
 */

DROP TRIGGER IF EXISTS newFullTimeEmployee$$
CREATE TRIGGER newFullTimeEmployee
BEFORE INSERT ON FullTimeEmployee
FOR EACH ROW
    BEGIN
		DECLARE mydata INT;
		DECLARE numOfUsers INT;
		SET mydata := new.id;

		IF ( (SELECT MAX(id) FROM FullTimeEmployee) IS NULL) THEN
			SET new.id := 1;
		ELSE
			SET new.id := (SELECT MAX(id) FROM FullTimeEmployee) + 1;
		END IF;

		IF ( (SELECT COUNT(id) FROM USER WHERE (user.id = mydata)) = 0) THEN
			SET mydata := null;
		END IF;

		INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
		(mydata, (SELECT NOW()), 'FullTimeEmployee', new.id, 'employee_id', null, new.employee_id, 'Insert');

		INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
		(mydata, (SELECT NOW()), 'FullTimeEmployee', new.id, 'dateOfHire', null, new.dateOfHire, 'Insert');

		INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
		(mydata, (SELECT NOW()), 'FullTimeEmployee', new.id, 'dateOfTermination', null, new.dateOfTermination, 'Insert');

		INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
		(mydata, (SELECT NOW()), 'FullTimeEmployee', new.id, 'salary', null, new.salary, 'Insert');
    END$$

DROP TRIGGER IF EXISTS updateFullTimeEmployee$$
CREATE TRIGGER updateFullTimeEmployee
BEFORE UPDATE ON FullTimeEmployee
FOR EACH ROW
	BEGIN
		DECLARE mydata INT;
		SET mydata := new.id;

		SET new.id := old.id;

		IF (mydata > (SELECT COUNT(id) FROM User)) THEN
			SET mydata := null;
		END IF;
		
		/* Start conditional Audit insert */

		IF (new.employee_id != OLD.employee_id) THEN
			INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
			(mydata, (SELECT NOW()), 'FullTimeEmployee', new.id, 'employee_id', OLD.employee_id, new.employee_id, 'Update');
		END IF;

		IF (new.dateOfHire != OLD.dateOfHire) THEN
			INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
			(mydata, (SELECT NOW()), 'FullTimeEmployee', new.id, 'dateOfHire', OLD.dateOfHire, new.dateOfHire, 'Update');
		END IF;

		IF (new.dateOfTermination != OLD.dateOfTermination) THEN
			INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
			(mydata, (SELECT NOW()), 'FullTimeEmployee', new.id, 'dateOfTermination', OLD.dateOfTermination, new.dateOfTermination, 'Update');
		END IF;

		IF (new.salary != OLD.salary) THEN
			INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
			(mydata, (SELECT NOW()), 'FullTimeEmployee', new.id, 'salary', OLD.salary, new.salary, 'Update');
		END IF;
	END$$

/*
 * Part Time Employee Triggers
 */

DROP TRIGGER IF EXISTS newPartTimeEmployee$$
CREATE TRIGGER newPartTimeEmployee
BEFORE INSERT ON PartTimeEmployee
FOR EACH ROW
    BEGIN
		DECLARE mydata INT;
		DECLARE numOfUsers INT;
		SET mydata := new.id;

		IF ( (SELECT MAX(id) FROM PartTimeEmployee) IS NULL) THEN
			SET new.id := 1;
		ELSE
			SET new.id := (SELECT MAX(id) FROM PartTimeEmployee) + 1;
		END IF;

		IF ( (SELECT COUNT(id) FROM USER WHERE (user.id = mydata)) = 0) THEN
			SET mydata := null;
		END IF;

		INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
		(mydata, (SELECT NOW()), 'PartTimeEmployee', new.id, 'employee_id', null, new.employee_id, 'Insert');

		INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
		(mydata, (SELECT NOW()), 'PartTimeEmployee', new.id, 'dateOfHire', null, new.dateOfHire, 'Insert');

		INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
		(mydata, (SELECT NOW()), 'PartTimeEmployee', new.id, 'dateOfTermination', null, new.dateOfTermination, 'Insert');

		INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
		(mydata, (SELECT NOW()), 'PartTimeEmployee', new.id, 'hourlyRate', null, new.hourlyRate, 'Insert');
    END$$

DROP TRIGGER IF EXISTS updatePartTimeEmployee$$
CREATE TRIGGER updatePartTimeEmployee
BEFORE UPDATE ON PartTimeEmployee
FOR EACH ROW
	BEGIN
		DECLARE mydata INT;
		SET mydata := new.id;

		SET new.id := old.id;

		IF (mydata > (SELECT COUNT(id) FROM User)) THEN
			SET mydata := null;
		END IF;
		
		/* Start conditional Audit insert */

		IF (new.employee_id != OLD.employee_id) THEN
			INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
			(mydata, (SELECT NOW()), 'PartTimeEmployee', new.id, 'employee_id', OLD.employee_id, new.employee_id, 'Update');
		END IF;

		IF (new.dateOfHire != OLD.dateOfHire) THEN
			INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
			(mydata, (SELECT NOW()), 'PartTimeEmployee', new.id, 'dateOfHire', OLD.dateOfHire, new.dateOfHire, 'Update');
		END IF;

		IF (new.dateOfTermination != OLD.dateOfTermination) THEN
			INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
			(mydata, (SELECT NOW()), 'PartTimeEmployee', new.id, 'dateOfTermination', OLD.dateOfTermination, new.dateOfTermination, 'Update');
		END IF;

		IF (new.hourlyRate != OLD.hourlyRate) THEN
			INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
			(mydata, (SELECT NOW()), 'PartTimeEmployee', new.id, 'hourlyRate', OLD.hourlyRate, new.hourlyRate, 'Update');
		END IF;
	END$$
    
/*
 * Seasonal Employee Triggers
 */

DROP TRIGGER IF EXISTS newSeasonalEmployee$$
CREATE TRIGGER newSeasonalEmployee
BEFORE INSERT ON SeasonalEmployee
FOR EACH ROW
    BEGIN
		DECLARE mydata INT;
		DECLARE numOfUsers INT;
		SET mydata := new.id;

		IF ( (SELECT MAX(id) FROM SeasonalEmployee) IS NULL) THEN
			SET new.id := 1;
		ELSE
			SET new.id := (SELECT MAX(id) FROM SeasonalEmployee) + 1;
		END IF;

		IF ( (SELECT COUNT(id) FROM USER WHERE (user.id = mydata)) = 0) THEN
			SET mydata := null;
		END IF;

		INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
		(mydata, (SELECT NOW()), 'SeasonalEmployee', new.id, 'employee_id', null, new.employee_id, 'Insert');

		INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
		(mydata, (SELECT NOW()), 'SeasonalEmployee', new.id, 'season', null, new.season, 'Insert');

		INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
		(mydata, (SELECT NOW()), 'SeasonalEmployee', new.id, 'piecePay', null, new.piecePay, 'Insert');

		INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
		(mydata, (SELECT NOW()), 'SeasonalEmployee', new.id, 'seasonYear', null, new.seasonYear, 'Insert');
    END$$

DROP TRIGGER IF EXISTS updateSeasonalEmployee$$
CREATE TRIGGER updateSeasonalEmployee
BEFORE UPDATE ON SeasonalEmployee
FOR EACH ROW
	BEGIN
		DECLARE mydata INT;
		SET mydata := new.id;

		SET new.id := old.id;

		IF (mydata > (SELECT COUNT(id) FROM User)) THEN
			SET mydata := null;
		END IF;
		
		/* Start conditional Audit insert */

		IF (new.employee_id != OLD.employee_id) THEN
			INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
			(mydata, (SELECT NOW()), 'SeasonalEmployee', new.id, 'employee_id', OLD.employee_id, new.employee_id, 'Update');
		END IF;

		IF (new.season != OLD.season) THEN
			INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
			(mydata, (SELECT NOW()), 'SeasonalEmployee', new.id, 'season', OLD.season, new.season, 'Update');
		END IF;

		IF (new.piecePay != OLD.piecePay) THEN
			INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
			(mydata, (SELECT NOW()), 'SeasonalEmployee', new.id, 'piecePay', OLD.piecePay, new.piecePay, 'Update');
		END IF;

		IF (new.seasonYear != OLD.seasonYear) THEN
			INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
			(mydata, (SELECT NOW()), 'SeasonalEmployee', new.id, 'seasonYear', OLD.seasonYear, new.seasonYear, 'Update');
		END IF;
	END$$
    
/*
 * Timecard Triggers
 */

DROP TRIGGER IF EXISTS newTimecard$$
CREATE TRIGGER newTimecard
BEFORE INSERT ON Timecard
FOR EACH ROW
    BEGIN
		DECLARE mydata INT;
		DECLARE numOfUsers INT;
		SET mydata := new.id;

		IF ( (SELECT MAX(id) FROM Timecard) IS NULL) THEN
			SET new.id := 1;
		ELSE
			SET new.id := (SELECT MAX(id) FROM Timecard) + 1;
		END IF;

		IF ( (SELECT COUNT(id) FROM USER WHERE (user.id = mydata)) = 0) THEN
			SET mydata := null;
		END IF;

		INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
		(mydata, (SELECT NOW()), 'Timecard', new.id, 'employee_id', null, new.employee_id, 'Insert');

		INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
		(mydata, (SELECT NOW()), 'Timecard', new.id, 'info_title', null, new.info_title, 'Insert');

		INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
		(mydata, (SELECT NOW()), 'Timecard', new.id, 'monday', null, new.monday, 'Insert');

		INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
		(mydata, (SELECT NOW()), 'Timecard', new.id, 'tuesday', null, new.tuesday, 'Insert');
        
        		INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
		(mydata, (SELECT NOW()), 'Timecard', new.id, 'wednesday', null, new.wednesday, 'Insert');

		INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
		(mydata, (SELECT NOW()), 'Timecard', new.id, 'thursday', null, new.thursday, 'Insert');
        
        		INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
		(mydata, (SELECT NOW()), 'Timecard', new.id, 'friday', null, new.friday, 'Insert');

		INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
		(mydata, (SELECT NOW()), 'Timecard', new.id, 'saturday', null, new.saturday, 'Insert');
        
        		INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
		(mydata, (SELECT NOW()), 'Timecard', new.id, 'sunday', null, new.sunday, 'Insert');
    END$$

DROP TRIGGER IF EXISTS updateTimecard$$
CREATE TRIGGER updateTimecard
BEFORE UPDATE ON Timecard
FOR EACH ROW
	BEGIN
		DECLARE mydata INT;
		SET mydata := new.id;

		SET new.id := old.id;

		IF (mydata > (SELECT COUNT(id) FROM User)) THEN
			SET mydata := null;
		END IF;
		
		/* Start conditional Audit insert */

		IF (new.employee_id != OLD.employee_id) THEN
			INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
			(mydata, (SELECT NOW()), 'Timecard', new.id, 'employee_id', OLD.employee_id, new.employee_id, 'Update');
		END IF;

		IF (new.info_title != OLD.info_title) THEN
			INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
			(mydata, (SELECT NOW()), 'Timecard', new.id, 'info_title', OLD.info_title, new.info_title, 'Update');
		END IF;

		IF (new.monday != OLD.monday) THEN
			INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
			(mydata, (SELECT NOW()), 'Timecard', new.id, 'monday', OLD.monday, new.monday, 'Update');
		END IF;

		IF (new.tuesday != OLD.tuesday) THEN
			INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
			(mydata, (SELECT NOW()), 'Timecard', new.id, 'tuesday', OLD.tuesday, new.tuesday, 'Update');
		END IF;
        
		IF (new.wednesday != OLD.wednesday) THEN
			INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
			(mydata, (SELECT NOW()), 'Timecard', new.id, 'wednesday', OLD.wednesday, new.wednesday, 'Update');
		END IF;

		IF (new.thursday != OLD.thursday) THEN
			INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
			(mydata, (SELECT NOW()), 'Timecard', new.id, 'thursday', OLD.thursday, new.thursday, 'Update');
		END IF;
        
		IF (new.friday != OLD.friday) THEN
			INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
			(mydata, (SELECT NOW()), 'Timecard', new.id, 'friday', OLD.friday, new.friday, 'Update');
		END IF;

		IF (new.saturday != OLD.saturday) THEN
			INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
			(mydata, (SELECT NOW()), 'Timecard', new.id, 'saturday', OLD.saturday, new.saturday, 'Update');
		END IF;
        
		IF (new.sunday != OLD.sunday) THEN
			INSERT INTO Audit (user_id, changeTime, changedTable, recordId, changedField, oldValue, newValue, extra) VALUES 
			(mydata, (SELECT NOW()), 'Timecard', new.id, 'sunday', OLD.sunday, new.sunday, 'Update');
		END IF;
	END$$