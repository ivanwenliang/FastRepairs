-- Initialize tables
-- System is built for employees to input data

-- cost of parts should be a separate thing upon input

-- ProblemCode(problemCode, description)
 
-- Prices(parts,price)

-- An entry for each item, where machineId serves as an id for that specific machine
-- RepairItems(machineId, model, price, year, serviceContractType)

-- ServiceContract(contractId, startDate, endDate, customerInfo, machineId1, machineId2)

-- RepairJob(machineId, contractId, arrivalTime, ownerInfo, status)

-- RepairPerson(employeeNo, employeeName, phoneNo)

-- CustomerBill(machineId, model, customerName, custPhoneNo, arrivalTime, timeOut, problemCodes, repair-personId, laborHours, partsUsedCost, totalCost)


drop table CustomerBill;
drop table ProblemReport;
drop table ProblemCode;
drop table RepairJob;
drop table RepairPerson;
drop table ServiceContract;
drop table RepairItems;
drop table Customers;


-- Customer(custName, phoneNo)
create table Customers(
    custFirst VARCHAR(15) NOT NULL,
    custLast VARCHAR(15) NOT NULL,
    custPhoneNo NUMERIC(10) PRIMARY KEY,
    custEmail VARCHAR(20)
);


-- Problem Code
-- contains descriptions of problem codes
create table ProblemCode(
    problemCode VARCHAR(30) UNIQUE
);

-- Repair Items(machineID, model, price, phoneNo, serviceContractType)
-- List of individual machines, get info at time of input
create table RepairItems(
    machineID VARCHAR(5) PRIMARY KEY,
    model VARCHAR(35),
    price NUMERIC(7,2),
    custPhoneNo NUMERIC(10),
    problemCode VARCHAR(30),
    serviceContractType VARCHAR(15) CHECK (serviceContractType = 'SINGLE' OR serviceContractType = 'GROUP' OR serviceContractType = 'NONE'),
    contractID VARCHAR(5) DEFAULT NULL,
    foreign key (custPhoneNo) references Customers(custPhoneNo),
    foreign key (problemCode) references ProblemCode(problemCode)
);


-- Service Contract(contractID, startDate, endDate, machienID, machineID2, phoneNo)
create table ServiceContract(
    contractID VARCHAR(5) PRIMARY KEY,
    startDate date NOT NULL,
    endDate date NOT NULL,
    machineID VARCHAR(5) UNIQUE NOT NULL,
    custPhoneNo NUMERIC(10),
    -- contract is either single or group
    serviceContractType VARCHAR(15) CHECK (serviceContractType = 'SINGLE' OR serviceContractType = 'GROUP'),
    foreign key (custPhoneNo) references Customers(custPhoneNo)
);


-- Repair Employee
create table RepairPerson(
    employeeNo VARCHAR(5) PRIMARY KEY,
    employeeFirst VARCHAR(15) NOT NULL,
    employeeLast VARCHAR(15) NOT NULL,
    phoneNo NUMERIC(10)
);


-- Repair Job(machineID, machineID2, contractID, arrivalTime, custPhoneNo, jobstat, employeeNo)
-- DATE FORMAT: DD-MON-YYYY
-- ex: select to_char(sysdate, 'DD-Mon-YYYY HH24:MI') as "Current Time" from dual;
create table RepairJob(
    machineID VARCHAR(5) PRIMARY KEY,
    contractID VARCHAR(5),
    arrivalTime TIMESTAMP, 
    custPhoneNo NUMERIC(10), 
    jobstat VARCHAR(15) DEFAULT 'UNDER_REPAIR' CHECK (jobstat = 'UNDER_REPAIR' OR jobstat = 'READY' OR jobstat = 'DONE'),
    employeeNo VARCHAR(5),
    foreign key (machineID) references RepairItems(machineID),    
    foreign key (contractID) references ServiceContract(contractID),
    foreign key (custPhoneNo) references Customers(custPhoneNo)
);




-- Problem Report
-- Weak Entity depends on RepairJob
create table ProblemReport(
    problemCode VARCHAR(30),
    arrivalTime TIMESTAMP,
    custPhoneNo NUMERIC(10) PRIMARY KEY
    -- foreign key (custPhoneNo) references Customers(custPhoneNo),
    -- foreign key (arrivalTime) references RepairJob(arrivalTime),
);


-- Customer Bill
-- CustomerBill(machineId, model, customerName, custPhoneNo, arrivalTime, timeOut, problemCodes, repair_personId, laborHours, partsUsedCost, totalCost)
-- References most of its content from other tables
create table CustomerBill(
    machineID VARCHAR(5) PRIMARY KEY,
    model VARCHAR(35), 
    custFirst VARCHAR(15),
    custLast VARCHAR(15),
    custPhoneNo NUMERIC(10), 
    arrivalTime TIMESTAMP, 
    timeOut DATE DEFAULT NULL, 
    -- single problem for now
    problemCode VARCHAR(30), 
    repair_personID VARCHAR(5), 
    laborHours NUMERIC(5,2) DEFAULT NULL, 
    partsUsedCost NUMERIC(10,2), 
    totalCost NUMERIC(20,2) DEFAULT NULL,
    foreign key (machineID) references RepairJob(machineID),  
    foreign key (custPhoneNo) references Customers(custPhoneNo),
    foreign key (repair_personID) references RepairPerson(employeeNo)
);
